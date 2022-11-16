<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?> 
 
<section id="pricing" class="pricing section-bg text-center">

      <div class="container">
        <header class="section-header">
          <h3>Ispezioni</h3>
          <h4>Costruzione</h4>
          <a class="btn btn-primary" style="width: 70%; margin: auto" href="<?php echo URLROOT; ?>/public/ispezioni/aggiungiIspezioneCostruzione?idProgetto=<?php echo $_GET["idProgetto"]; ?>">Aggiungi ispezione costruzione</a>
        </header><br>
        <h4>Ispezioni del progetto <?php echo $data["nomeProgetto"]; ?></h4>
     

        <div class="text-center">
          <?php
          if($data["ispezioniCostruzione"]){
     ?> 
           <br>
        <?php
          foreach($data["ispezioniCostruzione"] as $ispezione){
        ?>
              <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 90%; margin: auto">
                <div class="card-header">
                  <h3><span class="period"><?php echo $ispezione->data; ?></span></h3>
                </div>
                <div class="card-block"> 
                  <ul class="list-group">
                    <li class="list-group-item">Luogo: <?php echo $ispezione->luogo; ?> </li>
                    <li class="list-group-item">Operatori:  <?php echo $ispezione->operatori; ?>  </li> 
                  </ul>
                  <a href="<?php echo URLROOT ?>/anomalie/anomalieIspezioneCostruzione?idIspezione=<?php echo $ispezione->idIspezioneCostruzione; ?>" class="btn">DETTAGLI</a>
                </div>
              </div>
            </div>
         <?php
          } 
          }
     ?>
</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>  

