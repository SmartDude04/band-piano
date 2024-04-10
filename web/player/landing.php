<?php

// Assign a value to a session if POST is present
if (isset($_POST["key"])) {
    session_start();
    $_SESSION["key"] = $_POST["key"];

    session_start();
    header("Location: panel.php");
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
    <title>Instrument Selection &bull; Band Piano</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

    <link rel="stylesheet" href="landing.css?v=<?php echo rand(0, 10000);?>">
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

<div class="inst-selection">
    <div class="flex-container">
        <div class="selection-box">
            <h1 class="select-header poppins-black">Select your Instrument Key:</h1>
            <form action="" method="post" class="buttons">
                <button type="submit" name="key" class="poppins-bold" value="c_bass">C &#x1D122;</button>
                <button type="submit" name="key" class="poppins-bold" value="c_treble">C&#x1D11E;</button>
                <button type="submit" name="key" class="poppins-bold" value="b_flat">B&#9837;</button>
                <button type="submit" name="key" class="poppins-bold" value="e_flat">E&#9837;</button>
                <button type="submit" name="key" class="poppins-bold" value="f">F</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>