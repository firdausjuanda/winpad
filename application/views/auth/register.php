<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/fontawesome-free/css/all.min.css';?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/icheck-bootstrap/icheck-bootstrap.min.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'dist/css/adminlte.min.css';?>">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>WINPAD</b>System</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
        <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
        <p style="color: red;"><?= $this->session->flashdata('message'); ?></p>

      <form action="<?= base_url('register');?>" method="post">
        <div class="input-group mb-3">
        <input name="user_username" id="noSpace" class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('user_username'); ?>" type="text" placeholder="Username">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-at"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input name="user_firstname" id="noSpace" class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('user_firstname'); ?>" type="text" placeholder="First Name">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input name="user_lastname" id="noSpace" class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('user_lastname'); ?>" type="text" placeholder="Last Name">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input name="user_phone" id="noSpace" class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('user_phone'); ?>" type="number" placeholder="Phone">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input name="user_email" id="noSpace" class="form-control" value="<?= set_value('user_email'); ?>" type="email" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select name="user_company" class="form-control">
            <option value="">(Please select)</option>
            <option value="NI74">Wilmar Nabati Indonesia</option>
            <option value="TB71">Teluk Bayur Balking Terminal</option>
            <option value="EB01">Empat Bersaudara Engineering</option>
            <option value="BS01">Bima Sakti Engineering</option>
            <option value="AR01">ARA</option>
            <option value="PB01">Paraboss</option>
         </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="user_password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="user_password_check" type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="<?= base_url('login');?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script>
 function lettersOnly(input){
     var regex = /[^A-Za-z0-9]/gi;
     input.value = input.value.replace(regex,"");
 }
</script>
<!-- jQuery -->
<script src="<?= base_url('assets/vendor/admin-lte/').'plugins/jquery/jquery.min.js';?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/vendor/admin-lte/').'plugins/bootstrap/js/bootstrap.bundle.min.js';?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/vendor/admin-lte/').'dist/js/adminlte.min.js';?>"></script>
</body>
</html>
