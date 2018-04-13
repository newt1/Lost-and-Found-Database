<?php
require_once('table_data.php');

function h($string="") {
    return htmlspecialchars($string);
}

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function get_bootstrap(){
    return require_once('bootstrap.php');
}

function get_jquery(){
    return require_once('jquery.php');
}

function get_styles(){
    return require_once('styles.php');
}

function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

function setup_db(){
    return require_once('setup_db.php');    
}

function load_empty_table_array($table_name){
    global $lost_data;
    global $found_data;

    if($table_name == "lost"){
        return $lost_data;
    }
    else if($table_name == "found"){
        return $found_data;
    }
}


function uc($string){
    return ucfirst(str_replace("_", " ", $string));
}

?>