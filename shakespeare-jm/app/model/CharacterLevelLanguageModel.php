<?php

/**
 * 
 * Character Level Language Model is used to predct the next character 
 * given the next character. This class will be respobsible of 
 * creating a an associative array of associative arrays repersenting
 * a sequence of K characters and giving probablity of the next character.
 * 
 * @author Jeffrey Boisvert 1610878
 * 
 */
class CharacterLevelLanguageModel
{
    private $model;
    private $lengthOfKeyModel;
    
    /**
     *
     * Constructor used to build the CharacterLevelLanuguageModel
     * 
     * @param $givenLengthOfKeyModel Length of key in charactr model (so 3 characters is default)
     * @param $fileName Is the name of the file to be read to build model. 
     * @throws InvalidArgumentException If $fileName is not assigned
     * 
     */
    function __construct($givenLengthOfKeyModel = 3, $fileName = '') 
    {
        
        $this->lengthOfKeyModel = $givenLengthOfKeyModel;
        $this->model = array(); 
        
        if ($fileName === ''){
            throw new InvalidArgumentException("Must provide a text file (cannot be blank provide path to file)");
        }
        
        $this->trainModel($fileName);
        
    }
    
    /**
     *
     * Helper function used to train model based on given file name. 
     * It will add values to $model member
     * 
     * @param $fileName Is the name of the file to be read to build model
     * 
     */
    private function trainModel($fileName)
    {
        
        //Get data
        $stringContentOfFile = file_get_contents($fileName);
        
        //Set counts 
        $this->goThroughStringAndSetKeysAndCounts($stringContentOfFile);

        //Set chance based on counts
        $this->addProbabilitiesToModel();
        
    }
    
    /**
     * 
     * Used to take a character level language model that has been counted and then assign probabilties
     * for each inner key for the main key. Probabilitys are rounded to second decimal place
     * 
     * @throws UnexpectedValueException when model is empty and not yet set
     * @throws InvalidArgumentException when the sum of probabilities is not equal to 1.0 
     * 
     */
    private function addProbabilitiesToModel()
    {
        
        if (empty($this->model))
        {
            throw new UnexpectedValueException("Model currently has no keys and is empty"); 
        }
        
        foreach(array_keys($this->model) as $clustOfLetters)
        {
            $numberOfNextLetters = array_sum($this->model[$clustOfLetters]); 
            
            //Used to sum the probabilities together to then check if it is equal to 1.0
            $sum = 0.0; 
            
            //Go through each clust of words and divide the number of occurances of the next letter by the total number of letters possible
            //then assign probability
            foreach ($this->model[$clustOfLetters] as $nextLetter => $numberOfOccurances)
            {
                
                $probability = ($numberOfOccurances / $numberOfNextLetters);
                $sum += $probability; 
                $this->model[$clustOfLetters][$nextLetter] = $probability; 
                
            }

        }
        
    }
    
    
    /**
     * 
     * Used to break the given line into parts based on $lengthOfKeyModel
     * and then assign it to model the key along with another assiocated array
     * where the the other key points at the number occurances of the next letter
     * after the main key
     * 
     * @param $line is the string of of the line given
     * 
     */
    private function goThroughStringAndSetKeysAndCounts($line) 
    {
        
        $arrayOfCharacters = str_split($line);
        
        //Will be used to append $lengthOfKeyModel characters to string     
        $stringContainer = '';
        
        foreach($arrayOfCharacters as $character)
        {
            
            if(strlen($stringContainer) == $this->lengthOfKeyModel)
            {
                
                //Apply logic of updating model
                $this->updateModel($stringContainer, $character);
                   
                //Remove first string creating idea of shift
                $stringContainer = substr($stringContainer, 1);

            }

            $stringContainer.=$character;
            
        }
        
    }
    
    /**
     * Used to apply logic of updating the $model
     * 
     * @param $key First key for the model at the first dimension
     * @param $innerKey Second key for the model at the first key's array (second dimension)
     * 
     */
    private function updateModel($key, $innerKey)
    {
        
        //Do both keys exist? 
        if(array_key_exists($key, $this->model) && array_key_exists($innerKey, $this->model[$key]))
        {
            $this->model[$key][$innerKey] = $this->model[$key][$innerKey] + 1;

        }
        //One of the keys does not exist (or both) so set count to 1
        else
        {
            $this->model[$key][$innerKey] = 1;

        }
        
    }
    
    /**
     * 
     * Getter for $model
     * 
     * @return Copy of array of $model
     * 
     */
    public function getModel() : array
    {
        
        //Is there reference issues here? 
        return $this->model; 
        
    }
    
}

?>