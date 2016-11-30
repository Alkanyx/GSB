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
	/**
	 * Teste si un visiteur poss�de une fiche de frais pour le mois pass� en argument
	 *
	 * @param
	 *        	$idVisiteur
	 * @param $mois sous
	 *        	la forme aaaamm
	 * @return vrai ou faux
	 *        
	 */
	public function estPremierFraisMois($idVisiteur, $mois) {
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query ( $req );
		$laLigne = $res->fetch ();
		if ($laLigne ['nblignesfrais'] == 0) {
			$ok = true;
		}
		return $ok;
	}
	
	
	public function getMatricule($login) {
		$req = "select VIS_MATRICULE from visiteur where login='$login'";
		$res = PdoGsb::$monPdo->query ( $req );
		$mat = $res->fetch ();
		return $mat[0];
	}	
	

	
	public function saisirRapport($IdVis,$Num,$DateVis,$NumPrat,$RapDate,$IdMotif,$RapMotif,$RapBilan) {
		$req = "insert into rapport_visite(VIS_MATRICULE,RAP_NUM,PRA_NUM,RAP_DATE,RAP_BILAN,idMotif,rap_etat,rap_conf,date_visite) 
		values('$IdVis','$num','$NumPrat','$RapDate','$RapBilan','$IdMotif','valid�','confim�','$DateVis')";
		PdoGsb::$monPdo->exec ( $req );
	}
	/**
	 * Cr�e un nouveau frais hors forfait pour un visiteur un mois donn�
	 * � partir des informations fournies en param�tre
	 *
	 * @param
	 *        	$idVisiteur
	 * @param $mois sous
	 *        	la forme aaaamm
	 * @param $libelle :
	 *        	le libelle du frais
	 * @param $date :
	 *        	la date du frais au format fran�ais jj//mm/aaaa
	 * @param $montant :
	 *        	le montant
	 *        	
	 */
	public function creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant) {
		$dateFr = dateFrancaisVersAnglais ( $date );
		$req = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec ( $req );
	}
	/**
	 * Supprime le frais hors forfait dont l'id est pass� en argument
	 *
	 * @param
	 *        	$idFrais
	 *        	
	 */
	public function supprimerFraisHorsForfait($idFrais) {
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec ( $req );
	}
	/**
	 * Retourne les mois pour lesquel un visiteur a une fiche de frais
	 *
	 * @param
	 *        	$idVisiteur
	 * @return un tableau associatif de cl� un mois -aaaamm- et de valeurs l'ann�e et le mois correspondant
	 *        
	 */
	public function getLesMoisDisponibles($idVisiteur) {
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query ( $req );
		$lesMois = array ();
		$laLigne = $res->fetch ();
		while ( $laLigne != null ) {
			$mois = $laLigne ['mois'];
			$numAnnee = substr ( $mois, 0, 4 );
			$numMois = substr ( $mois, 4, 2 );
			$lesMois ["$mois"] = array (
					"mois" => "$mois",
					"numAnnee" => "$numAnnee",
					"numMois" => "$numMois" 
			);
			$laLigne = $res->fetch ();
		}
		return $lesMois;
	}
	/**
	 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donn�
	 *
	 * @param
	 *        	$idVisiteur
	 * @param $mois sous
	 *        	la forme aaaamm
	 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'�tat
	 *        
	 */
	public function getLesInfosFicheFrais($idVisiteur, $mois) {
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query ( $req );
		$laLigne = $res->fetch ();
		return $laLigne;
	}
	/**
	 * Modifie l'�tat et la date de modification d'une fiche de frais
	 *
	 * Modifie le champ idEtat et met la date de modif � aujourd'hui
	 *
	 * @param
	 *        	$idVisiteur
	 * @param $mois sous
	 *        	la forme aaaamm
	 */
	public function majEtatFicheFrais($idVisiteur, $mois, $etat) {
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec ( $req );
	}
}
?>