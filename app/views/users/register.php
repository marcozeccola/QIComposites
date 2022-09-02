<?php
   require APPROOT . '/views/includes/head.php'; 
?>
 <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0 "> 
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Registra un nuovo utente <br />
            <span class="text-primary"> per farlo accedere al servizio</span>
          </h1> 
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="<?php echo URLROOT;?>/users/register" method="POST">

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="nome" name="nome" class="form-control" required/>
                      <label class="form-label" for="nome">Nome</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="cognome" name="cognome" class="form-control" required />
                      <label class="form-label" for="cognome">Cognome</label>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control" required />
                  <label class="form-label" for="email">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control" required/>
                  <label class="form-label" for="password">Password</label>
                </div> 
                
                <!-- confirm password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required/>
                  <label class="form-label" for="confirmPassword">Conferma password</label>
                </div> 

                 
                <!-- ruoli -->
                <div class="form-outline mb-4">
                  <select class="form-select" required  name="role">
                    <option selected value="basic">Basic</option>
                    <option value="admin">Amministratore</option> 
                  </select>
                  <label class="form-label" for="role">Ruolo</label>
                </div> 

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign up
                </button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<?php
  require APPROOT . '/views/includes/footer.php';  
?>