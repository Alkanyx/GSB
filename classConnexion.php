<?php
/*-------------------------- Déclaration de la classe -----------------------------*/
class clstBDD {
/*----------------Propriétés de la classe  -----------------------------------*/
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=lafleurz';   		
    private static $user='root' ;    		
    private static $mdp='' ;	
	private static $monPdo;
	private static $monPdoLafleur = null;
	
	
	
/*---------------------- Accès aux propriétés --------------------------------------*/
	function getConnexion() {if($this->$connexion){return $this->$connexion;}
/* --------------   Connexion à une base par un ODBC-------------- ------------------- */
	function connecte($pNomDSN, $pUtil, $pPasse) {
		//tente d'établir une connexion à une base de données 
		$this->$connexion = odbc_connect( $pNomDSN , $pUtil, $pPasse );	
		return $this->$connexion; 		
	}
/* --------------   Requetes sur la base -------------- ------------------- */
	function requeteAction($req) {
		//exécute une requête action (insert, update, delete), ne retourne pas de résultat
		odbc_do($this->$connexion,$req);
	}
	function requeteSelect($req) {
		//interroge la base (select) et retourne le curseur correspondant
		$retour = odbc_do($this->$connexion,$req);
		return $retour;
	}
	
	function close() {
		odbc_close($this->$connexion);
	}
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    		PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
			PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoLafleur::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
 * @return l'unique objet de la classe PdoLafleur
 */
	public  static function getPdoLafleur()
	{
		if(PdoLafleur::$monPdoLafleur == null)
		{
			PdoLafleur::$monPdoLafleur= new PdoLafleur();
		}
		return PdoLafleur::$monPdoLafleur;  
	}

}
?>