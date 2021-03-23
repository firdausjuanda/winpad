<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<h3 >Registration Page</h3>
    <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('register');?>" method="post" >
        <label for="user_username">Username</label>
        <input name="user_username" id="noSpace" onkeyup='lettersOnly(this)' value="<?= set_value('user_username'); ?>" type="text" placeholder="Username">
        <br><br>
        <label for="user_firstname">First Name</label>
        <input name="user_firstname" value="<?= set_value('user_firstname'); ?>" type="text" placeholder="First Name">
        <br><br>
        <label for="user_lastname">Last Name</label>
        <input name="user_lastname" value="<?= set_value('user_lastname'); ?>" type="text" placeholder="Last Name">
        <br><br>
        <label for="user_phone">Phone Number</label>
        <input name="user_phone" value="<?= set_value('user_phone'); ?>" type="text" placeholder="Phone No">
        <br><br>
        <label for="user_phone">Company</label>
        <select name="user_company" >
            <option value="">-Please select-</option>
            <option value="NI74">Wilmar Nabati Indonesia</option>
            <option value="TB71">Teluk Bayur Balking Terminal</option>
            <option value="EB01">Empat Bersaudara Engineering</option>
            <option value="BS01">Bima Sakti Engineering</option>
            <option value="AR01">ARA</option>
            <option value="PB01">Paraboss</option>
        </select>
        <br><br>
        <label for="user_password">Password</label>
        <input name="user_password" value="<?= set_value('user_password'); ?>" type="password" placeholder="Password">
        <br><br>
        <label for="user_password_check">Confirm Password</label>
        <input name="user_password_check" value="<?= set_value('user_password_check'); ?>" type="password" placeholder="Confirm Password">
        <br><br>
        <button type="submit">Register</button>
    </form>
    <p>Go directly to <a href="<?= base_url('home');?>">Main page</a></p>
</body>
<script>
 function lettersOnly(input){
     var regex = /[^A-Za-z0-9]/gi;
     input.value = input.value.replace(regex,"");
 }
</script>
</html>