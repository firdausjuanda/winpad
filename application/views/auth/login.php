<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h3 >Login Page</h3>
    <?php 
    if($this->session->userdata('id'))
    {
        echo '<p>Session Now : '; echo $userData["user_username"]; echo '</p>';
    } else 
    {
        echo 'Nobody sign in yet!';
    }
    ?>
    <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('login');?>" method="post" >
        <label for="user_username">Username</label>
        <input name="user_username" value="<?= set_value('user_username'); ?>" type="text" placeholder="Username">
        <br><br>
        <label for="user_password">Password</label>
        <input name="user_password" value="<?= set_value('user_password'); ?>" type="password" placeholder="Password">
        <br><br>
        <button type="submit">Login</button>
    </form>
    <p>Go directly to <a href="<?= base_url('home');?>">Main page</a></p>
	<p>Go to <a href="<?= base_url('register');?>">Registration page</a>.</p>
</body>
</html>