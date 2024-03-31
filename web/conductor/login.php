<?php
    // Check if the user has tried to log in
use Random\RandomException;

// TODO: Check to make sure password and username are within a good length

if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {

        // If so, check if they are really a user on the database
        $conn = new mysqli("localhost", "root", "NsW284i^n95raK@Y%N4#", "band_piano");
        $result = $conn->execute_query("SELECT * FROM users WHERE usr_name = '" . $_POST["username"] . "'");
        if (mysqli_num_rows($result) == 1) {
            // If they are a user, make sure the password matches
            $row = mysqli_fetch_assoc($result);
            $passwordHash = $row["usr_password"];
            $passwordCorrect = password_verify($_POST["password"], $passwordHash);
            if ($passwordCorrect) {
                // Get session rand number
                $sessionRand = "";
                try {
                    $sessionRand = bin2hex(random_bytes(22));
                } catch (RandomException $e) {
                    // If there is a problem, reload the page
                    header("login.php");
                }

                // Insert the session token into the database
                echo $sessionRand;
            }

        }
    }

    // If we get down here, then the user either entered a wrong password or did something wrong
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=1080, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome">
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
                <input type="password" required placeholder="Enter The Password" class="poppins-medium" name="password" id="pw-field">
            </label>

            <input type="submit" value="Submit" id="pw-submit" disabled="disabled" name="submit">

        </form>
    </div>
</div>
</body>
</html>