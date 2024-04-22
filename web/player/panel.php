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


    <link rel="stylesheet" href="panel.css?v=<?php echo rand(0, 10000);?>">
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
        <svg viewBox="0 0 2000 1000" id="staff" preserveAspectRatio="xMidYMid slice">
            <image href="../img/music-staff.png" x="480" y="250" width="1040" height="640"/>
            <image transform="rotate(0, 1000, 420)" href="../img/note.svg" x="950" y="40" width="144" height="400" id="note" opacity="1"/>
            <image href="../img/flat.svg" x="850" y="715" width="90" height="194" id="flat" opacity="1"/>
            <image href="../img/sharp.svg" x="810" y="100" width="102" height="328" id="sharp" opacity="1"/>
        </svg>
    </div>
</div>
</body>
</html>