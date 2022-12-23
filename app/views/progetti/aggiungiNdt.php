<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci <b>nuova</b> NDT procedure</h3>
      <form action="<?php echo URLROOT ?>/progetti/aggiungiNdt?idProgetto=<?php echo $_GET["idProgetto"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- Procedure input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="sonda"><b>NDT Procedure</b></label>
            <input type="file" id="procedure" name="ndt" class="form-control"   required/>
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