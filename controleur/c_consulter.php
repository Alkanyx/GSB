
<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'formPrac';
}
$action = $_REQUEST['action'];
switch($action){
	case 'formPrac':{
		$lesPracticiens=$pdo->getPrac();
		if(isset($_REQUEST['practicien'])){
			$lePracticien=$pdo->getInfoPrac($_REQUEST['practicien']);
		}
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
		include("vues/v_formMed.php");
		break;
	}
	case 'saisirRap':{
		$lesPracticiens=$pdo->getPrac();
		if(isset($_SESSION['login'])){
		$IdVis = $pdo->getMatricule($_SESSION['login']);
		$pdo->saisirRapport($IdVis,$_POST['RAP_NUM'],$_POST['RAP_DATEVISITE'],'21',$_POST['RAP_DATE'],'1',$_POST['RAP_BILAN']);
		}else{
			echo "erreur";
		}
		break;
	}
	case 'medicament':{
		$lesMedicaments=$pdo->getMedoc();
		if(isset($_REQUEST['medicament'])){
			$leMedicament=$pdo->getInfoMedoc($_REQUEST['medicament']);
		}
		include("vues/v_medicament.php");
		break;
	}
}
?>