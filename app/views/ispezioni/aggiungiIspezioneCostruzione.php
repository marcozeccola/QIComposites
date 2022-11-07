<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<div class="d-flex justify-content-center">
     <div class="row text-center nuovoProgetto ">
          <h3>Inserisci dati per una nuova ispezione</h3>
          <form action="<?php echo URLROOT ?>/ispezioni/aggiungiIspezioneCostruzione?idProgetto=<?php echo $_GET["idProgetto"]; ?>"
               method="POST" enctype="multipart/form-data">


               <div class="form-outline mb-4">
                    <input type="date" id="data" name="data" class="form-control" />
                    <label class="form-label" for="data">Data inizio dell'ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="date" id="fine" name="fine" class="form-control" />
                    <label class="form-label" for="fine">Data di fine ispezione</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="luogo" name="luogo" class="form-control" />
                    <label class="form-label" for="luogo">Luogo dell'ispezione</label>
               </div>


               <div class="form-outline mb-4">
                    <input type="text" id="cliente" name="cliente" class="form-control" />
                    <label class="form-label" for="cliente">Cliente</label>
               </div>

               <div class="form-outline mb-4">
                    <input type="text" id="stato" name="stato" class="form-control" />
                    <label class="form-label" for="stato">Stato di avanzamento</label>
               </div>

               <!-- input Operatori --> 
               <div class="form-outline mb-4"> 
                    <textarea name="operatori" id="operatori" cols="30" rows="10"></textarea>
                    <select class="form-select" id="selectOpertatori" name="operatore">
                         <option disabled selected>Seleziona </option>
                         <?php 
                         foreach($data["operatori"] as $operatore){
                              $nomeCompletoOperatore =  $operatore->Nome . " " . $operatore->Cognome;
                    ?>
                         <option value="<?php echo $nomeCompletoOperatore;?>"><?php echo $nomeCompletoOperatore; ?>
                         </option>
                         <?php 
                         }
                    ?>
                    </select>
                    <label class="form-label" for="operatore">Operatore</label>
               </div> 

               <!-- input reticoli --> 
               <div class="form-outline mb-4">
                    <textarea name="reticoli" id="reticoli" cols="30" rows="10"></textarea>

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

               <!-- input sonde --> 
               <div class="form-outline mb-4">
                    <textarea name="sonde" id="sonde" cols="30" rows="10"></textarea>

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


               <div class="form-outline mb-4"  >
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
                    <label class="form-label" for="tipo">Macro area</label>
               </div>

               
               <label class="form-label" for="aggiungiTipo">Aggiungi area</label>
               <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="yes" role="switch" name="aggiungiArea"
                         id="aggiungiArea" style="margin-left:50%!important;">
               </div>

               <div class="form-outline mb-4" id="container-aggiungi">
                    <input type="text" id="sottoAreaInput" name="sottoAreaInput" class="form-control" />
                    <label class="form-label" for="sottoAreaInput">Nuova sotto area</label>
               </div> 

               <div class="form-outline mb-4" id="container-select">
                    <select class="form-select" name="sottoArea" id="selectSottoArea"> 
                    </select>
                    <label class="form-label" for="tipo">Sotto area</label>
               </div>
               <div class="form-outline mb-4">
                    <input type="text" id="nomeArea" name="nomeArea" class="form-control" />
                    <label class="form-label" for="nomeArea">Nome proprio area</label>
               </div>

               <button type="submit" class="btn btn-primary btn-block mb-4">
                    Aggiungi
               </button>
          </form>
     </div>
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
     let lista =   
               <?php 
               echo "{";
                    foreach($data["sottoAree"] as $area){
                         echo "'$area->nome':['$area->fk_idAreaRiferimento','$area->idSottoArea'],";
                    }
                    
               echo "}";
               ?> 
     ;  
     let idAreaRiferimento =  e.target.value;

     //pulisce la select
     select.innerHTML= "";

     //inserisce le option con value l'id della sottoarea di riferimento
     Object.entries(lista).forEach(([key, value]) => { 
          if(value[0]==idAreaRiferimento){
               select.add(new Option(key, value[1]))
          }
     });      
     
}); 
</script>

<?php
   require APPROOT . '/views/includes/footer.php';
?>