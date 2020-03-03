//Global variables for dragging
var pos1 = 0,
    pos2 = 0,
    pos3 = 0,
    pos4 = 0;

var boardNameSpace = {};
boardNameSpace.nextZIndex = 2;

//Waiting for document to be fully loaded    
if (document && document.addEventListener) {

    //When the dom is loaded this will be called
    document.addEventListener("DOMContentLoaded", function(event) {

        init();

    });
}
//Done for older version of Opera (6 and lower) and IE 8 and lower
else if (document && document.attachEvent) {

    document.attachEvent("on" + "DOMContentLoaded", function(event) {

        window.scrollTo(0, document.body.scrollHeight);

    }, false);

}

/**
 * Main of the script. Is called once the page has been fully loaded. 
 */
function init() {

    addEventListeners();

    let userLoggedIn = getLoggedInUser()

    //No user was logged in
    if (userLoggedIn == null) {

        loginState();

    } else {

        //Change logged in user text to the given username
        document.getElementById("logged-in-userame").innerHTML = escapeInput(userLoggedIn);

        //Load all the stickies of the user
        loadAllStickyNotesOfUser(userLoggedIn);

        //Set to logout state
        logoutState();

    }

}

/**
 * Ensures the login and register buttons and the text input fields for username and password are shown. 
 * Also ensures that the logged in username field and the logout button are not shown. 
 */
function loginState() {

    document.getElementById("login-btn").style.display = "block";
    document.getElementById("register-btn").style.display = "block";
    document.getElementById("username-input").style.display = "block";
    document.getElementById("password-input").style.display = "block";

    document.getElementById("logged-in-userame").style.display = "none";
    document.getElementById("logout-btn").style.display = "none";

    //User cannot add a sticky until logged in 
    document.getElementById("add-sticky-btn").disabled = true;
    closeStickyNoteForm(null);

}

/**
 * Used to remove the login button, register button and the username and password inputs but show the logged in username and the logout button. 
 */
function logoutState() {

    document.getElementById("login-btn").style.display = "none";
    document.getElementById("register-btn").style.display = "none";
    document.getElementById("username-input").style.display = "none";
    document.getElementById("password-input").style.display = "none";

    document.getElementById("logged-in-userame").style.display = "block";
    document.getElementById("logout-btn").style.display = "block";

    //User can now add sticky
    document.getElementById("add-sticky-btn").disabled = false;

}


/**
 * Used to take care of the logic of assigning event handlers. 
 */
function addEventListeners() {

    addUIEventHandlers();

}

/**
 * Used to add an onclick event handler to the add-sticky-btn. 
 * This will allow the user to be able to make sticky elements. 
 */
function addUIEventHandlers() {

    addEventHandlersForCreateStickyForm();
    addEventHandlersForLoginForm();

}

/**
 * Handles adding event handlers for form. 
 */
function addEventHandlersForLoginForm() {

    document.getElementById("login-btn").addEventListener("click", login);
    document.getElementById("register-btn").addEventListener("click", register);
    document.getElementById("logout-btn").addEventListener("click", logout);

}

/**
 * Handles logic of ensuring all elements in the text
 */
function addEventHandlersForCreateStickyForm() {

    document.getElementById("add-sticky-btn").addEventListener("click", openStickyNoteForm);
    document.getElementById("add-sticky-form-btn").addEventListener("click", addASticky);
    document.getElementById("close-sticky-form-btn").addEventListener("click", closeStickyNoteForm)

}

/**
 * Handles logic of opening the sticky note form. 
 */
function openStickyNoteForm(event) {

    document.getElementById("add-sticky-form").style.display = "block";

}

/**
 * Used to handle the logic of closing the sticky note form. 
 * 
 * @param {*} event that was triggered holding additional information about it. 
 */
function closeStickyNoteForm(event) {

    document.getElementById("add-sticky-form").style.display = "none";

}

/**
 * Used to delete the sticky note assiociated with this delete event.
 * @param {*} event 
 */
function deleteStickyNote(event) {

    //Get the div with class sticky assiociated to the button click. 
    let stickyNoteElement = event.target.parentNode.parentNode;

    let wasStickyDeleted = deleteFromDatabase(stickyNoteElement);

    if (wasStickyDeleted) {

        //Delete it from the page
        stickyNoteElement.remove();

    }


}

/**
 * Used to create a sticky note element that references the given stickyNoteObject
 * 
 * Makes html element like this:
 *  <div class="sticky">
 *      text of sticky note here
 *      <div class='row'>
 *               <button type="button" class="btn btn-danger delete-btn col-md-4">Delete</button>
 *      </div>
 *  </div>
 * 
 * @param {*} text 
 * @param {*} stickyNoteObject 
 */
function createStickyNoteHTMLElement(note) {

    //Escape any code charatcers.
    let cleanText = escapeInput(note.text);

    let stickyBody = document.createElement("div");
    stickyBody.classList.add("sticky");
    stickyBody.style.zIndex = note.zIndex;

    //Id of the element is used to get id of sticky
    stickyBody.id = note.id;

    //Set location of the sticky note based on what was stored in the database
    stickyBody.style.top = (note.top) + "px";
    stickyBody.style.left = (note.left) + "px";

    stickyBody.innerText = cleanText;

    let stickyButtonRow = document.createElement("div");
    stickyButtonRow.classList.add("row");

    let deleteButton = document.createElement("button");
    deleteButton.addEventListener("click", deleteStickyNote);
    deleteButton.type = "button";
    deleteButton.classList.add("btn")
    deleteButton.classList.add("btn-danger")
    deleteButton.classList.add("delete-btn")
    deleteButton.innerText = "Delete";

    stickyButtonRow.appendChild(deleteButton);

    //Add it all to sticky 
    stickyBody.appendChild(stickyButtonRow);

    return stickyBody;

}

