        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Esc@pe Web</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Bienvenue dans l'univers passionnant de notre site de jeux en ligne ! Plongez dans l'aventure, défiez vos limites et explorez un monde où l'amusement n'a pas de frontières. Préparez-vous à vivre des expériences de jeu exceptionnelles. Que l'aventure commence !</p>
                        <p class="text-white-75 mb-5">
                        Il y a <?= $nb_compte->res; ?> personnes qui ont joué sur l'application web !
                        <br> Soyez le <?= $nb_compte->res + 1; ?>ème pour montrer que vous faites partie des meilleurs !
                        </p>

                      </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">

                <div class="row gx-4 gx-lg-5 justify-content-center">
<?php if ($actu != NULL): ?>
                      <table class="tableau_acceuil" >
                        <thead>
                          <tr>
                            <th>Pseudo(s)</th>
                            <th>Actualité(s)</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php 
                          // Boucle de parcours de toutes les lignes du résultat obtenu
                          foreach($actu as $a){
                            // Affichage d’une ligne de tableau pour un pseudo non encore traité
                            if (!isset($traite[$a["pseudo_cpt"]])){
                              $cpt_id = $a["pseudo_cpt"];
                          ?>
                              <tr>
                                <td><?php echo $a["pseudo_cpt"]; ?></td>
                                <td>
                                  <ul>
                                    <?php
                                    // Boucle d’affichage des actualités liées au pseudo
                                    foreach($actu as $act){
                                      if(strcmp($cpt_id, $act["pseudo_cpt"]) == 0){
                                    ?>
                                        <li>
                                          <?php echo $act["description_act"]; ?> --
                                          <?php echo $act["intitule_act"]; ?> --
                                          <?php echo $act["date_act"]; ?>
                                        </li>
                                    <?php
                                      }
                                    }
                                    ?>
                                  </ul>
                                </td>
                              </tr>
                          <?php
                              // Conservation du traitement du pseudo          
                              $traite[$a["pseudo_cpt"]] = 1;
                            }
                          }
                          ?>

                        </tbody>
                      </table>

                    <?php else: ?>
                      <br />
                      Aucune actualité pour le moment !
                    <?php endif; ?>
                    <div class="col-lg-8 text-center">

                       
                    </div>
                </div>
            </div>
        </section>
                  <!-- Content section-->
      
        <!-- Services-->
        <section class="page-section bg-dark" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center bi-gem fs-1 text-warning">At Your Service</h2>
                <hr class="divider bg-light" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-warning"></i></div>
                            <h3 class="h4 mb-2 text-warning">Sturdy Themes</h3>
                            <p class="text-muted mb-0 text-light">Our themes are updated regularly to keep them bug free!</p>
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-warning"></i></div>
                            <h3 class="h4 mb-2 text-warning">Up to Date</h3>
                            <p class="text-muted mb-0 text-light">All dependencies are kept current to keep things fresh.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-warning"></i></div>
                            <h3 class="h4 mb-2 text-warning">Ready to Publish</h3>
                            <p class="text-muted mb-0 text-light">You can use this design as is, or you can make changes!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-warning"></i></div>
                            <h3 class="h4 mb-2 text-warning">Made with Love</h3>
                            <p class="text-muted mb-0 text-light">Is it really open source if it's not made with love?</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
                <a class="btn btn-light btn-xl" href="https://startbootstrap.com/theme/creative/">Download Now!</a>
            </div>
        </section>
        <!-- Contact-->
       

  

