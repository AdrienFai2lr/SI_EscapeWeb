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
        
    </div>
    <section class="page-section bg-primary" id="about">
    <div class="container px-2 px-lg-2">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <h2><?= $titre; ?></h2>
                <?= session()->getFlashdata('error') ?>
            </div>
            <div class="col-lg-8">
                <?php echo form_open('/compte/connecter'); ?>
                <?= csrf_field() ?>

                <div class="mb-3 row">
                    <label for="pseudo" class="col-sm-2 col-form-label">Pseudo :</label>
                    <div class="col-sm-10">
                        <input type="input" class="form-control" name="pseudo" value="<?= set_value('pseudo') ?>">
                        <?= validation_show_error('pseudo') ?>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="mdp" class="col-sm-2 col-form-label">Mot de passe :</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="mdp">
                        <?= validation_show_error('mdp') ?>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <input type="submit" name="submit" value="Se connecter" class="btn btn-primary">
                    </div>
                </div>

                </form>
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
       

  

