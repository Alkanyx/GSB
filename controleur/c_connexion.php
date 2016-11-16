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
		include("vues/.php");
		break;
	}
	
}
?>