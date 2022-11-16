<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>


<section id="pricing" class="pricing section-bg text-center">
   <div class="container">
      <header class="section-header">
         <h3>SottoAree</h3>
         <p>Lista delle sottoaree</p>
      </header>
      <a href="<?php echo URLROOT ?>/aree/aggiungiSottoArea?idArea=<?php echo $_GET["idArea"]; ?>"
         class="btn btn-primary">AGGIUNGI SOTTO AREA</a>
      <div class="row flex-items-xs-middle flex-items-xs-center" style="padding: 5%">
      <ul class="list-group list-group-flush">
      <?php 
         if($data["sottoAree"]){
               foreach($data["sottoAree"] as $sottoArea){
                     echo "<li class='list-group-item'>" . $sottoArea->nome. "</li>";
               }
         }
      ?>
      </ul>
</section>
<?php
   require APPROOT . '/views/includes/footer.php';
?>