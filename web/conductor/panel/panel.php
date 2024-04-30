<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}


$page = "panel";

if (isset($_GET["panel"])) {
    $page = strtolower($_GET["panel"]);
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conductor Panel &bull; Band Piano</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico">
    <script src="panel.js"></script>

    <?php
    if ($page == "panel") {
        echo "<script src='core/conductor.js'></script>";
    }
    ?>
    <link rel="stylesheet" href="panel.css?v=<?php echo rand(0, 1000); ?>">
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="core/core.css?v=<?php echo rand(0, 1000); ?>">

</head>
<body>
<nav>
    <a href="index.php" id="logo-container">
        <img src="../../img/band-piano-logo.png" id="logo" alt="Band Piano Logo" >
    </a>


    <div id="main-menu">
        <form id="main-nav">
            <input name="panel" <?php if($page == "panel") {echo "disabled";} ?> type="submit" value="Panel" class="poppins-bold page-button <?php if($page != "panel") {echo "not-selected";} ?>">
            <input name="panel" <?php if($page == "settings") {echo "disabled";} ?> type="submit" value="Settings" class="poppins-bold page-button <?php if($page != "settings") {echo "not-selected";} ?>">
            <input name="panel" <?php if($page == "instruments") {echo "disabled";} ?> type="submit" value="Instruments" class="poppins-bold page-button <?php if($page != "instruments") {echo "not-selected";} ?>">
        </form>
    </div>

    <div id="user-settings">
        <a href="../../index.html" class="poppins-black settings-link">Home</a>
        <a href="../login/index.php?logout=true" class="poppins-black settings-link">Logout</a>
    </div>
</nav>

<main class="content">

    <?php

    if ($page == "panel") {
        include "core/conductor.php";
    } else if ($page == "settings") {
        include "core/settings.php";
    } else if ($page == "instruments") {
        include "core/instruments.php";
    }

    ?>

</main>

<div class="footer">
    <h1 class="poppins-bold" >View this project's source code on <a href="https://github.com/SmartDude04/band-piano?tab=readme-ov-file">GitHub</a></h1>
</div>
</body>
</html>