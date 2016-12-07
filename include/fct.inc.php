<?php
/** 
 * Fonctions pour l'application GSB
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */
/**
 * Teste si un quelconque visiteur est connecté
 *
 * @return vrai ou faux
 */
function estConnecte() {
		var_dump($_SESSION['login']);
	return isset ( $_SESSION ['login'] );
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 *
 * @param
 *        	$id
 * @param
 *        	$nom
 * @param
 *        	$prenom
 */
function connecter($id, $nom, $prenom) {
	$_SESSION ['idVisiteur'] = $id;
	$_SESSION ['nom'] = $nom;
	$_SESSION ['prenom'] = $prenom;
}
/**
 * Détruit la session active
 */
function deconnecter() {
	session_destroy ();
}
?>