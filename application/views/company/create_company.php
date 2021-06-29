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
			<form action="<?php base_url('company/company_create');?>" method="post">
				<div class="form-group">
					<label for="">Company Name</label>
					<input type="text" required class="form-control" name="company_name" id="company_name" placeholder="Company Name">
				</div>
				<div class="form-group">
					<label for="">Company Code (Unique)</label>
					<input type="text" required class="form-control" onkeyup='lettersOnly(this)' value="<?= set_value('user_phone'); ?>" id="noSpace" style="text-transform:uppercase" oninput="this.value = this.value.toUpperCase()" maxlength="4" name="company_code" id="company_code" placeholder="Code">
				</div>
				<div class="form-group">
					<label for="">Company Type</label>
					<select type="text" required class="form-control"  name="company_type" id="company_type" placeholder="Type">
						<option value="PT">PT</option>
						<option value="CV">CV</option>
						<option value="PR">Perseorangan</option>
						<option value="OT">Lainnnya</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Decription</label>
					<textarea type="text" required class="form-control" name="company_desc" id="company_desc" placeholder="Description">
					</textarea>
				</div>
				<div class="form-group">
					<label for="">Location</label>
					<input type="text" required class="form-control" name="company_location" id="company_location" placeholder="Location">
				</div>
				<div class="form-group">
					<label for="">Country</label>
					<select type="text" required class="form-control" name="company_country" id="company_country" placeholder="Country">
						<option value="Indonesia">Indonesia</option>
						<option value="Singapore">Singapore</option>
						<option value="Malaysia">Malaysia</option>
						<option value="China">China</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Company Leader</label>
					<input type="text" required class="form-control" name="company_lead" id="company_lead" placeholder="Direksi/Manager/etc">
				</div>
				<input type="hidden" name="company_created_by" id="company_created_by" value="<?= $userData['user_id'];?>">
				<input type="hidden" name="company_admin1" id="company_admin1" value="<?= $userData['user_id'];?>">
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
