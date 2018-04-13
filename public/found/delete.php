<?php
    require_once('../../private/initialize.php');
    
    $id = $_GET['id'];
    delete_data_by_id("found", $id);
    redirect_to("index.php");
?>