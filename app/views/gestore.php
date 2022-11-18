<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';
?>

<section id="portfolio" class="portfolio section-bg">
      <div class="container" >
         <header class="section-header text-center">
         <h3 class="section-title">Gestore Caratteristiche</h3>
         <p>Caratteristiche generali dei progetti</p>
         </header>
         <div class="text-center">
               <h4>Tipi di Anomalie</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/anomalie/aggiungiTipoAnomalia?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                     <tbody>
                        <tr>
                           <td>         
                           </td>
                        </tr>
                     </tbody>
               </table><br>
               <h4>Sonde</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/sonde/aggiungiSonda?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                     <tbody>
                        <tr>
                           <td>
                                                
                           </td>
                        </tr>
                     </tbody>
               </table><br>
               <h4>Reticoli</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/reticoli/aggiungiReticolo?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                     <tbody>
                        <tr>
                           <td>
                                                
                           </td>
                        </tr>
                     </tbody>
               </table><br>
               </div>
            </div>
         </div>
      </div>
   </section>

 
<?php
   require APPROOT . '/views/includes/footer.php';
?>