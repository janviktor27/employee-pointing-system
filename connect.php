<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MY CONNECTION
$_CON = mysqli_connect('localhost', 'root', '', 'employee_pointing_system');

if (!$_CON) {
    echo mysqli_connect_error() . PHP_EOL;
    exit;
}
// END CONNECTION
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////