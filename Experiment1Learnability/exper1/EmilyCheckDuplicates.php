<?php
// the $_POST[] array will contain the data

//build filename from workerId. I am removing an slashes etc from workerID to avoid anything naughty happening
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}

$filename = "/home/wwwedavispplseda/server_data/".cleanInput($_POST['workerId']).".csv";

$duplicate_string = 'NotDuplicate';
if (file_exists($filename)) {
	$duplicate_string = 'Duplicate';
}

print $duplicate_string;

?>
