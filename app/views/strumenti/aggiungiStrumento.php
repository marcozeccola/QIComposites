<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci un <b>nuovo</b> strumento</h3>
      <form action="<?php echo URLROOT ?>/strumenti/aggiungiStrumento" method="POST" enctype="multipart/form-data"> 

         <!-- strumento input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="strumento"><b>Nome strumento</b></label>
            <input type="text" id="strumento" name="strumento" class="form-control" required/>
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