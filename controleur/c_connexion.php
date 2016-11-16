<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeconnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeconnexion':{
		include("vues/v_connexion.php");
		break;
	}
	
	case 'valideconnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			echo "yooooooooo";
			//include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			header('location:index.php?uc=consulter');
		}
		break;
	}
	
}
?>