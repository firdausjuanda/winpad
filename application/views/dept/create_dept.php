<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>
    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-default" href="<?= base_url(); ?>"> <i class="fa fa-arrow-left"></i> </a>
		</div>
	</div>
<div class="row">
	<div class="col-md-6">
		<div class="card card-body">
			<form action="<?php base_url('dept/dept_create');?>" method="post">
				<div class="form-group">
					<label for="company_name">Company Name</label>
					<input type="text" required class="form-control" name="company_name" id="company_name" value="<?= $company['company_name']; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="dept_code">Department Code</label>
					<input type="text" required class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('dept_code'); ?>" id="noSpace" style="text-transform:uppercase" oninput="this.value = this.value.toUpperCase()" maxlength="3" name="dept_code" id="dept_code" placeholder="Code">
				</div>
				<div class="form-group">
					<label for="dept_name">Department Name</label>
					<input type="text" required class="form-control" value="<?= set_value('dept_name'); ?>" name="dept_name" id="dept_name" placeholder="Department name">
				</div>
				<input type="hidden" name="company_id" id="company_id" value="<?= $company['company_id'];?>">
				<input type="hidden" name="dept_admin" id="dept_admin" value="<?= $userData['user_id'];?>">
				<input type="submit" class="btn btn-primary" value="submit">
			</form>
		</div>
	</div>
</div>
<script>
 function lettersOnly(input){
     var regex = /[^A-Za-z0-9]/gi;
     input.value = input.value.replace(regex,"");
 }
</script>
