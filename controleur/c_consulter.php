
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
		if(isset($_SESSION['login'])){
		$visiteur = $pdo->getMatricule($_SESSION['login']);
		//$pdo->saisirRapport($IdVis,$Num,$DateVis,$NumPrat,$RapDate,$IdMotif,$RapMotif,$RapBilan);
		}else{
			echo "erreur";
		}
		break;
	}
	case 'medicament':{
		include("vues/v_formMed.php");
		break;
	}
}
?>