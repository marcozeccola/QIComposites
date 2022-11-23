<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>  

 <section id="portfolio" class="portfolio section-bg">
      <div class="container" > 
        <header class="section-header text-center">
          <h3 class="section-title">Progetti</h3>
         <a href="<?php echo URLROOT;?>/progetti/nuovoProgetto">Aggiungi progetto</a>
         <p><a class="btn btn-primary" style="margin-top: 5%" href="<?php echo URLROOT;?>/pages/gestore">Caratteristiche Progetti</a></p>
         </header> 
            <div class="text-center" style="width: 100%; margin: auto">
            <?php  
               if($data["progetti"]){
                  foreach($data["progetti"] as $progetto){ 
                     $cartella = PUBLICROOT . "/progetti-docs/copertine/". $progetto->idProgetto."/";
                     $copertina = scandir($cartella)[2]; 
                     $pathCopertina = URLROOT . "/public/progetti-docs/copertine/". $progetto->idProgetto."/".$copertina;
            ?>
               <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 90%; margin: auto">
                  <div class="card-header">
                     <h3><b><?php echo $progetto->nome; ?></b></h3>
                  </div>
                  <table class="table"> 
                     <tbody>
                        <tr>
                        <th scope="row">Data di Inizio: </th>
                        <td><?php echo $progetto->inizio; ?></td>
                        </tr>
                        <tr>
                        <th scope="row">Progettista: </th>   
                        <td><?php echo $progetto->progettista; ?></td>
                        </tr>
                     </tbody>
               </table><br>
               <a class="btn btn-primary" href= "<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $progetto->idProgetto; ?>">APRI</a>
               </div>
               <?php 
                     }
                  }
               ?>
            </div>
      </div>
   </section>

 
<?php
   require APPROOT . '/views/includes/footer.php';
?>