<?php

require "authentication.php";

$conn = db_connect();

if ($_GET["note"] > 1) {
    if ($_GET["pressed"] == "true") {
        // If the note is pressed, add it into the database
        $conn->execute_query("INSERT INTO notes (note) VALUES ('" . $_GET['note'] . "')");
        echo $_GET['note'];
    } else {
        // If the note was released, delete it
        $conn->execute_query("DELETE FROM notes WHERE note = '" . $_GET['note'] . "'");
        echo "Deleted";
    }
}

