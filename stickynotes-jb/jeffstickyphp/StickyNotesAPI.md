**Create**
----
  Attempt to create a sticky note and insert it into the database table. 

* **URL**

  /StickyNotesAPI.php

* **Method:**

  `POST`

*  **Required Params:**
    * **method : 'create'**
    * **topLocation : topLocation**
    * **leftLocation : leftLocation**
    * **zIndex : zIndex**
    * **username : username**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ status : 200, 
                    message : 'Sticky note was stored in data base successfully',
                    stickyNote : {id : 1,
                                  username : 'demo', 
                                  note : 'this is a test',                         
                                  zIndex : 3,
                                  topLocation : 500,
                                  leftLocation : 600
                                }
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'You must be logged in to create a sticky note.'}`

  * **Code:** 409 FORBIDDEN <br />
    **Content:** `{ status : 409,
                     message: 'The note is too long. The note must be between 1 and 500 characters.'}`

    * **Code:** 500 INTERNAL SERVER ERROR <br />
    **Content:** `{ status : 500,
                     message: 'We were unable to create the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.'}`

    * **Code:** 400 BAD REQUEST<br />
    **Content:** `{ status : 400,
                     message: 'Missing information.'}`

* **Sample Call:**

`curl --data "method=create&username=demo&leftLocation=600&topLocation=500&zIndex=3" "http://localhost/StickyNoteAPI.php"`

* **Notes:**

The user must have already logged into a session in order to be able to create a sticky note in the the database. 

**Delete**
----
  Attempt to delete a given sticky note from the database

* **URL**

  /StickyNotesAPI.php

* **Method:**

  `POST`

*  **Required Params:**
    * **method : 'delete'**
    * **noteId : noteId**
    * **username : username**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ status : 200, 
                    message : 'Sticky note was deleted in database successfully',
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'You must be logged in to delete a sticky note.'}`

    * **Code:** 500 INTERNAL SERVER ERROR <br />
    **Content:** `{ status : 500,
                     message: 'We were unable to delete the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.'}`

    * **Code:** 400 BAD REQUEST<br />
    **Content:** `{ status : 400,
                     message: 'Missing information.'}`

* **Sample Call:**

`curl --data "method=delete&username=demo&noteId=1" "http://localhost/StickyNoteAPI.php"`

* **Notes:**

The user must have already logged into a session in order to be able to delete a sticky note in the the database. 

**Update**
----
  Attempt to update a given sticky note's location in the database. This  

* **URL**

  /StickyNotesAPI.php

* **Method:**

  `POST`

*  **Required Params:**
    * **method : 'update'**
    * **noteId : noteId**
    * **username : username**
    * **leftLocation : leftLocation**
    * **topLocation : topLocation**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ status : 200, 
                    message : 'Sticky note was updated in database successfully',
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'You must be logged in to update a sticky note.'}`

    * **Code:** 500 INTERNAL SERVER ERROR <br />
    **Content:** `{ status : 500,
                     message: 'We were unable to update the sticky note. Please contact the developer Jeffrey Boisvert for more infomation.'}`

    * **Code:** 400 BAD REQUEST<br />
    **Content:** `{ status : 400,
                     message: 'Missing information.'}`

* **Sample Call:**

`curl --data "method=update&username=demo&noteId=1&leftLocation=600&topLocation=500" "http://localhost/StickyNoteAPI.php"`

* **Notes:**

The user must have already logged into a session in order to be able to update a sticky note in the the database. 

**Retrieve**
----
  Retreieve all the sticky notes that belong to a given username.   

* **URL**

  /StickyNotesAPI.php

* **Method:**

  `GET`

*  **Required Params:**
    * **method : 'retrieve'**
    * **username : username**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ status : 200, 
                    message : 'Got all the sticky notes successfully for ['username']',
                    stickyNotes : [
                                {id : 1,
                                  username : 'demo', 
                                  note : 'this is a test',                         
                                  zIndex : 3,
                                  topLocation : 500,
                                  leftLocation : 600
                                },
                                {id : 2,
                                  username : 'demo', 
                                  note : 'this is a test',                         
                                  zIndex : 4,
                                  topLocation : 700,
                                  leftLocation : 200
                                },
                      .....
                    ]
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'You must be logged in to get all sticky notes.'}`

    * **Code:** 500 INTERNAL SERVER ERROR <br />
    **Content:** `{ status : 500,
                     message: 'We were unable to retireve all the sticky notes. Please contact the developer Jeffrey Boisvert for more infomation.'}`

    * **Code:** 400 BAD REQUEST<br />
    **Content:** `{ status : 400,
                     message: 'Missing information.'}`

* **Sample Call:**

`curl -X GET -H "Accept: application/json" "http://localhost/StickyNoteAPI.php?method=retrieve?username=demo"`

* **Notes:**

The user must have already logged into a session in order to be able to to retireve all the user's sticky notes.


