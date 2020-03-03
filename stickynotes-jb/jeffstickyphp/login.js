/**
 * This script is used to handle the authentication and login/logout/registration of the Sticky Note web application. 
 * This works with the login API called login.php.
 */

/**
 * Sends a post request to check if the user can login or not. 
 * If the login is successful it will then load all of the user's sticky notes. 
 * 
 * @param {*} event holding info about the triggered event. 
 */
function login(event) {

    var username = document.getElementById("username-input").value;
    var password = document.getElementById("password-input").value;

    $.ajax({
        type: 'POST',
        url: "login.php",
        async: true,
        data: {
            username: username,
            password: password,
            method: 'login'

        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            if (response.status == 200) {

                loadAllStickyNotesOfUser(username);

                //Change state to logout (remove login and register buttons and add logout)
                document.getElementById("logged-in-userame").innerHTML = escapeInput(username);
                logoutState();

            }
            //Something went wrong with logging in notify user
            else {

                alert(data.message);

            }


        }
    });

    clearLoginFields();

}

/**
 * Used to register a user (aka store their username and password into the database.
 * 
 * @param {*} event holding info about the triggered event. 
 */
function register(event) {

    var username = document.getElementById("username-input").value;
    var password = document.getElementById("password-input").value;

    $.ajax({
        type: 'POST',
        url: "login.php",
        async: true,
        data: {
            username: username,
            password: password,
            method: 'register'

        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            alert(data.message);

            //Register was successful
            if (response.status == 200) {

                clearLoginFields();

            }
        }
    });


}

/**
 * Used to logout a logged in user.
 * 
 * @param {*} event holding info about the triggered event. 
 */
function logout(event) {

    $.ajax({
        type: 'POST',
        url: "login.php",
        async: true,
        data: {

            method: 'logout'

        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            if (response.status == 200) {

                //Remove all stickies on screen
                removeAllStickyNotesFromBoard();

                //Allow user to login again
                loginState();

            }

            //Something went wrong
            else {

                alert("Something went wrong. That is all we know. Go error " + response.status + ". contact web developer Jeffrey Boisvert for more details.");

            }


        }
    });

}

/**
 * Gets the logged in username if not it returns null.
 * 
 * @return logged in username or null if there is no user logged in. 
 */
function getLoggedInUser() {

    //Default to null
    let result = null;

    $.ajax({
        type: 'POST',
        url: "login.php",
        async: false,
        data: {
            method: 'loggedIn'
        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            if (response.status == 200) {

                //Get the username of the logged in user
                result = data.username;

            }
            //User is not logged in or something went wrong.
            else {

                result = null;

            }


        }
    });

    return result;

}