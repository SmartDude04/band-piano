<?php

session_start();
if (!isset($_SESSION["instrument"])) {
    header("Location: landing.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Player Panel &bull; Band Piano</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

    <script src="panel.js" defer></script>


    <link rel="stylesheet" href="panel.css">
    <link rel="stylesheet" href="../global.css">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="rotate-screen">
    <div class="flex-container">
        <div class="rotate-message">
            <img src="../img/rotate.gif" alt="Rotate Phone Screen">
        </div>
    </div>
</div>

<div class="content">
    <div class="header">
        <a href="../index.html" class="home poppins-black">Band Piano</a>
    </div>
    <div class="flex-container">
        <svg viewBox="0 0 2000 1100" id="staff" preserveAspectRatio="xMidYMid slice">

            <?php

            $bass_clef = ["trombone_1", "trombone_2", "baritone", "tuba"];
            if (is_int(array_search($_SESSION["instrument"], $bass_clef))) {
                // Display the bass clef
                echo '<image href="../img/bass-clef.png" x="500" y="410" width="450" height="450"/>';
            } else {
                echo '<image href="../img/treble-clef.png" x="450" y="270" width="450" height="800"/>';
            }

            ?>

            <image href="../img/music-staff.png" x="480" y="350" width="1040" height="640"/>
            <image transform="rotate(0, 1000, 420)" href="../img/note.svg" x="1100" y="40" width="144" height="400" id="note" opacity="0"/>
            <image href="../img/flat.svg" x="1000" y="715" width="99" height="213" id="flat" opacity="0"/>
            <image href="../img/sharp.svg" x="950" y="100" width="120" height="328" id="sharp" opacity="0"/>
            <rect id="bar" width="220" height="20" x="1065" y="200" fill="black" opacity="0"/>
            <rect id="bar2" width="220" height="20" x="1065" y="200" fill="black" opacity="0"/>
        </svg>
    </div>
</div>
</body>
</html>