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
                         <a class="btn btn-primary" 
                         style="width: 70%; margin: auto" 
                         href="<?php echo URLROOT;?>/progetti/modificaProgetto?idProgetto=<?php echo $_GET["id"];?>">Modifica dati progetto</a>

                    </div>
                    <div class="portfolio-description text-center">
                         <h3>Scarica</h3>
                         <p>
                              
                              <?php   
                                   $dirDisegni = str_replace( ' ', '',PUBLICROOT. "/progetti-docs/disegni/ ". $data["progetto"]->idProgetto." / ");
                                   $fileDisegno =  is_dir($dirDisegni) ? scandir($dirDisegni)[2] : " ";

                                   $linkDisegno =  URLROOT. "/public/progetti-docs/disegni/". $data["progetto"]->idProgetto."/".$fileDisegno;
                                   $daCercare = $dirDisegni.$fileDisegno;
                                   if(file_exists($daCercare)){
                              ?>
                                   <a href="<?php echo URLROOT;?>/progetti/disegni?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-primary">DISEGNI</a>
                              <?php     
                                   }else{
                              ?>    
                                   <a href="<?php echo URLROOT;?>/progetti/aggiungiDisegno?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-secondary">DISEGNI</a>
                              <?php 
                                   }
                              ?>

                              <?php   
                                   $dirProcedure = str_replace( ' ', '',PUBLICROOT. "/progetti-docs/procedures/ ". $data["progetto"]->idProgetto."/ ");
                                   $fileProcedura =  is_dir($dirProcedure) ? scandir($dirProcedure)[2] : " ";

                                   $linkProcedure =  URLROOT. "/public/progetti-docs/procedures/". $data["progetto"]->idProgetto."/".$fileProcedura;
                                   $daCercare = $dirProcedure.$fileProcedura;
 
                                   if(file_exists($daCercare)){
                              ?>
                                   <a href="<?php echo URLROOT;?>/progetti/ndt?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-primary">NDT PROCEDURES</a>
                              <?php     
                                   }else{
                              ?>    
                                   <a href="<?php echo URLROOT;?>/progetti/aggiungiNdt?idProgetto=<?php echo $_GET["id"];?>"
                                    class="btn btn-secondary">NDT PROCEDURES</a>
                              <?php 
                                   }
                              ?>
                              
                              <br> <br>
                              <a href="<?php echo URLROOT;?>/progetti/modificaCopertina?idProgetto=<?php echo $_GET["id"];?>"
                                   class="btn btn-primary">MODIFICA COPERTINA PROGETTO</a>
                         </p>
                    </div>
                    <div class="portfolio-description text-center">
                         <h3>Operazioni</h3>
                         <p>
                              <a href="<?php echo URLROOT; ?>/public/ispezioni/aggiungiIspezioneCostruzione?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>"
                                   class="btn btn-primary">NUOVA ISPEZIONE</a>
                                   <br>
                                   <br>
                              <a href="<?php echo URLROOT ?>/ispezioni/index?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>"
                                   class="btn btn-primary">LISTA ISPEZIONI</a>
                              <a href="<?php echo URLROOT ?>/anomalie/index?idProgetto=<?php echo $data["progetto"]->idProgetto; ?>"
                                   class="btn btn-primary">ANOMALIE PRESENTI</a> 
                         </p>
                    </div>
               </div>

          </div>

          <div class="row gy-4 text-center">

               <div class="col-lg-12">
                    <div class="portfolio-description">
                         <h2>Caratteristiche</h2>
                         <h5 id="aree">Aree di riferimento</h5>
                         <a class="btn btn-primary" href="<?php echo URLROOT ?>/aree/aggiungiArea?idProgetto=<?php echo $_GET["id"]; ?>">Aggiungi area</a><br>
                         <table class="table" style="margin-top: 5%"> 
                              <tbody> 
                                   <tr>
                                        <?php 
                                             if($data["aree"]){
                                                  foreach($data["aree"] as $area){
                                        ?> 
                                                   <tr>
                                                       <td>
                                                            <a href="<?php echo URLROOT ?>/aree/singolaMacroArea?idArea=<?php echo $area->idAreaRiferimento ?>">
                                                                 <?php echo $area->area; ?>
                                                            </a>
                                                            <br> 
                                                            <a href="<?php echo URLROOT ?>/aree/modificaArea?idArea=<?php echo $area->idAreaRiferimento ?>">
                                                                 modifica
                                                            </a>
                                                       </td>
                                                  <tr>
                                        <?php     }
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