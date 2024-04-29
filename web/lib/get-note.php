<?php

require "authentication.php";

$conn = db_connect();

// Get all notes from the database
// Desc because groups go from highest to lowest but higher pitches are higher values
$note_result = $conn->query("SELECT note FROM notes ORDER BY note desc");

// Get an array of notes as a numerical array
$note_rows = $note_result->fetch_all();
$num_notes = count($note_rows);

if ($num_notes == 0) {
    echo "-1|false|false";
    exit();
}

$keys = [
    "flute" => "c_treble",
    "oboe" => "c_treble",
    "clarinet" => "b_flat",
    "alto_sax" => "e_flat",
    "trumpet_1" => "b_flat",
    "trumpet_2" => "b_flat",
    "trumpet_3" => "b_flat",
    "tenor_sax" => "b_flat",
    "trombone_1" => "c_bass",
    "trombone_2" => "c_bass",
    "baritone" => "c_bass",
    "bassoon" => "c_treble",
    "bari_sax" => "e_flat",
    "bass_clarinet" => "b_flat",
    "tuba" => "c_bass",
];

require "get-note-helper.php";
session_start();
$instrument = $_SESSION['instrument'];
// Get the set group for the current instrument
$groupings = $conn->query("SELECT inst_group FROM instrument_groupings WHERE inst_name = '$instrument'");
$groupings = $groupings->fetch_row();
$current_group = $groupings[0];

// Get the single note that we need to play
$note_group = ceil(((float) $current_group / 10) * $num_notes);
$note = $notes[$note_group - 1][0];

echo get_return_value($note, $keys[$instrument]);