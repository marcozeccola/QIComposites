<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="d-flex justify-content-center">
     <div class="row text-center nuovoProgetto ">
          <h3>Inserisci dati per una nuova ispezione</h3>
          <form action="<?php echo URLROOT ?>/ispezioni/aggiungiIspezioneNavigazione?idProgetto=<?php echo $_GET["idProgetto"]; ?>"
               method="POST" enctype="multipart/form-data">


               <div class="form-outline mb-4">
                    <input type="date" id="data" name="data" class="form-control" required />
                    <label class="form-label" for="data">Data dell'ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="luogo" name="luogo" class="form-control" required />
                    <label class="form-label" for="luogo">Luogo dell'ispezione</label>
               </div>
               
               <div class="form-outline mb-4">
                    <input type="text" id="cliente" name="cliente" class="form-control" required />
                    <label class="form-label" for="cliente">Cliente</label>
               </div>
               
               <div class="form-outline mb-4">
                    <label class="form-label" for="risultato">
                         Presenza anomalie
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" name="risultato" id="risultato">
               </div>

               <div class="form-outline mb-4">
                  <select class="form-select" required  name="operatore">
                    <?php 
                         foreach($data["operatori"] as $operatore){
                    ?> 
                         <option  value="<?php echo $operatore->idOperatore?>"><?php echo $operatore->Nome?> <?php echo $operatore->Cognome?></option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="operatore">Operatore</label>
                </div> 

               <div class="form-outline mb-4">
                  <select class="form-select" required  name="area">
                    <?php 
                         foreach($data["aree"] as $area){
                    ?> 
                         <option  value="<?php echo $area->idAreaRiferimento?>"><?php echo $area->area;?>  </option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="area">Area di riferimento</label>
                </div> 


               <div class="form-outline mb-4">
                    <textarea type="" id="dettagli" name="dettagli" class="form-control" required ></textarea>
                    <label class="form-label" for="dettagli">Dettagli</label>
               </div>
 
               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Aggiungi
               </button>
          </form>
     </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>