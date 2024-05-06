<?php


require "authentication.php";

$conn = db_connect();

$conn->execute_query("DELETE FROM notes");

echo "true";