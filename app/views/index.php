<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';
?>
<br><br><br>


<select class="form-select" id="ispezioneSelect" style="width:50%!important; margin-left:20%!important;">
<option disabled selected>Scegli ispezione</option>
<?php

foreach($data["ispezioni"] as $ispezione){ 

   $link = $ispezione->idIspezioneCostruzione ;
   ?>
   
   <option value="<?php echo $link;?>"> <?php echo $ispezione->macroArea. ", ". $ispezione->sottoArea ; ?>  - <?php echo $ispezione->luogo; ?> </option>

   <?php

}  

?>
</select> <br>
<button type="button" class="btn btn-primary" id="submitIspezione" style=" margin-left:20%!important;" >APRI</button>
<br>
<button type="button" class="btn btn-primary" id="aggiungiAnomalia" style=" margin-left:20%!important; margin-top:5px!important;" >AGGIUNGI ANOMALIA</button>

<br><br>

<select class="form-select" id="progettoSelect" style="width:50%!important; margin-left:20%!important;">
<option disabled selected>Scegli progetto</option>
<?php

foreach($data["progetti"] as $progetto){ 

   $idProgetto = $progetto->idProgetto ;
   ?>
   
   <option value="<?php echo $idProgetto;?>"> <?php echo $progetto->nome; ?> </option>

   <?php

}  

?>
</select> <br>
<button type="button" class="btn btn-primary" id="submitProgetto" style=" margin-left:20%!important;" >APRI</button>
<br>
 <button type="button" class="btn btn-primary" id="creaIspezioneCostruzione" style="margin-left:20%!important; margin-top:5px!important;" >CREA ISPEZIONE COSTRUZIONE</button>

<br><br><br>
<script>
   document.getElementById("submitIspezione").addEventListener("click", (e)=>{
      let optionValue = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/anomalie/anomalieIspezioneCostruzione?idIspezione=" + optionValue;
      window.location = link;
   });
   
   document.getElementById("aggiungiAnomalia").addEventListener("click", (e)=>{
      let idIspezione = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/anomalie/aggiungiAnomaliaCostruzione?idIspezione=" + idIspezione;
      window.location = link;
   });

   document.getElementById("submitProgetto").addEventListener("click", (e)=>{
      let idProgetto = document.getElementById('progettoSelect').value;
      let link = "<?php echo URLROOT; ?>/progetti/progetto?id=" + idProgetto;
      window.location = link;
   });
    

   document.getElementById("creaIspezioneCostruzione").addEventListener("click", (e)=>{
      let idProgetto = document.getElementById('progettoSelect').value;
      let link = "<?php echo URLROOT; ?>/ispezioni/aggiungiIspezioneCostruzione?idProgetto=" + idProgetto;
      window.location = link;
   });
</script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>