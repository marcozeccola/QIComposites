<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>  

 <section id="portfolio" class="portfolio section-bg">
      <div class="container" >

        <header class="section-header">
          <h3 class="section-title">Progetti</h3>
          <p><a href="<?php echo URLROOT;?>/progetti/nuovoProgetto">Aggiungi progetto</a></p>
        </header>

         

        <div class="row portfolio-container"  >

            <?php 
               foreach($data["progetti"] as $progetto){ 
                  $cartella = PUBLICROOT . "/progetti-docs/copertine/". $progetto->idProgetto."/";
                  $copertina = scandir($cartella)[2]; 
                  $pathCopertina = URLROOT . "/public/progetti-docs/copertine/". $progetto->idProgetto."/".$copertina;
 
            ?>

            <div class="col-lg-4 col-md-6 portfolio-item">
               <div class="portfolio-wrap">
                  <img src="<?php echo $pathCopertina ?>" class="img-fluid" alt="">
                  <div class="portfolio-info">
                     <h4><a href= "<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $progetto->idProgetto; ?>"><?php echo $progetto->nome; ?></a></h4>
                     <p><?php echo $progetto->inizio; ?></p>
                     <p><?php echo $progetto->progettista; ?></p>
                  </div>
                  
               </div>
               <div>
                     <h3><b><a style="colo:black!important;" href= "<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $progetto->idProgetto; ?>"><?php echo $progetto->nome; ?></a></b></h3>
                  </div>
            </div> 

            <?php 
               }
            ?>

        </div>

      </div>
   </section>

 
<?php
   require APPROOT . '/views/includes/footer.php';
?>