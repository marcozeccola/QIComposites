<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="d-flex justify-content-center">
     <div class="row text-center nuovoProgetto ">
          <h3>Inserisci dati per una nuova anomalia in navigazione</h3>
          <form action="<?php echo URLROOT ?>/anomalie/aggiungiAnomaliaNavigazione?idIspezione=<?php echo $_GET["idIspezione"]; ?>"
               method="POST" enctype="multipart/form-data">


               <div class="form-outline mb-4">
                    <input type="text" id="localizzazione" name="localizzazione" class="form-control" required />
                    <label class="form-label" for="localizzazione">Localizzazione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="estensione" name="estensione" class="form-control" required />
                    <label class="form-label" for="estensione">Estensione</label>
               </div> 

               <div class="form-outline mb-4">
                    <input type="text" id="profondita" name="profondita" class="form-control" required />
                    <label class="form-label" for="profondita">Profondità</label>
               </div> 
               

               <div class="form-outline mb-4">
                    <textarea id="causa" name="causa" class="form-control" required > </textarea>
                    <label class="form-label" for="causa">Ipotesi causa</label>
               </div> 

               <div class="form-outline mb-4">
                  <select class="form-select" required  name="tipo">
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
 
 
               <button type="submit" name="continua" class="btn btn-primary btn-block mb-4">
                    Aggiungi altre anomalie
               </button>

               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Salva e chiudi
               </button>
          </form>
     </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>