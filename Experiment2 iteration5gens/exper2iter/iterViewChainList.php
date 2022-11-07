<?php
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
$sql3 = "SELECT * FROM iterated";
$result2 = $conn->query($sql3);
echo "<html><table><tr>";
echo "<th>Worker</th><th>Chain</th><th>Gen</th><th>Status</th><th>Time</th></tr>";
while($row = mysqli_fetch_assoc($result2))
  {
  echo "<tr><td>".$row['worker'] ."</td><td>" . $row['chain'] ."</td><td>". $row['gen'] ."</td><td>". $row['stat'] ."</td><td>". $row['time']."</tr>";
  }
echo "</table></html>";
mysqli_close($conn);
?>