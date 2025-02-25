               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Modification de votre compte <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Modification de vos informations personnelles</li>
                        </ol>
                       

                        
                        <div class="container px-2 px-lg-2">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-6">
            <?= session()->getFlashdata('error') ?>
            <?php echo form_open('/compte/modification_profil'); ?>
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="mdp1" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" name="mdp1">
                    <?= validation_show_error('mdp1') ?>
                </div>

                <div class="mb-3">
                    <label for="mdp2" class="form-label">Confirmez le mot de passe :</label>
                    <input type="password" class="form-control" name="mdp2">
                    <?= validation_show_error('mdp2') ?>
                </div>

                <input type="submit" name="submit" value="Modifier" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

                  
                        <?php echo $message ?>           

       
                                                            
                                  
                    </div>
                </main>