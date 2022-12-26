<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci <b>nuova immagine</b></h3>
      <form action="<?php echo URLROOT ?>/anomalie/aggiungiImmagineAnomaliaCostruzione?idAnomalia=<?php echo $_GET["idAnomalia"]; ?>" method="POST" enctype="multipart/form-data"> 

          <input type="hidden" name="idAnomalia" value="<?php echo $_GET["idAnomalia"]; ?>">
 
         <div class="form-outline mb-4">
            <label class="form-label" for="immagini"><b>Immagine</b></label>
            <input type="file" id="immagini" name="immagini[]" class="form-control" accept="image/*"  required/>
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