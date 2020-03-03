<?php

require_once ('UserStickyNotesDAO.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/model/User.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/LoginConstants.php');

/** 
  * This class is responsible for registration and login.
  * It is assumed that the client of this class has started the session 
  * before using an object of this class.
  *
  * Credit to Jaya Nilakantan for skeleton of code.
  */
class Authentication {
	
	/** 
     * Registers a user with a username and password. Additional fields need to be added as
	 * parameters, or pass a User object with all required attributes
     */
	public function register($username, $password) {
		
		$dao =  new UserStickyNotesDAO();
        
        //If a user is found it means the username is already taken. 
		if ($user = $dao->getUser($username)){
			
			return LoginConstants::UNABLE_REGISTER;
			
		}

		$hash = password_hash($password, PASSWORD_DEFAULT);
        
        //Create a user to pass. 
		$user = new User($username, $hash);
        
        //If able to register user return true else return false. 
		if ($dao->createUser($user)) 
		{

			return LoginConstants::REGISTER_SUCCESSFUL;
			
		}
        
        //DAO was unable to create the user.
		return LoginConstants::UNABLE_REGISTER; 
		
		
	}
		
    /**
     * Login the user with the given username and password. 
     */
	public function login($username, $password){
		
		$dao = new UserStickyNotesDAO();
		
		$user = $dao->getUser($username);
        
        //DAO did not find a match, returned null
	    if (!$user) {
            return LoginConstants::INVALID_CREDENTIALS;
        }
		  
	    //use DAO to get check login attempts
		//user made more than 3 consecutive invalid login attempts and has not waited 5 minutes.
		if ( ($user->getNumberOfBadLogins() >= 3) && ((strtotime($user->getBadLoginTimestamp()) + 60*5) >  strtotime('now') ) ) { 
			
			// not allowed to login
			return LoginConstants::TOO_MANY_BAD_LOGINS; 
		
				
		}

	    //Try to authenticate user, update last login attempt time
        $hash = $user->getPassword();
        
		//check clear text against hash
	    if (!password_verify($password, $hash) ) {
	    	
			//Increment attempts and update the last time they tried to login
			$dao->incrementInvalidLoginAttempts($user);
			$dao->updateLoginLastAttempt($user);
		    return LoginConstants::INVALID_CREDENTIALS; 
	    }
	    
		//good password so reset attempts back to 0
	    $dao->resetInvalidLoginAttempts($user);
		
		//put $user name in session, this is how we check that the user has logged in
		$this->saveInSession($user);

        return LoginConstants::USER_LOGGED_IN;
        
	}
	
	/** Helper function to save authenticated user in session.
	**/
	private function saveInSession(User $user) {
		
		//assume the client code already started the session
		$_SESSION['username'] = $user->getUsername();
		
		//always regenerate the session identifier when authorization levels change
		session_regenerate_id(); 
	
		
	}
	
    /**
     * Validated if there is a user logged in. 
     * @return if there is it returns the user object if not it returns null
     */
	public function checkLoggedIn() {
		
		//assume the client code already started the session
		if (isset($_SESSION['username'])) {
			
			$config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/database-utils/config.ini");
			
			//get User object
            $dao =  new UserStickyNotesDAO($config['server_name'], $config['user'], $config['password'], $config['database_name']);
            
            $user = $dao->getUser($_SESSION['username']);

            //If user is null it means there is no user of that name return false. 
            if (!$user){

                return null;

            }

            //User is not null
			return $user;
			
		}
        
        //No user is logged in 
		return null;
	
		
	}
	
    /**
     * Used to destroy the session and cookie. Assumes a session was already created.
     */
	public function logout() {
		
		//destroy the cookie
		setcookie(session_name(),'', time() - 42000);

		// Destroy session
        session_destroy();
		
	}
}
