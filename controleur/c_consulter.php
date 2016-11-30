
<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'formPrac';
}
$action = $_REQUEST['action'];
switch($action){
	case 'formPrac':{
		$lesPrac=$pdo->getPrac();
		include("vues/v_formPracticien.php");
		break;
	}
	case 'formVis':{
		include("vues/v_formVisiteur.php");
		break;
	}
	case 'formRap':{
		$lesPracticiens=$pdo->getPrac();
		include("vues/v_formRapport.php");
		break;
	}
	case 'formMed':{
		include("vues/v_formMed.php");
		break;
	}
	case 'saisirRap':{
		
		echo $_POST['RAP_NUM'];
		break;
	}
}
?>