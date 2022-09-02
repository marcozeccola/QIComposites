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
            Cambia password <br />
            <span class="text-primary"> per una maggiore sicurezza</span>
          </h1> 
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="<?php echo URLROOT ?>/users/changePassword" method="POST">  

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control" value="<?php echo $data["password"]; ?>" required />
                  <label class="form-label" for="password">Password</label>
                  <br>
                  <small class="text-danger"><?php echo $data["passwordError"]; ?></small>
                </div> 

                
                <div class="form-outline mb-4">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" value="<?php echo $data["confirmPassword"]; ?>" required />
                  <label class="form-label" for="confirmPassword">Conferma Password</label>
                  <br>
                  <small class="text-danger"><?php echo $data["confirmPasswordError"]; ?></small>
                </div> 

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Login
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