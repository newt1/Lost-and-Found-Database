<?php
    require_once('../../private/initialize.php');


    $table_name = "found";
    $page_type = "new";
    $data = load_empty_table_array($table_name);

    require_once('../../private/new_or_edit.php');
?>