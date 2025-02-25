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
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
    <div class="container px-4 px-lg-5">
        <!-- Affichage d'une galerie pour chaque scénario et leur étape avec l'ordre + lien hypertexte vers le scénario et l'étape en question et les images (des scénarios) en fond -->

        <div class="row gx-4 gx-lg-5 justify-content-center">
            
                <?php
        if ($scenario != NULL) {
            
            echo '<div class="row gx-4 gx-lg-5 justify-content-center">';

            foreach ($scenario as $s) {
                
                    echo '<div class="col-lg-4 col-md-6 mb-4">';
                    echo '<div class="card h-100" style="position: relative;">';
                    echo '<img src="' . base_url('img/' . $s['code_sce'] .'/' . $s['image_sce']) . '" class="card-img-top" alt="Scenario Image" style="height: 100%; object-fit: cover;">';
            
                    //overlay (intitulle du scenario)
                    echo '<div class="card-img-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0); color: white; padding: 10px;">';
                    echo '<h3 class="card-title" style="text-align: center;">' . $s['intitule_sce'] . " by " . $s['pseudo_cpt'] . '</h3>';

                    echo '</div>';
        
            
                    // overlay (difficulte)
                    echo '<div class="card-img-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; top: 50%; background: rgba(0, 0, 0, 0); color: white; padding: 10px;">';
                    echo '<h5 class="card-title" >Niveau</h5>';
                    
                        $difficulties = ['Facile', 'Moyen', 'Difficile'];
                        $val = 25; 
                        $opacity=0;
                        foreach ($difficulties as $difficulty) {
                            $opacity += 0.01;
                            echo '<a href="' . base_url('index.php/scenario/jouer/' . $s['code_sce'] . '/' . $difficulty) . '">';
                            echo '<div class="card-img-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; top: ' . $val . '%; background: rgba(0, 0, 0, ' . $opacity . '); color: white; padding: 10px;">';
                        
                            echo '<h6 style="text-align: center; font-weight: bold;">' . $difficulty . '</h6>';


                            echo "</a>";
                        
                        
                            echo '</div>';
                            $val += 22;
                        }
                    
                    echo '</div>';
                    
                    echo '</div>';
                    echo '</div>';
                
            }

            echo '</div>';
        } else {
            echo "Aucun scénario pour le moment, revenez plus tard !";
        }
        ?>

            
            


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
      

  

