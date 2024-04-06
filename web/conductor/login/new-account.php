<?php
use Random\RandomException;
require "../../lib/authentication.php";

$length_error = false;
$taken_username = false;

if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {

    if (strlen($_POST["password"]) >= 8) {
        try {
            if (new_user($_POST["username"], $_POST["password"])) {
                // Login validated
                header("Location: index.php");
                exit();
            } else {
                // Login incorrect; username is taken
                $taken_username = true;
            }
        } catch (RandomException $e) {
            header("Location: ../index.php");
            exit();
        }
    } else {
        $length_error = true;
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico">
    <title>New Account &bull; Band Piano</title>
    <link rel="stylesheet" href="login.css?v=<?php echo rand(0, 1000); ?>">
    <link rel="stylesheet" href="../../global.css">
    <script src="login.js"></script>

    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>

<div id="login-container">
    <div id="login-panel" class="poppins-bold">
        <h1 id="login-title">Create A New Login</h1>

        <form method="post" action="">
            <h1 id="username-taken" class="poppins-medium" <?php if(!$taken_username) {echo "style='visibility: hidden;'";} ?>>That username is already taken</h1>
            <label>
                <input value="<?php if (isset($_POST["username"])) {echo $_POST["username"];} ?>" type="text" required placeholder="Username" class="poppins-medium <?php if($taken_username) {echo "incorrect-shake";} ?>" name="username" id="un-field">
            </label>

            <label>
                <input value="<?php if (isset($_POST["password"])) {echo $_POST["username"];} ?>"  type="password" required placeholder="Password" class="poppins-medium <?php if($length_error) {echo "incorrect-shake";} ?>" name="password" id="pw-field">
            </label>
            <h1 id="password-length" class="poppins-medium" <?php if(!$length_error) {echo "style='visibility: hidden;'";} ?>>Password must be at least 8 characters</h1>

            <br/>
            <input type="submit" value="Create Account" id="pw-submit" disabled="disabled" name="submit" class="poppins-black button-disabled">
        </form>
    </div>
    <h1 id="account-redirect" class="poppins-medium">Already have an account? <a href="index.php" id="redirect-link">Login Here</a></h1>
</div>

</body>
</html>