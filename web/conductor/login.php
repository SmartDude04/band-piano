<?php
use Random\RandomException;
require "../lib/authentication.php";

// TODO: Check to make sure password and username are within a good length

if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {



}

    // If we get down here, then the user either entered a wrong password or did something wrong
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <title>Conductor Login &bull; Band Piano</title>
    <link rel="stylesheet" href="login.css?v=<?php echo rand(0, 1000); ?>">
    <link rel="stylesheet" href="../global.css">

    <script src="login.js"></script>


    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div id="login-container">
    <div id="login-panel" class="poppins-bold">
        <h1 id="login-title">Conductor Login</h1>

        <form method="post" action="">
            <label>
                <input type="text" required placeholder="Enter The Username" class="poppins-medium" name="username" id="un-field">
            </label>

            <label>
                <input type="password" required placeholder="Enter Your Password" class="poppins-medium" name="password" id="pw-field">
            </label>

            <input type="submit" value="Submit" id="pw-submit" disabled="disabled" name="submit">

        </form>
    </div>
</div>
</body>
</html>