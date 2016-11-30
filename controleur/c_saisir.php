<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}
$action = $_REQUEST['action'];
switch($action){
	case 'saisirRap':{
		$lesPrac=$pdo->getPrac();
		include("vues/v_formPracticien.php");
		break;
	}	
}
?>