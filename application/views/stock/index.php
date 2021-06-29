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
		<a class="btn btn-default" href="<?= base_url('permit'); ?>"> <i class="fa fa-arrow-left"></i> </a>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<a href="<?php echo base_url().'stock/all_stock/'?>">
			<div class="card card-default">
				<div class="card-body text-center">
				<i class="fa fa-cubes mr-2"></i>Stock
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?php echo base_url().'stock/transaction/'?>">
			<div class="card card-default">
				<div class="card-body text-center">
					<i class="fa fa-file mr-2"></i> Transaction
				</div>
			</div>
		</a>
	</div>
</div>
