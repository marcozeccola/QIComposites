<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci commento sulla risoluzione</h3>
      <?php
          $query="";
          if(isset($_GET["idProgetto"])){
               $query = "idProgetto=".$_GET["idProgetto"]."&";
          }
          if(isset($_GET["idIspezione"])){
               $query = $query."idIspezione=".$_GET["idIspezione"]."&";
          }
          
          if(!isset($_GET["idProgetto"]) && !isset($_GET["idIspezione"])){
               $query = $query."idAnomalia=".$_GET["idAnomalia"];
          }
      ?>
      <form action="<?php echo URLROOT ?>/anomalie/risoltoCostruzione?<?php echo  $query; ?>" method="POST" enctype="multipart/form-data"> 

          <input type="hidden" name="idAnomalia" value="<?php echo $_GET["idAnomalia"]; ?>">
          
          <div class="form-outline mb-4">
            <label class="form-label" for="commento"><b>Commento</b></label>
            <textarea type="text" id="commento" name="commento" class="form-control" required/></textarea>
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