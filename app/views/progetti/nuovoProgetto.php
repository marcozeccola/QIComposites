<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="text-center" style="width: 70%; margin: auto">
   <h3>Inserisci i <b>dati</b> per un <b>nuovo</b> progetto</h3>
</div>
   <div class="d-flex flex-column card shadow-lg p-3 mb-5 bg-white rounded" style="margin: auto; margin-top: 5%; width: 90%">
      <div class="text-left" style="padding: 5%">
         <form action="<?php echo URLROOT ?>/progetti/nuovoProgetto" method="POST" enctype="multipart/form-data"> 
            <!-- nome del progetto input -->
            <div class="p-2">
               <label class="form-label" for="nome" style="font-weight: bold">Nome del progetto</label>
               <input type="text" id="nome" name="nome" class="form-control" required/>
               <small class="text-danger"><?php echo $data["errorNome"]; ?></small>
            </div>

            <!-- data di inizio input -->
            <div class="p-2">
               <label class="form-label" for="inizio" style="font-weight: bold">Data di inizio</label>
               <input type="date" id="inizio" name="inizio" class="form-control" required />
               <small class="text-danger"><?php echo $data["errorInizio"]; ?></small>
            </div> 

            <!-- nome del progettista input -->
            <div class="p-2">
               <label class="form-label" for="progettista" style="font-weight: bold">Nome del progettista</label>
               <input type="text" id="progettista" name="progettista" class="form-control"   />
               <small class="text-danger"><?php echo $data["errorProgettista"]; ?></small>
            </div> 

            <!-- immagine copertina input -->
            <div class="p-2">
               <label class="form-label" for="copertina" style="font-weight: bold">Immagine copertina</label> 
               <input type="file" id="copertina" name="copertina" class="form-control" accept="image/*" />
            </div>  
            
            <!-- disegni input -->
            <div class="p-2">
               <label class="form-label" for="disegni" style="font-weight: bold">Disegni</label> 
               <input type="file" id="disegni" name="disegni" class="form-control" accept="application/pdf" />
            </div> 
            
            <!-- ndt input -->
            <div class="p-2">
               <label class="form-label" for="ndt" style="font-weight: bold">NDT Procedures</label> 
               <input type="file" id="ndt" name="ndt" class="form-control" accept="application/pdf" />
            </div> 
      </div>
      <button type="submit" class="btn btn-primary btn-block" style="width: 50%; margin: auto">
            Aggiungi
      </button> 
      </form>
   </div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>