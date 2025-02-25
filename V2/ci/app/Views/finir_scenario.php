
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">

            </div>
            <div class="col-lg-8 align-self-baseline">
                <div class="message-container bg-light p-4 rounded">
                    <h1 class="display-4 mb-4">Félicitations!</h1>
                    <p class="lead mb-4">
                        Vous avez réussi le jeu numéro <?= $code_jeux->res; ?> dans la difficulté <?= $difficulte; ?> le
                        <?= date('Y-m-d') ?>.
                    </p>

                    
                    <form method="post" action="<?= base_url('index.php/scenario/finir_scenario'); ?>" class="mx-auto">
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label text-sm-end">Email :</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="themail" required style="max-width: 300px;">
                            </div>
                        </div>
                        <input type="hidden" name="thecode" value="<?= $code_jeux->res; ?>">
                        <input type="hidden" name="thedifficulte" value="<?= $difficulte; ?>">
                       
                        <div class="mb-3 row">
                            <div class="col-sm-6 offset-sm-3">
                                <button type="submit" class="btn btn-primary">Continuer</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</header>
