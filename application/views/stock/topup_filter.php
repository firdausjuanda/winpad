<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header">Search Material</div>
<a href="<?= base_url('stock/all_stock/') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<form action="<?php echo base_url('stock/get_topup_filter');?>" method="POST">
				<label for="mat_type">Permit Type</label>
				<div class="input-group mb-3">
					<select class="form-control" placeholder="NXX.XXXXXXX.XXXXX" required  name="mat_type">
					<option value="">(Select Category)</option>
					<?php foreach($permit_type as $val):?>
					<option value="<?= $val['mat_type']; ?>"><?= $val['mat_desc']; ?></option>
					<?php endforeach; ?>
					</select>
					<div class="input-group-append">
						<span class="input-group-text"><button style="padding:0; border:none"  type="submit"><i class="fas fa-search"></button></i></span>
					</div>
                </div>
			</form>
		</div>
	</div>
</div>
