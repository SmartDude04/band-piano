<?php

// Prevent direct access to this page without going through index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

?>

<svg viewBox="0 0 2635 600" id="staff" preserveAspectRatio="xMidYMid slice" class="piano">
    <!--  White keys  -->
    <rect id="key-47" style="fill:white;stroke:black" x="0" y="0" width="115" height="600"/>
    <rect id="key-48" style="fill:white;stroke:black" x="115" y="0" width="115" height="600"/>
    <rect id="key-50" style="fill:white;stroke:black" x="230" y="0" width="115" height="600"/>
    <rect id="key-52" style="fill:white;stroke:black" x="345" y="0" width="115" height="600"/>
    <rect id="key-53" style="fill:white;stroke:black" x="460" y="0" width="115" height="600"/>
    <rect id="key-55" style="fill:white;stroke:black" x="575" y="0" width="115" height="600"/>
    <rect id="key-57" style="fill:white;stroke:black" x="690" y="0" width="115" height="600"/>
    <rect id="key-59" style="fill:white;stroke:black" x="805" y="0" width="115" height="600"/>
    <!--  Black keys (overlap with the white keys) -->
    <rect id="key-49" style="fill:black;stroke:black" x="185" y="0" width="65" height="400"/>
    <rect id="key-51" style="fill:black;stroke:black" x="312" y="0" width="65" height="400"/>
    <rect id="key-54" style="fill:black;stroke:black" x="541" y="0" width="65" height="400"/>
    <rect id="key-56" style="fill:black;stroke:black" x="656" y="0" width="65" height="400"/>
    <rect id="key-58" style="fill:black;stroke:black" x="771" y="0" width="65" height="400"/>

    <!--  White keys  -->
    <rect id="key-60" style="fill:white;stroke:black" x="920" y="0" width="115" height="600"/>
    <rect id="key-62" style="fill:white;stroke:black" x="1035" y="0" width="115" height="600"/>
    <rect id="key-64" style="fill:white;stroke:black" x="1150" y="0" width="115" height="600"/>
    <rect id="key-65" style="fill:white;stroke:black" x="1265" y="0" width="115" height="600"/>
    <rect id="key-67" style="fill:white;stroke:black" x="1380" y="0" width="115" height="600"/>
    <rect id="key-69" style="fill:white;stroke:black" x="1495" y="0" width="115" height="600"/>
    <rect id="key-71" style="fill:white;stroke:black" x="1610" y="0" width="115" height="600"/>
    <!--  Black keys (overlap with the white keys)  -->
    <rect id="key-61" style="fill:black;stroke:black" x="1000" y="0" width="65" height="400"/>
    <rect id="key-63" style="fill:black;stroke:black" x="1120" y="0" width="65" height="400"/>
    <rect id="key-66" style="fill:black;stroke:black" x="1345" y="0" width="65" height="400"/>
    <rect id="key-68" style="fill:black;stroke:black" x="1462" y="0" width="65" height="400"/>
    <rect id="key-70" style="fill:black;stroke:black" x="1576" y="0" width="65" height="400"/>

    <!--  White keys  -->
    <rect id="key-72" style="fill:white;stroke:black" x="1725" y="0" width="115" height="600"/>
    <rect id="key-74" style="fill:white;stroke:black" x="1840" y="0" width="115" height="600"/>
    <rect id="key-76" style="fill:white;stroke:black" x="1955" y="0" width="115" height="600"/>
    <rect id="key-77" style="fill:white;stroke:black" x="2070" y="0" width="115" height="600"/>
    <rect id="key-79" style="fill:white;stroke:black" x="2185" y="0" width="115" height="600"/>
    <rect id="key-81" style="fill:white;stroke:black" x="2300" y="0" width="115" height="600"/>
    <rect id="key-83" style="fill:white;stroke:black" x="2415" y="0" width="115" height="600"/>
    <!--  Black keys (overlap with the white keys) -->
    <rect id="key-73" style="fill:black;stroke:black" x="1805" y="0" width="65" height="400"/>
    <rect id="key-75" style="fill:black;stroke:black" x="1925" y="0" width="65" height="400"/>
    <rect id="key-78" style="fill:black;stroke:black" x="2150" y="0" width="65" height="400"/>
    <rect id="key-80" style="fill:black;stroke:black" x="2267" y="0" width="65" height="400"/>
    <rect id="key-82" style="fill:black;stroke:black" x="2381" y="0" width="65" height="400"/>

    <rect id="key-84" style="fill:white;stroke:black" x="2520" y="0" width="115" height="600"/>
</svg>
