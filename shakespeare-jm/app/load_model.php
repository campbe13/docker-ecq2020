<?php
/**
 *  
 * This file is just used to test for now. 
 * Later this file will be used to create data model for
 * Shakespeare Text Generator. 
 * 
 * @params Command line arguments are passed and hold the values for the CharacterLevelLanguageModel objects
 * @throws InvalidArgumentException If no command line arguments passed 
 * 
 */
include './model/CharacterLevelLanguageModel.php';
include './model/DataStorage.php';

echo 'Starting Shakespeare text model loading.' . PHP_EOL;

//Create data storage object (aka connection)
$dataStorage = new DataStorage();

//Flushed store to ensure to start from scratch 
$dataStorage->flushDataStore();

echo 'Connection to data storage successful. Flushed previous results and now attempting to insert data' . PHP_EOL;

if (isset($argc))
  {
    //Skip first element since just name of script
    for ($i = 1; $i < $argc; $i++)
      {
        
        $model = new CharacterLevelLanguageModel($argv[$i], './data/shakespeare_input.txt');
        
        echo 'Model created with length of key of ' . $argv[$i] . PHP_EOL;
        
        storeModelData($model, $dataStorage);
        
        echo 'Inserting of model data was successful.' . PHP_EOL;
        
      }
  }
else
  {
    throw new InvalidArgumentException('Must provide command line arguments of integers holding the sizes used for the creation of model');
  }

echo 'Inserting of all data was successful terminating program' . PHP_EOL;

/**
 * 
 * Used to store CharacterLevelLanguageModels into a datastorage
 * 
 * @param $givenModel is of type CharacterLevelLanguageModel holding model to be stored
 * @param $datastore is where the $givenModel is stored into of type DataStorage
 * 
 */
function storeModelData($givenModel, $datastore)
  {
    //Get copy of model
    $copyOfModel = $givenModel->getModel();
    
    $modelEncoded = jsonEncodeValues($copyOfModel);
    
    foreach ($modelEncoded as $key => $value)
      {
        $datastore->setValueAndKey($key, $value);
      }
    
  }

/**
 * 
 * Used to json encode all the values of multi-dimension array
 * 
 * @param $givenArray holds the array given as input (multi-dimension)
 * @returns a new associative where the keys points to json encoded strings
 * 
 */
function jsonEncodeValues($givenArray)
  {
    
    $newArray = array();
    
    foreach (array_keys($givenArray) as $key)
      {
        $jsonEncodedValue = jsonEncodeInnerKeysAndValues($givenArray[$key]);
        $newArray[$key]   = $jsonEncodedValue;
      }
    
    return $newArray;
    
  }

/**
 * 
 * Used to json encode a given associative array
 * @param $givenArray holds the array given as input to be converted to json string
 * 
 */
function jsonEncodeInnerKeysAndValues($givenArray)
  {
    return json_encode($givenArray);
  }


?>