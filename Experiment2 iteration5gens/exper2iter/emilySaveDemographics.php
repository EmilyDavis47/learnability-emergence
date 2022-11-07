<?php

function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  $data = str_replace(',',';',$data);
  $data = trim(preg_replace('/\s\s+/', ' ', $data));
  return $data;
}
$filename = "/home/wwwedavispplseda/server_data/".cleanInput($_POST['workerId'])."Demo.csv";
if (!(file_exists($filename))) {
$headers = array('workerId',
'hitId',
'assignId',
    'writing',
'langNative', 
'langOther',
'preps',
'comments');
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);
}
$demo_data = array($_POST['workerId'],$_POST['hitId'],$_POST['assignmentId'],$_POST['writing'],cleanInput($_POST['langNative']), cleanInput($_POST['langOther']),
            cleanInput($_POST['preps']), cleanInput($_POST['comments']));

file_put_contents($filename, implode(',',$demo_data).PHP_EOL, FILE_APPEND);
?>
