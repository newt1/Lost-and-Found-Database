<?php

    if($page_type == "edit"){            
        $data = get_data_by_id($table_name, $_GET["id"]);
    }

    if(is_post_request()) {

        //gets all values including id for edit page
        foreach($data as $name => &$value){   
            $value = $_REQUEST["{$name}"] ?? '';
        }

        if($page_type == "new"){
            if($result = insert_data($table_name, $data)){
                $new_id = mysqli_insert_id($db);
                redirect_to('index.php');
            }
        }        
        else if($page_type == "edit"){

            if($result = update_data($table_name, $data)){
                redirect_to('index.php');
            }
        }
    
    }

?>

<!doctype html>

<html lang="en">
  <head>
    <title><?php echo h($site_name); ?></title>
    <meta charset="utf-8">
    <?php
        get_jquery();
        get_bootstrap();
    ?>
  </head>

<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../"><?php echo h($site_name); ?></a>
    </div>
    <ul class="nav navbar-nav">
        

      
    <li <?php if($table_name == "found"){
        echo "class=\"active\"";
        } 
        ?>><a href="../found">Found</a></li>
    <li <?php if($table_name == "lost"){
        echo "class=\"active\"";
        } 
        ?> ><a href="../lost">Lost</a></li>

      
    </ul>
  </div>
</nav>
<div class="container-fluid">
<h1><?php echo uc($page_type) . " " . uc($table_name) . " Item"; ?></h1>

<form action="<?php 
if($page_type == "new"){
    echo "{$page_type}.php";
}
else if($page_type == "edit"){
    echo "{$page_type}.php?id=" . $data["id"];
}
?>" method="post">


    <?php
    
    foreach($data as $name => $value){  
        echo "\n\t<dl>\n";
        if($name == "category"){
            echo "\t\t<dt>" . uc($name) . "</dt>\n";
            echo "\t\t<dd>\n";
            echo "\t\t\t<select name=\"category\">";
            $category_set = get_data("category");
            while($category_row = mysqli_fetch_assoc($category_set)) {

                echo "<option value=\"" . $category_row["id"] . "\"";
                
                if($category_row["id"] == $data['category']) {
                  echo " selected";
                }
                echo ">" . $category_row["name"] . "</option>";
              }

            echo  "\t\t\t</select>\n";
            echo "\t\t</dd>\n"; 
        }
        else if($name != "id") {
            echo "\t\t<dt>" . uc($name) . "</dt>\n";
            echo "\t\t<dd><input type=\"text\" name=\"" . $name . "\" value=\"" . $value . "\" /></dd>\n";   
        }     
        echo "\t</dl>\n";
    }
   
    ?>
      
    <input class="btn btn-success" type="submit" value="Save" />
    <?php 
        if($page_type == "edit"){            
            echo "<a href=\"delete.php?id=" . $data["id"] . "\" class=\"btn btn-danger\" role=\"button\">Delete</a>";
        }
    ?>
    <a href="index.php" class="btn btn-default" role="button">cancel</a>


    </form>
</div>

</body>