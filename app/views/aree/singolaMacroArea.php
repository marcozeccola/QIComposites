<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>


<section id="pricing" class="pricing section-bg text-center">
   <div class="container">
      <header class="section-header">
         <h3><?php echo $data["area"]->area?></h3>
         <h4>SottoAree</h4>
         <p>Lista delle sottoaree</p>
      </header>
      <a href="<?php echo URLROOT ?>/aree/aggiungiSottoArea?idArea=<?php echo $_GET["idArea"]; ?>"
         class="btn btn-primary">AGGIUNGI SOTTO AREA</a>
      <div class="row flex-items-xs-middle flex-items-xs-center" style="padding: 5%">
      <ul class="list-group list-group-flush">
      <?php 
         if($data["sottoAree"]){
               foreach($data["sottoAree"] as $sottoArea){
                  ?>
                     <li class='list-group-item'>
                        <?php   echo  $sottoArea->nome ; ?> <br>
                        <a href="<?php echo URLROOT ?>/aree/modificaSottoArea?id=<?php echo  $sottoArea->idSottoArea ; ?>">modifica</a>
                     </li>
      <?php
               }
         }
      ?>
      </ul>
</section>
<?php
   require APPROOT . '/views/includes/footer.php';
?>