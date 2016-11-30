<?php
/** 
 * Classe d'acc�s aux donn�es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 */
class PdoGsb {
	private static $serveur = 'mysql:host=localhost';
	private static $bdd = 'dbname=gsb';
	private static $user = 'root';
	private static $mdp = '';
	private static $monPdo;
	private static $monPdoGsb = null;
	/**
	 * Constructeur priv�, cr�e l'instance de PDO qui sera sollicit�e
	 * pour toutes les m�thodes de la classe
	 */
	private function __construct() {
		PdoGsb::$monPdo = new PDO ( PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp );
		PdoGsb::$monPdo->query ( "SET CHARACTER SET utf8" );
	}
	public function _destruct() {
		PdoGsb::$monPdo = null;
	}
	/**
	 * Fonction statique qui cr�e l'unique instance de la classe
	 *
	 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
	 *
	 * @return l'unique objet de la classe PdoGsb
	 */
	public static function getPdoGsb() {
		if (PdoGsb::$monPdoGsb == null) {
			PdoGsb::$monPdoGsb = new PdoGsb ();
		}
		return PdoGsb::$monPdoGsb;
	}
	/**
	 * Retourne les informations d'un visiteur
	 *
	 * @param
	 *        	$login
	 * @param
	 *        	$mdp
	 * @return l'id, le nom et le pr�nom sous la forme d'un tableau associatif
	 *        
	 */
	public function getInfoPrac($pracNum) {
		$req = "select * from praticien where pra_num=$pracNum";
		$rs = PdoGsb::$monPdo->query ( $req );
		$ligne = $rs->fetch ();
		return $ligne;
	}
	
	/**
	 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
	 * concern�es par les deux arguments
	 *
	 * La boucle foreach ne peut �tre utilis�e ici car on proc�de
	 * � une modification de la structure it�r�e - transformation du champ date-
	 *
	 * @param
	 *        	$idVisiteur
	 * @param $mois sous
	 *        	la forme aaaamm
	 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
	 *        
	 */
	public function getInfosVisiteur($login, $mdp) {
		$res = PdoGsb::$monPdo->prepare ( "select * from visiteur 
		where visiteur.login=:login and visiteur.password=:mdp" );
		$res->execute ( array (
				'login' => $login,
				'mdp' => $mdp 
		) );
		$ligne = $res->fetch ();
		return $ligne;
	}
	
	public function getPrac() {
		$req = "select * from  praticien";
		$res = PdoGsb::$monPdo->query ( $req );
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	
	public function getMedoc() {
		$req = "select * from  medicament";
		$res = PdoGsb::$monPdo->query ( $req );
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	/**
	 * Retourne les informations d'un medicament
	 *
	 * @param
	 *        	$medocNum

	 * @return toutes les info sous la forme d'un tableau associatif
	 *
	 */
	public function getInfoMedoc($medocNum) {
		$req = "select * from medicament INNER JOIN famille ON famille.FAM_CODE=medicament.FAM_CODE where MED_DEPOTLEGAL='$medocNum'";
		$rs = PdoGsb::$monPdo->query ( $req );
		$ligne = $rs->fetch ();
		return $ligne;
	}

}
?>