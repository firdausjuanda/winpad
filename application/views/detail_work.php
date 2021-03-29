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
	<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
	<p><strong><?= $userData['user_firstname'];?> <?= $userData['user_lastname'];?> </strong><strong>(<?= $userData['user_company'];?>)</strong></p>
	<p><a href="<?= base_url('login');?>">login page</a>.</p>
	<p><a href="<?= base_url('register');?>">Registration page</a>.</p>
	<p><a href="<?= base_url('login/logout');?>">logout</a>.</p>
	<br>
	<a href="<?= base_url('new_permit/new_permit/').$work['work_id']; ?>">Add New Permit</a>
	<a href="<?= base_url('my_permit/this_work_permit/').$work['work_id']; ?>">See This Work Permit</a>
	<h3>Detail Work</h3>
	<table border="1">
		<tr>
			<th>Date start</th>
			<th>Status</th>
			<th>Area</th>
			<th>Title</th>
			<th>Company</th>
			<th>User</th>
			<th>Created</th>
			<th>Img</th>
		</tr>
		<tr>
			<td><?= $work['work_date_open'];?></td>
			<td><?= $work['work_status'];?></td>
			<td><?= $work['work_area'];?></td>
			<td><a href="<?= base_url('work/detail_work/').$work['work_id'];;?>"><?= $work['work_title'];?></a></td>
			<td><?= $work['work_company'];?></td>
			<td><?= $work['work_user'];?></td>
			<td><?= $work['work_date_created'];?></td>
			<td><img width="150px" src="<?= base_url('assets/img/img_open/').$work['work_img_open'];?>" alt=""></td>
		</tr>
	</table>
	<a href="<?= base_url('work'); ?>">Back</a>
</body>
</html>
