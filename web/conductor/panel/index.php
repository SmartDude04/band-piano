<?php

use Random\RandomException;

require "../../lib/authentication.php";

try {
    if (confirm_session()) {
        // If the session is good, load the page
        require "panel.php";
    } else {
        // If not, redirect to the login screen
        header("Location: ../login/index.php");
        exit();
    }
} catch (RandomException $e) {
    exit();
}