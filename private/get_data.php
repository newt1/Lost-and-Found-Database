<?php

    require_once("initialize.php");

    $table_name = $_REQUEST["table"] ?? "";
    if($table_name == ""){
        echo "Must specify table: use get_data.php?table=";
    }

    $id = $_REQUEST["id"] ?? "";


    $search = strtolower($_REQUEST["search"] ?? "");
    

    //for getting category data
    if($table_name == "category"){
        header("Content-type: application/json");
        echo json_encode(get_category_array());
        exit();
    }



    if($id !=""){
        $data = get_data_by_id($table_name, $id);
        header("Content-type: application/json");
        echo json_encode($data);
    }
    else{

        $data_set =[];

        $result = get_data($table_name);

        while($row = mysqli_fetch_assoc($result))
        {
            $data_set[] = $row;
        }
        if($search != ""){
            $found_set = [];
            foreach($data_set as $data){
                if(strpos(strtolower($data["description"]), $search) !== false){
                    $found_set[] = $data;
                }
            }
            header("Content-type: application/json");
            echo json_encode($found_set);
        }
        else{
            header("Content-type: application/json");
            echo json_encode($data_set);
        }
    }


?>