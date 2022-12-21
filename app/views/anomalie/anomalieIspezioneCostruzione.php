<?php
   require APPROOT . '/views/includes/head.php'; 
   
   require APPROOT . '/views/includes/navigation.php';   
?>

<section id="pricing" class="pricing section-bg ">

    <div style="margin-left: 20px!important;">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/">Progetti</a></li>
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $data["ispezione"]->fk_idProgetto; ?>"><?php echo $data["ispezione"]->nomeProgetto; ?></a></li>
          <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/ispezioni/index?idProgetto=<?php echo $data["ispezione"]->fk_idProgetto; ?>">Lista Ispezioni</a></li>
          <li class="breadcrumb-item active" aria-current="page">Singola ispezione</li>
        </ol>
      </nav>
    </div>

     <div class="container text-left" style="width: 95%; margin: auto">
          <header class="section-header">
               <h3>Dettagli tecnici ispezione in costruzione</h3>
          </header>
          <br> 

          <table class="table">
               <tbody>
                    <tr>
                         <th scope="row">id Report</th>
                         <td><?php echo $data["ispezione"]->idCustom; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Main Goal</th>
                         <td><?php echo $data["ispezione"]->obiettivo; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Data di inizio</th>
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
                         <th scope="row">Reticolo</th>
                         <td><?php echo $data["ispezione"]->reticoli; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Sonda</th>
                         <td><?php echo $data["ispezione"]->sonde; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Strumento</th>
                         <td><?php echo $data["ispezione"]->strumenti; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Revisionato</th>
                         <td><?php echo $data["ispezione"]->revisionato == 1 ? "Sì": "No"; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Macroarea di Riferimento</th>
                         <td>
                              <?php  
                  if($data["macroArea"]){
                    echo $data["macroArea"]->area; 
                  }
                ?>
                         </td>
                    </tr>
                    <tr>
                         <th scope="row">Sotto area di Riferimento</th>
                         <td>
                              <?php 
                  if($data["sottoArea"]){
                    echo $data["sottoArea"]->nome; 
                  }
                ?>
                         </td>
                    </tr>
                    <tr>
                         <th scope="row">Nome area</th>
                         <td><?php echo $data["ispezione"]->nomeArea; ?></td>
                    </tr>
               </tbody>
          </table>

          <!-- Link al report veloce -->
          <a href="<?php echo URLROOT; ?>/pdf/quick?idIspezione=<?php echo $data["ispezione"]->idIspezioneCostruzione; ?>"
               class="btn btn-primary">QUICK REPORT</a>


          <!-- Link al report completo -->
          <a href="<?php echo URLROOT; ?>/pdf/report?idIspezione=<?php echo $data["ispezione"]->idIspezioneCostruzione; ?>"
               class="btn btn-primary">REPORT</a>

          <?php
              $dir = PUBLICROOT . "/ispezioni/costruzione/".$data["ispezione"]->idIspezioneCostruzione;
              $ispezione = $data["ispezione"];
              $files= NULL;

              if(is_dir($dir)){
                  $files = array_slice(scandir($dir),2);
              } 

              if(!empty($files) && !is_null($files)){
          ?>
          <div class="col-xs-12 col-lg-4 card-anomalia">
               <div class="card-carousel">
                    <div id="carouselCostruzione<?php echo $ispezione->idIspezioneCostruzione; ?>"
                         class="carousel slide" data-bs-ride="carousel">
                         <div class="carousel-inner">
                              <?php 
                foreach($files as $file){
          ?>
                              <div class="carousel-item active">
                                   <img src="<?php echo URLROOT ;?>/public/ispezioni/costruzione/<?php echo $ispezione->idIspezioneCostruzione; ;?>/<?php echo $file;?>"
                                        class="d-block w-100">
                              </div>
                              <?php 
                }
                ?>
                      </div>
                         <button class="carousel-control-prev" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $ispezione->idIspezioneCostruzione; ?>"
                              data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                         </button>
                         <button class="carousel-control-next" type="button"
                              data-bs-target="#carouselCostruzione<?php echo $ispezione->idIspezioneCostruzione; ?>"
                              data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                         </button>
                         <br>
                    </div>
               </div>
            <?php
              } 
            ?>
                         
          </div>
          <div class="text-center" style="width: 50%; margin: auto">
               <a class="btn btn-primary"
                    href="<?php echo URLROOT; ?>/ispezioni/modificaIspezioneCostruzione?idIspezione=<?php echo $data["ispezione"]->idIspezioneCostruzione; ?>">Modifica</a>
          </div><br><br>
          <header class="section-header">
               <h3>Anomalie</h3>
               <p>
                    <a class="btn btn-primary"
                         href="<?php echo URLROOT; ?>/anomalie/aggiungiAnomaliaCostruzione?idIspezione=<?php echo $_GET["idIspezione"]; ?>">Aggiungi
                         anomalia</a>
               </p>
          </header>

          <?php 
          if($data["anomalieCostruzione"]){
     ?>

          <div class="row flex-items-xs-middle flex-items-xs-center">
               <?php
          foreach($data["anomalieCostruzione"] as $anomalia){ 
              $dir = PUBLICROOT . "/anomalie/costruzione/".$anomalia->idAnomaliaCostruzione;
            
            $files= NULL;
            if(is_dir($dir)){
              $files = array_slice(scandir($dir),2);
            } 

         ?>
               <div class="col-xs-12 col-lg-4 card-anomalia shadow-sm p-3 mb-5 bg-white rounded">

                    <div class="card-block"><br>
                         <h4 class="card-title text-center"><b>
                                   <?php echo $anomalia->anomalia; ?></b>
                         </h4>
                         <ul class="list-group list-group-flush">
                              <li class="list-group-item">Localizzazione: <?php echo $anomalia->localizzazione; ?> </li>
                              <li class="list-group-item">Estensione: <?php echo $anomalia->estensione; ?></li>
                              <li class="list-group-item">Profondità: <?php echo $anomalia->profondita; ?></li>
                              <li class="list-group-item">Ancora presente:
                                   <?php echo $anomalia->presente ? "sì": "no"; ?></li>
                         </ul><br>
                         <div class="text-center">
                              <a class="btn btn-primary" sty
                                   href="<?php echo URLROOT ?>/anomalie/singolaAnomaliaCostruzione?idAnomalia=<?php echo $anomalia->idAnomaliaCostruzione; ?>">DETTAGLI</a>
                         </div>
                         <?php if($anomalia->presente!=0){
                  ?>
                         <a href="<?php echo URLROOT ?>/anomalie/risoltoCostruzione?idAnomalia=<?php echo $anomalia->idAnomaliaCostruzione; ?>&idProgetto=<?php echo $data["ispezione"]->fk_idProgetto ;?>&idIspezione=<?php echo $data["ispezione"]->idIspezioneCostruzione; ?>"
                              class="btn">SEGNA COME RISOLTA</a>
                         <?php
                  }
                ?>
                    </div>
               </div>

               <?php
          }
         ?>
          </div>

     </div>
     <br>
     <?php 
          }
     ?>

</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>