<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'formPrac';
}
$action = $_REQUEST['action'];
echo $action;
switch($action){
	case 'formPrac':{
		include("vues/v_formPracticien.php");
		break;
	}
	case 'formVis':{
		include("vues/v_formVisiteur.php");
		break;
	}
	case 'formRap':{
		include("vues/v_formRapport.php");
		break;
	}
	case 'formMed':{
		include("vues/v_formMedicament.php");
		break;
	}
	
}
?>