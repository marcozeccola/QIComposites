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
                              <a href="<?php echo URLROOT ?>/anomalie/singolaAnomaliaCostruzione?idAnomalia=<?php echo $anomalia->idAnomaliaCostruzione; ?>"
                                   class="btn">DETTAGLI</a>
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

           

     </div>

</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>