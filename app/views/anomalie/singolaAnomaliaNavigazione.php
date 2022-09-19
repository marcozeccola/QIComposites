<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="pricing" class="pricing section-bg ">
     <div class="container" >
          <header class="section-header">
               <h3>Dettagli tecnici anomalia in navigazione</h3> 
          </header>

          <a href="<?php echo URLROOT; ?>/anomalie/modificaAnomaliaNavigazione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaNavigazione; ?>">modifica</a>


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
                         <th scope="row">Operatori</th>
                         <td><?php echo $data["anomalia"]->tipo; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Dettagli - causa</th>
                         <td><?php echo $data["anomalia"]->causa; ?></td>
                    </tr>
               </tbody>
          </table>

          <div class="col-xs-12 col-lg-4 card-anomalia">
               <div class="card card-carousel">

                    <?php
                         $dir = PUBLICROOT . "/anomalie/navigazione/".$data["anomalia"]->idAnomaliaNavigazione;
                         $anomalia = $data["anomalia"];
                         $files= NULL;

                         if(is_dir($dir)){
                              $files = array_slice(scandir($dir),2);
                         } 

                         if(!empty($files) && !is_null($files)){
                    ?>
                    <div id="carouselNavigazione<?php echo $anomalia->idAnomaliaNavigazione; ?>" class="carousel slide"
                         data-bs-ride="carousel">
                         <div class="carousel-inner">
                              <?php 
                                   foreach($files as $file){
                              ?>
                              <div class="carousel-item active">
                                   <img src="<?php echo URLROOT ;?>/public/anomalie/navigazione/<?php echo $anomalia->idAnomaliaNavigazione; ;?>/<?php echo $file;?>"
                                        class="d-block w-100">
                              </div>
                              <?php 
                                   }
                              ?>
                         </div>
                         <button class="carousel-control-prev" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaNavigazione; ?>"
                              data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                         </button>
                         <button class="carousel-control-next" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $anomalia->idAnomaliaNavigazione; ?>"
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
          const carouselCos<?php echo $anomalia->idAnomaliaNavigazione; ?> = new bootstrap.Carousel(
               '#carouselCostruzione<?php echo $anomalia->idAnomaliaNavigazione; ?>');
          </script>

<?php 
     } 
     require APPROOT . '/views/includes/footer.php'; 
?>