<?php
/*=============================================================
// Nom du fichier : Compte.php
// Auteur : Adrien FAILLER  
// Date de création : Novembre 2023
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Contrôleur de la page Compte, responsable de l'exécution de
// fonctions liées à la base de données à l'aide de requêtes.
// ------------------------------------------------------------
// Remarque :
// Ce contrôleur gère les opérations liées aux compte dans la
// base de données.
//=============================================================*/

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Compte extends BaseController
	{

	public function __construct(){
		helper('form');
		$this->model = model(Db_model::class);
		
	}

	public function lister(){
		$data['titre']="Liste de tous les comptes";
		$data['logins'] = $model->get_all_compte();
		$data['nb_compte']= $model->nombre_compte();
		return view('templates/haut', $data)
		. view('affichage_comptes')
		. view('templates/bas');
	}
	
	public function creer_compte(){
		$session=session();
		if ($session->has('user')){
			$username = $session->get('user');
			$role=$this->model->profil_connecter($username);
			if($role->role_pfl=='A'){
				// L’utilisateur a validé le formulaire en cliquant sur le bouton
				if ($this->request->getMethod()=="post"){
					if (! $this->validate([
					'pseudo' => 'required|max_length[255]|min_length[2]',
					'mdp' => 'required|max_length[255]|min_length[8]',
					'mdp2' => 'required|max_length[255]|min_length[8]',
					'role' => 'required|in_list[O,A]',
					'nom' => 'required|max_length[255]|min_length[2]',
					'prenom' => 'required|max_length[255]|min_length[2]',
					'etat' => 'required|in_list[A,D]',
					],
					[ // Configuration des messages d’erreurs
					'pseudo' => [
					'required' => 'Veuillez entrer un pseudo pour le compte !',
					],
					'mdp' => [
					'required' => 'Veuillez entrer un mot de passe !',
					],
					'mdp' => [
					'min_length' => 'Le mot de passe saisi est trop court !',
					],
					'mdp2' => [
						'required' => 'Veuillez entrer un mot de passe !',
						],
					'mdp2' => [
						'min_length' => 'Le mot de passe saisi est trop court !',
						],
					'role' => [
						'required' => 'Veuillez sélectionner un rôle !',
						'in_list' => 'Rôle non valide !',
					],
					'nom' => [
						'required' => 'Veuillez entrer un nom pour le compte !',
					],
					'prenom' => [
						'required' => 'Veuillez entrer un prenom pour le compte !',
					],
					'etat' => [
						'required' => 'Veuillez sélectionner un etat !',
						'in_list' => 'Etat non valide !',
					],
					]
					))
					{
					// La validation du formulaire a échoué, retour au formulaire !
					return view('templates/menu_administrateur.php')
					. view('connexion/compte_creationCompte.php')
					. view('templates/bas2');
					}

				// La validation du formulaire a réussi, traitement du formulaire
				$recuperation = $this->validator->getValidated();
				$pseudo_deja_use = $this->model->get_pseudo();
				$array_pseudo = explode(",", $pseudo_deja_use->res);
				//verfication du pseudo
				if(in_array($recuperation['pseudo'], $array_pseudo)) {
					$message="Pseudo déjà pris choisissez un nouveau !";
					return view('templates/menu_administrateur.php')
					. view('connexion/compte_creationCompte.php',['message' => $message])
					. view('templates/bas2');
				} 
				if(strcmp($recuperation['mdp'], $recuperation['mdp2']) != 0){
					$message="Mot de passe non identique";
					return view('templates/menu_administrateur.php')
					. view('connexion/compte_creationCompte.php',['message' => $message])
					. view('templates/bas2');
				}
				$this->model->set_compte($recuperation);		
				//puis on retourne sur la page creer compte				
				return view('templates/menu_administrateur.php')
				. view('connexion/compte_creationCompte.php')
				. view('templates/bas2');
				}
				// L’utilisateur veut afficher le formulaire pour créer un compte
				return view('templates/menu_administrateur.php')
				. view('connexion/compte_creationCompte.php')
				. view('templates/bas2');
			}else{
				// La validation du formulaire a échoué, retour au formulaire !
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
			}
		}else{
			// La validation du formulaire a échoué, retour au formulaire !
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
		}
	}
	//connexion d'un profil via des zones de saisies
	public function connecter(){
		// L’utilisateur a validé le formulaire en cliquant sur le bouton
		if ($this->request->getMethod()=="post"){
			if (! $this->validate([
			'pseudo' => 'required',
			'mdp' => 'required'
			]))
			{ // La validation du formulaire a échoué, retour au formulaire !
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
			}
			// La validation du formulaire a réussi, traitement du formulaire
			$username=$this->request->getVar('pseudo');
			$password=$this->request->getVar('mdp');
			if ($this->model->connect_compte($username,$password)==true){
				$session=session();
				$session->set('user',$username);
				$data['le_message']="Affichage des données du profil ici !!!";
				//recuperation d'un profil active
				$role=$this->model->profil_connecter($username);
				$data['info_perso']=$this->model->profil_connecter($username);
				//partie orga
				if($role->etat_pfl == 'A'){
					if($role->role_pfl=='O'){
						return view('templates/menu_organisateur.php',$data)
						. view('connexion/compte_profil_orga',$data)
						. view('templates/bas2');

					//partie admin
					}elseif($role->role_pfl=='A'){
						return view('templates/menu_administrateur.php',$data)
						. view('connexion/compte_profil_admin',$data)
						. view('templates/bas2');
					}
				}else{ 
					return view('templates/haut', ['titre' => 'Se connecter'])
					. view('connexion/compte_connecter')
					. view('templates/bas');
				}
			}
			else{ 
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
			}
		}
		// L’utilisateur veut afficher le formulaire pour se conncecter
		return view('templates/haut', ['titre' => 'Se connecter'])
		. view('connexion/compte_connecter')
		. view('templates/bas');
	}
	//affichage du profil connecter
	public function afficher_profil(){
		$session=session();
		if ($session->has('user')){
			$data['le_message']="Affichage des données du profil ici !!!";
			//recuperation du role du profil connecter et affichage de son menu en fonction de son role
			$username = $session->get('user');
			$role=$this->model->profil_connecter($username);
			$data['info_perso']=$this->model->profil_connecter($username);
			//partie orga
			if($role->role_pfl=='O'){
				return view('templates/menu_organisateur.php',$data)
				. view('connexion/compte_profil_orga',$data)
				. view('templates/bas2');

			//partie admin
			}elseif($role->role_pfl=='A'){
				return view('templates/menu_administrateur.php',$data)
				. view('connexion/compte_profil_admin',$data)
				. view('templates/bas2');
			}
		}
		else{
			return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
		}
	}
	//affichage des comptes de l'application web par l'admin
	public function affichage_comptes(){
		$session=session();
		if ($session->has('user')){
			//recuperation du role du profil connecter et affichage de son menu en fonction de son role
			$username = $session->get('user');
			$role=$this->model->profil_connecter($username);
			$data['comptes']=$this->model->recup_donne_compte();
			//il faut etre admin pour acceder à la gestion des comptes
			if($role->role_pfl=='A'){
				return view('templates/menu_administrateur.php',$data)
				. view('connexion/compte_gestionCompte.php',$data)
				. view('templates/bas2');
			}else{
				return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
			}
		}else{
			return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
		}
	}
	//affichage des jeux de l'organisateur connecte
	public function affichage_jeux(){
		$session=session();
		if ($session->has('user')){
			//recuperation du role du profil connecter et affichage de son menu en fonction de son role
			$username = $session->get('user');
			$role=$this->model->profil_connecter($username);
			$data['jeux']=$this->model->recuperation_jeux($username);
			$data['loggin']=$username;
			//il faut etre admin pour acceder à la gestion des comptes
			if($role->role_pfl=='O'){
				return view('templates/menu_organisateur.php',$data)
				. view('connexion/compte_gestionScenario.php',$data)
				. view('templates/bas2');
			}else{
				return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
			}
		}else{
			return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
		}
	}

	//
	public function modification_profil(){
		$session = session();
		$username = $session->get('user');
		$message = "";
		
		$role = $this->model->profil_connecter($username);
		
		if ($this->request->getMethod() == "post") {
			if (!$this->validate([
				'mdp1' => 'required|max_length[255]|min_length[8]',
				'mdp2' => 'required|max_length[255]|min_length[8]',
			], [
				'mdp1' => [
					'required' => 'Veuillez entrer un mot de passe !',
					'min_length' => 'Le mot de passe saisi est trop court !',
				],
				'mdp2' => [
					'required' => 'Veuillez entrer le 2ème mot de passe pour validation !',
					'min_length' => 'Le mot de passe saisi est trop court !',
				],
			])){	
				$message = "Votre mot de passe n'a pas pu être modifié.";
				// Partie organisateur
				if ($role->role_pfl == 'O') {
					return view('templates/menu_organisateur.php')
						. view('connexion/compte_profil_modif', ['message' => $message])
						. view('templates/bas2');
				
				// Partie administrateur
				} elseif ($role->role_pfl == 'A') {
					return view('templates/menu_administrateur.php')
						. view('connexion/compte_profil_modif', ['message' => $message])
						. view('templates/bas2');
				}
		}
		
		$recuperation = $this->validator->getValidated();
		
		//récupèration des données des champs de mot de passe
		$mdp1 = $this->request->getPost('mdp1');
		$mdp2 = $this->request->getPost('mdp2');

		//vérifie qu'ils sont égaux et pas vide
			if (!empty($mdp1) && !empty($mdp2)) {
				if (strcmp($mdp1, $mdp2) == 0) {
					$this->model->modificationmdp($mdp1, $username);
					$message = "Votre mot de passe a été correctement modifié !";
				} else {
					$message = "Votre mot de passe n'a pas pu être modifié. Veuillez insérer correctement le même mot de passe deux fois !";
				}
			}
				
			// Partie organisateur
			if ($role->role_pfl == 'O') {
				return view('templates/menu_organisateur.php')
					. view('connexion/compte_profil_modif', ['message' => $message])
					. view('templates/bas2');
			
			// Partie administrateur
			} elseif ($role->role_pfl == 'A') {
				return view('templates/menu_administrateur.php')
					. view('connexion/compte_profil_modif', ['message' => $message])
					. view('templates/bas2');
			}
		
		}// Partie organisateur
		if($username = $session->get('user')){
			if ($role->role_pfl == 'O') {
				return view('templates/menu_organisateur.php')
					. view('connexion/compte_profil_modif',['message' => $message])
					. view('templates/bas2');
			
			// Partie administrateur
			} elseif ($role->role_pfl == 'A') {
				return view('templates/menu_administrateur.php')
					. view('connexion/compte_profil_modif',['message' => $message])
					. view('templates/bas2');
			}
		}else{
			return view('templates/haut', ['titre' => 'Se connecter'])
			. view('connexion/compte_connecter')
			. view('templates/bas');
		}
	}
	//visualisation du scenario voulu
	public function visualiser_scenario($id=null){
		$session = session();
		$username = $session->get('user');		
		$role = $this->model->profil_connecter($username);
		if($id!=null){
			if($role->role_pfl=='O' && $role->etat_pfl=='A'){
				//recuperation de tout les details d'un scenario en particulier
				$data['info_sce'] = $this->model->get_scenario($id);
				$data['info_all'] = $this->model->get_scenario_etape($id);
				
				
				if ($data['info_sce'] != NULL) {
					return view('templates/menu_organisateur.php')
						. view('connexion/compte_afficherScenario.php', $data)
						. view('templates/bas2');
				}else{
					return redirect()->to('/compte/affichage_jeux');
				}

			}else{
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
			}
		}else{
			return redirect()->to('/compte/affichage_jeux');
		}
	}
	public function creer_jeux(){
		$session = session();
		if ($session->has('user')) {
			$username = $session->get('user');
			$role = $this->model->profil_connecter($username);
			
			if ($role->role_pfl == 'O') {
				// L’utilisateur a validé le formulaire en cliquant sur le bouton
				if ($this->request->getMethod() == "post") {
					if (!$this->validate([
						'intitule' => 'required|max_length[255]',
						'description' => 'required|max_length[255]',
						'image' => [
							'label' => 'Fichier image',
							'rules' => [
								'uploaded[image]',  
								'is_image[image]',   
								'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',  
								'max_size[image,100]', 
								'max_dims[image,1024,768]',  
							]
						], 
						'etat' => 'required|in_list[A,D]',
					], [
						// Configuration des messages d’erreurs
						'intitule' => [
							'required' => 'Veuillez entrer un intitulé !',
							'max_length' => 'L\'intitulé ne doit pas dépasser 255 caractères !',
						],
						'description' => [
							'required' => 'Veuillez entrer une description !',
							'max_length' => 'La description ne doit pas dépasser 255 caractères !',
						],
						'image' => [
							'uploaded' => 'Veuillez sélectionner une image !',
							'is_image' => 'Le fichier sélectionné n\'est pas une image valide !',
							'mime_in' => 'Le format de l\'image n\'est pas valide !',
							'max_size' => 'La taille de l\'image ne doit pas dépasser 1 Mo !',
							'max_dims' => 'Les dimensions de l\'image ne doivent pas dépasser 1024x768 pixels !',
						],
						'etat' => [
							'required' => 'Veuillez sélectionner un état !',
							'in_list' => 'État non valide !',
						],
					])) {
						// La validation du formulaire a échoué, retour au formulaire !
						return view('templates/menu_organisateur.php')
							. view('connexion/compte_creationJeux.php')
							. view('templates/bas2');
					}
					$fichier = $this->request->getFile('image');
					$code = $this->request->getPost('lecode');

					if (!empty($fichier) && !empty($code)) {
						// Récupération du nom du fichier téléversé
						$nom_fichier = $fichier->getName();

						// Créer le dossier s'il n'existe pas déjà
						$dossier = FCPATH . "img/" . $code;
						if (!is_dir($dossier)) {
							mkdir($dossier, 0777, true);
						}

						// Déplacer le fichier dans le dossier créé
						if ($fichier->move($dossier, $nom_fichier)) {
							// La validation du formulaire a réussi, traitement du formulaire
							$recuperation = $this->validator->getValidated();
							$this->model->add_jeux($recuperation, $username, $nom_fichier,$code);

							// Puis on retourne sur la page creer jeux avec un message de création effectuée              
							return view('templates/menu_organisateur.php')
								. view('connexion/compte_creationJeux.php', ['message' => 'Création réussie.'])
								. view('templates/bas2');
						} else {
							// Gérer l'échec du déplacement du fichier si nécessaire
							echo 'Échec du déplacement du fichier.';
						}
					} else {
						// Gérer le cas où le fichier ou l'intitulé est vide
						echo 'Veuillez sélectionner un fichier et spécifier un intitulé.';
					}

						
					
				}
	
				// L’utilisateur veut afficher le formulaire pour créer un compte
				return view('templates/menu_organisateur.php')
					. view('connexion/compte_creationJeux.php',['message' => ''])
					. view('templates/bas2');
			} else {
				// La validation du formulaire a échoué, retour au formulaire !
				return view('templates/menu_organisateur.php')
					. view('connexion/compte_creationJeux.php',['message' => ''])
					. view('templates/bas2');
			}
		} else {
			// La validation du formulaire a échoué, retour au formulaire !
			return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter',['message' => ''])
				. view('templates/bas');
		}
	}
	// visualisation du scenario voulu
	public function supprimer_scenario($id) {
		$session = session();
		$username = $session->get('user');
		$role = $this->model->profil_connecter($username);
		$nom_image = $this->model->get_scenario($id);

		if ($role->role_pfl == 'O' && $role->etat_pfl == 'A') {
			$chemin_image = FCPATH . 'img/' . $nom_image->code_sce . '/' . $nom_image->image_sce;

			if (file_exists($chemin_image)) {
				// Supprimer l'image
				unlink($chemin_image);

				// Vérifier s'il s'agit de la dernière image dans le répertoire
				$chemin_repertoire = FCPATH . 'img/' . $nom_image->code_sce;
				$images_dossier = glob($chemin_repertoire . '/*');
				
				if (empty($images_dossier)) {
					// Il s'agit de la dernière image, supprimer le répertoire
					rmdir($chemin_repertoire);
				}
			}


			$deleteResult = $this->model->delete_sce($id);
			
			if ($deleteResult === true) {
				return $this->affichage_jeux();
				echo $nom_image;
				//suppression de l'image dans le repertoire sur le serv qui a le nom
			} else {
				return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
			}
		} else {
			// L'utilisateur n'a pas les droits nécessaires
			return view('templates/haut', ['titre' => 'Se connecter'])
				. view('connexion/compte_connecter')
				. view('templates/bas');
		}
	}

	//deconnexion de la session connecter
	public function deconnecter(){
		$session=session();
		$session->destroy();
		return view('templates/haut', ['titre' => 'Se connecter'])
		. view('connexion/compte_connecter')
		. view('templates/bas');
	}
	

}
