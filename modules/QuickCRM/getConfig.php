<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Allow-Credentials: true");

$res='';

if ($_REQUEST['param']=='file') {
	header("Content-Type: text/plain");
	$res= file_get_contents('custom/QuickCRM/'.basename($_REQUEST['name']),true);
}
else {
	header("Content-Type: application/javascript");
	$f='mobile'.(isset($_REQUEST['trial'])?'_trial':'').'/fielddefs/';
	
	switch ($_REQUEST['param']){
		case 'custom':
			if (file_exists('custom/QuickCRM/custom.js')){
				$res = file_get_contents('custom/QuickCRM/custom.js',true);
			}
			break;
		case 'sugar_config':
			$res .= file_get_contents($f.'../config.js',true);
			break;
		default:
			$res= file_get_contents($f.basename($_REQUEST['param']).'.js',true);
			break;
	}
}
ob_clean();
if (isset($_REQUEST['to_json'])){
	echo $_GET["jsoncallback"] . '({response: "' . base64_encode($res) . '"});';
}
else {
	echo $res;
}
die;
