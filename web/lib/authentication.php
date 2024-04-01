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

}

function confirm_session(): bool {
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

        $result = $conn->execute_query("SELECT username FROM sessions
                WHERE series_identifier = '$series_identifier'
                AND session_token = '$session_token'
                AND user_hash = '$user_hash'");


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
        $user_hash = password_hash($username, PASSWORD_DEFAULT);
        $expire = time() + ($expire_days * 24 * 60 * 60);

        // Generate a cookie
        $cookie_val = "$series_identifier|$session_token|$user_hash";
        setcookie("auth", $cookie_val, $expire);

        // Generate a session record on a database
        $conn->execute_query("INSERT INTO band_piano.sessions (series_identifier, session_token, username, expire) VALUES ($series_identifier, $session_token, $user_hash, $expire)");

        // Create a session
        session_start();
        $_SESSION["auth"] = true;

        // Confirm the login was successful
        return true;
    } else {
        return false;
    }
}
