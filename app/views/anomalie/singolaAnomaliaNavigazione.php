<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="pricing" class="pricing section-bg ">
     <div class="container" >
          <header class="section-header">
               <h3>Dettagli tecnici anomalia in navigazione</h3> 
          </header>

          <a href="<?php echo URLROOT; ?>/anomalie/modificaAnomaliaNavigazione?idAnomalia=<?php echo $data["anomalia"]->idAnomaliaNavigazione; ?>">modifica</a>


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
                         <th scope="row">Tipi anomalie</th>
                         <td><?php echo $data["anomalia"]->anomalia; ?></td>
                    </tr>
                    <tr>
                         <th scope="row">Dettagli - causa</th>
                         <td><?php echo $data["anomalia"]->causa; ?></td>
                    </tr>
               </tbody>
          </table>
 
                    <?php
                         $dir = PUBLICROOT . "/anomalie/navigazione/".$data["anomalia"]->idAnomaliaNavigazione;
                         $anomalia = $data["anomalia"];
                         $files= NULL;

                         if(is_dir($dir)){
                              $files = array_slice(scandir($dir),2);
                         } 

                         if(!empty($files) && !is_null($files)){
                    ?> 
                         <div class="row">
                              <?php 
                                   foreach($files as $file){
                              ?>
                              <div class="col-6">
                              <div class="carousel-item active">
                                   <img src="<?php echo URLROOT ;?>/public/anomalie/navigazione/<?php echo $anomalia->idAnomaliaNavigazione; ;?>/<?php echo $file;?>"
                                        class="d-block w-100">
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
          </div>
     </div>
</section>

<?php    
     require APPROOT . '/views/includes/footer.php'; 
?>