<?php
require_once('database.php');

// Create connection

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Do not need to drop and create database
/*
//drop database
$sql = "DROP DATABASE IF EXISTS " . DB_NAME; 
//$result = mysqli_query($conn, $sql);
      
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully <br>";
} else {
    echo "Error dropping database: " . $conn->error .  "<br>";
}

//create database
$sql = "CREATE DATABASE " . DB_NAME;
//$result = mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error .  "<br>";
}
*/

$db = db_connect();


//drop and create tables
foreach($tables as $table_name => $data){
    $sql = "DROP TABLE IF EXISTS {$table_name};";
    
    if ($result = mysqli_query($db, $sql)) {
        echo "Table {$table_name} dropped successfully <br>";
    } else {
        echo "Error dropping table {$table_name}: " . mysqli_error($db) .  "<br>";
    }

    $sql = "CREATE TABLE {$table_name} (";
    foreach($data as $name => $value){
        if($name == "id"){
            $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        }
        if($name == "category"){
            $sql .= "{$name} int(11) DEFAULT NULL, ";
        }
        else if($name != "id"){
            $sql .= "{$name} varchar(255) DEFAULT NULL, ";
        }
    }
    $sql .= "PRIMARY KEY (id)";
    $sql .= ")";

    if ($result = mysqli_query($db, $sql)) {
        echo "Table {$table_name} created successfully <br>";
    } else {
        echo "Error created table {$table_name}: " . mysqli_error($db) .  "<br>";
    }
}

$table_name = "category";

//create category table
$sql = "INSERT INTO {$table_name} (name) VALUES ";
foreach($categories as $value){
  $sql .= "('{$value}'),";
}
//remove last comma
    $sql = substr($sql, 0, -1);

if ($result = mysqli_query($db, $sql)) {
    echo "{$table_name} data added successfully <br>";
} else {
    echo "Error adding {$table_name} data: " . mysqli_error($db) .  "<br>";
}

$table_name = "users";

/*
//insert user data
$sql = "INSERT INTO {$table_name} (username, password, logged_in) VALUES ";
$sql .= "('" .$users["username"] . "','" . $users["password"] . "'" . $users["logged_in"] . ")";

if ($result = mysqli_query($db, $sql)) {
    echo "{$table_name} data added successfully <br>";
} else {
    echo "Error adding {$table_name} data: " . mysqli_error($db) .  "<br>";
}*/



$first_names = ["Marcus", "Lester", "Desiree", "Janie", "George", 
"Jesus", "Salvatore", "Melody", "Norman", "Mercedes", 
"Richard", "Rebecca","David","Annie","Tina",
"Ralph","Teresa","Mark","Tom","Rachel"];

$last_names = ["Watts", "Wright","Hines","Pierce","Fitgerald",
"Walsh","Bryant","Moody","Schmidt","Ford", 
"Turner", "Li", "Lee","Brooks","Parker",
"Cook", "Bailey","Adams","Thompson", "Ramirez"];

$descriptions = ["dorm keys", "wallet", "one card", 
"debit card", "bicycle", "car keys", "watch", "ring", "necklace",
 "earing", "keycard", "iPhone 6", "iPhone 5", "jacket", 
 "gloves", "go pro", "UNC student planner", 
 "USB drive", "Swahili textbook", 
"car key", "wallet", "Longboard", "Water Bottle"];

$turned_in_locations = ["With ", "Student Union Lost and Found Desk", "Sitterson front desk", "Carmichael Gym", "Public Safety", "Hanes Art"];

$lost_locations = ["Sitterson","Phillips","Lenior","Student Union","Genome", 
"Winston or Aycock", "between Davis and Fetzer",  "Campus Y",
"Stratford Apartments", "Granville", 
"Hooker Field 3", "Gardner, Davis, or Chapman", 
"Undergraduate Library"];

$found_locations = ["Sitterson","Phillips","Lenior","Student Union","Genome", 
"Winston", "Aycock", "by South Rd",  
"Stratford Apartments", "Granville", 
"Hooker Field 3", "Gardner", "Davis", "Chapman", 
"Undergraduate Library"];


for($i=0; $i<50; $i++) {
    insert_random_lost_data($i);
    insert_random_found_data($i);
}


//add random found data
function insert_random_lost_data($i){
    global $db;

    global $first_names;
    global $last_names;
    global $descriptions;
    global $turned_in_locations;
    global $lost_locations;

    $rand_name = rand(0,sizeof($first_names)-1);
    $rand_phone = rand(111,999) . "-" . rand(111,999) . "-" . rand(1111,9999);
    $rand_location = rand(0,sizeof($lost_locations)-1);
    $rand_date = rand(1,30) . "-" . rand(1,12) . "-" . (2017+rand(0,1));
    $rand_description = rand(0,sizeof($descriptions)-1);
    $rand_category = rand(1,13);

    $sql = "INSERT INTO lost (first,last,description,category,location_lost,date_lost,phone) VALUES (";
    $sql .= "'" . $first_names[$rand_name] . "',";
    $sql .= "'" . $last_names[$rand_name] . "',";
    $sql .= "'" . $descriptions[$rand_description] . "',";
    $sql .= "'" . strval($rand_category) . "',";
    $sql .= "'" . $lost_locations[$rand_location] . "',";
    $sql .= "'" . $rand_date . "',";
    $sql .= "'" . $rand_phone . "'";
    $sql .= ")";

    if ($result = mysqli_query($db, $sql)) {
        echo "lost data {$i} generated<br>";
    } else {
        echo "Error generating lost data {$i}: " . mysqli_error($db) .  "<br>";
    }
}

//add random found data
function insert_random_found_data($i){
    global $db;

    global $first_names;
    global $last_names;
    global $descriptions;
    global $turned_in_locations;
    global $found_locations;

    $rand_phone = rand(111,999) . "-" . rand(111,999) . "-" . rand(1111,9999);
    $rand_location = rand(0,sizeof($found_locations)-1);
    $rand_day = rand(1,26);
    $rand_month = rand(1,12);
    $rand_year = rand(0,1);
    $rand_date = $rand_month . "-" . $rand_day . "-" . (2016+$rand_year);
    $rand_date2 = $rand_month . "-" . ($rand_day+rand(0,1)) . "-" . (2016+$rand_year);
    $rand_description = rand(0,sizeof($descriptions)-1);
    $rand_category = rand(1,13);
    $rand_current_location = rand(0,sizeof($turned_in_locations)-1);
    if($rand_current_location == 0){
        $rand_name = rand(0,sizeof($first_names)-1);
        $current_location = $turned_in_locations[0] . $first_names[$rand_name] . " " . $last_names[$rand_name];
    } else {
        $current_location = $turned_in_locations[$rand_current_location];
    }

    $sql = "INSERT INTO found (description,category,found_location,date_found,date_turned_in,current_location) VALUES (";
    $sql .= "'" . $descriptions[$rand_description] . "',";
    $sql .= "'" . strval($rand_category) . "',";
    $sql .= "'" . $found_locations[$rand_location] . "',";
    $sql .= "'" . $rand_date . "',";
    $sql .= "'" . $rand_date2 . "',";
    $sql .= "'" . $current_location . "'";
    $sql .= ")";

    if ($result = mysqli_query($db, $sql)) {
        echo "found data {$i} generated<br>";
    } else {
        echo "Error generating found data {$i}: " . mysqli_error($db) .  "<br>";
    }
}


db_disconnect($db);
?>