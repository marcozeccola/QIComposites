 <body> 
 <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
     <h1  class="logo me-auto "><a   href="<?php echo URLROOT; ?>"><img class="logo" src="<?php echo URLROOT ?>/public/assets/img/logo.png" alt=""></a></h1> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto  "> 
        <a class="nav-link " href="<?php echo URLROOT; ?>">Home</a>
        <a class="nav-link " href="<?php echo URLROOT; ?>/progetti/">Progetti</a>
        <li class="dropdown"><a href="#"><span><?php echo $_SESSION['username'] ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo URLROOT;?>/users/logout">LOGOUT</a></li>
              <li><a href="<?php echo URLROOT;?>/users/changePassword">Cambia password</a></li>  
            </ul>
        </li>
        
        <?php 
          if(isAdmin()){
        ?>
        <a class="nav-link " href="<?php echo URLROOT; ?>/users/register">Registra nuovo utente</a>
        <?php 
          }
        ?>
      </div>
    </div>
  </div>
</nav>
  <main id="main">