<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;

session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

if(!$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}elseif(!isset($_REQUEST['uc'])){
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
}
include("vues/v_pied.php") ;
?>