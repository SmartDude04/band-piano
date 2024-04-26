<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

?>

<div class="content">
    <svg viewBox="0 0 2000 1100" id="staff" preserveAspectRatio="xMidYMid slice" class="piano">
        <!--  Image provided by Wikimedia: https://upload.wikimedia.org/wikipedia/commons/1/15/PianoKeyboard.svg   -->

        <!--  White keys   -->
        <rect class="key-0" style="fill:white;stroke:black" x="0" y="0" width="23" height="120"/>
        <rect class="key-2" style="fill:white;stroke:black" x="23" y="0" width="23" height="120"/>
        <rect class="key-4" style="fill:white;stroke:black" x="46" y="0" width="23" height="120"/>
        <rect class="key-5" style="fill:white;stroke:black" x="69" y="0" width="23" height="120"/>
        <rect class="key-7" style="fill:white;stroke:black" x="92" y="0" width="23" height="120"/>
        <rect class="key-9" style="fill:white;stroke:black" x="115" y="0" width="23" height="120"/>
        <rect class="key-11" style="fill:white;stroke:black" x="138" y="0" width="23" height="120"/>
        <!--  Black keys (overlap with the white keys)  -->
        <rect class="key-1" style="fill:black;stroke:black" x="14.33333" y="0" width="13" height="80"/>
        <rect class="key-3" style="fill:black;stroke:black" x="41.66666" y="0" width="13" height="80"/>
        <rect class="key-6" style="fill:black;stroke:black" x="82.25" y="0" width="13" height="80"/>
        <rect class="key-8" style="fill:black;stroke:black" x="108.25" y="0" width="13" height="80"/>
        <rect class="key-10" style="fill:black;stroke:black" x="134.75" y="0" width="13" height="80"/>
    </svg>
</div>