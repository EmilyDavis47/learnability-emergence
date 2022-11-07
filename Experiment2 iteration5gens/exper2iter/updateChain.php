 <?php 
 
error_reporting(E_ALL);
ini_set('display_errors', 1);
 //update SQL 
 // the $_POST[] array will contain the data
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}
$worker = cleanInput($_POST['workerId']);
$gen = cleanInput($_POST['gen']);
$chain = cleanInput($_POST['chain']);
$stat = cleanInput($_POST['stat']);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
if ($stat == 'Finished') {//if diversity criterion has been met
$sql_update = "UPDATE iterated SET stat='Finished' ,`time`=NOW() WHERE gen='$gen' AND chain = '$chain'";
$conn->query($sql_update);
$sql_add = "INSERT INTO iterated (chain, gen, worker, stat, `time`) 
VALUES (?, ?, ?, ?, ?)";
$blank = ' ';
$nl = NULL;
$newgen = intval($gen)+1;
$max = 10;
if ($newgen == $max) {//done with this chain
    echo 'chain complete';
}
else { //if more generations
$stmt=  $conn->prepare($sql_add);
$stat2 = 'Available';
if ($stmt !== FALSE) {
    $stmt->bind_param("sisss", $chain, $newgen, $blank, $stat2, $nl);
    $stmt->execute();
    $stmt->close();
    } else {
    $error = $conn->errno . ' ' . $conn->error;
    echo $error;
    }
$conn->query($sql_add);
}
//update CSV file with same info as table
$filename = "/home/wwwedavispplseda/server_data/chainList.csv";
if (!(file_exists($filename))) {
$headers = array('worker','chain','generation');
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);
}
$standard_data = array($worker,$chain,$gen);
file_put_contents($filename, implode(',',$standard_data).PHP_EOL,FILE_APPEND);
} else {//criterion for iteration not met
$sql_update = "UPDATE iterated SET stat='Available',`time`=NULL, worker = NULL WHERE gen='$gen' AND chain = '$chain'";
$conn->query($sql_update);
    
}

mysqli_close($conn);



?>