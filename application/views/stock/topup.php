<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>
<a href="<?= base_url('stock/topup_filter/') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
<div class="row">
	<div class="col-md-6">
		<div class="card">
		<div class="card-body">
			<form action="<?php echo base_url('stock/topup_posting/').$mat_data['mat_id'];?>" method="post">
				<div class="form-group">
					<label for="mat_no">Reference</label>
					<input type="text" readonly class="form-control" value="<?= $mat_data['mat_no']; ?>" name="mat_no">
				</div>
				<div class="form-group">
					<label for="mat_desc">Description</label>
					<input type="text" readonly class="form-control" value="<?= $mat_data['mat_desc']; ?>"  name="mat_desc">
				</div>
				<div class="form-group">
					<label for="stock_qty">Current stock</label>
					<div class="input-group ">
						 <input readonly type="number" value="<?= $permit_stock; ?>" name="stock_qty" class="form-control">
						 <div class="input-group-append">
							<span class="input-group-text"><?= $mat_data['mat_unit']; ?></span>
						  </div>
					</div>
				</div>
				<div class="form-group">
					<label for="stock_add">Stock Added</label>
					<div class="input-group ">
						<input type="number" required min=0 class="form-control"  name="stock_add">
						<div class="input-group-append">
							<span class="input-group-text"><?= $mat_data['mat_unit']; ?></span>
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control" value="<?= $mat_data['mat_type']; ?>" name="stock_type">
				<button class="btn btn-primary form-control" onclick="confirm('Are you sure?')">Submit</button>
			</form>
		</div>
	</div>
</div>
