<?php
include "Constants.php";
include "RedisConnector.php";

class RedisDataLoader {
    
    private $redisConnector;
    private $redis;

    function __construct(){
        //Get reference to Redis Connector
        $this->redisConnector = new RedisConnector();
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Main Load Function
    ////////////////////////////////////////////////////////////////////////////
      function loadData($fileNameStr){
        //Validate $fileNameStr
        if(is_null($fileNameStr) || !isset($fileNameStr)){
            throw new InvalidArgumentException("File name must be a non-empty string");
        }
        
        try {
            $this->redis = $this->redisConnector->connect();
            
            //Flush
            $this->redis->flushAll();
            print "\nDatabase Flushed\n";
            
            $this->loadFor($fileNameStr, Constants::NB_OF_CHARS_1);
            $this->loadFor($fileNameStr, Constants::NB_OF_CHARS_2);
            $this->loadFor($fileNameStr, Constants::NB_OF_CHARS_3);
            
        } catch (Exception $e){
            $this->redisConnector->error($e); //exits
        } finally {
            $this->redisConnector->disconnect();
        }
        
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Helper functions
    ////////////////////////////////////////////////////////////////////////////
    private function loadFor($fileNameStr, $nbOfChars){
        echo "\nLoading Database For: ".$nbOfChars." characters\n";
        echo "Start Time: ". date("i:sa")."\n";
        //fileNameStr validated in loadData()
        
        //Validate $nbOfChars
        if($nbOfChars!=Constants::NB_OF_CHARS_1 
            && $nbOfChars!=Constants::NB_OF_CHARS_2 
            && $nbOfChars!=Constants::NB_OF_CHARS_3){
                throw new InvalidArgumentException("nbOfChars must be ".
                Constants::NB_OF_CHARS_1." or ".Constants::NB_OF_CHARS_2." or ".
                Constants::NB_OF_CHARS_3);
        }
        
        //Load
        $frequency_array =  $this->read_file($fileNameStr, $nbOfChars, 'r');
                
        $keys = array_keys($frequency_array);
                
        foreach($keys as $key) {
            $this->redis->set($key, $frequency_array[$key]);
        }
        echo "End Time: ". date("i:s")."\n";
    }

    
    /**
     * Reads a text file of given name, generates an array of a all characters in sets of n size and then gets the number of instances of each character following, then uses those counts to generate a frequency
     * @param $fname              The name of the file to read
     * @param $order              The size of the character history
     * @param $read_mode          The file access mode
     * 
     * @return                    A multidimensional array of chunks of n characters ($order) with all following characters and the number of occurrences.
     */
    function read_file($fname, $order, $read_mode = "r") {
        //Declare output variable
        $output = array();
        $counter = 0;
        
        //Validate input
        if (!empty($fname)) {
            if ($read_mode === "r" || $read_mode === "r+" || $read_mode === "w") {
                
                //Searchable data
                $filedata = file_get_contents($fname);
                
                
                //Get empty associative array with keys
                $assoc =  $this->generate_keys($filedata, $order);
                
                
                //Generate sub-arrays based on associative array above
                $char_counts =  $this->count_following($filedata, $order, $assoc);
                
                //Use char_counts to get the frequency of characters rather than just their counts
                $char_keys = array_keys($char_counts);
                
                foreach($char_keys as $current_key) {
                    $char_counts[$current_key] = $this->generate_frequencies($char_counts[$current_key]);
                }
                
                //JSON encode subarrays
                foreach($char_keys as $current_key) {
                    $char_counts[$current_key] = json_encode($char_counts[$current_key]);
                }
                
                $output = $char_counts;
                
            }
        }
        return $output;
    }
    
    
    /**
     * A method to generate an associative array of empty sub-arrays based on an input string.
     * @param $haystack         The string to sift
     * @param $order            The size of the character set to use as a key
     * 
     * @return                  An associative array with substrings of n characters as keys
     */
    private   function generate_keys($haystack, $order) {
        //Current charset tracker
        $current_charset = '';
        
        //Output array
        $output = array();
                
        //Ensure searchable data can be generated
        if ($haystack !== FALSE && $haystack != NULL) {
            //Loop through all data
            for ($i = 0; $i < strlen($haystack) - $order; $i++) {
                //Set charset
                $current_charset = substr($haystack, $i, $order);
                        
                //Ensure key does not already exist; if it does not, generate new array
                if(!(array_key_exists($current_charset, $output))) {
                    $output[$current_charset] = array();
                }
            }
        }
        return $output;
    }
    
    /**
     * Takes an associative array of all possible substrings of size in a given input text string and uses these substrings to generate sub-arrays listing all characters following said substrings,
     * as well as the frequencies of these characters.
     * @param $haystack         A string containing the full input text.
     * @param $order            The size of the substrings
     * @param $array            The associative array to modify.
     * 
     * @return                  A multidimensional associative array of substrings and all characters found to follow any instance of those substrings, as well as the number of times those characters appear.
     */
    private   function count_following($haystack, $order, $array) {
        $current_charset = '';
        
        $following = '';
        
        $output = $array;
        
        //Iterate through and count following letters
        for ($i = 0; $i < (strlen($haystack) - $order); $i++) {
            //Get the current character set
            $current_charset = substr($haystack, $i, $order);
                        
            //Get the character immediately following the current set
            $following = substr($haystack, $i+$order, 1);
                        
            //If key has already been entered in sub-array, increment counter, else create new sub-array
            if (array_key_exists($following, $output[$current_charset])) {
                $output[$current_charset][$following]++;
            } else {
                $output[$current_charset][$following] = 1;
            }
        }
        return $output;
    }
    
    /**
     * Uses a subarray of all characters + counts to calculate the frequency with which a given character appears in a given array.
     * @param $array                             An associative array - a character as key, a number representing the number of times the character appears as value.
     * 
     * @return                                   The input array, adjusted such that the values are no longer the number of times the character appears but rather the frequency with which it appears.
     */
    private   function generate_frequencies($array) {
        //Get all keys
        $keys = array_keys($array);
        
        //Total counter
        $total = 0;
        
        //Get the total number of characters found
        foreach ($array as $value) {
            $total+=$value;
        }
        
        //Use total to generate frequencies
        foreach($keys as $key) {
            $array[$key] = $array[$key] / $total;
        }
        return $array;
    }
}
?>