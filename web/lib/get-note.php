<?php

require "authentication.php";

$conn = db_connect();

// Get all notes from the database
// Desc because groups go from highest to lowest but higher pitches are higher values
$notes = $conn->query("SELECT note FROM notes ORDER BY note desc");

// Get an array of notes as a numerical array
$notes = $notes->fetch_all();
$num_notes = count($notes);

if ($num_notes == 0) {
    echo "-1|false|false";
    exit();
}

$transpositions = [
    "flute" => 0,
    "oboe" => 0,
    "clarinet" => 2,
    "alto_sax" => 9,
    "trumpet_1" => 2,
    "trumpet_2" => 2,
    "trumpet_3" => 2,
    "tenor_sax" => 2,
    "trombone_1" => 0,
    "trombone_2" => 0,
    "baritone" => 0,
    "bassoon" => 0,
    "bari_sax" => 9,
    "bass_clarinet" => 2,
    "tuba" => 0,
];

$bass_clef = ["tuba", "trombone_1", "trombone_2", "baritone"];

session_start();
$instrument = $_SESSION['instrument'];
// Get the set group for the current instrument
$groupings = $conn->query("SELECT inst_group FROM instrument_groupings WHERE inst_name = '$instrument'");
$groupings = $groupings->fetch_all();
$current_group = $groupings[0];

$note_group = ceil(((float) $current_group / 10) * $num_notes);

$note = $notes[$note_group - 1][0];

$note = $note + $transpositions[$instrument];

// Prepare the note to be sent to the user
if (array_search($instrument, $bass_clef)) {
    // Lower the note to the bass clef
    $note += 2;
} else {
    // Lower the note to the treble clef
    $note += 6;
}

echo $note % 12;