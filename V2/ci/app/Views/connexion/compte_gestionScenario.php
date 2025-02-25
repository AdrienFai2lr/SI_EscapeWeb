               
                <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenue <?php $session=session(); echo $session->get('user');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Informations sur les jeux.</li>
                        </ol>
                        <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        Créer un nouveau scénario :
        <a href="<?php echo base_url();?>index.php/compte/creer_jeux"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </a>
    </li>
</ol>

                       

                        <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <?php if ($jeux != NULL): ?>
            <table class="info_compte">
                <thead>
                    <tr>
                        <th>Intitule</th>
                        <th>Image</th>
                        <th>Nombres d'étapes</th>
                        <th>Auteur</th>
                        <th>Visualiser</th><!-- tout les scenarios sont visuable-->
                        <th>Activer/Descativer</th><!-- Les scenarios de l'organisateur sont activable desactivable-->
                        <th>Supprimer</th><!-- Les scenarios de l'organisateur sont supprimable-->
                        <th>RAZ</th><!-- Les scenarios de l'organisateur peuvent etre mise a 0-->
                        <th>modifier</th>
                        <th>Copier</th><!-- Copie d'un scenario possible pour tous sauf les siens-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jeux as $j): ?>
                        <tr>

                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                                <td style="background:#e8f1f1"><?= htmlspecialchars($j["intitule_sce"]); ?></td>
                            <?php }else{ ?>
                                <td><?= htmlspecialchars($j["intitule_sce"]); ?></td>
                            <?php } ?>

                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                                <td style="background:#e8f1f1">
                                <?= '<img src="' . base_url('img/' . $j['code_sce']) . '/' . $j['image_sce'] .'" class="card-img-top" alt="Scenario Image" style="height: 100px; width: auto;">'; ?>
                                </td>
                            <?php }else{ ?>
                                <td>
                                <?= '<img src="' . base_url('img/' . $j['code_sce']) . '/' . $j['image_sce'] . '" class="card-img-top" alt="Scenario Image" style="height: 100px; width: auto;">'; ?>
                                </td>
                            <?php } ?>

                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                                <td class="text-center" style="background:#e8f1f1"><?= htmlspecialchars($j["nombre_etapes"]); ?></td>
                            <?php }else{ ?>
                                <td class="text-center"><?= htmlspecialchars($j["nombre_etapes"]); ?></td>
                            <?php } ?>

                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td style="background:#e8f1f1" ><?= htmlspecialchars($j["pseudo_cpt"]); ?></td>
                            <?php }else{ ?>
                                <td ><?= htmlspecialchars($j["pseudo_cpt"]); ?></td>
                            <?php } ?>
                            <!-- ||||------------------------------|||| -->
                            <!-- tout les scenarios sont visuable-->
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td class="text-center" style="background:#e8f1f1">
                                <a href="<?php echo base_url();?>index.php/compte/visualiser_scenario/<?= $j['id_sce'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </td>
                            <?php }else{ ?>
                                 <td class="text-center">
                                <a href="visualiser_scenario/<?= $j['id_sce'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </td>
                            <?php } ?>
                            <!-- ||||------------------------------|||| -->
                            <!-- active/desactive-->
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td class="text-center" style="background:#e8f1f1">
                                <?php if($loggin == $j['pseudo_cpt']): ?>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                            <?php }else{ ?>
                                 <td class="text-center" >
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg>
                                
                                <?php endif; ?>
                            </td>
                            <?php } ?>
                            <!-- ||||------------------------------|||| -->
                            <!-- supprimer-->
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td class="text-center" style="background:#e8f1f1">
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                    <a href="supprimer_scenario/<?= $j['id_sce'];?>" onclick="confirmDelete(<?= $j['id_sce']; ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </a>
                                <?php endif; ?>
                            </td>
                            <?php }else{ ?>
                                <td class="text-center">
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                            <?php } ?>
                            <!-- ||||------------------------------|||| -->
                            <!-- RAZ-->
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td class="text-center" style="background:#e8f1f1">
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-0-circle-fill" viewBox="0 0 16 16">
                                  <path d="M8 4.951c-1.008 0-1.629 1.09-1.629 2.895v.31c0 1.81.627 2.895 1.629 2.895s1.623-1.09 1.623-2.895v-.31c0-1.8-.621-2.895-1.623-2.895Z"/>
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-8.012 4.158c1.858 0 2.96-1.582 2.96-3.99V7.84c0-2.426-1.079-3.996-2.936-3.996-1.864 0-2.965 1.588-2.965 3.996v.328c0 2.42 1.09 3.99 2.941 3.99Z"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                            <?php }else{ ?>
                                 <td class="text-center">
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-0-circle-fill" viewBox="0 0 16 16">
                                  <path d="M8 4.951c-1.008 0-1.629 1.09-1.629 2.895v.31c0 1.81.627 2.895 1.629 2.895s1.623-1.09 1.623-2.895v-.31c0-1.8-.621-2.895-1.623-2.895Z"/>
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-8.012 4.158c1.858 0 2.96-1.582 2.96-3.99V7.84c0-2.426-1.079-3.996-2.936-3.996-1.864 0-2.965 1.588-2.965 3.996v.328c0 2.42 1.09 3.99 2.941 3.99Z"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                             <?php } ?>
                             <!-- ||||------------------------------|||| -->
                            <!-- modifier-->
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                            <td class="text-center" style="background:#e8f1f1">
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                            <?php }else{ ?>
                                <td class="text-center" >
                                <?php if($loggin == $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                                <?php endif; ?>

                        <!-- ||||------------------------------|||| -->
                            <!-- copie-->
                            </td>
                             <?php } ?>
                            <?php if($loggin == $j['pseudo_cpt']){ ?>
                             <td class="text-center" style="background:#e8f1f1">
                                <?php if($loggin != $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                                  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                  <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                </svg>
                                <?php endif; ?>
                            </td>
                            <?php }else{ ?>
                                 <td class="text-center" >
                                <?php if($loggin != $j['pseudo_cpt']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                                  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                  <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                </svg>
                                <?php endif; ?>
                                 <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <br />
            Aucun scénario pour le moment !
        <?php endif; ?>
    </div>
</div>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous vraiment supprimer ce scénario?')) {
            window.location.href = '<?= base_url('Compte/supprimer_scenario/'); ?>' + id;
        }
    }
</script>

                
       
       
                </main>