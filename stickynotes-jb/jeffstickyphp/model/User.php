<?php 

/**
 * Class used as a transfer object to encapsulate a user
 */
class User implements JsonSerializable {
        
        private $username; 
        private $badLoginAttempts;
        private $password;
        private $lastLoginTimestamp;

        //Given all params
        function __construct(string $username = '', string $password = '', int $badLoginAttempts = 0, string $lastLoginTimestamp=''){
            
            $this->username = $username;
            $this->password = $password;
            $this->badLoginAttempts = $badLoginAttempts;
            $this->lastLoginTimestamp = $lastLoginTimestamp; 
            
        }
        
        /**
         * Used to get the username of the user
         */
        function getUsername(){
            
            return $this->username;
            
        }
        
        /**
         * Used to get the number of bad logins
         */
        function getNumberOfBadLogins(){
           
           return $this->badLoginAttempts; 
            
        }
        
        /**
         * Used to set the number of bad login events to a new value
         */
        function setNumberOfBadLogins(int $value){
            
            $this->badLoginAttempts = $value;
            
        }
        
        /**
         * Used to get the timestamp of the last bad login
         */
        function getBadLoginTimestamp() : string {
            
            return $this->lastLoginTimestamp;
            
        }
        
        /**
         * Used to get the user's password
         */
        function getPassword() : string{
            
            return $this->password;
            
        }
        
        
        /**
         *Makes a string repersenting the user
         */
        function __toString(){
            
            return "username: {$this->username}, bad login attempts: {$this->badLoginAttempts}, timestamp of last bad login: {$this->lastLoginTimestamp}";
            
        }
        
        /**
         * Return a json version of object
         */
        function jsonSerialize() {
		    return [
		    'username' => $this->username,
		    'bad_login_attempts' => $this->badLoginAttempts,
		    'bad_login_timestamp' => $this->lastLoginTimestamp
		    ];
		    
	    }

        
}