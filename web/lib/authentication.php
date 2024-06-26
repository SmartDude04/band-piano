<?php

use Random\RandomException;


function db_connect(): mysqli {
    $hostname = "localhost";
    $username = "root";
    $password = "NsW284i^n95raK@Y%N4#";
    $database = "band_piano";

    return new mysqli($hostname, $username, $password, $database);
}

function logout(): bool {
    // Remove the session
    if (isset($_SESSION["auth"])) {
        session_destroy();
    }

    // Delete the session from the database
    $conn = db_connect();
    $series_identifier = explode("|", $_COOKIE["auth"])[0];
    $conn->execute_query("DELETE FROM sessions WHERE sn_series_identifier = '$series_identifier'");

    // Remove the cookie
    setcookie("auth", "", time() - 3600, "/");

    return true;
}

/**
 * @throws RandomException
 */
function new_user($username, $password): bool {
    // Register the user in the database

    $conn = db_connect();

    // Create their password hash
    $password = $conn->real_escape_string($password);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $username = $conn->real_escape_string($username);

    // Make sure no users have the same username
    $num_usernames = $conn->execute_query("SELECT * FROM users WHERE usr_name = '$username'");
    if (mysqli_num_rows($num_usernames) != 0) {
        return false;
    }

    // Insert them into the database
    $conn->execute_query("INSERT INTO users (usr_name, usr_password) VALUES ('$username', '$password_hash')");

    // Log them in
    login($username, $password);

    // Return true for success
    return true;
}

/**
 * @throws RandomException
 */
function confirm_session(): bool {

    $expire_days = 7;

    // Check for a session, then cookie triplet, then cookie double (problem), then return false
    if (isset($_SESSION["auth"]) && $_SESSION["auth"]) {
        // There is a session; no more info needed. Return true
        return true;
    } else if (isset($_COOKIE["auth"])) {
        // There is a cookie; continue with verification
        $conn = db_connect();

        $arr = explode("|", $_COOKIE["auth"]);

        // If the length of the cookie array does not match what is expected, return false and stop verification
        if (count($arr) != 3) {
            return false;
        }

        // Get the cookie triplet
        $series_identifier = $conn->real_escape_string($arr[0]);
        $session_token = $conn->real_escape_string($arr[1]);
        $user_hash = $conn->real_escape_string($arr[2]);

        // Check if the triplet (with a correct expiry date) is present on the database
        $result = $conn->execute_query("SELECT sn_username FROM sessions
                WHERE sn_series_identifier = '$series_identifier'
                AND sn_session_token = '$session_token'
                AND SHA2(sn_username, 256) = '$user_hash'
                AND sn_expire > UNIX_TIMESTAMP()");

        if (mysqli_num_rows($result) == 1) {
            // Cookie triplet was present!
            // Make a new cookie, create a session, and return a positive verification
            $row = mysqli_fetch_assoc($result);

            // Get the same info for some parts (redundant but should be done anyway)
            $username = $row["sn_username"];
            $user_hash = hash("sha256", $username);
            $expire = time() + ($expire_days * 24 * 60 * 60);

            // Make a new token
            $new_token = bin2hex(random_bytes(32));

            // Set the new cookie
            $cookie_val = "$series_identifier|$new_token|$user_hash";
            setcookie("auth", $cookie_val, $expire, "/");

            // Update the session database record with the new session token
            $conn->execute_query("UPDATE sessions
            SET sn_session_token = '$new_token', sn_expire = '$expire'
            WHERE sn_series_identifier = '$series_identifier'
            AND SHA2(sn_username, 256) = '$user_hash'");

            // Set up a session for the user
            session_start();
            $_SESSION["auth"] = true;

            // Validate that all was successful and the user is confirmed logged in
            return true;


        } else if (mysqli_num_rows($conn->execute_query("SELECT sn_username FROM sessions
                   WHERE sn_series_identifier = '$series_identifier'
                     AND SHA2(sn_username, 256) = '$user_hash'
                     AND sn_expire > UNIX_TIMESTAMP()")) == 1) {
            // Series is valid but token is not; something malicious has happened

            // Delete all database records with the series identifier present
            $conn->execute_query("DELETE from sessions WHERE sn_series_identifier = '$series_identifier'");

            // Remove the cookie by setting it to expire a time in the past
            setcookie("auth", "", time() - 3600, "/");

            return false;
        } else {
            // Cookie was present but something else weird happened; delete it and return false
            // Possibly the database record was deleted before the cookie expired

            setcookie("auth", "", time() - 3600, "/");

            return false;
        }

    } else {
        // No cookie or session present; return false

        return false;
    }
}

/**
 * @throws RandomException
 */
function login($username, $password): bool {
    $expire_days = 7;

    // Confirm the user is real
    $conn = db_connect();

    // Prevent SQL injection
    $username = $conn->real_escape_string($username);

    // Get the credentials
    $result = $conn->execute_query("SELECT * FROM users WHERE usr_name = '$username'");
    $row = mysqli_num_rows($result) == 1 ? mysqli_fetch_assoc($result) : "";

    if (mysqli_num_rows($result) == 1 && password_verify($password, $row["usr_password"])) {

        // The user is real and the password is correct; continue to logging in and creating a cookie
        // Generate the info for a session row in the database and a cookie
        $series_identifier = bin2hex(random_bytes(32));
        $session_token = bin2hex(random_bytes(32));
        $username = $row["usr_name"];
        $user_hash = hash("sha256", $username);
        $expire = time() + ($expire_days * 24 * 60 * 60);

        // Generate a cookie
        $cookie_val = "$series_identifier|$session_token|$user_hash";
        setcookie("auth", $cookie_val, $expire, "/");

        // Generate a session record on a database
        $conn->execute_query("INSERT INTO band_piano.sessions (sn_series_identifier, sn_session_token, sn_username, sn_expire) VALUES ('$series_identifier', '$session_token', '$username', '$expire')");

        // Create a session
        session_start();
        $_SESSION["auth"] = true;

        // Confirm the login was successful
        return true;
    } else {
        return false;
    }
}
