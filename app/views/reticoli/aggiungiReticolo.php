<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci un <b>nuovo</b> reticolo</h3>
      <form action="<?php echo URLROOT ?>/reticoli/aggiungiReticolo?idProgetto=<?php echo $_GET["idProgetto"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- reticolo input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="reticolo"><b>Nome Reticolo</b></label>
            <input type="text" id="reticolo" name="reticolo" class="form-control" required/>
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