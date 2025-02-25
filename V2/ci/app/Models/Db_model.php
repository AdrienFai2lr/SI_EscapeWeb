<?php
/*=============================================================
// Nom du fichier : Db_model.php
// Auteur : Adrien FAILLER  
// Date de création : Novembre 2023
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page model, qui permet de réaliser toute fonction liée avec la
// base de données via des requêtes.
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/
namespace App\Models;
use CodeIgniter\Model;
class Db_model extends Model
{
	protected $db;
	public function __construct(){
		$this->db = db_connect(); //charger la base de données
		// ou
		// $this->db = \Config\Database::connect();
	}

	//requete qui recupere tout les comptes de l'application web
	public function get_all_compte(){
		$resultat = $this->db->query("SELECT pseudo_cpt FROM t_compte_cpt;");
		return $resultat->getResultArray();
	}

	//requete qui recupere les nombre de compte
	public function nombre_compte(){
		$resultat=$this->db->query("SELECT count(pseudo_cpt) as res from t_compte_cpt;");
		return $resultat->getRow();
	}

	//requete qui recupere une actualite avec son id
	public function get_actualite($numero){
		$requete="SELECT * FROM t_actualite_act WHERE id_act=".$numero.";";
		$resultat = $this->db->query($requete);
		return $resultat->getRow();
	}

	//recuperation de toute les actualites
	public function get_all_actualite(){
		$resultat = $this->db->query("SELECT * FROM t_actualite_act WHERE etat_act ='A';");
		return $resultat->getResultArray();
	}

	//fonction qui récupère tout les scénarios 
    public function get_all_scenario(){
        $resultat=$this->db->query("select * from t_scenario_sce where etat_sce='A';");
        return $resultat->getResultArray();
    }

	//recuperation de toute les donne d'un scenario + etape + indice à partir du code du scenario marquer en URL
	public function get_scenario_by_code($code, $difficulte) {
    	$resultat = $this->db->query("SELECT code_eta,description_ind,lien_ind,question_eta,difficulte_ind,ressource_eta,code_sce,pseudo_cpt,intitule_sce,t_etape_eta.id_eta FROM t_scenario_sce
        LEFT JOIN t_etape_eta ON t_scenario_sce.id_sce = t_etape_eta.id_sce
        LEFT JOIN t_indice_ind ON t_etape_eta.id_eta = t_indice_ind.id_eta AND difficulte_ind = '" . $difficulte . "'
        WHERE code_sce = '" . $code . "' AND ordre_eta=1;");
    	return $resultat->getRow();
	}
	
	//fonction qui va inserer dans la base de donnée un nouveau compte + profil lié (utlisation des ? pour ne pas avoir de probleme avec des caractere speciaux)
	public function set_compte($saisie) {
		$login = $saisie['pseudo'];
		$mdp = $saisie['mdp'];
		$role = $saisie['role'];
		$nom = $saisie['nom'];
		$prenom = $saisie['prenom'];
		$etat = $saisie['etat'];
	
		// Requête préparée pour le premier INSERT
		$sql = "INSERT INTO `t_compte_cpt` (`pseudo_cpt`, `mdp_cpt`) VALUES (?, ?)";
		$this->db->query($sql, [$login, $mdp]);
	
		// Requête préparée pour le deuxième INSERT
		$sql2 = "INSERT INTO `t_profil_pfl`(`nom_pfl`, `prenom_pfl`, `role_pfl`, `etat_pfl`, `pseudo_cpt`) VALUES (?, ?, ?, ?, ?)";
		$this->db->query($sql2, [$nom, $prenom, $role, $etat, $login]);
	}
	
	//recuperer tout les compte + leur profil en fonction de leur etat
	public function recup_donne_compte(){
		$resultat=$this->db->query("SELECT * from t_compte_cpt left outer join t_profil_pfl using(pseudo_cpt) order by etat_pfl;");
		return $resultat->getResultArray();
	}

	//verification du couple login et mdp + return vrai si le couple existe => donc connexion validée (utilisation de la view)
	public function connect_compte($u,$p){
		$saltQuery = "SELECT sel as res FROM le_sel";
		$result = $this->db->query($saltQuery);

		if ($result->getNumRows() > 0) {
			$row = $result->getRow();
			$salt = $row->res; 
		}
        $password=hash('sha256', $salt.$p);
		$sql="SELECT pseudo_cpt,mdp_cpt
		FROM t_compte_cpt
		WHERE pseudo_cpt='".$u."'
		AND mdp_cpt='".$password."';";
		$resultat=$this->db->query($sql);

		if($resultat->getNumRows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	//recuperation des informations du profil connecter 
	public function profil_connecter($u){
		$sql="Select *,role_pfl from t_profil_pfl where pseudo_cpt='".$u."';";
		$resultat=$this->db->query($sql);
		return $resultat->getRow();
	}

	//modification du mdp
    public function modificationmdp($mdp,$pseudo){
		$saltQuery = "SELECT sel as res FROM le_sel";
		$result = $this->db->query($saltQuery);

		if ($result->getNumRows() > 0) {
			$row = $result->getRow();
			$salt = $row->res; 
		}
        $password=hash('sha256', $salt.$mdp);
        $query=$this->db->query("UPDATE t_compte_cpt set mdp_cpt='".$password."' where pseudo_cpt='".$pseudo."'; ");
    }

    //recuperation de tout les scenario et leur nb d'etape
    public function recuperation_jeux($user){
    	$resultat=$this->db->query("SELECT s.*,nb_etat_par_sce(s.id_sce) AS nombre_etapes FROM
		t_scenario_sce s order by pseudo_cpt='".$user."' desc;");
    	return $resultat->getResultArray();
    }

	//recuperattion de tout les données d'un scenario et de ses questions reponses
	public function get_scenario_etape($id){
		$sql="select * from t_etape_eta where id_sce = '".$id."'";
		$resultat=$this->db->query($sql);
		return $resultat->getResultArray();
	}

	//recupe les info du scenario
	public function get_scenario($id){
		$sql="select * from t_scenario_sce where id_sce = '".$id."'";
		$resultat=$this->db->query($sql);
		return $resultat->getRow();
	}

	//ajoute un nouveau scénario
	public function add_jeux($saisie,$user,$image,$code){
		$intitule = $saisie['intitule'];
		$description = $saisie['description'];
		$etat=$saisie['etat'];	
		$sql = "INSERT INTO `t_scenario_sce`(`id_sce`, `intitule_sce`, `code_sce`, `description_sce`, `etat_sce`, `image_sce`, `pseudo_cpt`) 
		VALUES (?,?,?,?,?,?,?)";
		$this->db->query($sql,[null,$intitule,$code,$description,$etat,$image,$user]);
	}
	
	//suppresion des scenario leur etape + leur indices +leur reussite
	public function delete_sce($id) {
		$sql_1 = "DELETE FROM t_indice_ind WHERE id_eta IN (SELECT id_eta FROM t_etape_eta WHERE id_sce = '".$id."')";
		$query_1 = $this->db->query($sql_1);
		$sql_2 = "DELETE FROM t_etape_eta WHERE id_sce = '".$id."'";
		$query_2 = $this->db->query($sql_2);
		$sql_3 = "DELETE FROM t_reussite_reu WHERE id_sce = '".$id."'";
		$query_3 = $this->db->query($sql_3);	
		$sql_4 = "DELETE FROM t_scenario_sce WHERE id_sce = '".$id."'";
		$query_4 = $this->db->query($sql_4);
		if ($query_1 && $query_2 && $query_3 && $query_4) {
			return true;		
		}
	}
	
	//recuperation de tout les modes disponible dans la base
	public function get_mode(){
		$sql="SELECT GROUP_CONCAT(DISTINCT difficulte_ind) AS modes FROM t_indice_ind";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

	////recuperation de tout les pseudos disponible dans la base
	public function get_pseudo(){
		$sql="SELECT GROUP_CONCAT(DISTINCT pseudo_cpt) AS res FROM t_compte_cpt";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

	//recuperation de la reponse correcte lors de l'étape d'un jeux
	public function get_vrai_reponse($code){
		$sql="select reponse_eta as reponse from t_etape_eta where code_eta ='".$code."';";
		$resultat=$this->db->query($sql);
		return $resultat->getRow();
	}

	//recuperation du code de la prochaine étape (utilisation d'une procedure)
	public function get_code_proEtape($code){
		$this->db->query("CALL recup_codeSuiv('$code', @code_suiv)");
		$result = $this->db->query("SELECT @code_suiv AS code_suiv")->getRow();
		return $result->code_suiv;
	}

	//recuperation des donnée d'une étape "suivante"
	public function get_etape($code,$difficulte){
		$sql="SELECT *
		FROM t_etape_eta
		left outer join t_scenario_sce USING (id_sce)
		LEFT OUTER JOIN t_indice_ind ON t_etape_eta.id_eta = t_indice_ind.id_eta AND difficulte_ind='".$difficulte."'
		WHERE code_eta = '".$code."';
		;";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

	//recupe le code pour la partie finale
	public function get_code_sce($code){
		$sql="SELECT code_sce as res
		FROM t_scenario_sce
		WHERE id_sce IN (SELECT id_sce FROM t_etape_eta WHERE code_eta ='".$code."');";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

	//insere le joueur qui finit un jeux (cle unique sur le mail, on verifie si il existe avant de le cree puis on gere tout les cas possible et on ajoute dans les table le necessaire)
	public function inserer_joueur($mail, $code, $difficulte) {
		$sql1 = "INSERT INTO `t_participant_par`(`id_par`, `adresse_par`) VALUES (null, '" . $mail . "') ON DUPLICATE KEY UPDATE `adresse_par` = `adresse_par`";
		$this->db->query($sql1);
		$sql_id = "SELECT id_sce FROM t_scenario_sce WHERE code_sce = '" . $code . "'";
		$id_result = $this->db->query($sql_id);
		$id_row = $id_result->getRow();
		$id_sce = $id_row->id_sce;
		$sql3 = "INSERT INTO `t_reussite_reu`(`id_par`, `id_sce`, `dateFirstR_reu`, `dateSecondR_reu`, `difficulte_reu`) 
				VALUES (
					(SELECT id_par FROM t_participant_par WHERE adresse_par = '" . $mail . "'), 
					" . $id_sce . ", 
					NOW(), 
					NULL, 
					'" . $difficulte . "'
				)
				ON DUPLICATE KEY UPDATE 
					`dateFirstR_reu` = IF(`dateFirstR_reu` IS NULL, NOW(), `dateFirstR_reu`), 
					`dateSecondR_reu` = IF(`dateFirstR_reu` IS NOT NULL, NOW(), `dateSecondR_reu`)";
		
		$this->db->query($sql3);
	}
	
	//recupe de l'ordre pour la redirection lors d'un jeux
	public function recup_ordre($code){
		$sql="select ordre_eta as res from t_etape_eta where code_eta='".$code."';";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

	//recuperation du total de participant à l'application web (via une fonction)
	public function get_nb_participant(){
		$sql="SELECT nombre_joueurs_appli() as res;";
		$result=$this->db->query($sql);
		return $result->getRow();
	}

}