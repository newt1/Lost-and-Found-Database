<?php 
require_once("initialize.php");

$username = $_POST["username"];
$password = $_POST["password"];

$user_data = get_data_by_id("users","1");

if($user_data["username"] == $username && $user_data["password"] == $password){
    $data = ["logged_in" => "True"];
    
    
}


?>