/**
 * This script is used to interact with the StickyNotesAPI.php file to interact with the backend to retrieve data about sticky notes. 
 */

/**
 * Handles interacting with the StickyNotesAPI to delete the given sticky note element from the database. 
 * 
 * @param {*} stickyNoteElement holds reference to the html element assiocated to the sticky note.
 * @return true if the delete was sucessful and false if it wasn't.
 */
function deleteFromDatabase(stickyNoteElement) {

    //Default to false
    let result = false;

    let username = document.getElementById("logged-in-userame").innerText;

    $.ajax({
        type: 'POST',
        url: "StickyNotesAPI.php",
        async: false,
        data: {
            username: username,
            noteId: stickyNoteElement.id,
            method: 'delete',
        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            if (response.status == 200) {

                result = true;

            }

            //Something went wrong
            else {

                alert(data.message);
                result = false;

            }


        }
    });

    return result;

}

/**
 * Used to create a sticky note in the backend using the StickyNoteAPI.php.
 *  
 * @param {*} username that the sticky note belongs to
 * @param {*} note that is written in the sticky note
 * @param {*} zIndex of the sticky note
 * @param {*} topLocation of sticky note
 * @param {*} leftLocation of sticky note
 * @return {*} JSON object holding data about the sticky note and null otherwise
 */
function createStickyNote(username, note, zIndex, topLocation, leftLocation) {

    //Default to false
    let result = null;

    $.ajax({
        type: 'POST',
        url: "StickyNotesAPI.php",
        async: false,
        data: {
            username: username,
            note: note,
            method: 'create',
            topLocation: topLocation,
            leftLocation: leftLocation,
            zIndex: zIndex
        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            //It worked
            if (response.status == 200) {

                //Result holds the sticky note made
                result = JSON.parse(data.stickyNote);

            }

            //Something went wrong
            else {

                alert(data.message);
                result = null;

            }


        }
    });

    return result;

}

/**
 * Used to update the position of the sticky note in the database using the StickyNotesAPI. 
 * 
 * @param {*} stickyId to know which sticky to update 
 * @param {*} topLocation holding the new top location 
 * @param {*} leftLocation holding the new left location
 */
function updateStickyLocationInDatabase(stickyId, topLocation, leftLocation) {

    let username = document.getElementById("logged-in-userame").innerText;

    $.ajax({
        type: 'POST',
        url: "StickyNotesAPI.php",
        async: true,
        data: {
            username: username,
            method: 'update',
            noteId: stickyId,
            leftLocation: leftLocation,
            topLocation: topLocation
        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            //Credentials were invalid
            if (response.status == 401) {

                alert(data.message);

            }

        }
    });

}

/**
 * Handles call to API to get all the sticky notes. 
 * Returns the json response or null if nothing was found due to an error.
 *  
 * @param {*} username of the owner of sticky notes to get. 
 */
function getStickyNotesOfUser(username) {

    //Default to false
    let result = null;

    $.ajax({
        type: 'GET',
        url: "StickyNotesAPI.php",
        async: false,
        data: {
            username: username,
            method: 'retrieve'
        },
        complete: function(response, textStatus) {

            let data = JSON.parse(response.responseText);

            if (response.status == 200) {

                //Result holds the sticky note made
                result = JSON.parse(data.stickyNotes);

            }

            //Credentials were invalid
            else if (response.status == 401) {

                alert(data.message);
                result = null;

            }


        }
    });

    return result;

}