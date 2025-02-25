<?php
/*=============================================================
// Nom du fichier : Scenario.php
// Auteur : Adrien FAILLER  
// Date de création : Novembre 2023
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Contrôleur de la page Scenario, responsable de l'exécution de
// fonctions liées à la base de données à l'aide de requêtes.
// ------------------------------------------------------------
// Remarque :
// Ce contrôleur gère les opérations liées aux scénarios dans la
// base de données.
//=============================================================*/

namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Scenario extends BaseController
	{
	public function __construct(){
			helper('form');
			$this->model = model(Db_model::class);
	}
	public function afficher(){
		$model = model(Db_model::class);
		$data['scenario'] = $model->get_all_scenario();
    		
		return view('templates/haut')
		. view('afficher_scenario',$data)
		. view('templates/bas');
	}

    //affichage première etape
	public function jouer($code=null, $difficulte = null){
			$model = model(Db_model::class);
            $modes_possibles = $this->model->get_mode();
			$array_modes = explode(",", $modes_possibles->modes);
            //verfication que le mode est dans la bdd sinon redirect sur la gallerie
            if(!in_array($difficulte, $array_modes)) {
                return redirect()->to('/scenario/afficher');
            } 
			if (!isset($difficulte) || !isset($code)) {
				return redirect()->to('/scenario/afficher');
			}

			$data['scenario'] = $model->get_scenario_by_code($code, $difficulte);
			$data['difficulte']=$difficulte;

			//affichage des etapes par rapport à la difficulte
			return view('templates/haut')
				. view('jouer_scenario', $data)
				. view('templates/bas');
	}

	//franchir etape d'un scénario
	public function franchir_etape($code = NULL, $difficulte = NULL){
        if ($this->request->getMethod() == "post") {
			///$difficulte=base64_encode($difficulte);
            
            $reponse = $this->request->getPost('reponse');
            $code_etape = $this->request->getPost('thecode');
            $vrai_reponse = $this->model->get_vrai_reponse($code_etape);
            $difficulte = $this->request->getPost('thedifficulte');
             
            if (strcmp($reponse, $vrai_reponse->reponse) == 0) {
                $code_proEtape = $this->model->get_code_proEtape($code_etape);

                if ($code_proEtape != null) {
                    $ordre = $this->model->recup_ordre($code_etape);
                    if ($ordre) {
                        return redirect()->to(base_url("index.php/scenario/franchir_etape/{$code_proEtape}/{$difficulte}"));
                    } else {
                        return redirect()->to(base_url("index.php/scenario/afficher"));
                    }
                } else {
                    return redirect()->to(base_url("index.php/scenario/finir_scenario/{$code_etape}/{$difficulte}"));
                }
            } else {
                return redirect()->to(base_url("index.php/scenario/franchir_etape/{$code_etape}/{$difficulte}"));
            }
        }
        if ($code != NULL && $difficulte !=null) {
            $data['scenario'] = $this->model->get_etape($code,$difficulte);
            $data['lecode'] = $code;
			$data['difficulte']=$difficulte;
        }else{
            return redirect()->to(base_url("index.php/scenario/afficher"));
        }
        $modes_possibles = $this->model->get_mode();
		$array_modes = explode(",", $modes_possibles->modes);
        //verfication que le mode est dans la bdd sinon redirect sur la gallerie
        if(!in_array($difficulte, $array_modes)) {
            return redirect()->to('/scenario/afficher');
        }
        return view('templates/haut', ['titre' => 'franchir étape'])
            . view('etape_suivante', $data)
            . view('templates/bas');
    }

    //le joueur a finis il va completer le formulaire avec son mail et il sera mit dans la bdd
	public function finir_scenario($code = null, $difficulte = null){
        if($this->request->getMethod() == "post"){
            $mail = $this->request->getPost('themail');
            $code = $this->request->getPost('thecode');
            $difficulte = $this->request->getPost('thedifficulte');
            //requete pour inserer le joueur
            $this->model->inserer_joueur($mail,$code,$difficulte);
            return redirect()->to(base_url('index.php/scenario/afficher'));

        }
        if (($code !== null && $difficulte !== null)) {
            
            $data['code_jeux']=$this->model->get_code_sce($code);	
            $data['difficulte']=$difficulte;

            return view('templates/haut')
                . view('finir_scenario', $data)
                . view('templates/bas');
        
        } else {
            return redirect()->to(base_url('index.php/scenario/afficher'));
        }
	}
}