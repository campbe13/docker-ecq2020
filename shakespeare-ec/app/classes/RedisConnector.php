<?php
//A RedisConnector allows to manage connection, disconnection and errors
//to the Redis database.
class RedisConnector {
    
    private $schemeStr;
    private $hostStr;
    private $portNb;
    private $redis;
    
    ////////////////////////////////////////////////////////////////////////////
    //Construct
    ////////////////////////////////////////////////////////////////////////////
    function __construct(){
        $this->schemeStr = "tcp";
        $this->hostStr = "localhost";
        $this->portNb = 6379;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Public methods
    ////////////////////////////////////////////////////////////////////////////
    
    //Returns $redis
    public function connect(){
        require "vendor/autoload.php";
        Predis\Autoloader::register();
        
        $this->redis = new Predis\Client([
            "scheme" => $this->schemeStr,
            "host" => $this->hostStr,
            "port" => $this->portNb]);
            
        return $this->redis;
    }
    
    //Logs error message and exits
    public function error($e){
        error_log('eroor with Redis '. $e->getMessage() );
        exit;
    }
    
    //Unset $redisObjects
    public function disconnect(){
        unset($this->redis);
    }
}

?>