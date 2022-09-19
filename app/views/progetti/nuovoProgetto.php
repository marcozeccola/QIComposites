<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center">
   <div class="row text-center nuovoProgetto ">
      <h3>Inserisci dati per un nuovo progetto</h3>
      <form action="<?php echo URLROOT ?>/progetti/nuovoProgetto" method="POST" enctype="multipart/form-data"> 
         <!-- nome del progetto input -->
         <div class="form-outline mb-4">
            <input type="text" id="nome" name="nome" class="form-control" required/>
            <label class="form-label" for="nome">Nome del progetto</label>
            <small class="text-danger"><?php echo $data["errorNome"]; ?></small>
         </div>

         <!-- data di inizio input -->
         <div class="form-outline mb-4">
            <input type="date" id="inizio" name="inizio" class="form-control" required />
            <label class="form-label" for="inizio">Data di inizio</label>
            <small class="text-danger"><?php echo $data["errorInizio"]; ?></small>
         </div> 

         <!-- nome del progettista input -->
         <div class="form-outline mb-4">
            <input type="text" id="progettista" name="progettista" class="form-control"   />
            <label class="form-label" for="progettista">Nome del progettista</label>
            <small class="text-danger"><?php echo $data["errorProgettista"]; ?></small>
         </div> 

         <!-- immagine copertina input -->
         <div class="form-outline mb-4">
            <input type="file" id="copertina" name="copertina" class="form-control" accept="image/*" required />
            <label class="form-label" for="copertina">Immagine copertina</label> 
         </div>  
         
         <!-- disegni input -->
         <div class="form-outline mb-4">
            <input type="file" id="disegni" name="disegni" class="form-control" accept="application/pdf" />
            <label class="form-label" for="disegni">Disegni</label> 
         </div> 
         
         <!-- ndt input -->
         <div class="form-outline mb-4">
            <input type="file" id="ndt" name="ndt" class="form-control" accept="application/pdf" />
            <label class="form-label" for="ndt">NDT Procedures</label> 
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