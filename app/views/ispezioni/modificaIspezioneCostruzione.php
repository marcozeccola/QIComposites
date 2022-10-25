<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="d-flex justify-content-center">
     <div class="row text-center nuovoProgetto ">
          <h3>Inserisci dati per una nuova ispezione</h3>
          <form action="<?php echo URLROOT ?>/ispezioni/modificaIspezioneCostruzione"
               method="POST" enctype="multipart/form-data"> 

               <input type="hidden" name="idIspezione" value="<?php echo $data["ispezione"]->idIspezioneCostruzione ?>">

               <div class="form-outline mb-4">
                    <input type="date" id="data" name="data" class="form-control"  value="<?php echo $data["ispezione"]->data ?>" />
                    <label class="form-label" for="data">Data dell'ispezione</label>
               </div>
               
               <div class="form-outline mb-4">
                    <input type="date" id="fine" name="fine" class="form-control" value="<?php echo $data["ispezione"]->fine ?>"  />
                    <label class="form-label" for="fine">Data di fine ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="luogo" name="luogo" class="form-control" value="<?php echo $data["ispezione"]->luogo ?>"  />
                    <label class="form-label" for="luogo">Luogo dell'ispezione</label>
               </div>
               
               <div class="form-outline mb-4">
                    <input type="text" id="cliente" name="cliente" class="form-control" value="<?php echo $data["ispezione"]->cliente ?>"  />
                    <label class="form-label" for="cliente">Cliente</label>
               </div> 

               <textarea name="operatori" id="operatori" cols="30" rows="10"  ><?php echo $data["ispezione"]->operatori ?></textarea>

               <div class="form-outline mb-4">
                  <select class="form-select" id="selectOpertatori" name="operatore">
                    <option  disabled selected >Seleziona  </option>
                    <?php 
                         foreach($data["operatori"] as $operatore){
                              $nomeCompletoOperatore =  $operatore->Nome . " " . $operatore->Cognome;
                    ?> 
                         <option value="<?php echo $nomeCompletoOperatore;?>"><?php echo $nomeCompletoOperatore; ?></option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="operatore">Operatore</label>
                </div> 

               <textarea name="aree" id="aree" cols="30" rows="10"  ><?php echo $data["ispezione"]->aree ?></textarea>

               <div class="form-outline mb-4">
                    
                  <select class="form-select" id="selectAree"  name="area">
                    
                    <?php 
                         foreach($data["aree"] as $area){
                    ?> 
                         <option  value="<?php echo $area->area;?>"><?php echo $area->area;?>  </option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="area">Area di riferimento</label>
               </div>   

               <div class="form-outline mb-4">
                    <textarea name="reticoli" id="reticoli" cols="30" rows="10" > <?php echo $data["ispezione"]->reticoli; ?> </textarea>

                    <select class="form-select" id="selectReticoli" name="reticolo">

                         <option disabled selected>Seleziona </option>
                         <?php 
                         foreach($data["reticoli"] as $reticolo){
                    ?>
                         <option value="<?php echo $reticolo->nome;?>"><?php echo $reticolo->nome;?> </option>
                         <?php 
                         }
                    ?>
                    </select>
                    <label class="form-label" for="area">Reticolo</label>
               </div>

               <div class="form-outline mb-4">
                    <textarea name="sonde" id="sonde" cols="30" rows="10" ><?php echo $data["ispezione"]->sonde; ?></textarea>

                    <select class="form-select" id="selectSonde" name="sonda">

                         <option disabled selected>Seleziona </option>
                         <?php 
                         foreach($data["sonde"] as $sonda){
                    ?>
                         <option value="<?php echo $sonda->sonda;?>"><?php echo $sonda->sonda;?> </option>
                         <?php 
                         }
                    ?>
                    </select>
                    <label class="form-label" for="area">Sonda</label>
               </div>

               <br>
               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Modifica
               </button>
          </form>
     </div>
</div>

<script>
     document.getElementById("selectOpertatori").addEventListener("change", (e)=>{
          let nomeOperatore = e.target.value;
          let inputOperatori = document.getElementById("operatori");
          let spazio = inputOperatori.value == "" ? " ": ", ";
          inputOperatori.value+= spazio + nomeOperatore;
     });
 

     document.getElementById("selectSonde").addEventListener("change", (e) => {
          let nomeSonda = e.target.value;
          let textarea = document.getElementById("sonde");
          let spazio = textarea.value == "" ? " " : ", ";
          textarea.value += spazio + nomeSonda;
     });

     document.getElementById("selectReticoli").addEventListener("change", (e) => {
          let nomeReticolo = e.target.value;
          let textarea = document.getElementById("reticoli");
          let spazio = textarea.value == "" ? " " : ", ";
          textarea.value += spazio + nomeReticolo;
     });

     document.getElementById("selectAree").addEventListener("change", (e)=>{
          let nomeArea = e.target.value;
          let inputAree = document.getElementById("aree");
          let spazio = inputAree.value == "" ? " ": ", ";
          inputAree.value+= spazio + nomeArea;
     });
</script>

<?php
   require APPROOT . '/views/includes/footer.php';
?>