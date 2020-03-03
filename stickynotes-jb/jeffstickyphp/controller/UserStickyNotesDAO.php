<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/UserStickyNotesDAOInterface.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/StickyNote.php');

/**
 * Used to interact with the tables in database
 */
class UserStickyNotesDAO implements UserStickyNotesDAOInterface {
    
    /**
     * Store given user in the database
     * @param user holding information to create the user. 
     */ 
    public function createUser(User $user){
        
        $query = "INSERT INTO users(username, password) VALUES (?, ?)";
        
        try {
            
            $pdo = $this->createPDOObject();
            
            $statement = $pdo->prepare($query);
            
            //Bind values 
            $statement->bindValue(1, $user->getUsername());
            $statement->bindValue(2, $user->getPassword());
            
            $statement->execute(); 
            
            //Successful
            return TRUE;
            
        }
        catch (PDOException $e) {
          
          //Unsuccessful
          return FALSE; 
          
          echo $e->getMessage();
          exit;
        
        } 
    
        
    }
    
    /**
     * Used to get the user with the given username
     * @param username of the user to get. 
     */
    public function getUser(string $username) {
        
        $query = "SELECT * FROM users 
                  WHERE username = ?
                  LIMIT 1"; 
        
    try {
        
        $pdo = $this->createPDOObject();
        
        $statment = $pdo->prepare($query); 
        
        $statment->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        
        $statment->bindValue(1, $username);
        
        $statment->execute();
        
        $resultSet = $statment->fetchAll();
        
        //Means there was no user
        if(empty($resultSet)){
            
            return null;
            
        }
        
        //Return first result
        return $resultSet[0]; 
      
     }
        catch (PDOException $e) { 
          echo $e->getMessage();
          exit;
        } 
        
    }

