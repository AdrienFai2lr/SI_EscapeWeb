<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Bienvenue <?php $session = session(); echo $session->get('user'); ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Information sur le scénario <?= $info_sce->intitule_sce; ?></li>
            </ol>

            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <?php if ($info_sce != NULL): ?>
                        <div class="table-responsive mx-auto">
                            <table class="info_compte">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Intitule</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Etat</th>
                                        <th>Image</th>
                                        <th>créateur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?= $info_sce->id_sce; ?></td>
                                    <td><?= $info_sce->intitule_sce; ?></td>
                                    <td><?= $info_sce->code_sce; ?></td>
                                    <td><?= $info_sce->description_sce; ?></td>
                                    <td><?= $info_sce->etat_sce; ?></td>
                                    <td>
                                        <?= '<img src="' . base_url('img/' . $info_sce->code_sce . '/' . $info_sce->image_sce) . '" class="card-img-top" alt="Scenario Image" style="height: 100px; width: auto;">'; ?>
                                    </td>
                                    <td><?= $info_sce->pseudo_cpt; ?></td>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <br />
                        Aucun scenario avec ce numero
                    <?php endif; ?>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <br>
                </div>
            </div>

            <div class="col-lg-8 text-start main-container mt-4">
            <span style="font-size: 24px; text-decoration: underline;">Question & Réponses.</span>
    <?php if (!empty($info_all)): ?>
        <div class="info-container">
            <?php foreach ($info_all as $question): ?>
                <div class="qa-container">
                    <span style="display: inline;"><?= $question['question_eta']; ?> <span style="font-size: 25px;">&rarr;</span> </span>
                    <span style="display: inline;"><?= $question['reponse_eta']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <br />
        <p>Aucune question & réponse pour ce scénario.</p>
    <?php endif; ?>
</div>





        </div>
    </main>
</div>
