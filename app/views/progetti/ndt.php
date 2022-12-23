 

<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?> 
 
<section id="pricing" class="pricing section-bg text-center">

<div style="margin-left: 20px!important;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/">Progetti</a></li>
      <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/progetto?id=<?php echo $_GET["idProgetto"] ?>"><?php echo $data["progetto"]->nome; ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">NDT Procedures</li>
    </ol>
  </nav>
</div>

      <div class="container">
        <header class="section-header">
          <h3>NDT Procedures</h3> 
          <a class="btn btn-primary" style="width: 70%; margin: auto" href="<?php echo URLROOT;?>/progetti/aggiungiNdt?idProgetto=<?php echo $_GET["idProgetto"];?>">Aggiungi NDT</a>
        </header><br>
        <h4>NDT Procedures del progetto <?php echo $data["progetto"]->nome; ?></h4>
     

        <div class="text-center">
          <table class=" text-center">

<?php   
      $dirNdt = str_replace( ' ', '',PUBLICROOT. "/progetti-docs/procedures/ ". $data["progetto"]->idProgetto." / ");
      $arrayFiles =  is_dir($dirNdt) ? scandir($dirNdt) : " ";

      for($i=2;$i<count($arrayFiles);$i++){ 
         $fileNdt = $arrayFiles[$i];
         $linkNdt =  URLROOT. "/public/progetti-docs/procedures/". $data["progetto"]->idProgetto."/".$fileNdt;
         $daCercare = $dirNdt.$fileNdt; 
         if(file_exists($daCercare)){
?>
                    <tr>
                         <td>
                              <p><?php echo $fileNdt; ?> </p>
                         </td>
                         <td>
                              <a href="<?php echo $linkNdt; ?>" download class="btn btn-primary">Scarica</a>
                         </td>
                    </tr>
                    <?php  
 
         }
      }
?>

               </table>
        </div>
</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>  


