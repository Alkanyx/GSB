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
			ajouterErreur("Login ou mot de passe incorrect");
			//include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
			connecter($id,$nom,$prenom);
			echo "yooooooooo";
			header('location:index.php?uc=consulter');
		}
		break;
	}
	
}
?>