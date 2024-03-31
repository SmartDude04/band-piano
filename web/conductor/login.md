# Login Verification & Cookie Storage Process

## Login Creation

1. On a page, a user will enter a username and password
2. When they submit it, the password will be hashed and it along with the username will be sent to a database. The database will also store a unique user id
3. The user will have a login cookie (explained later) created and will be redirected to the dashboard

## Login Verification

1. A user will enter their already-existing username and password into a login page
2. When submitted, the POST method on the form will store the two pieces of data
3. A PHP script will check if both those values exist and will get a result column for a user with that username
4. If the column exists, the `password_verify()` function will check if the password entered matches the one in the database
5. If it does, the page will continue to cookie generation

## Logout Procedures

1. When a user logs out, a script will run
2. This will get the user ID and session token from the cookie
3. The database will be directed to delete any records that include the user ID and session token
4. This, in theory, should only delete the single record from the current browser
5. Finally, the cookie will be deleted from the users browser

## Cookie Generation, Verification, and Storage

A cookie is a piece of data stored on a user's browser. It can be used to securely verify if a user has previously logged in

The cookie will consist of two pieces of data:
1. A user ID
2. A secret token

On the database, a table of tokens stores three pieces of data:
1. A user ID
2. A secret token 
3. A machine identifier hash

*Even if a threat actor were to gain access to the database storing the three pieces, when verifying with that cookie, the MAC address will need to be verified against a hash, rendering it useless*

### Generation:
1. Upon verification of a password, a cookie and database record will be created
2. Three variables will be created from either new or existing data:
    1. User ID: Taken from the record in the `users` table
    2. Secret token: 16-byte (32 digits in hex) cryptographically-secure random string of hex digits
    3. Machine Identifier: A hashed representation of the user's MAC Address
3. Upon creation of these variables, a cookie will be created storing the User ID and Secret Token that will last for 7 days (or another set interval)
4. ***CLEANUP***: To make sure unused items in the database are deleted, any records with the same machine identifier hash will be deleted. Doing it this way allows for multiple devices with the same user ID to be used.
5. A database record in the `session_tokens` table will be created, storing all three variables.

### Verification:
1. If a site is requested that requires access verification, it will first check for the existence of a cookie
2. If no cookie was found, the user will be redirected to the login page
3. If a cookie was found, verification can continue. ***If at any point this process fails, the user will be redirected to the login page***
4. First, a database record with the user ID and secret token will be accessed
5. The machine identifier hash will be accessed, and with the `password_verify()` function it will be checked against the user's MAC address
6. If these steps yield a result from the database and a match with the MAC address token, the user will be able to continue