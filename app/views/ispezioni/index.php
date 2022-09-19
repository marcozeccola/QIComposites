<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?> 
 
<section id="pricing" class="pricing section-bg ">

      <div class="container" >

        <header class="section-header">
          <h3>Ispezioni</h3>
          <p>Ispezioni del progetto <?php echo $data["nomeProgetto"]; ?></p>
        </header>

     
        <h4>Costruzione</h4>

        <div class="row flex-items-xs-middle flex-items-xs-center">
            <a href="<?php echo URLROOT; ?>/public/ispezioni/aggiungiIspezioneCostruzione?idProgetto=<?php echo $_GET["idProgetto"]; ?>">Aggiungi ispezione costruzione</a>
          <?php 
          if($data["ispezioniCostruzione"]){
     ?> 
           <br>
         <?php
          foreach($data["ispezioniCostruzione"] as $ispezione){
         ?>
          <div class="col-xs-12 col-lg-4 card-anomalia" >
            <div class="card">
              <div class="card-header">
                <h3><span class="period"><?php echo $ispezione->data; ?></span></h3>
              </div>
              <div class="card-block"> 
                <ul class="list-group">
                  <li class="list-group-item">Luogo: <?php echo $ispezione->luogo; ?> </li>
                  <li class="list-group-item">Operatori:  <?php echo $ispezione->operatori; ?>  </li>
                  <li class="list-group-item">Anomalie:  <?php echo $ispezione->risultato ? "presenti" :  "assenti"; ?></li> 
                </ul>
                <a href="<?php echo URLROOT ?>/anomalie/anomalieIspezioneCostruzione?idIspezione=<?php echo $ispezione->idIspezioneCostruzione; ?>" class="btn">DETTAGLI</a>
              </div>
            </div>
          </div>
         <?php
          }
         ?>

<?php 
          }
     ?>
        </div>
<br>
     

     <br><br>
        <h4>Navigazione</h4>

        <div class="row flex-items-xs-middle flex-items-xs-center">

            <a href="<?php echo URLROOT; ?>/public/ispezioni/aggiungiIspezioneNavigazione?idProgetto=<?php echo $_GET["idProgetto"]; ?>">Aggiungi ispezione navigazione</a>
           
           
     <?php 
          if($data["ispezioniNavigazione"]){
     ?> <br>
         <?php
          foreach($data["ispezioniNavigazione"] as $ispezione){
         ?>
          <div class="col-xs-12 col-lg-4 card-anomalia" >
            <div class="card">
              <div class="card-header">
                <h3><span class="period"><?php echo $ispezione->data; ?></span></h3>
              </div>
              <div class="card-block">
                <h4 class="card-title">
                  <?php echo $ispezione->aree; ?>
                </h4>
                <ul class="list-group">
                  <li class="list-group-item">Luogo: <?php echo $ispezione->luogo; ?> </li>
                  <li class="list-group-item">Operatori:  <?php echo $ispezione->operatori; ?></li>
                  <li class="list-group-item">Anomalie:  <?php echo $ispezione->risultato ? "presenti" :  "assenti"; ?></li> 
                  <li class="list-group-item">Dettagli:  <?php echo $ispezione->dettagli; ?></li> 
                </ul>
                <a href="<?php echo URLROOT ?>/anomalie/anomalieIspezioneNavigazione?idIspezione=<?php echo $ispezione->idIspezioneNavigazione; ?>" class="btn">DETTAGLI</a>
              </div>
            </div>
          </div>
         <?php
          }
         ?>


     <?php 
          }
     ?>
        </div>


      </div>

    </section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>  

