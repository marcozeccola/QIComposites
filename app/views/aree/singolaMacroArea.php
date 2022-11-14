<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 

<?php 
     if($data["sottoAree"]){
          foreach($data["sottoAree"] as $sottoArea){
               echo $sottoArea->nome. "<br>";
          }
     }
?>

Aggiungi sotto area:  <br>

<a href="<?php echo URLROOT ?>/aree/aggiungiSottoArea?idArea=<?php echo $_GET["idArea"]; ?>" class="btn btn-primary">AGGIUNGI SOTTO AREA</a>
<?php
   require APPROOT . '/views/includes/footer.php';
?>