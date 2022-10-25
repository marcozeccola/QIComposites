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
                    <input type="date" id="data" name="data" class="form-control"   />
                    <label class="form-label" for="data">Data dell'ispezione</label>
               </div>
               
               <div class="form-outline mb-4">
                    <input type="date" id="fine" name="fine" class="form-control"   />
                    <label class="form-label" for="fine">Data di fine ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="luogo" name="luogo" class="form-control"   />
                    <label class="form-label" for="luogo">Luogo dell'ispezione</label>
               </div>
               
               <div class="form-outline mb-4">
                    <input type="text" id="cliente" name="cliente" class="form-control"   />
                    <label class="form-label" for="cliente">Cliente</label>
               </div>
               
               <div class="form-outline mb-4">
                    <label class="form-label" for="risultato">
                         Presenza anomalie
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" name="risultato" id="risultato">
               </div>

               <textarea name="operatori" id="operatori" cols="30" rows="10"></textarea>

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

               <label class="form-label" for="aggiungiTipo">Aggiungi area</label>
               <div class="form-check form-switch"> 
                    <input class="form-check-input" type="checkbox" value="yes" role="switch" name="aggiungiArea" id="aggiungiArea" style="margin-left:50%!important;">
               </div>

               <div class="form-outline mb-4" id="container-aggiungi">
                    <input type="text" id="areaInput" name="areaInput" class="form-control"  />
                    <label class="form-label" for="areaInput">Area</label>
               </div> 

               <div class="form-outline mb-4" id="container-select">
                  <select class="form-select"  name="area">
                    <?php 
                         foreach($data["aree"] as $area){
                    ?> 
                         <option value="<?php echo $area->area?>"><?php echo $area->area?></option>
                    <?php
                         }
                    ?>
                  </select>
                  <label class="form-label" for="tipo">Area</label>
               </div>   

               
               <div class="form-outline mb-4">
                    <input type="text" id="reticolo" name="reticolo" class="form-control"   />
                    <label class="form-label" for="reticolo">Reticolo di ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    
                  <select class="form-select" id="selectSonde"  name="sonda">
                    
                    <option  disabled selected >Seleziona  </option>
                    <?php 
                         foreach($data["sonde"] as $sonda){
                    ?> 
                         <option  value="<?php echo $sonda->idSonda;?>"><?php echo $sonda->sonda;?>  </option>
                    <?php 
                         }
                    ?>
                  </select>
                  <label class="form-label" for="area">Sonda</label>
               </div> 
               
               <div class="form-outline mb-4">
                    <textarea type="" id="dettagli" name="dettagli" class="form-control"   ></textarea>
                    <label class="form-label" for="dettagli">Dettagli</label>
               </div>
 
               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Aggiungi
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
     
     document.getElementById("aggiungiArea").addEventListener("change", (e) => {
          console.log(e.target.aggiungi);
          let aggiungi = document.getElementById("container-aggiungi");
          let selectAggiungi = document.getElementById("container-select");
          if (e.target.checked) {
               aggiungi.style.display = "block";
               selectAggiungi.style.display = "none";
          } else {
               aggiungi.style.display = "none";
               selectAggiungi.style.display = "block";
          }    
     });
</script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>