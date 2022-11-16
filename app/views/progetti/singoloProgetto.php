<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="portfolio-details" class="portfolio-details">
     <div class="container">

          <div class="row gy-4">

               <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                         <div class="swiper-wrapper align-items-center">
                              <div class="swiper-slide">
                                   <?php  
                                        $cartella = PUBLICROOT . "/progetti-docs/copertine/".$data["progetto"]->idProgetto."/";
                                        $copertina = scandir($cartella)[2]; 
                                   ?>
                                   <img src="<?php echo URLROOT ?>/public/progetti-docs/copertine/<?php echo $data["progetto"]->idProgetto; ?>/<?php echo $copertina; ?>"
                                        alt="">
                              </div>
                         </div>
                         <div class="swiper-pagination"></div>
                    </div>
               </div>
 
            <div class="col-lg-4">
                    <div class="portfolio-info">
                         <h3><?php echo $data["progetto"]->nome; ?></h3>
                         <ul>
                              <li><strong>Inizio</strong>: <?php echo $data["progetto"]->inizio; ?></li>
                              <li><strong>Nome del progettista</strong>: <?php echo $data["progetto"]->progettista; ?></li>
                         </ul>
                    </div>
                    <div class="portfolio-description text-center">
                         <h3>Scarica</h3>
                         <p>
                              <a href="<?php echo URLROOT ?>/pdf/index?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>" class="btn btn-primary">REPORT</a>
                              <?php   
                                   $dirDisegni = str_replace( ' ', '',PUBLICROOT. "\progetti-docs\disegni\ ". $data["progetto"]->idProgetto." \ ");
                                   $fileDisegno =  is_dir($dirDisegni) ? scandir($dirDisegni)[2] : " ";

                                   $linkDisegno =  URLROOT. "/public/progetti-docs/disegni/". $data["progetto"]->idProgetto."/".$fileDisegno;
                                   $daCercare = $dirDisegni.$fileDisegno;
                                   if(file_exists($daCercare)){
                              ?>
                                   <a href="<?php echo $linkDisegno; ?>"
                                   download class="btn btn-primary">DISEGNI</a>
                              <?php     
                                   }else{
                              ?>    
                                   <a href="<?php echo URLROOT;?>/progetti/aggiungiDisegno?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-secondary">DISEGNI</a>
                              <?php 
                                   }
                              ?>

                              <?php   
                                   $dirProcedure = str_replace( ' ', '',PUBLICROOT. "\progetti-docs\procedures\ ". $data["progetto"]->idProgetto." \ ");
                                   $fileProcedura =  is_dir($dirProcedure) ? scandir($dirProcedure)[2] : " ";

                                   $linkProcedure =  URLROOT. "/public/progetti-docs/procedures/". $data["progetto"]->idProgetto."/".$fileProcedura;
                                   $daCercare = $dirProcedure.$fileProcedura;
 
                                   if(file_exists($daCercare)){
                              ?>
                                   <a href="<?php echo $linkProcedure; ?>"
                                    download class="btn btn-primary">NDT PROCEDURES</a>
                              <?php     
                                   }else{
                              ?>    
                                   <a href="<?php echo URLROOT;?>/progetti/aggiungiNdt?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-secondary">NDT PROCEDURES</a>
                              <?php 
                                   }
                              ?>
                              
                              
                         </p>
                    </div>
                    <div class="portfolio-description text-center">
                         <h3>Operazioni</h3>
                         <p>
                              <a href="<?php echo URLROOT ?>/anomalie/index?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>"
                                   class="btn btn-primary">ANOMALIE PRESENTI</a>
                              <a href="<?php echo URLROOT ?>/ispezioni/index?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>"
                                   class="btn btn-primary">LISTA ISPEZIONI</a>
                         </p>
                    </div>
               </div>

          </div>


          <div class="row gy-4 text-center">

               <div class="col-lg-12">
                    <div class="portfolio-description">
                         <h2>Caratteristiche</h2>

                         <table class="table"> 
                              <tbody> 

                                   <tr>
                                        <th scope="row">Aree di riferimento</th>
                                        <td>
                                             <a href="<?php echo URLROOT ?>/aree/aggiungiArea?idProgetto=<?php echo $_GET["id"]; ?>"><h6>Aggiungi area di riferimento</h6></a>
                                        </td>
                                        <?php 
                                             if($data["aree"]){
                                                  foreach($data["aree"] as $area){
                                        ?> 
                                                   <td><a href="<?php echo URLROOT ?>/aree/singolaMacroArea?idArea=<?php echo $area->idAreaRiferimento ?>"><?php echo $area->area; ?></a></td> 
                                        <?php     }
                                             }
                                        ?>
                                   </tr>

                                   <tr>
                                        <th scope="row">Tipi di anomalie</th>
                                        <td>
                                             <a href="<?php echo URLROOT ?>/anomalie/aggiungiTipoAnomalia?idProgetto=<?php echo $_GET["id"]; ?>"><h6>Aggiungi tipi di anomalie</h6></a>
                                        </td>
                                        <?php 
                                             if($data["tipiAnomalie"]){
                                             foreach($data["tipiAnomalie"] as $tipoAnomalia){
                                        ?> 
                                             <td><?php echo $tipoAnomalia->anomalia; ?></td>
                                       
                                        <?php     }
                                              } 
                                        ?>
                                   </tr>
                              
                                   <tr>
                                        <th scope="row">Sonde</th>
                                        <td>
                                             <a href="<?php echo URLROOT ?>/sonde/aggiungiSonda?idProgetto=<?php echo $_GET["id"]; ?>"><h6>Aggiungi sonda</h6></a>
                                        </td>
                                        <?php  
                                             foreach($data["sonde"] as $sonda){
                                        ?> 
                                             <td><?php echo $sonda->sonda; ?></td>
                                        <?php     
                                             }
                                        ?>
                                   </tr>
                                   <tr>
                                        <th scope="row">Reticoli</th>
                                        <td>
                                             <a href="<?php echo URLROOT ?>/reticoli/aggiungiReticolo?idProgetto=<?php echo $_GET["id"]; ?>"><h6>Aggiungi reticolo</h6></a>
                                        </td>
                                        <?php  
                                             foreach($data["reticoli"] as $reticolo){
                                        ?> 
                                             <td><?php echo $reticolo->nome; ?></td>
                                        <?php     
                                             }
                                        ?>
                                   </tr>
                              </tbody>
                         </table>
 
                    </div>
               </div>


          </div>

     </div>
</section>

<?php
   require APPROOT . '/views/includes/footer.php'; 
?>