**Login**
----
  Attempt to login to the Sticky Note application

* **URL**

  /login.php

* **Method:**

  `POST`

*  **Reuqired Params:**
    * **method : 'login'**
    * **username : username**
    * **password : password**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ 'status' : 200, 
                    'message' : 'Login for [username] was successful.'
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'Invalid credentials!'}`

  * **Code:** 403 FORBIDDEN <br />
    **Content:** `{ status : 403,
                     message: 'Unable to login please try again later.'}`

* **Sample Call:**

`curl --data "method=login&username=demo&password=test123" "http://localhost/login.php"`

* **Notes:**

If client does not give correct params a response wit a status of 400 is returned. 

**Logout**
----
  Attempt to logout of the Sticky Note appliction

* **URL**

  /login.php

* **Method:**

  `POST`

*  **Reuqired Params:**
    * **method : 'logout'**

* **Success Response:**

  * **Code:**200 OK<br />
    **Content:** `{ 'status' : 200, 
                    'message' : 'Logout was successful.'
                  }`

* **Sample Call:**

`curl --data "method=logout" "http://localhost/login.php"`

* **Notes:**
If there is no session or cookie nothing happens. 

**Logged in**
----
  Validating if there is a user logged in and get the username of the logged in user.

* **URL**

  /login.php

* **Method:**

  `POST`

*  **Reuqired Params:**
    * **method : 'loggedIn'**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ 'status' : 200, 
                    'message' : 'There is a user logged in',
                    'username : [username of the logged in user]
                  }`

* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ status : 401,
                     message: 'There is no user logged in'}`

* **Sample Call:**

`curl --data "method=loggedIn" "http://localhost/login.php"`

* **Notes:**

This should be used to see if there is any user logged in from a previous session.

**Register**
----
  Registering a user.

* **URL**

  /login.php

* **Method:**

  `POST`

*  **Reuqired Params:**
    * **method : 'register'**
    * **username : username**
    * **password : password**

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{ 'status' : 200, 
                    'message' : 'Register for [username] was successful. Please login.',
                  }`

* **Error Response:**

  * **Code:** 409 INVALID <br />
    **Content:** `{ status : 409,
                     message: [error message for either password, username or other problem]}`

* **Sample Call:**

`curl --data "method=register&username=demo&password=test123" "http://localhost/login.php"`

* **Notes:**

Validates that the username is between 1 and 50 characters and the password is between 8 and 255 characters. 
