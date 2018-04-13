<?php

$site_location = "local";

if($site_location == "local"){
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "finder");
}
else if($site_location == "online"){
    define("DB_SERVER", "localhost");
    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_NAME", "");
}




?>