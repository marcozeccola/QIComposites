<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="pricing" class="pricing section-bg ">
     <div class="container" >
          <header class="section-header">
               <h3>Dettagli tecnici anomalia in costruzione</h3> 
          </header>

          <a href="<?php echo URLROOT; ?>/anomalie/modificaAnomaliaCostruzione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaCostruzione; ?>">modifica</a>

          <table class="table">
               <tbody>
                    <tr>
                         <th scope="row">Localizzazione</th>
                         <td><?php echo $data["anomalia"]->localizzazione; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Estensione</th>
                         <td><?php echo $data["anomalia"]->estensione; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Profondita</th>
                         <td><?php echo $data["anomalia"]->profondita; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Tipologia anomalia</th>
                         <td><?php echo $data["anomalia"]->tipo; ?></td>
                    </tr>
               </tbody>
          </table>
          <?php
               if($data["anomalia"]->presente){
          ?>
          <a href="<?php echo URLROOT ?>/anomalie/risoltoCostruzione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaCostruzione; ?>"
                                   class="btn">RISOLTO</a>                   
          <?php
               }
          ?>
          <div class="col-xs-12 col-lg-4 card-anomalia">
               <div class="card card-carousel">

                    <?php
                         $dir = PUBLICROOT . "/anomalie/costruzione/".$data["anomalia"]->idAnomaliaCostruzione;
                         $anomalia = $data["anomalia"];
                         $files= NULL;

                         if(is_dir($dir)){
                              $files = array_slice(scandir($dir),2);
                         } 

                         if(!empty($files) && !is_null($files)){
                    ?>
                    <div id="carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>" class="carousel slide"
                         data-bs-ride="carousel">
                         <div class="carousel-inner">
                              <?php 
                                   foreach($files as $file){
                              ?>
                              <div class="carousel-item active">
                                   <img src="<?php echo URLROOT ;?>/public/anomalie/costruzione/<?php echo $anomalia->idAnomaliaCostruzione; ;?>/<?php echo $file;?>"
                                        class="d-block w-100">
                              </div>
                              <?php 
                                   }
                              ?>
                         </div>
                         <button class="carousel-control-prev" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>"
                              data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                         </button>
                         <button class="carousel-control-next" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>"
                              data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                         </button>
                    </div>
                    <?php  
                         } 
                    ?>
               </div>
          </div>
     </div>
</section>



<?php  
     if(!empty($files) && !is_null($files)){
?>
          <script>
          const carouselCos<?php echo $anomalia->idAnomaliaCostruzione; ?> = new bootstrap.Carousel(
               '#carouselCostruzione<?php echo $anomalia->idAnomaliaCostruzione; ?>');
          </script>
<?php 
     } 
?> 
<?php
     require APPROOT . '/views/includes/footer.php'; 
?>