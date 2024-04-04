<?php
use Random\RandomException;
require "../lib/authentication.php";

if (isset($_GET["logout"])) {
    logout();
    header("Location: login.php");
    exit();
}

try {
    if (confirm_session()) {
        // If the user is already logged in, no need to continue; redirect to panel
        header("Location: index.php");
        exit();
    }
} catch (RandomException $e) {
    // If something fails, delete the cookie and session data then reload
    session_destroy();
    setcookie("auth", "", time() - 3600, "/");
    header("Location: ../index.html");
    exit();
}

$retry = false;

if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {


    try {
        if (login($_POST["username"], $_POST["password"])) {
            // Login approved
            header("Location: index.php");
        } else {
            // Login denied
            $retry = true;
        }
    } catch (RandomException $e) {
        header("Location: login.php");
        exit();
    }
}
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
                <input value="<?php if (isset($_POST["username"])) {echo $_POST["username"];} ?>" type="text" required placeholder="Username" class="poppins-medium" name="username" id="un-field">
            </label>

            <label>
                <input value="<?php if (isset($_POST["password"])) {echo $_POST["password"];} ?>" type="password" required placeholder="Password" class="poppins-medium <?php if($retry) {echo "incorrect-shake";} ?>" name="password" id="pw-field">
            </label>

            <br/>
            <input type="submit" value="Login" id="pw-submit" disabled="disabled" name="submit" class="poppins-black button-disabled">

        </form>

        <h1 id="account-redirect" class="poppins-medium">Don't have an account? <a href="new-account.php" id="redirect-link">Create One Here</a></h1>
    </div>
</div>
</body>
</html>