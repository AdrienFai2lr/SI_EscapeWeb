               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenue <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Informations personnelles</li>
                        </ol>
                        
                        <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        Créer un compte :
        <a href="creer_compte"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </a>
    </li>
</ol>

                       

               
                        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php if ($comptes != NULL): ?>
                      <table class="info_compte" >
                        <thead>
                          <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Role</th>
                            <th>Etat</th>
                            <th>Pseudo</th>
                            <th>Suppression</th>
                            <th>Modification</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php 
                          // Boucle de parcours de toutes les lignes du résultat obtenu
                          foreach($comptes as $c){?>
                            <br>
                              <tr>
                                <td><?php echo $c["nom_pfl"]; ?></td>
                                <td><?php echo $c["prenom_pfl"]; ?></td>
                                <td><?php echo $c["role_pfl"]; ?></td>
                                <td><?php echo $c["etat_pfl"]; ?></td>
                                <td><?php echo $c["pseudo_cpt"]; ?></td> 
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></td>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
</svg></td>                                   
                              </tr>
                              <?php } ?>
                        </tbody>
                      </table>

                    <?php else: ?>
                    <br />
                    Aucun compte pour le moment !
                    <?php endif; ?>
                <div class="col-lg-8 text-center">

                </div>
            </div>
        </div>

                                                            
                                  
                    </div>
                </main>