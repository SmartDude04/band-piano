<?php

use Random\RandomException;

require "../lib/authentication.php";

try {
    if (confirm_session()) {
        require "panel.php";
    } else {
        header("Location: login.php");
        exit();
    }
} catch (RandomException $e) {
    exit();
}