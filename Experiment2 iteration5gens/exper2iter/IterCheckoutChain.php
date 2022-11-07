<?php
$servername = 'localhost';
$username = 'wwwedavispplseda_Emily2';
$password = 'Gg;&mV3*tJ9Y3fTyF~';
$dbname = 'wwwedavispplseda_iterated';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Removes any slashes etc to avoid anything naughty happening
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}

$worker = cleanInput($_POST['workerId']);

$mysqli = new mysqli($servername, $username, $password, $dbname);

//Ones that were tagged as InProgress more than 3 hours ago and have not been updated need to be freed up again: SUBTIME(NOW(),'03:10:00
//username emily1 is for testing
$sql_cleanup = "UPDATE iterated SET stat='Available',worker=NULL,time=NULL WHERE (stat='InProgress' AND time < SUBTIME(NOW(),'01:45:00') OR worker='emily1')";
$mysqli->query($sql_cleanup);

//Command to select a randomly available condition
//$sql_random_chain1 = "SET @myid = (SELECT id FROM iterated WHERE stat='Available' ORDER BY RAND() LIMIT 1)";
//if we wanted to select from the lowest generation available the command would be
$sql_random_chain1 = "SET @myid = (SELECT id from iterated where stat='Available' AND gen=(SELECT MIN(gen) from iterated where stat='Available') ORDER BY RAND() LIMIT 1)";

//Command to mark it as InProgress
$sql_random_chain2 = "UPDATE iterated SET stat='InProgress',worker='{$worker}',time=NOW() WHERE id=@myid";

//Command to return that row
$sql_random_chain3 = "SELECT id,chain,gen FROM iterated WHERE id=@myid";

//Execute
$mysqli->query($sql_random_chain1);
$mysqli->query($sql_random_chain2);
$result = $mysqli->query($sql_random_chain3) or die($conn->error);;

//Convert to something more usable and return
$result_string = json_encode($result->fetch_assoc());
echo $result_string;
//echo $result;

?>
