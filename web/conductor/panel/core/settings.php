<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

?>

<div class="settings" id="settings">

    <h1 class="title poppins-black">Settings</h1>

    <div class="elements">
        <div class="element latency">
            <h1 class="poppins-extrabold">Latency</h1>
            <div>
                <h1 class="poppins-extrabold" id="latency-num">--</h1>
                <h1 class="poppins-extrabold">&nbsp;ms</h1>
            </div>
        </div>

        <div class="element">
            <h1 class="poppins-extrabold">Notes Database Reset</h1>
            <button class="settings-button poppins-extrabold" onclick="showToast()">Clear Notes</button>
        </div>
    </div>
</div>