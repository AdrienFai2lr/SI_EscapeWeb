               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Creation d'un jeux <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Créez un nouveau jeux en remplissant les champs de saisies si dessous.</li>
                        </ol>
                       

                        
                        <div class="container px-2 px-lg-2">            
                            <div class="row gx-4 gx-lg-5 justify-content-center">
                                

                            <?php echo form_open_multipart('/compte/creer_jeux', ['class' => 'container mt-4']); ?>
    <?= session()->getFlashdata('error') ?>
    <?= csrf_field() ?>

    <div class="row mb-3">
        <label for="intitule" class="col-sm-2 col-form-label">Intitule :</label>
        <div class="col-sm-10">
            <input type="input" class="form-control" name="intitule">
        </div>
    </div>

    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">Description :</label>
        <div class="col-sm-10">
            <input type="input" class="form-control" name="description">
        </div>
    </div>
    <!-- transfert de fichier ici-->
    <div class="row mb-3">
        <label for="image" class="col-sm-2 col-form-label">Votre image :</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="image">
        </div>
    </div>
    <div class="row mb-3">
        <label for="etat" class="col-sm-2 col-form-label">Etat :</label>
        <div class="col-sm-10">
            <select name="etat" class="form-control">
                <option value="A" <?= set_select('etat', 'A', true) ?>>Activé</option>
                <option value="D" <?= set_select('etat', 'D') ?>>Désactivé</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="lecode" value="<?= substr(md5(uniqid(rand(), true)), 0, 8) ?>">

    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <input type="submit" name="submit" value="Créer un nouveau jeu !" class="btn btn-primary">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-10 offset-sm-2">
        <?= validation_show_error('intitule') ?>
        <?= validation_show_error('description') ?>
        <?= validation_show_error('image') ?>
        <?= validation_show_error('etat') ?>
        <?php if(isset($message) && !empty($message)): ?>
    <div class="alert alert-success" role="alert">
        <?= $message ?>
    </div>
<?php endif; ?>


    </div>
</div>

                  
                                  

       
                                                            
                                  
                    </div>
                </main>