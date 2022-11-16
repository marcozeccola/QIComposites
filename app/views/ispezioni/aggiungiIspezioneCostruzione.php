<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="text-center" style="width: 70%; margin: auto">
     <h3>Inserisci <b>dati</b> per una nuova <b>ispezione</b></h3>
</div>
<div class="d-flex flex-column card shadow-lg p-3 mb-5 bg-white rounded"
     style="margin: auto; margin-top: 5%; width: 90%">
     <div class="text-left" style="padding: 5%">
          <form action="<?php echo URLROOT ?>/ispezioni/aggiungiIspezioneCostruzione?idProgetto=<?php echo $_GET["idProgetto"]; ?>"
               method="POST" enctype="multipart/form-data">
               <div class="p-2">
                    <label class="form-label" for="data" style="font-weight: bold">Data inizio dell'ispezione</label>
                    <input type="date" id="data" name="data" class="form-control" />
               </div>

               <div class="p-2">
                    <label class="form-label" for="fine" style="font-weight: bold">Data di fine ispezione</label>
                    <input type="date" id="fine" name="fine" class="form-control" />
               </div>

               <div class="p-2">
                    <label class="form-label" for="luogo" style="font-weight: bold">Luogo dell'ispezione</label>
                    <input type="text" id="luogo" name="luogo" class="form-control" />
               </div>

               <div class="p-2">
                    <label class="form-label" for="cliente" style="font-weight: bold">Cliente</label>
                    <input type="text" id="cliente" name="cliente" class="form-control" />
               </div>

               <div class="p-2">
                    <label class="form-label" for="stato" style="font-weight: bold">Stato di avanzamento</label>
                    <input type="text" id="stato" name="stato" class="form-control" />
               </div>

               <!-- input Operatori -->
               <div class="p-2">
                    <label class="form-label" for="operatore" style="font-weight: bold">Operatore</label>
                    <select class="form-select" id="selectOpertatori" name="operatore">
                         <option disabled selected>Seleziona</option>
                         <?php 
                         foreach($data["operatori"] as $operatore){
                              $nomeCompletoOperatore =  $operatore->Nome . " " . $operatore->Cognome;
                    ?>
                         <option value="<?php echo $nomeCompletoOperatore;?>"><?php echo $nomeCompletoOperatore; ?>
                         </option>
                         <?php 
                         }
                    ?>
                    </select><br>
                    <label for="operatori">Operatore esterno?</label>
                    <textarea name="operatori" id="operatori" cols="30" rows="1"></textarea>
               </div>

               <!-- input reticoli -->
               <div class="p-2">
                    <label class="form-label" for="area"><b>Reticolo</b></label>
                    <select class="form-select" id="selectReticoli" name="reticolo">

                         <option disabled selected>Seleziona </option>
                         <?php 
                         foreach($data["reticoli"] as $reticolo){
                    ?>
                         <option value="<?php echo $reticolo->nome;?>"><?php echo $reticolo->nome;?> </option>
                         <?php 
                         }
                    ?>
                    </select><br>
                    <label for="reticoli">Reticolo particolare?</label>
                    <textarea name="reticoli" id="reticoli" cols="30" rows="1"></textarea>
               </div>

               <!-- input sonde -->
               <div class="p-2">
                    <label class="form-label" for="area"><b>Sonda</b></label>
                    <select class="form-select" id="selectSonde" name="sonda">

                         <option disabled selected>Seleziona </option>
                         <?php 
                         foreach($data["sonde"] as $sonda){
                    ?>
                         <option value="<?php echo $sonda->sonda;?>"><?php echo $sonda->sonda;?> </option>
                         <?php 
                         }
                    ?>
                    </select><br>
                    <label for="sonde">Sonda particolare?</label>
                    <textarea name="sonde" id="sonde" cols="30" rows="1"></textarea>
               </div>


               <div class="p-2">
                    <label class="form-label" for="tipo"><b>Macro area</b></label>
                    <select class="form-select" name="macroArea" id="selectMacroArea">
                         <option disabled selected>Scegli macro area</option>
                         <?php 
                         foreach($data["macroAree"] as $area){
                    ?>
                         <option value="<?php echo $area->idAreaRiferimento?>"><?php echo $area->area?></option>
                         <?php
                         }
                    ?>
                    </select>
               </div>



               <div class="p-2" id="container-aggiungi">
               </div>

               <div class="p-2" id="container-select">
                    <label class="form-label" for="tipo"><b>Sotto area</b></label>
                    <select class="form-select" name="sottoArea" id="selectSottoArea">
                    </select><br>
                    <label class="form-label" for="sottoAreaInput">Nuova sotto area?</label>
                    <textarea id="sottoAreaInput" name="sottoAreaInput" cols="30" rows="1"></textarea>
               </div>
               <div class="p-2">
                    <label class="form-label" for="nomeArea"><b>Nome proprio area</b></label>
                    <input type="text" id="nomeArea" name="nomeArea" class="form-control" />
               </div>

               <div class="p-2">
                    <label class="form-label" for="immagini"><b>Aggiungi immagini</b></label>
                    <input type="file" id="immagini" name="immagini[]" class="form-control" accept="image/*"
                         multiple="multiple" />
               </div>
     </div>
     <button type="submit" class="btn btn-primary btn-block" style="width: 50%; margin: auto">
          Aggiungii
     </button>
     </form>
</div>

<script>
     document.getElementById("selectOpertatori").addEventListener("change", (e) => {
          let nomeOperatore = e.target.value;
          let inputOperatori = document.getElementById("operatori");
          let spazio = inputOperatori.value == "" ? " " : ", ";
          inputOperatori.value += spazio + nomeOperatore;
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

     document.getElementById("aggiungiArea").addEventListener("change", (e) => {

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

     document.getElementById("selectMacroArea").addEventListener("change", (e) => {
          let select = document.getElementById("selectSottoArea");
          let lista = <
               ? php
          echo "{";
          foreach($data["sottoAree"] as $area) {
               echo "'$area->nome':['$area->fk_idAreaRiferimento','$area->idSottoArea'],";
          }

          echo "}"; ?
          > ;
          let idAreaRiferimento = e.target.value;

          //pulisce la select
          select.innerHTML = "";

          //inserisce le option con value l'id della sottoarea di riferimento
          Object.entries(lista).forEach(([key, value]) => {
               if (value[0] == idAreaRiferimento) {
                    select.add(new Option(key, value[1]))
               }
          });

     });
</script>

<?php
   require APPROOT . '/views/includes/footer.php';
?>