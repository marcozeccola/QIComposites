<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center nuovoProgetto">
      <h3>Modifica una <b>macro</b> area</h3>
      <form action="<?php echo URLROOT ?>/aree/modificaArea?idProgetto=<?php echo  $data["area"]->fk_idProgetto;?>" method="POST" enctype="multipart/form-data"> 

          <input type="hidden" name="idArea" value="<?php echo $_GET["idArea"]; ?>"> 
         <!-- area input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="area"><b>Nome Area</b></label>
            <input type="text" id="area" name="area" class="form-control" value="<?php echo $data["area"]->area; ?>" required/>
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