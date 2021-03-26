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
	<a href="<?= base_url('work/new_work') ?>">Add New Work</a>
	<a href="<?= base_url('work/my_work') ?>">See My Work</a>
	<h3>Permit List</h3>
	<table border="1">
		<tr>
			<th>Date start</th>
			<th>Status</th>
			<th>Area</th>
			<th>Title</th>
			<th>Company</th>
			<th>User</th>
			<th>Created</th>
		</tr>
		<?php foreach( $work as $w) :?>
		<tr>
			<td><?= $w['work_date_open'];?></td>
			<td><?= $w['work_status'];?></td>
			<td><?= $w['work_area'];?></td>
			<td><a href="<?= base_url('work/detail_work/').$w['work_id'];;?>"><?= $w['work_title'];?></a></td>
			<td><?= $w['work_company'];?></td>
			<td><?= $w['work_user'];?></td>
			<td><?= $w['work_date_created'];?></td>

		</tr>
		<?php endforeach;?>
	</table>
</body>
</html>
