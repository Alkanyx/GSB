
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
		$lesPracticiens=$pdo->getPrac();

		//$lesRapports=$pdo->getRapports($_SESSION['idVis']);
		if(isset($_REQUEST['medicament'])){
			$leMedicament=$pdo->getInfoMedoc($_REQUEST['medicament']);
		}
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
		if(isset($_SESSION['login'])){
			$IdVis = $pdo->getMatricule($_SESSION['login']);
			if(isset ( $_POST['PRA_REMPLACANT'])){
				$pdo->saisirRapportRemp($IdVis,$_POST['RAP_NUM'],$_POST['RAP_DATEVISITE'],$_POST['PRA_NUM'],$_POST['RAP_DATE'],'1',$_POST['RAP_BILAN'],$_POST['PRA_REMPLACANT']);
			}else{
				$pdo->saisirRapport($IdVis,$_POST['RAP_NUM'],$_POST['RAP_DATEVISITE'],$_POST['PRA_NUM'],$_POST['RAP_DATE'],$_POST['RAP_MOTIF'],$_POST['RAP_BILAN']);
			}
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