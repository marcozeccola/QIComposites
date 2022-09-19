<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="d-flex justify-content-center">
     <div class="row text-center nuovoProgetto ">
          <h3>Inserisci dati per una modificare l'anomalia in navigazione</h3>
          <form action="<?php echo URLROOT ?>/anomalie/modificaAnomaliaNavigazione"
               method="POST" enctype="multipart/form-data">

               <input type="hidden" name="idAnomalia" value="<?php echo $data["anomalia"]->idAnomaliaNavigazione; ?>">
               
               <div class="form-outline mb-4">
                    <input type="text" id="localizzazione" name="localizzazione" class="form-control" value="<?php echo $data["anomalia"]->localizzazione; ?>" />
                    <label class="form-label" for="localizzazione">Localizzazione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="estensione" name="estensione" class="form-control" value="<?php echo $data["anomalia"]->estensione; ?>" />
                    <label class="form-label" for="estensione">Estensione</label>
               </div> 

               <div class="form-outline mb-4">
                    <input type="text" id="profondita" name="profondita" class="form-control" value="<?php echo $data["anomalia"]->profondita; ?>" />
                    <label class="form-label" for="profondita">Profondità</label>
               </div> 

               
               <label class="form-label" for="aggiungiTipo">Aggiungi ora tipo anomalia</label>
               <div class="form-check form-switch"> 
                    <input class="form-check-input" type="checkbox" value="yes" role="switch" name="aggiungiTipo" id="aggiungiTipo" style="margin-left:50%!important;">
               </div>

               <div class="form-outline mb-4" id="container-aggiungi">
                    <input type="text" id="tipoAnomalieInput" name="tipoAnomalieInput" class="form-control"  />
                    <label class="form-label" for="tipoAnomalieInput">Tipo anomalia</label>
               </div> 

               <div class="form-outline mb-4" id="container-select">
                  <select class="form-select"   name="tipo">
                    <option value="no" selected>Lascia invariato</option>
                    <?php 
                         foreach($data["tipiAnomalie"] as $tipo){
                    ?> 
                         <option  value="<?php echo $tipo->idTipoAnomalia?>"><?php echo $tipo->anomalia?></option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="tipo">Tipo anomalia</label>
               </div>  

               <div class="form-outline mb-4">
                  <input type="file" id="immagini" name="immagini[]" class="form-control" accept="image/*"  multiple="multiple"  />
                  <label class="form-label" for="immagini">Immagini</label>
               </div>   
               
               <div class="form-outline mb-4">
                    <textarea id="causa" name="causa" class="form-control"   > </textarea>
                    <label class="form-label" for="causa">Commenti</label>
               </div> 

               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Salva e chiudi
               </button>
          </form>
     </div>
</div>

<script src="<?php echo URLROOT ?>/public/assets/js/switchTipiAnomalie.js"></script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>