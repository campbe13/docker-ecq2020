<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/LoginConstants.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/controller/Authentication.php');

/**
 * This API is used to login/logout/register a user in the sticky notes application. 
 * This expects to get a POST request formated as follows:
 */

//Start API
init();

/**
 * Acts as the main function of the API. 
 */
function init(){

    //Got a request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        session_start();
        
        //Are the values set
        if (isset($_POST['method'])){
            
            $method = $_POST['method'];
            
            //User is attempting to login
            if ($method === 'login'){

                loginAPIResponse();

            }
            //User wants to logout
            else if ($method === 'logout'){

                logoutAPIResponse();
            
            }
            //Client wants to know if there is a user already logged in
            else if ($method === 'loggedIn'){

                loggedInAPIResponse();
            
            }
            //User wants to register
            else if ($method === 'register'){
                
                registerAPIResponse();

            }
            //Invalid method
            else {

                    invalidMethodResponse();
            
            }

        }
        else {

            missingParamToPostResponse();

        }

    }
    else {
            
            invalidMethodRequest();
            
    }

}

/**
 * Used to indicate that the wrong method request was used.
 */
function invalidMethodRequest(){

    $return = array(
        'status' => 405,
        'message' => "Method should be a post"
    );

    http_response_code(405);

    //Send back response to client. 
    print_r(json_encode($return));
    
}

/**
 * Used to notify that the method given was not regonized 
 */
function invalidMethodResponse(){

    $return = array(
        'status' => 400,
        'message' => "Bad method given"
        );

    http_response_code(400);

    //Send back response to client. 
    print_r(json_encode($return));

}

/**
 * Used to indicate there was an issue with the method given in the request. 
 */
function missingParamToPostResponse(){

    $return = array(
        'status' => 400,
        'message' => "Missing params to post."
    );

    http_response_code(400);

    //Send back response to client. 
    print_r(json_encode($return));

}

/**
 * Used to handle the register API response. 
 * This method assumes the request method is used.
 */
function registerAPIResponse(){
    
    $authentication = new Authentication();
    
    if(isset($_POST['username'], $_POST['password'])){
                
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Username is too long or short
        if(strlen($username) > 50 || strlen($username) < 1){

            $return = array(
                'status' => 409,
                'message' => "Unable to register $username. Username must be between 1 and 50 characters."
            );

            http_response_code(409);

        }
        //Password is too long or short
        else if(strlen($password) > 255 || strlen($password) < 8){

            $return = array(
                'status' => 409,
                'message' => "Unable to register $username. Password must be between 8 and 255 characters."
            );

            http_response_code(409);

        }
        else {

            $registerValidaton = $authentication->register($username, $password);
    
            //Unable to register
            if($registerValidaton === LoginConstants::UNABLE_REGISTER){
                
                $return = array(
                    'status' => 409,
                    'message' => "Unable to register $username. This may be due to the username being already taken or an error."
                );
    
                http_response_code(409);
    
                
            }
            else {
    
                $return = array(
                    'status' => 200 ,
                    'message' => "Register for $username was successful. Please login."
                );
    
                http_response_code(200);
    
            }

        }
    }
    
    //Send back response to client. 
    print_r(json_encode($return));
    
}

/**
 * Used to handle the login API resonse. This assumes the post request has been validated
 */
function loginAPIResponse(){
    
    $authentication = new Authentication();

    if(isset($_POST['username'], $_POST['password'])){
                    
            $username = $_POST['username'];
            $password = $_POST['password'];

            $validaton = $authentication->login($username, $password);

            //Invalid credentials
            if($validaton === LoginConstants::INVALID_CREDENTIALS){
            
                $return = array(
                    'status' => 401 ,
                    'message' => "Invalid credentials!"
                );

                http_response_code(401);

            }
            //User is locked out
            else if ($validaton === LoginConstants::TOO_MANY_BAD_LOGINS){

                $return = array(
                    'status' => 403 ,
                    'message' => "Unable to login please try again later."
                );

                http_response_code(403);

            }
            //Credentials were correct and user is logged in
            else {

            $return = array(
                'status' => 200 ,
                'message' => "Login for $username was successful."
            );

            http_response_code(200);

        }

    }
    else {

        $return = array(
            'status' => 400,
            'message' => "Missing params to post."
        );

        http_response_code(400);

    }

    //Send back response to client. 
    print_r(json_encode($return));

}

/**
 * Used to handle the logout API response. 
 */
function logoutAPIResponse(){
    
    $authentication = new Authentication();

    $authentication->logout(); 

    $return = array(
        'status' => 200 ,
        'message' => "Logout was successful."
    );

    http_response_code(200);

    //Send back response to client. 
    print_r(json_encode($return));

}

/**
 * Used to handle the logged in API response. 
 */
function loggedInAPIResponse(){
    
    $authentication = new Authentication();

    $user = $authentication->checkLoggedIn(); 
        
    if($user != null){

        $return = array(
            'status' => 200,
            'message' => "There is a user logged in",
            'username' => $user->getUsername()
        );

        http_response_code(200);
    
    }
    //Means the user is null 
    else {

        $return = array(
            'status' => 401 ,
            'message' => "There is no user logged in"
        );

        http_response_code(401);

    }

    //Send back response to client. 
    print_r(json_encode($return));

}

?>
