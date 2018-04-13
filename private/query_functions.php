<?php

    
    //read
    function get_data_by_id($table_name, $id) {
      global $db;

      $sql = "SELECT * FROM {$table_name} ";
      $sql .= "WHERE id='" . $id . "'";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $data = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $data; // returns an assoc. array
    }

    function get_category_array(){
        $result = get_data_col("category", "name");
        $index = 1;
        while($row = mysqli_fetch_assoc($result))
        {
            $data_set[$index] = $row["name"];
            $index += 1;
        }
        return $data_set;
      
    }

    //read
    function get_data($table_name) {
      global $db;

      $sql = "SELECT * FROM {$table_name} ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

    //read
    function get_data_col($table_name, $col) {
      global $db;

      $sql = "SELECT {$col} FROM {$table_name} ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }


    function insert_data($table_name, $data){
      global $db;

      foreach($data as &$value){
        $value = mysqli_real_escape_string($db, $value);
      }
      unset($value);
      

      $sql = "INSERT into {$table_name}";
      $sql .= "(";
              
      $iter_one = True;
      foreach($data as $name => $value){     
          if($iter_one){
              $sql .=   "{$name}";
              $iter_one = False;
          }
          else{
              $sql .=   ", {$name}";
          }
      }
      
      $sql .=   ")";
      $sql .= " VALUES (";

      $iter_one = True;
      foreach($data as $name => $value){     
          if($iter_one){
              $sql .=   "'{$value}'";
              $iter_one = False;
          }
          else{
              $sql .=   ",'{$value}'";
          }
      }

      $sql .= ")";
      

      $result = mysqli_query($db, $sql);

      if($result) {
        return true;
      } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    //update
    function update_data($table_name, $data){
      global $db;

      foreach($data as &$value){
        $value = mysqli_real_escape_string($db, $value);
      }
      
      unset($value);

      $sql = "UPDATE {$table_name} SET ";

      $firstElement = True;
      foreach($data as $name => $value){ 
          if($name == "id")  {

          }   
          else if($firstElement){
              $sql .= "{$name}='{$value}'";
              $firstElement = False;
          }
          else{
              $sql .= ", {$name}='{$value}'";
          }
      }

      $sql .= "WHERE id='" . $data["id"] . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);

      if($result) {
        return true;
      } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
    
    function delete_data_by_id($table_name, $id){
      global $db;

      $sql = "DELETE FROM {$table_name} ";
      $sql .= "WHERE id='" . $id . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);

      if($result) {
        return true;
      } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
    

    function log_in(){
      $sql = "INSERT into users";
      $sql .= "(logged_in)";
      $sql .= " VALUES ('True')";
    }

    function is_logged_in(){
      $user_data = get_data_by_id("users", "1");
      return $user_data["logged_in"];
    }

    

?>