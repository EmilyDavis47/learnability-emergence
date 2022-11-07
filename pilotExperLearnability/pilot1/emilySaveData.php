<?php

function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('/','',$data);
  $data = str_replace('.','',$data);
  return $data;
}
$filename = "/home/wwwedavispplseda/server_data/".cleanInput($_POST['workerId']).".csv";

if (!(file_exists($filename))) {
$headers = array('workerId','hitId','assignmentId','time',
						'chain','generation',
            'level','trialType',
            'nameTraining', 'arrayTraining',  //available for all trials
            'seenInTraining',  //only shown on training and comprehension trials,
						'choiceArray0','choiceArray1','choiceArray2','choiceArray3', 'correctChoiceNumber',
						'participantChoiceNumber', //comprehension only
						'participantText', 'compositionalAnswer', 'seenInTesting' //text trials only'
						);
file_put_contents($filename, implode(',',$headers).PHP_EOL, FILE_APPEND);
}

$standard_data = array($_POST['workerId'],$_POST['hitId'],$_POST['assignmentId'],time(),
						$_POST['chain'],$_POST['generation'],
            $_POST['level'],$_POST['trialType']);
            

$trial_type = $_POST['trialType'];
if ($trial_type=="training") {
	$trial_data = array(
	    $_POST['nameTraining'],
		json_encode($_POST['arrayTraining']),
		'NA',
		'NA','NA','NA','NA','NA', 'NA',
		'NA','NA', 'NA');
}
elseif ($trial_type=="testing") {
	$trial_data = array(
		$_POST['nameTraining'],
		json_encode($_POST['arrayTraining']),
		$_POST['seenInTraining'],
		json_encode($_POST['choiceArray0']),
		json_encode($_POST['choiceArray1']),
		json_encode($_POST['choiceArray2']),
		json_encode($_POST['choiceArray3']),
		$_POST['correctChoiceNumber'],
		$_POST['participantChoiceNumber'],
		"NA", "NA", "NA");
}
elseif ($trial_type=="write") {
	$trial_data = array(
		'NA',
		json_encode($_POST['arrayTraining']),
		$_POST['seenInTraining'],'NA','NA','NA','NA','NA', 'NA',
		$_POST['participantText'], $_POST['compositionalAnswer'], $_POST['seenInTesting']);
}

$trial_data = array_merge($standard_data,$trial_data);
file_put_contents($filename,implode(',',$trial_data).PHP_EOL,FILE_APPEND);



?>
