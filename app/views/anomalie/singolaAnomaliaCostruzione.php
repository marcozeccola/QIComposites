<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="pricing" class="pricing section-bg ">

     <div style="margin-left: 20px!important;">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/">Progetti</a></li>
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $data["anomalia"]->idProgetto; ?>"><?php echo $data["anomalia"]->nomeProgetto; ?></a></li>
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/ispezioni/index?idProgetto=<?php echo $data["anomalia"]->idProgetto; ?>">Lista Ispezioni</a></li>
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/anomalie/anomalieIspezioneCostruzione?idIspezione=<?php echo $data["anomalia"]->idIspezione; ?>">Singola ispezione</a></li>
          <li class="breadcrumb-item active" aria-current="page">Singola anomalia</li>
        </ol>
      </nav>
    </div>

     <div class="container" >
          <header class="section-header">
               <h3>Dettagli tecnici anomalia in costruzione</h3> 
          </header>

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
                         <td><?php echo $data["anomalia"]->anomalia; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Commenti</th>
                         <td><?php echo $data["anomalia"]->commenti; ?></td>
                    </tr>
                    <?php
                         if(isset($data["anomalia"]->riparazione) && $data["anomalia"]->riparazione != "no"){
                    ?>
                              <tr>
                                   <th scope="row">Commento sulla riparazione</th>
                                   <td><?php echo $data["anomalia"]->riparazione; ?></td>
                              </tr>
                    <?php
                         }
                    ?>
               </tbody>
          </table>
          <?php
               if($data["anomalia"]->presente){
          ?>
          <a href="<?php echo URLROOT ?>/anomalie/risoltoCostruzione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaCostruzione; ?>"
                                   class="btn">SEGNA COME RISOLTA</a>                   
          <?php
               }
          ?>
          <div class="col-xs-12 col-lg-4 card-anomalia">
               <div class="card-carousel">

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
                                   $cont =0;
                                   foreach($files as $file){
                              ?>
                              <div class="carousel-item <?php echo $cont == 0? "active":""; ?>">
                                   <img src="<?php echo URLROOT ;?>/public/anomalie/costruzione/<?php echo $anomalia->idAnomaliaCostruzione; ;?>/<?php echo $file;?>"
                                        class="d-block w-100">
                              </div>
                              <?php 
                                   $cont++;
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
<div class="text-center">
     <a class="btn btn-primary" style="width: 40%; margin: auto"href="<?php echo URLROOT; ?>/anomalie/modificaAnomaliaCostruzione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaCostruzione; ?>">modifica</a>
</div>




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