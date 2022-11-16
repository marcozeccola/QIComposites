<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci <b>nuova sotto-area</b></h3>
      <form action="<?php echo URLROOT ?>/aree/aggiungiSottoArea?idArea=<?php echo $_GET["idArea"]; ?>" method="POST" enctype="multipart/form-data"> 

         <!-- sotto area input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="area"><b>Sotto-area</b></label>
            <input type="text" id="sottoAreaInput" name="sottoAreaInput" class="form-control" required/>
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