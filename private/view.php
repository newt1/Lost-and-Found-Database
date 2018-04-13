<?php
  $data_set = get_data($table_name);
  $category_array = get_category_array();



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
    <script src="../javascript/main.js"></script>	
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

<!-- End of Header -->

<div class="container-fluid">
  <a href="new.php" class="btn btn-info" role="button">Add</a>
  <button id="refresh" type="button" class="btn btn-default">Refresh</button>

  <label for="search">Search</label>
  <input type="text" id="search">

  <table class="table table-striped">
      <!-- Table header -->
      <thead>
        <tr>
        <?php        
        foreach($data as $name => $value){ 
                echo "\t\t<th>" . uc($name) . "</th>\n";           
        }
        ?>
        </tr>
      </thead>

      <!-- Table rows -->
      
      <tbody>      
      
    

      <tbody id="table">
      <?php while($data = mysqli_fetch_assoc($data_set)) { 
        echo "<tr>";
            foreach($data as $name => $value){ 
                if($name == "description"){
                    echo "<td><a href=\"edit.php?id=" . $data['id'] . "\"> " . $data['description'] . "</a></td>";
                }
                else if($name == "category"){
                    echo "<td>" . $category_array[$data[$name]] . "</td>";
                }
                else{
                    echo "<td>" . $data[$name] . "</td>";
                }
            }
        echo "</tr>";
        } 
      ?>


      </tbody>

    </table>

    </div>
    <div id="table_name" data-name="<?php echo $table_name ?>"></div>
</body>