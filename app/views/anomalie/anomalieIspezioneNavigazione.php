<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>  
<section id="pricing" class="pricing section-bg ">

      <div class="container" >

 <header class="section-header">
          <h3>Dettagli tecnici ispezione in navigazione</h3> 
        </header>
        <a href="<?php echo URLROOT; ?>/ispezioni/modificaIspezioneNavigazione?idIspezione=<?php echo $data["ispezione"]->idIspezioneNavigazione; ?>">modifica</a>

        <table class="table"> 
          <tbody>
            <tr>
              <th scope="row">Data</th>
              <td><?php echo $data["ispezione"]->data; ?></td> 
            </tr>
            <tr>
              <th scope="row">Cliente</th>
              <td><?php echo $data["ispezione"]->cliente; ?></td> 
            </tr> 
            <tr>
              <th scope="row">Luogo</th>
              <td><?php echo $data["ispezione"]->luogo; ?></td> 
            </tr>
            <tr>
              <th scope="row">Progetto</th>
              <td><?php echo $data["ispezione"]->nomeProgetto; ?></td> 
            </tr>
            <tr>
              <th scope="row">Operatori</th>
              <td><?php echo $data["ispezione"]->operatori; ?></td> 
            </tr>
            <tr>
              <th scope="row">Aree di riferimento</th>
              <td><?php echo $data["ispezione"]->aree; ?></td> 
            </tr>
            <tr>
              <th scope="row">Dettagli</th>
              <td><?php echo $data["ispezione"]->dettagli; ?></td> 
            </tr> 
            <tr>
              <th scope="row">Sonda</th>
              <td><?php echo $data["ispezione"]->sonda; ?></td> 
            </tr> 
          </tbody>
        </table>

        <header class="section-header">
          <h3>Anomalie</h3> 
          <p>
           <a href="<?php echo URLROOT; ?>/anomalie/aggiungiAnomaliaNavigazione?idIspezione=<?php echo $_GET["idIspezione"]; ?>">Aggiungi anomalia</a>

          </p>         

        </header>
 

     <?php 
          if($data["anomalieNavigazione"]){
     ?>  

        <div class="row flex-items-xs-middle flex-items-xs-center">

    <?php
          foreach($data["anomalieNavigazione"] as $anomalia){
            $dir = PUBLICROOT . "/anomalie/navigazione/".$anomalia->idAnomaliaNavigazione;
            $files= NULL;
            if(is_dir($dir)){
              $files = array_slice(scandir($dir),2);
            } 

         ?>
               <div class="col-xs-12 col-lg-4 card-anomalia">
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
                        <?php }?>
                        <br>
                         <div class="card-block">
                              <h4 class="card-title">
                                   <?php echo  $anomalia->localizzazione; ?>
                              </h4>
                              <ul class="list-group">
                                   <li class="list-group-item">Anomalia: <?php echo  $anomalia->anomalia; ?>
                                   </li>
                                   <li class="list-group-item">Estensione: <?php echo $anomalia->estensione; ?></li>
                                   <li class="list-group-item">Profondità: <?php echo $anomalia->profondita; ?></li>
                                   <li class="list-group-item">Ipotesi causa: <?php echo $anomalia->causa; ?></li>
                              </ul>
                              <a href="<?php echo URLROOT ?>/anomalie/singolaAnomaliaNavigazione?idAnomalia=<?php echo $anomalia->idAnomaliaNavigazione; ?>" class="btn">DETTAGLI</a>
                            <?php 
                              if($anomalia->presente!=0){
                            ?>
                              <a href="<?php echo URLROOT ?>/anomalie/risoltoNavigazione?idAnomalia=<?php echo $anomalia->idAnomaliaNavigazione; ?>&idProgetto=<?php echo $data["ispezione"]->fk_idProgetto ;?>&idIspezione=<?php echo $data["ispezione"]->idIspezioneNavigazione; ?>"
                                   class="btn">RISOLTO</a>
                            <?php }?>
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

