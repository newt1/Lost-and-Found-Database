<?php
    require_once('../../private/initialize.php');


    $table_name = "lost";
    $page_type = "edit";
    $data = load_empty_table_array($table_name);

    require_once('../../private/new_or_edit.php');
?>