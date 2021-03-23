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
	<a href="<?= base_url('new_permit') ?>">Add New Permit</a>
	<a href="<?= base_url('my_permit') ?>">See My Permit</a>
	<h3>Permit List</h3>
	<table border="1">
		<tr>
			<th>Date</th>
			<th>Category</th>
			<th>Permit No</th>
			<th>Status</th>
			<th>Area</th>
			<th>Work Description</th>
			<th>User</th>
			<th>Company</th>
			<th>Created</th>
		</tr>
		<?php foreach( $permit as $p) :?>
		<tr>
			<td><?= $p['permit_date'];?></td>
			<td><?= $p['permit_category'];?></td>
			<td><?= $p['permit_no'];?></td>
			<td><?= $p['permit_status'];?></td>
			<td><?= $p['permit_area'];?></td>
			<td><?= $p['permit_title'];?></td>
			<td><?= $p['permit_user'];?></td>
			<td><?= $p['permit_company'];?></td>
			<td><?= $p['permit_date_created'];?></td>

		</tr>
		<?php endforeach;?>
	</table>
</body>
</html>
