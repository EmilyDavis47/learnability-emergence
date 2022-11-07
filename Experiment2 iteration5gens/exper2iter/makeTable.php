<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = 'localhost';
$username = 'wwwedavispplseda_Emily2';
$password = 'Gg;&mV3*tJ9Y3fTyF~';
$dbname = 'wwwedavispplseda_iterated';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$val = mysqli_query($conn,"select 1 from iterated");
if($val !== FALSE) { //table already exists
mysqli_select_db($conn, $dbname);
$result = mysqli_query($conn, "SELECT * FROM iterated");
$num_rows = mysqli_num_rows($result);
print $num_rows;
}else{ //table does not exist
    // sql to create table
    $sql = "CREATE TABLE iterated (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       chain  TEXT, 
       gen INTEGER,
    worker  TEXT,
    stat  TEXT,
    time DATETIME  
    )";
mysqli_query($conn, $sql);
$result = mysqli_query($conn, "SELECT * FROM iterated");
$num_rows = mysqli_num_rows($result);
print 0;
   // if (mysqli_query($conn, $sql)) {
     //   echo "Table created successfully";
  //  } else {
   //     echo "Error creating table: " . mysqli_error($conn);
   // }
}



mysqli_close($conn);
?>