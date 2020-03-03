<?php 

/**
 * Class used as a transfer object to encapsulate a sticky note
 */
class StickyNote implements JsonSerializable {
        
        private $id; 
        private $username; 
        private $note; 
        private $zIndex; 
        private $topLocation; 
        private $leftLocation;

        /**
         * Default constrcutor which sets all fields to default values. 
         */
        function __construct(int $id = -1, string $username = '', string $note = '', int $zIndex = 1, int $topLocation = 0, int $leftLocation = 0){
            
            $this->id = $id; 
            $this->username = $username; 
            $this->note = $note; 
            $this->zIndex = $zIndex; 
            $this->topLocation = $topLocation; 
            $this->leftLocation = $leftLocation; 
            
        }

        /**
         * Used to get the id of the sticky note 
         */
        function getId(){

            return $this->id; 

        }
        
        /**
         * Used to get the username of the user
         */
        function getUsername(){
            
            return $this->username;
            
        }

        /**
         * Used to get the note of the sticky note. 
         */
        function getNote(){

            return $this->note; 

        }

        /**
         * Used to get the z index of the sticky note (what layer does it need to be at in the front end)
         */
        function getZIndex(){

            return $this->zIndex; 

        }

        /**
         * Used to get the top location of the sticky note. 
         */
        function getTopLocation(){

            return $this->topLocation; 

        }

        /**
         * Used to get the left location of the sticky note. 
         */
        function getLeftLocation(){

            return $this->leftLocation; 

        }
        
        
        /**
         *Makes a string repersenting the user
         */
        function __toString(){
            
            return "id: {$this->id}, belongs to: {$this->username}, with contents: {$this->note}, z index of: {$this->zIndex}, top location of {$this->topLocation}, left location of: {$this->leftLocation}";
            
        }
        
        /**
         * Return a json version of object. 
         */
        function jsonSerialize() {
		    return [
            'id' => $this->id,
		    'username' => $this->username,
		    'note' => $this->note,
            'zIndex' => $this->zIndex,
            'topLocation' => $this->topLocation,
            'leftLocation' => $this->leftLocation
		    ];
		    
	    }

        
}