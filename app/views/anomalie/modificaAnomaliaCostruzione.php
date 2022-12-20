<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>

<div class="text-center" style="width: 70%; margin: auto">
     <h3>Inserisci <b>dati</b> per <b>modificare</b> l'<b>anomalia</b> in <b>costruzione</b></h3>
</div>
<div class="d-flex flex-column card shadow-lg p-3 mb-5 bg-white rounded"
     style="margin: auto; margin-top: 5%; width: 90%">
     <div class="text-left" style="padding: 5%">
          <form action="<?php echo URLROOT ?>/anomalie/modificaAnomaliaCostruzione"
               method="POST" enctype="multipart/form-data">

               <input type="hidden" name="idAnomalia" value="<?php echo $data["anomalia"]->idAnomaliaCostruzione; ?>">
               
               <div class="form-outline p-2">
                    <label class="form-label" for="localizzazione"><b>Localizzazione</b></label>
                    <input type="text" id="localizzazione" name="localizzazione" class="form-control" value="<?php echo $data["anomalia"]->localizzazione; ?>" />
               </div>

               <div class="form-outline p-2">
                    <label class="form-label" for="estensione"><b>Estensione</b></label>
                    <input type="text" id="estensione" name="estensione" class="form-control" value="<?php echo $data["anomalia"]->estensione; ?>" />
               </div> 

               <div class="form-outline p-2">
                    <label class="form-label" for="profondita"><b>Profondità</b></label>
                    <input type="text" id="profondita" name="profondita" class="form-control" value="<?php echo $data["anomalia"]->profondita; ?>" />
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
                  <select class="form-select"  name="tipo">
                         <option value="no" selected>Non volgio modificare</option>
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
               </div>

               
               <div class="form-outline p-2">
                    <label class="form-label" for="commenti"><b>Commenti</b></label>
                    <textarea name="commenti" id="commenti" class="form-control"  ><?php echo $data["anomalia"]->commenti;?></textarea>
               </div> 

               <?php
                    if(isset($data["anomalia"]->riparazione) && $data["anomalia"]->riparazione != "no"){
               ?>
               <div class="form-outline p-2">
                    <label class="form-label" for="riparazione"><b>Commenti sulla risoluzione dell'anomalia</b></label>
                    <textarea name="riparazione" id="riparazione" class="form-control"  ><?php echo $data["anomalia"]->riparazione;?></textarea>
               </div> 
               <?php
                    }
               ?>

               </div>
               <button type="submit" style="width: 50%; margin: auto" class="btn btn-primary btn-block p-2">
                    Salva e chiudi
               </button>
          </form>
</div>

<script src="<?php echo URLROOT ?>/public/assets/js/switchTipiAnomalie.js"></script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>