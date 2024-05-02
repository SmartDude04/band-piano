<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

?>

<div class="instrumentation">
    <div class="group">
        <div class="sections">
            <h1 class="group-header poppins-black">Group 1</h1>
            <div class="instruments">

                <div class="instrument">
                    <h1 class="instrument-name poppins-bold">Trombone</h1>

                    <form method="post" action="" class="buttons">
                        <button type="submit" name="down" class="move-button">
                            <img src="../../img/arrow-down.png" alt="down arrow">
                        </button>
                        <button type="submit" name="up" class="move-button">
                            <img src="../../img/arrow-up.png" alt="down arrow">
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php

    // Use SSR instead of SSG as the load time isn't that important

    // If I was more concerned, I would send off the templates for each group then fill them in
    // with each instrument after page load to improve load time

    // Generate all groups using the SQL database
    require "../../../lib/authentication.php";
    $conn = db_connect();

    $result = $conn->execute_query("SELECT * FROM instrument_groupings ORDER BY inst_group");
    $result_rows = $result->fetch_all(MYSQLI_ASSOC);

    

    ?>
</div>