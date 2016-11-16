<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;
include("vues/v_menu.php") ;
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'consulter';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'consulter':{
		include("controleur/c_consulter.php");break;
	}
	case 'gererFrais' :{
		include("controleur/c_gererFrais.php");break;
	}
	case 'etatFrais' :{
		include("controleur/c_etatFrais.php");break; 
	}
}
include("vues/v_pied.php") ;
?>