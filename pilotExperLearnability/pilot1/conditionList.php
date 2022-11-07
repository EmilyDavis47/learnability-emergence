<? 

//DELETE BEFORE EACH EXPERIMENT
$filename = "/home/wwwedavispplseda/server_data/conditions.csv";
if (!(file_exists($filename))) {
$headers = array('conditions');
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);
}

//put condition into file
$data = array($_POST['condition']);
file_put_contents($filename, implode(',',$data).PHP_EOL,FILE_APPEND);

?>