<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title;?></title>
</head>
<body>
	<p>Go to <a href="<?= base_url('login');?>">login page</a>.</p>
	<p>Ready to <a href="<?= base_url('login/logout');?>">logout</a>.</p>
	<p>Hi my name is <strong><?= $userData['user_name'];?></strong>. I work at department <strong><?= $userData['user_dept'];?></strong></p>
	<p>My password is <strong><?= $userData['user_password'];?></strong>. </p>
</body>
</html>
