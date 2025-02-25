<?php
/*=============================================================
// Nom du fichier : Accueil.php
// Auteur : Adrien FAILLER  
// Date de création : Novembre 2023
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Contrôleur de la page Accueil, responsable de l'exécution de
// fonctions liées à la base de données à l'aide de requêtes.
// ------------------------------------------------------------
// Remarque :
// Ce contrôleur gère les opérations liées à l'accueil dans la
// base de données.
//=============================================================*/

    namespace App\Controllers;
    use App\Models\Db_model;
    use CodeIgniter\Exceptions\PageNotFoundException;
    class Accueil extends BaseController
    {
    public function afficher()
    {   $model = model(Db_model::class);
    	$data['titre'] = 'Actualité :';
        $data['actu'] = $model->get_all_actualite();
        $data['nb_compte'] = $model->get_nb_participant();
        return view('templates/haut')
    		. view('affichage_accueil',$data)
    		. view('templates/bas');
    }
}
