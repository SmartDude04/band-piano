<?php

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

    <link rel="stylesheet" href="panel.css?v=<?php echo rand(0, 1000); ?>">
    <link rel="stylesheet" href="../../global.css">

</head>
<body>
<nav>
    <a href="panel.php" id="logo-container">
        <img src="../../img/band-piano-logo.png" id="logo" alt="Band Piano Logo" >
    </a>

    <div id="main-menu">
        <form id="main-nav">
            <input name="panel" <?php if($page == "panel") {echo "disabled";} ?> type="submit" value="Panel" class="poppins-bold page-button <?php if($page != "panel") {echo "not-selected";} ?>">
            <input name="panel" <?php if($page == "settings") {echo "disabled";} ?> type="submit" value="Settings" class="poppins-bold page-button <?php if($page != "settings") {echo "not-selected";} ?>">
            <input name="panel" <?php if($page == "filler") {echo "disabled";} ?> type="submit" value="Filler" class="poppins-bold page-button not-selected <?php if($page != "filler") {echo "not-selected";} ?>">
        </form>
    </div>

    <div id="user-settings">
        <a href="../../index.html" class="poppins-black settings-link">Home</a>
        <a href="../login/index.php?logout=true" class="poppins-black settings-link">Logout</a>
    </div>
</nav>

<div class="content">

    <?php

    if ($page == "panel") {
        include "core/conductor.php";
    } else if ($page == "settings") {
        include "core/settings.php";
    } else if ($page == "filler") {
        include "core/filler.php";
    }

    ?>

</div>

</body>
</html>