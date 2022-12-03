<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci <b>foto della tua firma</b></h3>
      <form action="<?php echo URLROOT ?>/users/firma" method="POST" enctype="multipart/form-data"> 

         <!-- firma input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="firma"><b>Firma</b></label>
            <input type="file" id="firma" name="firma" class="form-control"  accept="image" required/>
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