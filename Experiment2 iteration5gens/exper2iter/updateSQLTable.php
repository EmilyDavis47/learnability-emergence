<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$chains = explode(";", $_POST['chains']);

$servername = 'localhost';
$username = 'wwwedavispplseda_Emily2';
$password = 'Gg;&mV3*tJ9Y3fTyF~';
$dbname = 'wwwedavispplseda_iterated';

$conn = mysqli_connect($servername, $username, $password, $dbname);
$result = $conn->query("SELECT * FROM iterated");
$num_rows = mysqli_num_rows($result);
if ($num_rows == 0) {
    foreach ($chains as $chain) {
$sql = "INSERT INTO iterated (chain, gen, worker, stat, `time`) 
VALUES (?, 0, NULL, 'Available', NULL)";
$stmt= $conn->prepare($sql);
if ($stmt !== FALSE) {
    $stmt->bind_param("s", $chain);
    $stmt->execute();
    } else {
    $error = $conn->errno . ' ' . $conn->error;
    echo $error;
    }
}
}

?>