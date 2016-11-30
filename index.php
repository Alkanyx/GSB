<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;

session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) && !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}else{
	$_REQUEST['uc'] = 'consulter';
}
$uc = $_REQUEST['uc'];
switch($uc){
	case 'consulter':{
		include("controleur/c_consulter.php");break;
	}
	case 'connexion' :{
		include("controleur/c_connexion.php");break;
	}
	case 'etatFrais' :{
		include("controleur/c_etatFrais.php");break; 
	}
	case 'saisir' :{
		include("controleur/c_saisir.php");break;
	}
}
include("vues/v_pied.php") ;
?>