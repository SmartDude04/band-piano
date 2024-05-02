<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

// Update any changes since last time
require_once("../../lib/authentication.php");

$conn = db_connect();
$result = $conn->query("SELECT inst_name, inst_group FROM instrument_groupings");
$rows = $result->fetch_all();

foreach ($rows as $row) {
    // Check if a POST with that instrument is found, for either up or down
    $inst_name = $row[0];
    $inst_group = $row[1];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["down-" . $inst_name])) {
        // Handle the POST request for the instrument going down a level
        $new_group = $inst_group + 1;
        $conn->execute_query("UPDATE instrument_groupings SET inst_group = '$new_group' WHERE inst_name = '$inst_name'");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["up-" . $inst_name])) {
        // Handle the POST request for the instrument going down a level
        $new_group = $inst_group - 1;
        $conn->execute_query("UPDATE instrument_groupings SET inst_group = '$new_group' WHERE inst_name = '$inst_name'");
    }
}


?>

<div class="instrumentation">

    <?php

    // Use SSR instead of SSG as the load time isn't that important

    // If I was more concerned, I would send off the templates for each group then fill them in
    // with each instrument after page load to improve load time

    // Generate all groups using the SQL database
    $conn = db_connect();


    $result = $conn->execute_query("SELECT * FROM instrument_groupings");
    $result_rows = $result->fetch_all(MYSQLI_ASSOC);
    $instrument_groups = [];
    $instrument_display_names = [
        "flute" => "Flute",
        "oboe" => "Oboe",
        "clarinet" => "Clarinet",
        "alto_sax" => "Alto Sax",
        "trumpet_1" => "Trumpet 1",
        "trumpet_2" => "Trumpet 2",
        "trumpet_3" => "Trumpet 3",
        "tenor_sax" => "Tenor Sax",
        "trombone_1" => "Trombone 1",
        "trombone_2" => "Trombone 2",
        "baritone" => "Baritone",
        "bassoon" => "Bassoon",
        "bari_sax" => "Bari Sax",
        "bass_clarinet" => "Bass Clarinet",
        "tuba" => "Tuba"
    ];

    foreach ($result_rows as $row) {
        $inst_name = $row["inst_name"];
        $group_string = $row["inst_group"];
        $inst_group = (int) $group_string;

        if (array_key_exists($inst_group, $instrument_groups)) {
            // If there is already an instrument with that group, add a new value onto it
            $instrument_groups[$inst_group][] = $inst_name;
        } else {
            $instrument_groups[$inst_group] = [$inst_name];
        }
    }

    ksort($instrument_groups);

    // Now that we have an array of instruments and groups, begin creating the HTML to display
    for ($i = 1; $i <= 10; $i = $i > 5 && $i != 10 ? $i - 4 : $i + 5) {

        $instruments = $instrument_groups[$i] ?? [];

        echo '<div class="group">';
        echo '<div class="sections">';
        echo '<h1 class="group-header poppins-bold">Group ' . $i . '</h1>';
        echo '<div class="instruments">';

        foreach ($instruments as $instrument) {
            echo '<div class="instrument">';
            echo '<h1 class="instrument-name poppins-bold">' . $instrument_display_names[$instrument] . '</h1>';
            echo '<form method="post" action="" class="buttons">';

            // Handle the edges of the groups to stop people from causing errors
            if ($i != 10) {
                echo '<button type="submit" name="down-' . $instrument . '" class="move-button">';
            } else {
                echo '<button type="submit" disabled="disabled" name="down-' . $instrument . '" class="move-button move-disabled">';
            }

            echo '<img src="../../img/arrow-down.png" alt="down arrow">';
            echo '</button>';

            // Handle the edges of the groups to stop people from causing errors
            if ($i != 1) {
                echo '<button type="submit" name="up-' . $instrument . '" class="move-button">';
            } else {
                echo '<button type="submit" disabled="disabled" name="up-' . $instrument . '" class="move-button move-disabled">';
            }

            echo '<img src="../../img/arrow-up.png" alt="down arrow">';
            echo '</button>';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';

    }

    ?>
</div>