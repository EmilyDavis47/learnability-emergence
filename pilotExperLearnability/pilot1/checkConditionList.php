<? 
//wipe file before each experiment
$filename = "/home/wwwedavispplseda/server_data/conditions.csv";
if (!(file_exists($filename))) {
$headers = array('conditions');
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);
}
//count occurrences of conditions in existing file
$conditions_done = array();
$file = fopen($filename, 'r');

while (($result = fgetcsv($file)) !== false)
{
    $conditions_done[] = $result[0]; 
}
$counts = array_count_values($conditions_done);

$maxed = array();
foreach ($counts as $k => $v) {
    if ($v >=20) {
       $maxed[] = $k ;
    }
}

echo json_encode($maxed)
?>