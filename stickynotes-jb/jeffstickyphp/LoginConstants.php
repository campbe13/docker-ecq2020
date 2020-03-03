<?php

/**
 * Used as a way to know what errors occured when sending and recieveing data about login
 */
abstract class LoginConstants {

    const USER_ALREADY_TAKEN = -1; 
    const INVALID_CREDENTIALS = -2; 
    const USER_LOCKED_OUT = -3; 
    const USER_LOGGED_IN = -4; 
    const UNABLE_REGISTER = -5; 
    const REGISTER_SUCCESSFUL = -6; 
    const TOO_MANY_BAD_LOGINS = -99; 
    
}
?>
