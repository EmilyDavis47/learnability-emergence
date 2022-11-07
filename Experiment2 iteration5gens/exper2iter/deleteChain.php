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
$sql_update = "DELETE FROM iterated WHERE chain = 'H' and gen > 6";
$conn->query($sql_update);
mysqli_close($conn);
?>