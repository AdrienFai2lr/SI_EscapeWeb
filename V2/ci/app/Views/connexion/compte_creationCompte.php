               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">creation d'un compte <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Créez un nouveau compte en remplissant les champs de saisies si dessous.</li>
                        </ol>
                       

                        
                        <div class="container px-2 px-lg-2">            
                            <div class="row gx-4 gx-lg-5 justify-content-center">
                                

                            <?php echo form_open('/compte/creer_compte', ['class' => 'container mt-4']); ?>
    <?= session()->getFlashdata('error') ?>
    <?= csrf_field() ?>

    <div class="row mb-3">
        <label for="pseudo" class="col-sm-2 col-form-label">Pseudo :</label>
        <div class="col-sm-10">
            <input type="input" class="form-control" name="pseudo">
        </div>
    </div>

    <div class="row mb-3">
        <label for="mdp" class="col-sm-2 col-form-label">Mot de passe :</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="mdp">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="mdp2" class="col-sm-2 col-form-label">Confirmer le mot de passe:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="mdp2">
        </div>
    </div>

    <div class="row mb-3">
        <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
        <div class="col-sm-10">
            <input type="input" class="form-control" name="nom">
        </div>
    </div>

    <div class="row mb-3">
        <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
        <div class="col-sm-10">
            <input type="input" class="form-control" name="prenom">
        </div>
    </div>

    <div class="row mb-3">
        <label for="role" class="col-sm-2 col-form-label">Rôle :</label>
        <div class="col-sm-10">
            <select name="role" class="form-control">
                <option value="O" <?= set_select('role', 'O', true) ?>>Organisateur</option>
                <option value="A" <?= set_select('role', 'A') ?>>Administrateur</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="role" class="col-sm-2 col-form-label">Etat :</label>
        <div class="col-sm-10">
            <select name="etat" class="form-control">
                <option value="A" <?= set_select('etat', 'A', true) ?>>Activé</option>
                <option value="D" <?= set_select('etat', 'D') ?>>Desactivé</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <input type="submit" name="submit" value="Créer un nouveau compte" class="btn btn-primary">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-10 offset-sm-2">
        <?= validation_show_error('pseudo') ?>
        <?= validation_show_error('mdp') ?>
        <?= validation_show_error('role') ?>
        <?= validation_show_error('nom') ?>
        <?= validation_show_error('prenom') ?>
        <?= validation_show_error('mdp2') ?>
        <?= $message; ?>
    </div>
</div>

                  
                                  

       
                                                            
                                  
                    </div>
                </main>