<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>
<section id="pricing" class="pricing section-bg ">

     <div class="container">

          <header class="section-header">
               <h3>Anomalie</h3>
               <p>Anomalie ancora presenti del progetto <?php echo $data["nomeProgetto"]; ?></p>
          </header>

          <?php 
          if($data["anomalieCostruzione"]){
     ?>
          <h4>Costruzione</h4>

          <div class="row flex-items-xs-middle flex-items-xs-center">

               <?php
          foreach($data["anomalieCostruzione"] as $anomalia){
            $dir = PUBLICROOT . "/anomalie/costruzione/".$anomalia->idAnomaliaCostruzione;
            
            $files= NULL;
            if(is_dir($dir)){
              $files = array_slice(scandir($dir),2);
            } 

         ?>
               <div class="col-xs-12 col-lg-4">
                    <div class="card card-carousel">
                      

                        <?php 
                            if(!empty($files) && !is_null($files)){
                        ?> 
                        <div id="carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                        <?php 
                                foreach($files as $file){
                        ?>  
                                   <div class="carousel-item active">
                                        <img src="<?php echo URLROOT ;?>/public/anomalie/costruzione/<?php echo $anomalia->idAnomaliaCostruzione; ;?>/<?php echo $file;?>" class="d-block w-100">
                                   </div> 
                        <?php 
                                }
                        ?>
                              </div>
                              <button class="carousel-control-prev" type="button"
                                   data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>" data-bs-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button"
                                   data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>" data-bs-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Next</span>
                              </button>
                         </div>
                        <?php  
                            } 
                            if(!empty($files) && !is_null($files)){
                        ?> 
                            <script> 
                              const carouselCos<?php echo $anomalia->idAnomaliaCostruzione; ?> = new bootstrap.Carousel('#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>');
                            </script>
                        <?php }
                        ?>

                         <div class="card-header">
                              <h3><span class="period"><?php echo $anomalia->data; ?></span></h3>
                         </div>
                         <div class="card-block">
                              <h4 class="card-title">
                                   <?php echo $anomalia->anomalia; ?>
                              </h4>
                              <ul class="list-group">
                                   <li class="list-group-item">Localizzazione: <?php echo $anomalia->localizzazione; ?>
                                   </li>
                                   <li class="list-group-item">Estensione: <?php echo $anomalia->estensione; ?></li>
                                   <li class="list-group-item">Profondità: <?php echo $anomalia->profondita; ?></li>
                              </ul>
                              <a href="<?php echo URLROOT ?>/anomalie/risoltoCostruzione?idAnomalia=<?php echo $anomalia->idAnomaliaCostruzione; ?>&idProgetto=<?php echo $data["idProgetto"] ;?>"
                                   class="btn">RISOLTO</a>
                         </div>
                    </div>
               </div>
               <?php
          }
         ?>


          </div>
          <br>
          <?php 
          }
     ?>

          <?php 
          if($data["anomalieNavigazione"]){
     ?>
          <br><br>
          <h4>Navigazione</h4>

          <div class="row flex-items-xs-middle flex-items-xs-center">

               <?php
          foreach($data["anomalieNavigazione"] as $anomalia){$dir = PUBLICROOT . "/anomalie/navigazione/".$anomalia->idAnomaliaNavigazione;
            $files= NULL;
            if(is_dir($dir)){
              $files = array_slice(scandir($dir),2);
            } 

         ?>
               <div class="col-xs-12 col-lg-4">
                    <div class="card card-carousel">
                      

                        <?php 
                            if(!empty($files) && !is_null($files)){
                        ?> 
                        <div id="carouselNavigazione<?php echo $anomalia->idAnomaliaNavigazione; ?>" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                        <?php 
                                foreach($files as $file){
                        ?>  
                                   <div class="carousel-item active">
                                        <img src="<?php echo URLROOT ;?>/public/anomalie/navigazione/<?php echo $anomalia->idAnomaliaNavigazione; ;?>/<?php echo $file;?>" class="d-block w-100">
                                   </div> 
                        <?php 
                                }
                        ?>
                              </div>
                              <button class="carousel-control-prev" type="button"
                                   data-bs-target="#carouselNavigazione<?php echo $anomalia->idAnomaliaNavigazione; ?>" data-bs-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button"
                                   data-bs-target="#carouselNavigazione<?php echo $anomalia->idAnomaliaNavigazione; ?>" data-bs-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Next</span>
                              </button>
                         </div>
                        <?php 
                            } 
                            if(!empty($files) && !is_null($files)){
                        ?> 
                            <script> 
                              const carouselNav<?php echo $anomalia->idAnomaliaNavigazione; ?> = new bootstrap.Carousel('#carouselNavigazione<?php echo $anomalia->idAnomaliaNavigazione; ?>');
                            </script>
                        <?php }
                        ?>
                         <div class="card-header">
                              <h3><span class="period"><?php echo $anomalia->data; ?></span></h3>
                         </div>
                         <div class="card-block">
                              <h4 class="card-title">
                                   <?php echo $anomalia->anomalia; ?>
                              </h4>
                              <ul class="list-group">
                                   <li class="list-group-item">Localizzazione: <?php echo $anomalia->localizzazione; ?>
                                   </li>
                                   <li class="list-group-item">Estensione: <?php echo $anomalia->estensione; ?></li>
                                   <li class="list-group-item">Profondità: <?php echo $anomalia->profondita; ?></li>
                                   <li class="list-group-item">Ipotesi causa: <?php echo $anomalia->causa; ?></li>
                              </ul>
                              <a href="<?php echo URLROOT ?>/anomalie/risoltoNavigazione?idAnomalia=<?php echo $anomalia->idAnomaliaNavigazione; ?>&idProgetto=<?php echo $data["idProgetto"] ;?>"
                                   class="btn">RISOLTO</a>
                         </div>
                    </div>
               </div>
               <?php
          }
         ?>


          </div>

          <?php 
          }
     ?>

     </div>

</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>