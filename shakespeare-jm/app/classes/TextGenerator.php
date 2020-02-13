<?php
include "RedisConnector.php";
include "Constants.php";
    
class TextGenerator {
    
    //Final generated text
    private $text; 
    
    //User-chosen nb of chars to base prediction on
    private $nbOfChars; 

    //Connector to redis database
    private $redisConnector;

    
    ////////////////////////////////////////////////////////////////////////////
    //Construct
    ////////////////////////////////////////////////////////////////////////////
    function __construct($inputedNbOfChars=3){
    
        //Validate $inputedNbOfChars
        if($inputedNbOfChars!=Constants::NB_OF_CHARS_1 
            && $inputedNbOfChars!=Constants::NB_OF_CHARS_2 
            && $inputedNbOfChars!=Constants::NB_OF_CHARS_3){
                throw new InvalidArgumentException("inputedNbOfChars must be ".
                Constants::NB_OF_CHARS_1." or ".Constants::NB_OF_CHARS_2." or ".
                Constants::NB_OF_CHARS_3);
        }
        $this->nbOfChars=$inputedNbOfChars;
        
        //Initialize text
        switch($this->nbOfChars){
            
            case Constants::NB_OF_CHARS_1 :
                $this->text = Constants::INITIAL_TEXT_1;
                break;
                
            case Constants::NB_OF_CHARS_2 :
                $this->text = Constants::INITIAL_TEXT_2;
                break;
                
            case Constants::NB_OF_CHARS_3 : 
                $this->text = Constants::INITIAL_TEXT_3;
                break;
        }
        
        //Initialize connector to redis
        $this->redisConnector = new RedisConnector();
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Public methods
    ////////////////////////////////////////////////////////////////////////////
    //Returns the generated text
    public function createText(){
        //Generate a new character until desired length reached
        for($i=0; $i< Constants::FINAL_TEXT_LENGTH; $i++){
            $this->addIndividualChar();
        }
        return $this->text;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Helper methods
    ////////////////////////////////////////////////////////////////////////////
    //Adds one char based on the last sequence of $nbOfChars of $this->text
    //and the probabilities stored in database
    private function addIndividualChar(){
        //Get the last n characters of the text
        $lastCharSequence = substr($this->text, -($this->nbOfChars), $this->nbOfChars);

        //Query predis to find all the charaters that follow and their probability
        //Connect to Predis and get values for the key/sequence of chars
        $encodeValue;
        try {
            $redis = $this->redisConnector->connect();
            $encodedValue = $redis->get($lastCharSequence);
        } catch (Exception $e){
            //Exit
            $this->redisConnector->error($e);
        } finally {
            $this->redisConnector->disconnect();
        }
        
        //Process encoded probability array
        $probabilityArray;
        
        //If returned array was null
        if(is_null($encodedValue)){
           //This should never happen.
           $char="a";
        } 
        //If returned array contains the keys with their probability
        else {
            //Decode array
            $probabilityArray=json_decode($encodedValue);
            
            //Generate random float between 0 and 1
            $probabilityFloat=rand()/getrandmax();
       
            //Go through the array and find character which have the closest
            //probability to the generated probability
            $char="a";
            $difference=0;
            $smallestDifference=1;//as all probabilities are less than 1
            
            
            foreach($probabilityArray as $key=>$keyProbability){
                $difference=abs($probabilityFloat-$keyProbability);
                if($difference<$smallestDifference){
                    $char=$key;
                    $smallestDifference=$difference;
                }
            }
        }
        $this->text.=$char;
    }
}
?>