    /**
     * Used to create a sticky note in the database belonging to the given user. 
     */
    public function createSticky(StickyNote $note){

        $query = "INSERT INTO sticky_notes(username, note, zIndex, topLocation, leftLocation) VALUES (?, ?, ?, ?, ?)";
        
        try {
            
            $pdo = $this->createPDOObject();
            
            $statement = $pdo->prepare($query);
            
            //Bind values 
            $statement->bindValue(1, $note->getUsername());
            $statement->bindValue(2, $note->getNote());
            $statement->bindValue(3, $note->getZIndex());
            $statement->bindValue(4, $note->getTopLocation());
            $statement->bindValue(5, $note->getLeftLocation());
            
            $statement->execute(); 

            //insert was successful get the object
            $stickyNoteId = $pdo->lastInsertId();
            
            $stickyNoteQuery = "SELECT * FROM sticky_notes 
                                WHERE id = ?
                                LIMIT 1"; 

            $stickyNoteStatement = $pdo->prepare($stickyNoteQuery); 
                    
            $stickyNoteStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'StickyNote');

            $stickyNoteStatement->bindValue(1, $stickyNoteId);

            $stickyNoteStatement->execute();

            $resultSet = $stickyNoteStatement->fetchAll();

            //Means there was an error in insert
            if(empty($resultSet)){
            
                return null;
            
            }
        
            //Return first result
            return $resultSet[0]; 
            
            }
        catch (PDOException $e) {
          
          //Unsuccessful
          return null; 
          
          echo $e->getMessage();
          exit;
        
        } 

    }

    /**
     * Used to get all the sticky notes of a given user 
     */
    public function getStickyNotesOfUser(string $user) : array {

        $query = "SELECT * FROM sticky_notes 
                  WHERE username = ?"; 

        try {

            $pdo = $this->createPDOObject();

            $statment = $pdo->prepare($query); 

            $statment->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'StickyNote');

            $statment->bindValue(1, $user);

            $statment->execute();

            $resultSet = $statment->fetchAll();

            //Return first result
            return $resultSet; 

        }
        catch (PDOException $e) { 

            echo $e->getMessage();
            
            //Means there was an error.
            return null; 
            exit;
        
        } 

    }

    /**
     * Used to update a sticky note location 
     */
    public function updateStickyLocation(int $noteId, int $newTop, int $newLeft){

        $query = "UPDATE sticky_notes 
                  SET topLocation = ?, leftLocation = ?
                  WHERE id = ?"; 

        try {

            $pdo = $this->createPDOObject();

            $statment = $pdo->prepare($query); 

            $statment->bindValue(1, $newTop);
            $statment->bindValue(2, $newLeft);
            $statment->bindValue(3, $noteId);

            $statment->execute();
            $rowsAffected = $statment->rowCount();

            //If there were no rows updated there was an issue. 
            if($rowsAffected < 1){

                return FALSE;

            }
            else {

                return TRUE; 

            }

        }
        catch (PDOException $e) { 

            echo $e->getMessage();
            return FALSE;
            exit;

        } 

    }

    /**
     * Used to delete a given sticky from the database
     */
    public function deleteSticky(int $noteId){

        $query = "DELETE FROM sticky_notes WHERE id = ?"; 

        try {

            $pdo = $this->createPDOObject();

            $statment = $pdo->prepare($query); 

            $statment->bindValue(1, $noteId);

            $statment->execute();
            $rowsAffected = $statment->rowCount();

            //If there were no rows deleted there was an issue. 
            if($rowsAffected < 1){

                return FALSE;

            }
            else {

                return TRUE; 

            }

        }
        catch (PDOException $e) { 

            echo $e->getMessage();
            return FALSE;
            exit;

        } 

    }
    
    /**
     * Used to increment the number of invalid logins by the user. 
     */
    public function incrementInvalidLoginAttempts(User $user){

            $query = "UPDATE users 
                      SET badLoginAttempts = ?
                      WHERE username = ?"; 

            try {

                $pdo = $this->createPDOObject();

                $statment = $pdo->prepare($query); 

                $newValue = $user->getNumberOfBadLogins() + 1; 

                $statment->bindValue(1, $newValue);
                $statment->bindValue(2, $user->getUsername());

                $statment->execute();
                $rowsAffected = $statment->rowCount();

                //If there were no rows updated there was an issue. 
                if($rowsAffected < 1){

                    return FALSE;

                }
                else {

                    return TRUE; 

                }

            }
            catch (PDOException $e) { 

                echo $e->getMessage();
                return FALSE;
                exit;

            } 

    }
    
    /**
     * Used to update the last time the user attempted to login 
     */
    public function updateLoginLastAttempt(User $user){

        $query = "UPDATE users 
                  SET lastLoginTimestamp = ?
                  WHERE username = ?"; 

        try {

            $pdo = $this->createPDOObject();

            $statment = $pdo->prepare($query); 

            //Get current timestamp
            $currentTimeStamp = date("Y-m-d H:i:s"); 

            $statment->bindValue(1, $currentTimeStamp);
            $statment->bindValue(2, $user->getUsername());

            $statment->execute();
            $rowsAffected = $statment->rowCount();

            //If there were no rows updated there was an issue. 
            if($rowsAffected < 1){

                return FALSE;

            }
            else {

                return TRUE; 

            }

        }
        catch (PDOException $e) { 

            echo $e->getMessage();
            return FALSE;
            exit;

        } 
        

    }
    
    /**
     * Used to reset the number of bad logins to 0. 
     */
    public function resetInvalidLoginAttempts(User $user){

        $query = "UPDATE users 
                  SET badLoginAttempts = ?
                  WHERE username = ?"; 

        try {

            $pdo = $this->createPDOObject();

            $statment = $pdo->prepare($query); 

            $statment->bindValue(1, 0);
            $statment->bindValue(2, $user->getUsername());

            $statment->execute();
            $rowsAffected = $statment->rowCount();

            //If there were no rows updated there was an issue. 
            if($rowsAffected < 1){

                return FALSE;

            }
            else {

                return TRUE; 

            }

        }
        catch (PDOException $e) { 

            echo $e->getMessage();
            return FALSE;
            exit;

        } 

    }
    
    /**
     * Used to create a pdo object to the given database. 
     */
    private function createPDOObject(){
        
        //Load database credentials
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/database-utils/config.ini");

        $pdo=new PDO("mysql:dbname=".$config['database_name'].";host=".$config['server_name'], $config['user'] , $config['password']); 
            
        //Ensures that exceptions are thrown
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
        
        return $pdo;
        
    }
    
}
