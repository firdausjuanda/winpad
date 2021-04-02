<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/fontawesome-free/css/all.min.css';?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/icheck-bootstrap/icheck-bootstrap.min.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'dist/css/adminlte.min.css';?>">
</head>
<body class="hold-transition login-page">
    <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
    <p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    
    <div class="login-box">
    <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Winpad</b>System</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= base_url('login');?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_username" value="<?= set_value('user_username'); ?>" type="text" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-at"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="user_password" value="<?= set_value('user_password'); ?>" type="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?= base_url('home');?>">Go to home</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('register');?>" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
    </div>
<!-- jQuery -->
<script src="<?= base_url('assets/vendor/admin-lte/').'plugins/jquery/jquery.min.js';?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/vendor/admin-lte/').'plugins/bootstrap/js/bootstrap.bundle.min.js';?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/vendor/admin-lte/').'dist/js/adminlte.min.js';?>"></script>
</body>
</html>