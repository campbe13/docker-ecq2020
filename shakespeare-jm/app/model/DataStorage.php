<?php

require dirname(__FILE__)."/../vendor/predis/predis/autoload.php";
Predis\Autoloader::register();

/**
 * 
 * DataStorage is used to store/retrieve data (key value pairs) in a
 * external data storage source. This class is used to encapsulate behavior
 * 
 * @author Jeffrey Boisvert 1610878
 * 
 */ 
class DataStorage
{
    private $database; 
    
    /**
     * 
     * Default constructor used to intialize connection to data storage being used
     * 
     */ 
    function __construct()
    {
        try 
        {   
            
            $this->database = new Predis\Client( [     
                "scheme" => "tcp",     
                "host" => "localhost",     
                "port" => 6379] );
            
        }
       catch (Exception $e)
        {        
            error_log('error with Redis '. $e->getMessage() );     
            exit; 
           
        } 
    }
    
    /**
     * 
     * Gets the value stored in database associated to the given key
     * 
     * @params $givenKey holds a key value to retireve from database
     * 
     */
    public function getValueFromKey($givenKey)
    {
        $value = $this->database->get($givenKey); 
        return $value; 
    }
    
    /**
     * 
     * Sets the value in the database associated to the given key
     * 
     * @params $givenKey holds a key value to store into database
     * @params $givenValue holds a value to to store in database with $givenKey
     * 
     */
    public function setValueAndKey($givenKey, $givenValue)
    {
        $this->database->set($givenKey, $givenValue); 
    }
    
    /**
     * 
     * Flushes the database being used (empties it)
     *
     */
    public function flushDataStore()
    {
        $this->database->flushAll(); 
    }
    
}

?>