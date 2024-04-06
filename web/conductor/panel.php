<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conductor Panel &bull; Band Piano</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

    <script src="panel.js"></script>

    <link rel="stylesheet" href="panel.css?v=<?php echo rand(0, 1000); ?>">
    <link rel="stylesheet" href="../global.css">

</head>
<body>
    <nav>
        <a href="panel.php" id="logo-container">
            <img src="../img/band-piano-logo.png" id="logo" alt="Band Piano Logo" >
        </a>

        <div id="main-menu">
            <form action="" method="post" id="main-nav">
                <input type="button" value="Panel" class="poppins-bold page-button">
                <input type="button" value="Settings" class="poppins-bold page-button not-selected">
                <input type="button" value="Filler" class="poppins-bold page-button not-selected">
            </form>
        </div>

        <div id="user-settings">
            <a href="../index.html" class="poppins-black settings-link">Home</a>
            <a href="login.php?logout=true" class="poppins-black settings-link">Logout</a>
        </div>
    </nav>
</body>
</html>