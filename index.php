<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'infoprac';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'infoprac':{
		include("controleur/c_infoPrac.php");break;
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