
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// the $_POST[] array will contain the data
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}
$chain = cleanInput($_POST['chain']);

$filename = "/home/wwwedavispplseda/server_data/".$chain."_GenList.csv";
//make file if there isn't one already, and fill in generation 0 data
if (!(file_exists($filename))) {
    print 0;
} else {
    print 1;
}
    ?>