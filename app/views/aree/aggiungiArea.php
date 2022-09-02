<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci nuova area</h3>
      <form action="<?php echo URLROOT ?>/aree/aggiungiArea?idProgetto=<?php echo $_GET["idProgetto"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- area input -->
         <div class="form-outline mb-4">
            <input type="text" id="area" name="area" class="form-control" required/>
            <label class="form-label" for="area">area</label>
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