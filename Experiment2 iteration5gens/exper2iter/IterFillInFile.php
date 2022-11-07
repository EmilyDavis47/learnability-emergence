
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
$worker = cleanInput($_POST['workerId']);
$gen = cleanInput($_POST['generation']);
$chain = cleanInput($_POST['chain']);

$filename = "/home/wwwedavispplseda/server_data/".$chain."_GenList.csv";
//make file if there isn't one already, and fill in generation 0 data
if (!(file_exists($filename))) {
$headers = array('workerId','chain','generation', 'nouns','strings');
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);// this is gen 0; there is nothing but the headers
    	$gen_data = array(
		"NULL",
		$chain,
		0, //generation 0 
		$_POST['nouns'],
		$_POST['strings']);
    file_put_contents($filename,implode(',',$gen_data).PHP_EOL,FILE_APPEND);
 }
 else {
     //file has been made, this is a later gen
     $gen_data2 = array(
		$worker,
		$chain,
		$gen,
		$_POST['nouns'],
		$_POST['strings']);
    file_put_contents($filename,implode(',',$gen_data2).PHP_EOL,FILE_APPEND);
 }
 echo $chain; 

?>
