<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci nuovo Disegno</h3>
      <form action="<?php echo URLROOT ?>/progetti/aggiungiDisegno?idProgetto=<?php echo $_GET["idProgetto"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- disegno input -->
         <div class="form-outline mb-4">
            <input type="file" id="disegno" name="disegni" class="form-control"  accept="application/pdf" required/>
            <label class="form-label" for="sonda">Disegno</label>
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