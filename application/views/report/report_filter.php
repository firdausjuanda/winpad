<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<?php
$today = date('Y-m-d');
$lastmonth = date('Y-m-d', strtotime($today. '- 30 days'));?>
<div class="winpad-header"><?= $title; ?></div>
<a href="<?= base_url('permit') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<form action="<?php echo base_url('report/permit_filter_post');?>" method="POST">
				<label for="permit_type">Permit Type</label>
				<div class="input-group mb-3">
					<select class="form-control"  name="permit_type">
					<option value="*">ALL</option>
					<?php foreach($permit_type as $val):?>
					<option value="<?= $val['mat_type']; ?>"><?= $val['mat_desc']; ?></option>
					<?php endforeach; ?>
					</select>
					<!-- <div class="input-group-append">
						<span class="input-group-text"><button style="padding:0; border:none"  type="submit"><i class="fas fa-search"></button></i></span>
					</div> -->
        </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="date_start">Date from</label>
							<input class="form-control" name="date_start" value="<?php echo $lastmonth; ?>" type="date">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="date_finish">Date until</label>
							<input class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date_finish" type="date">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="company">Company</label>
					<select type="text" name="company_name" class="form-control">
						<option value="<?= $userData['company_id']; ?>"><?= $userData['company_name'] ?></option>
					</select>
				</div>
				<div class="form-group">
					<label for="dept">Department</label>
					<select name="dept_name"type="text" class="form-control">
					<option value="*">ALL</option>
					<option value="<?= $userData['dept_id']; ?>"><?= $userData['dept_name'] ?></option>
					</select>
				</div>
				<button type="submit" class="form-control btn btn-primary">Generate</button>
			</form>
		</div>
	</div>
</div>
