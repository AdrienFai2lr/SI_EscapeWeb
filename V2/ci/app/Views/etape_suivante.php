

        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        
                    
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                    <?php
// On re vérifie que le scénario est bon
                        if ($scenario !== null) {
                            echo '<div class="etape" style="margin-top: 20px; border: 3px solid #ccc; padding: 15px; text-align: left; margin: 0 auto; max-width: 600px; background-color: rgba(180, 130, 220, 0.5);; color: #000;overflow: hidden;">';

                            echo '<p style="font-weight: bold; font-size: 18px; color: #200;">Titre : ' . $scenario->intitule_sce . " by " . $scenario->pseudo_cpt . " Code : " . $scenario->code_sce . '</p>';
                            echo "<br>";

                            echo '<div class="ressource" style="float: left; margin-right: 20px; max-width: 300px; overflow: hidden;">';
                            echo '<h3>Ressource</h3>';
                            echo '<img src="' . base_url() . 'img_etape/' . $scenario->ressource_eta . '" alt="Image de l\'etape" style="max-width: 100%; height: auto;">';
                            echo '</div>';

                            echo '<div class="question" style="overflow: hidden;">';
                            echo '<span style="display: block; margin-bottom: 10px;"><h3 style="font-size: 16px; color: #200;">Question | ' . $scenario->difficulte_ind . '</h3></span>';
                            echo '<p style="font-size: 14px; color: #000;">' . $scenario->question_eta . '</p>';

                            echo form_open(base_url('index.php/scenario/franchir_etape/'));
                            echo csrf_field();
                            echo '<label for="reponse">Votre réponse : </label>';
                            echo '<input type="text" id="reponse" name="reponse" placeholder="Reponse" style="margin-bottom: 10px; padding: 5px; font-size: 14px;">';
                            echo '<input type="hidden" name="thecode" value="' . $scenario->code_eta . '">';
                            echo '<input type="hidden" name="thedifficulte" value="' . $difficulte . '">';

                            echo '<input type="submit" name="submit" value="Valider">';
                            echo form_close();

                            if ($scenario->lien_ind != null) {
                                echo '<a href="' . $scenario->lien_ind . '" target="_blank" style="text-decoration: none;">';
                                echo '<span id="aide" title="' . htmlspecialchars($scenario->description_ind) . '" style="font-size: 20px; color: #fff; cursor: help; margin-left: 10px;">?</span>';
                                echo '</a>';
                            }

                            echo '</div>';
                            echo '</div>';
                        } else {
                           // Aucun enregistrement trouvé, vous pouvez afficher un message approprié.
                           echo 'Aucun enregistrement trouvé.';
                        }
                        ?>

                            
                       
                        
                        
                    </div>
                </div>
            </div>
        </header>
       
  

