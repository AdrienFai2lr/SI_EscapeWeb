               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenue <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Informations personnelles</li>
                        </ol>
                       

        
                        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php if ($info_perso != NULL): ?>
                    <table class="info_personnelle">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Role</th>
                                <th>Etat</th>
                                <th>Pseudo</th>
                            </tr>
                        </thead>
                        <tbody>       
                            <tr>                                
                                <td><?php echo $info_perso->nom_pfl; ?></td> 
                                <td><?php echo $info_perso->prenom_pfl; ?></td>   
                                <td><?php echo $info_perso->role_pfl; ?></td>   
                                <td><?php echo $info_perso->etat_pfl; ?></td>
                                <td><?php echo $info_perso->pseudo_cpt; ?></td>                                        
                            </tr>
                        </tbody>
                    </table>
                    <br />
                <?php endif; ?>
                <div class="col-lg-8 text-center">

                </div>
            </div>
        </div>

                                                            
                                  
                    </div>
                </main>