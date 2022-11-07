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
$sql_update = "UPDATE iterated SET worker=NULL, stat='Available' ,`time`=NULL WHERE (gen='8' AND chain = 'H') OR (gen='3' AND chain = 'J')";
$sql_update2 = "UPDATE iterated SET worker=NULL, stat='X' ,`time`=NULL WHERE gen='9' AND chain = 'H' OR (gen='4' AND chain = 'J')";
$sql_update3 = "UPDATE iterated SET worker=NULL ,`time`=NULL, stat = 'Available' WHERE worker = 'AEQ8K4HBO323D'";
$conn->query($sql_update);
$conn->query($sql_update2);
mysqli_close($conn);
?>