/**
 * Used to create a new sticky note and add it to the board. 
 * This also calls API to add note to database.
 */
function addASticky(event) {

    let stickyNoteText = document.getElementById("note-textarea").value;

    let username = document.getElementById("logged-in-userame").innerText;

    let boardElement = document.getElementById("board");

    //Calculate center of screen to be default
    let left = parseInt(boardElement.offsetWidth / 2);
    let top = parseInt(boardElement.offsetHeight / 2);

    let stickyNoteCreated = createStickyNote(username, stickyNoteText, parseInt(boardNameSpace.nextZIndex), top, left);

    //Only create a UI sticky if the user was able to insert a sticky note in the database.
    if (stickyNoteCreated != null) {

        let stickyNote = new StickyNote(stickyNoteCreated.id, stickyNoteCreated.note, stickyNoteCreated.topLocation, stickyNoteCreated.leftLocation, stickyNoteCreated.zIndex);

        let stickyElement = createStickyNoteHTMLElement(stickyNote);

        //Make note dragable
        addStickyEventHandlers(stickyElement);

        //Add note to board
        boardElement.appendChild(stickyElement);

        //Ensure stays within bounds of the board
        $('.sticky').draggable({
            containment: "parent"
        });

        //Ensure text is emptied 
        document.getElementById("note-textarea").value = "";

        //Increment the next z index
        boardNameSpace.nextZIndex = parseInt(boardNameSpace.nextZIndex) + 1;

        //Ensure the form is always visible over sticky notes. 
        document.getElementById("add-sticky-form").style.zIndex = boardNameSpace.nextZIndex;

        //Close the form. 
        closeStickyNoteForm(event);

    }


}

/**
 * Used to add all the needed event handlers for a sticky. 
 * @param stickyNoteElement given to give event handlers to.  
 */
function addStickyEventHandlers(stickyNoteElement) {

    var sitckyElements = document.getElementsByClassName("sticky");

    makeElementDragable(stickyNoteElement);

    //Go through each element and make them 
    for (let item of sitckyElements) {

        makeElementDragable(item);

    }

}

/**
 * Used to make the element dragable. 
 * @param {} item to make dragable. 
 */
function makeElementDragable(item) {

    item.onmousedown = dragMouseDown;

}

/**
 * Used to allow dragging when the user clicks on the item.
 * 
 * @param {*} e 
 */
function dragMouseDown(e) {

    //Force only sticky notes can be dragged
    if (!e.target.classList.contains('sticky')) {

        return;

    }

    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;

    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;

}

/**
 * Used to allow draging of the element on the screen. 
 * 
 * @param {*} e 
 */
function elementDrag(e) {

    //Force only sticky notes can be dragged
    if (!e.target.classList.contains('sticky')) {

        return;

    }

    e.preventDefault();

    // calculate the new cursor position:
    pos1 = pos3 - e.clientX; //left
    pos2 = pos4 - e.clientY; //top
    pos3 = e.clientX; //right
    pos4 = e.clientY; //bottom

    // set the element's new position:
    e.target.style.top = (e.target.offsetTop - pos2) + "px";
    e.target.style.left = (e.target.offsetLeft - pos1) + "px";

}

/**
 * Called when the user releases the dragging element. 
 * Used to store the new location in the database. 
 * @param {*} e 
 */
function closeDragElement(e) {

    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;

    //Store where the sticky note is now positioned. 
    let newTopLocation = parseInt(e.target.style.top, 10);
    let newLeftLocation = parseInt(e.target.style.left, 10);

    //What sticky note was moved
    let stickyId = e.target.id;

    //Notify the database about the new location
    updateStickyLocationInDatabase(stickyId, newTopLocation, newLeftLocation);


}

/**
 * Used to load all the sticky notes to add to the board that belong to a given username. 
 * @param {*} username to use to find all the sticky notes associated to it. 
 */
function loadAllStickyNotesOfUser(username) {

    let stickyNotes = getStickyNotesOfUser(username);

    //Only create a UI sticky if the user was able to insert a sticky note in the database.
    if (stickyNotes != null) {

        //Used to find the largest zindex value while looping through the sticky notes
        let highestZIndex = 2;

        for (let stickyNote of stickyNotes) {

            let stickyNoteObject = new StickyNote(stickyNote.id, stickyNote.note, stickyNote.topLocation, stickyNote.leftLocation, stickyNote.zIndex);

            let stickyElement = createStickyNoteHTMLElement(stickyNoteObject);

            //Make note dragable
            addStickyEventHandlers(stickyElement);

            let boardElement = document.getElementById("board");
            boardElement.appendChild(stickyElement);

            //Ensure stays within bounds of the board
            $('.sticky').draggable({
                containment: "parent"
            });

            if (stickyNote.zIndex > highestZIndex) {

                highestZIndex = stickyNote.zIndex;

            }

        }

        //Increment the next z index
        boardNameSpace.nextZIndex = highestZIndex + 1;

        //Ensure the form is always visible over sticky notes. 
        document.getElementById("add-sticky-form").style.zIndex = boardNameSpace.nextZIndex;

    }

}

/**
 * Simply clear the username and password inputs
 */
function clearLoginFields() {

    document.getElementById("username-input").value = '';
    document.getElementById("password-input").value = '';

}

/**
 * To be used when logging out. Removes all the sticky notes from the board aka screen. 
 */
function removeAllStickyNotesFromBoard() {

    $(".sticky").remove();

}

/**
 * Simply removes all html and possible characters that could cause XSS.
 * @param {*} input 
 */
function escapeInput(input) {
    return String(input)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}