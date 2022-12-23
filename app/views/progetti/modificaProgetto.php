<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center nuovoProgetto">
      <h3>Modifica <b>progetto</b> </h3>
      <form action="<?php echo URLROOT ?>/progetti/modificaProgetto" method="POST" enctype="multipart/form-data"> 

          <input type="hidden" name="idProgetto" value="<?php echo $_GET["idProgetto"]; ?>"> 
           
          <!-- nome del progetto input -->
            <div class="p-2">
               <label class="form-label" for="nome" style="font-weight: bold">Nome del progetto</label>
               <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $data["progetto"]->nome; ?>"/> 
            </div>

            <!-- data di inizio input -->
            <div class="p-2">
               <label class="form-label" for="inizio" style="font-weight: bold">Data di inizio</label>
               <input type="date" id="inizio" name="inizio" class="form-control" value="<?php echo $data["progetto"]->inizio; ?>" /> 
            </div> 

            <!-- nome del progettista input -->
            <div class="p-2">
               <label class="form-label" for="progettista" style="font-weight: bold">Nome del progettista</label>
               <input type="text" id="progettista" name="progettista" class="form-control" value="<?php echo $data["progetto"]->progettista; ?>"  /> 
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