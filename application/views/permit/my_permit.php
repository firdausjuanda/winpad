<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title;?></title>
</head>
<body>
<a href="<?= base_url('home') ?>">Back</a>
	<h3>My Permit List</h3>
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
		<?php foreach( $my_permit as $mp) :?>
		<tr>
			<td><?= $mp['permit_date'];?></td>
			<td><?= $mp['permit_category'];?></td>
			<td><?= $mp['permit_no'];?></td>
			<td><?= $mp['permit_status'];?></td>
			<td><?= $mp['permit_area'];?></td>
			<td><?= $mp['permit_title'];?></td>
			<td><?= $mp['permit_user'];?></td>
			<td><?= $mp['permit_company'];?></td>
			<td><?= $mp['permit_date_created'];?></td>

		</tr>
		<?php endforeach;?>
	</table>
</body>
</html>