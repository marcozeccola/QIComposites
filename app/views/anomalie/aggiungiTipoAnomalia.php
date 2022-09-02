<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci nuovo tipo di anomalia</h3>
      <form action="<?php echo URLROOT ?>/anomalie/aggiungiTipoAnomalia?idProgetto=<?php echo $_GET["idProgetto"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- anomalie input -->
         <div class="form-outline mb-4">
            <input type="text" id="anomalia" name="anomalia" class="form-control" required/>
            <label class="form-label" for="anomalia">Anomalia</label>
         </div>

         <!-- Submit button -->
         <button type="submit" class="btn btn-primary btn-block mb-4">
         Aggiungi
         </button> 
      </form>
   </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>