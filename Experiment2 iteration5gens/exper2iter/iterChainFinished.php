<?php
//Removes any slashes etc to avoid anything naughty happening
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}
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
// the $_POST[] array will contain the data
$chain = cleanInput($_POST['chain']);
$gen = cleanInput($_POST['generation']);
//$meetsaccuracy = cleanInput($_POST['meetsaccuracy']);
$workerId = cleanInput($_POST['workerId']);

$sql_markdone = "UPDATE iterated stat = 'Finished' WHERE CONVERT(VARCHAR, [chain]) = '{$chain}' and gen = '{$gen}'";
$conn->query($sql_markdone);

mysqli_close($conn);
?>
