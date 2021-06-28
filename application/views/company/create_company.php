<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php echo validation_errors('company_name');?>
	<?php echo validation_errors('company_code');?>
	<?php echo validation_errors('company_type');?>
	<?php echo validation_errors('company_desc');?>
	<?php echo validation_errors('company_logo');?>
	<?php echo validation_errors('company_location');?>
	<?php echo validation_errors('company_country');?>
	<?php echo validation_errors('company_lead');?>
	<?php echo $this->session->flashdata('message');?>
	<form action="<?php base_url('company/company_create');?>" method="post">
		<input type="text" required name="company_name" id="company_name" placeholder="Company Name"><br>
		<input type="text" required name="company_code" id="company_code" placeholder="Code"><br>
		<input type="text" required name="company_type" id="company_type" placeholder="Type"><br>
		<input type="text" required name="company_desc" id="company_desc" placeholder="Description"><br>
		<input type="text" required name="company_location" id="company_location" placeholder="Location"><br>
		<input type="text" required name="company_country" id="company_country" placeholder="Country"><br>
		<input type="text" required name="company_lead" id="company_lead" placeholder="Direksi/Manager/etc"><br>
		<input type="hidden" name="company_created_by" id="company_created_by" value="<?= $userData['user_id'];?>"><br>
		<input type="hidden" name="company_admin1" id="company_admin1" value="<?= $userData['user_id'];?>"><br>
		<input type="submit" value="submit"><br>
	</form>
</body>
</html>
