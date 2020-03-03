<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Authentication.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/UserStickyNotesDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/StickyNote.php');

/**
 * This API is used to retireve all sticky notes, create a sticky note, move an existing sticky note (update location) and delete a sticky note.
 * Each function is documented with expected request method and what is expected as input.
 * The API assumes a logged in session is active.
 */

//Call main app
init();

/**
 * Acts as the main of the program.
 */
function init() {
    
    //Got a POST request (all functions related to post)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        session_start();
        $authentication = new Authentication();

        //Is the method set
        if ($_POST['method']) {

            $method = $_POST['method'];
            //User is attempting to create a sticky note
            if ($method === 'create') {
                createAPIResponse();
            }
            //User is attempting to delete the sticky note
            else if ($method === 'delete') {
                deleteAPIResponse();
            }
            //User is attempting to update the location of a sticky note
            else if ($method === 'update') {
                updateAPIResponse();
            }
            //Invalid method
            else {
                badMethodResponse();
            }

        } else {

            badMethodResponse();

        }
    }
    //Got a GET request (all methods regarding a GET request)
    else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        session_start();
        $authentication = new Authentication();

        //Is the method set
        if (isset($_GET['method'])) {

            $method = $_GET['method'];
            //User is attempting to get all the sticky notes of a user
            if ($method === 'retrieve') {
                retrieveAPIResponse();
            } else {
                badMethodResponse();
            }
        } else {

            badMethodResponse();

        }
    }
    //Incorrect request method used
    else {

        badRequestMethod();
        
    }
}

/**
 * Used to indicate that the request method must be a POST or a GET.
 */
function badRequestMethod() {
    $return = array('status' => 405, 'message' => "Request method should be a POST or GET.");
    http_response_code(405);
    //Send back response to client.
    print_r(json_encode($return));
}

/**
 * Used to respond that the method given is incorrect.
 */
function badMethodResponse() {
    $return = array('status' => 400, 'message' => "Bad method given $method. Do not regonize this as a valid method. Please read API documentation");
    http_response_code(400);
    //Send back response to client.
    print_r(json_encode($return));
}

/**
 * Used to do action related to creating a Sticky Note.
 * This assumes checking for the post request was already done.
 */
function createAPIResponse() {
    //Did the user provide everything to create a sticky.
    if (isset($_POST['note'], $_POST['topLocation'], $_POST['leftLocation'], $_POST['zIndex'], $_POST['username'])) {
        //Must be logged in
        if ($_SESSION['username'] != $_POST['username'] || !isset($_SESSION['username'])) {
            $return = array('status' => 401, 'message' => "You must be logged in to create a sticky note.");
            http_response_code(401);
        } else {

            //Message is too long
            if (strlen($_POST['note']) > 500) {
                $return = array('status' => 409, 'message' => "The note is too long. The note must be between 1 and 500 characters.");
                http_response_code(409);
            } else {

                $dao = new UserStickyNotesDAO();
                //Create a stiky note to send to the dao
                $stickyNote = new StickyNote(-1, $_POST['username'], $_POST['note'], $_POST['zIndex'], $_POST['topLocation'], $_POST['leftLocation']);
                $dbStickyNote = $dao->createSticky($stickyNote);

                if ($dbStickyNote) {
                    $return = array('status' => 200, 'message' => "Sticky note was stored in data base successfully", 'stickyNote' => json_encode($dbStickyNote));
                    http_response_code(200);
                }
                //Something went wrong
                else {
                    $return = array('status' => 500, 'message' => "We were unable to create the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.");
                    http_response_code(500);
                }
                
            }
        }
    }
    //did not provide everything
    else {
        $return = array('status' => 400, 'message' => "Missing information.");
        http_response_code(400);
    }
    //Send back response to client.
    print_r(json_encode($return));
}

/**
 * Used to do action related to deleting a Sticky Note.
 * This assumes checking for the post request was already done.
 */
function deleteAPIResponse() {
    
    //Did the user provide everything to create a sticky.
    if (isset($_POST['noteId'], $_POST['username'])) {

        //Must be logged in
        if ($_SESSION['username'] != $_POST['username'] || !isset($_SESSION['username'])) {
            $return = array('status' => 401, 'message' => "You must be logged in to delete a sticky note.");
            http_response_code(401);
        } else {

            $dao = new UserStickyNotesDAO();
            $wasStickyDeleted = $dao->deleteSticky($_POST['noteId']);

            if ($wasStickyDeleted) {
                $return = array('status' => 200, 'message' => "Sticky note was deleted in database successfully",);
                http_response_code(200);
            }
            //Unable to delete
            else {
                $return = array('status' => 500, 'message' => "We were unable to delete the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.");
                http_response_code(500);
            }

        }
    }

    //did not provide everything
    else {
        $return = array('status' => 400, 'message' => "Missing information.");
        http_response_code(400);
    }

    //Send back response to client.
    print_r(json_encode($return));
    
}

/**
 * Used to handle the update api request of a sitcky note location.
 * This assumes checking for the post request was already done.
 */
function updateAPIResponse() {
    
    //Did the user provide everything to create a sticky.
    if (isset($_POST['noteId'], $_POST['username'], $_POST['leftLocation'], $_POST['topLocation'])) {
        //Must be logged in
        if ($_SESSION['username'] != $_POST['username'] || !isset($_SESSION['username'])) {
            $return = array('status' => 401, 'message' => "You must be logged in to update a sticky note.");
            http_response_code(401);
        } else {

            $dao = new UserStickyNotesDAO();
            $wasStickyUpdated = $dao->updateStickyLocation($_POST['noteId'], $_POST['topLocation'], $_POST['leftLocation']);

            if ($wasStickyUpdated) {
                $return = array('status' => 200, 'message' => "Sticky note was updated in database successfully",);
                http_response_code(200);
            }
            //Unable to delete
            else {
                $return = array('status' => 500, 'message' => "We were unable to update the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.");
                http_response_code(500);
            }
        }
    }
    //did not provide everything
    else {
        $return = array('status' => 400, 'message' => "Missing information.");
        http_response_code(400);
    }
    //Send back response to client.
    print_r(json_encode($return));

    
}

/**
 * Used to handle the GET reuqest to retireve all of the user's sticky notes.
 * Assumes checks for get request were already done.
 */
function retrieveAPIResponse() {
    
    //Did the user provide everything
    if (isset($_GET['username'])) {

        //Must be logged in
        if ($_SESSION['username'] != $_GET['username'] || !isset($_SESSION['username'])) {
            $return = array('status' => 401, 'message' => "You must be logged in to get all sticky notes.");
            http_response_code(401);
        } else {

            $dao = new UserStickyNotesDAO();
            $stickyNotes = $dao->getStickyNotesOfUser($_GET['username']);

            if ($stickyNotes) {
                $return = array('status' => 200, 'message' => "Got all the sticky notes successfully for " . $_GET['username'], 'stickyNotes' => json_encode($stickyNotes));
                http_response_code(200);
            }
            //Something went wrong
            else {
                $return = array('status' => 500, 'message' => "We were unable to retireve all the sticky notes. Please contact the developer Jeffrey Boisvert for more infomation.");
                http_response_code(500);
            }
        }
    }
    //did not provide everything
    else {
        $return = array('status' => 400, 'message' => "Missing information.");
        http_response_code(400);
    }
    //Send back response to client.
    print_r(json_encode($return));

    
}
?>
