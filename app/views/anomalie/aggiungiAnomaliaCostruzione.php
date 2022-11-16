<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="text-center" style="width: 70%; margin: auto">
     <h3>Inserisci <b>dati</b> per una <b>nuova</b> <b>anomalia</b> in <b>costruzione</b></h3>
</div>
<div class="d-flex flex-column card shadow-lg p-3 mb-5 bg-white rounded"
     style="margin: auto; margin-top: 5%; width: 90%">
     <div class="text-left" style="padding: 5%">
          <form action="<?php echo URLROOT ?>/anomalie/aggiungiAnomaliaCostruzione?idIspezione=<?php echo $_GET["idIspezione"]; ?>"
               method="POST" enctype="multipart/form-data">

               <div class="form-outline p-2">
                    <label class="form-label" for="localizzazione"><b>Localizzazione</b></label>
                    <input type="text" id="localizzazione" name="localizzazione" class="form-control"  />
               </div>

               <div class="form-outline p-2">
                    <label class="form-label" for="estensione"><b>Estensione</b></label>
                    <input type="text" id="estensione" name="estensione" class="form-control"  />
               </div> 

               <div class="form-outline p-2">
                    <label class="form-label" for="profondita"><b>Profondità</b></label>
                    <input type="text" id="profondita" name="profondita" class="form-control"  />
               </div> 

               
               <label class="form-label" for="aggiungiTipo"><b>Aggiungi ora tipo anomalia</b></label>
               <div class="form-check form-switch"> 
                    <input class="form-check-input" type="checkbox" value="yes" role="switch" name="aggiungiTipo" id="aggiungiTipo" style="margin-left:50%!important;">
               </div>

               <div class="form-outline p-2" id="container-aggiungi">
                    <label class="form-label" for="tipoAnomalieInput"><b>Tipo anomalia</b></label>
                    <input type="text" id="tipoAnomalieInput" name="tipoAnomalieInput" class="form-control"  />
               </div> 

               <div class="form-outline p-2" id="container-select">
                  <label class="form-label" for="tipo"><b>Tipo anomalia</b></label>
                  <select class="form-select"   name="tipo">
                    <?php 
                         foreach($data["tipiAnomalie"] as $tipo){
                    ?> 
                         <option  value="<?php echo $tipo->anomalia?>"><?php echo $tipo->anomalia?></option>
                    <?php 
                         }
                    ?>
                  </select>
               </div>  

               <div class="form-outline p-2">
                  <label class="form-label" for="immagini"><b>Immagini</b></label>
                  <input type="file" id="immagini" name="immagini[]" class="form-control" accept="image/*"  multiple="multiple"  />
               </div><br>
     </div>
     <button type="submit" name="continua" class="btn btn-primary btn-block p-2" style="50%; margin: auto">
          Aggiungi altre anomalie
     </button>
     <br>
     <button type="submit" class="btn btn-primary btn-block p-2" style="50%; margin: auto">
          Salva e chiudi
     </button>
          </form>
</div>

<script src="<?php echo URLROOT ?>/public/assets/js/switchTipiAnomalie.js"></script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>