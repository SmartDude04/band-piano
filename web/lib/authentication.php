<?php

use Random\RandomException;

function sql_connect(): mysqli {
    $hostname = "localhost";
    $username = "root";
    $password = "NsW284i^n95raK@Y%N4#";
    $database = "band_piano";

    return new mysqli($hostname, $username, $password, $database);
}

function execute_sql(string $script): mysqli_result {
    // Get a SQL connection
    $conn = sql_connect();

    // Prevent SQL injection
    $script = $conn->real_escape_string($script);

    // Store the result
    $result = $conn->execute_query($script);

    $conn->close();

    if (!$result) {
        exit("SQL statement failed. Please reload...");
    }

    return $result;
}

function logout(): bool {

}

function confirm_session(): bool {

}

/**
 * @throws RandomException
 */
function login($username, $password): bool {

    // Confirm the user is real
    $result = execute_sql("SELECT * FROM users WHERE usr_name = '" . $username . "'");
    $row = mysqli_num_rows($result) == 1 ? mysqli_fetch_assoc($result) : "";

    if (mysqli_num_rows($result) == 1 && password_verify($password, $row["usr_password"])) {

        // The user is real and the password is correct; continue to logging in and creating a cookie
        // Generate the info for a session row in the database and a cookie
        $series_identifier = bin2hex(random_bytes(32));
        $session_token = bin2hex(random_bytes(32));
        $user_hash = password_hash($row["usr_name"], PASSWORD_DEFAULT);


    } else {
        return false;
    }
}