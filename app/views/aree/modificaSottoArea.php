<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Modifica <b>nuova sotto-area</b></h3>
      <form action="<?php echo URLROOT ?>/aree/modificaSottoArea?idMacroArea=<?php echo $data["sottoArea"]->fk_idAreaRiferimento; ?>" method="POST" enctype="multipart/form-data"> 
 
          <input type="hidden" name="idSottoArea"  value="<?php echo $data["sottoArea"]->idSottoArea; ?>">

         <!-- sotto area input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="area"><b>Sotto-area</b></label>
            <input type="text" id="sottoAreaInput" name="sottoAreaInput" class="form-control" value="<?php echo $data["sottoArea"]->nome; ?>" required/>
         </div>

         <!-- Submit button -->
         <button type="submit" class="btn btn-primary btn-block mb-4">
         Modifica
         </button>
      </form>
   </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>