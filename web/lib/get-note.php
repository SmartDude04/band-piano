<?php

require "authentication.php";

$conn = db_connect();

// Get all notes from the database
$notes = $conn->query("SELECT * FROM notes");


// Get an array of notes as a numerical array
$notes = $notes->fetch_all();
$num_notes = count($notes);

if ($num_notes == 0) {
    echo "-1|false|false";
    exit();
}

require "get-note-helper.php";

// If notes are present, continue with deciding which note to display
session_start();
$instrument = $_SESSION['instrument'];

// Get the groupings for the current instrument
$groupings = $conn->query("SELECT * FROM instrument_groupings WHERE inst_name = '$instrument'");
