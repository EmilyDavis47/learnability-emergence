<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}
$chain = cleanInput($_POST['chain']);
$filename = "/home/wwwedavispplseda/server_data/".$chain."_GenList.csv";
$num_rows = count(file($filename));
$csv = array();
 if(($handle = fopen($filename, "r")) !== FALSE)
 {
    while(($data2 = fgetcsv($handle, 10000, ",")) !== FALSE)
    {
        $csv[] = $data2;
    }
 }

fclose($handle);
$genInfo = $csv[$num_rows-1][2]."#".$csv[$num_rows-1][3]."#".$csv[$num_rows-1][4];//gen, nouns, strings in most recent
echo json_encode($genInfo)
    ?>