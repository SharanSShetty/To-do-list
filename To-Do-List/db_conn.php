<?php

// Check if constants are not defined before defining them
if (!defined("HOSTNAME")) {
    define("HOSTNAME","localhost");
}

if (!defined("USERNAME")) {
    define("USERNAME","root");
}

if (!defined("PASSWORD")) {
    define("PASSWORD","");
}

if (!defined("DATABASE")) {
    define("DATABASE","to_do_app");
}

// Establish database connection using defined constants
$connection=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
if(!$connection) {
    echo "Connection failed";
}

?>
