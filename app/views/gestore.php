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

               <h4 id="tipi">Tipi di Anomalie</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/anomalie/aggiungiTipoAnomalia?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["tipiAnomalie"] as $tipo){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $tipo->anomalia;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/anomalie/eliminaTipoAnomalia?id=<?php echo $tipo->idTipoAnomalia;?>">elimina</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               <h4 id="sonde">Sonde</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/sonde/aggiungiSonda?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["sonde"] as $sonda){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $sonda->sonda;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/sonde/eliminaSonda?id=<?php echo $sonda->idSonda;?>">elimina</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               <h4 id="reticoli">Reticoli</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/reticoli/aggiungiReticolo?idProgetto=23">AGGIUNGI</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["reticoli"] as $reticolo){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $reticolo->nome;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/reticoli/eliminaReticolo?id=<?php echo $reticolo->idReticolo;?>">elimina</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br> 
               
               <h4 id="strumenti">Strumenti</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/strumenti/aggiungiStrumento">AGGIUNGI</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["strumenti"] as $strumento){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $strumento->strumento;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/strumenti/eliminaStrumento?id=<?php echo $strumento->idStrumento;?>">elimina</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               </div>
            </div>
         </div>
      </div>
   </section>

<!-- POPUP di errore-->
<div class="modal" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attenzione</h5>
      </div>
      <div class="modal-body">
        <p>
         <?php 
            if(isset($_GET["errore"])){
               if($_GET["errore"]="tipi"){
                  echo "Non è possibile eliminare questo tipo di anomalia perchè utilizzata in alcune anomalie!";
               }else if($_GET["errore"]=="sonde"){ 
                  echo "Non è possibile eliminare questa sonda perchè utilizzata in alcune ispezioni!";
               }else if($_GET["errore"]=="reticoli"){
                  echo "Non è possibile eliminare questo reticolo  perchè utilizzata in alcune ispezioni!";
               }
            }
         ?>
        </p>
      </div>
      <div class="modal-footer">
         <a href="<?php echo URLROOT; ?>/pages/gestore<?php 
            if(isset($_GET["errore"])){
               if($_GET["errore"]="tipi"){
                  echo "#tipi";
               }else if($_GET["errore"]=="sonde"){ 
                  echo "#sonde";
               }else if($_GET["errore"]=="reticoli"){
                  echo "#reticoli";
               }
            }
         ?>"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button> </a>
      </div>
    </div>
  </div>
</div>

<!-- Mostra popUp solo se presente errore -->
 <?php 
   if(isset($_GET["errore"])){
?>
 <script>
   var myModal = new bootstrap.Modal(document.getElementById("modal"), {});
   document.onreadystatechange = function () {
      myModal.show();
   };
   </script>
<?php }?>
<?php
   require APPROOT . '/views/includes/footer.php';
?>