<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

<a href="<?= base_url('stock/') ;?>" class="btn btn-default mb-2 mr-2"><i class="fa fa-arrow-left"> </i></a>
<a href="#" class="btn btn-default mb-2 mr-2"><i class="fa fa-plus"></i></a>
<table class="table table-responsive table-sm table-condense">
	<tr>
		<th>No</th>
		<th>Code</th>
		<th>Status</th>
		<th>Mat. No</th>
		<th>Mat. Desc</th>
		<th>Qty</th>
		<th>UoM</th>
		<th>Detail</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach($all_trans as $val): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $val['mt_code']; ?></td>
		<td><?php echo $val['mt_status']; ?></td>
		<td><?php echo $val['mat_no']; ?></td>
		<td><?php echo $val['mat_desc']; ?></td>
		<td><?php echo $val['mt_qty']; ?></td>
		<td><?php echo $val['mat_unit']; ?></td>
		<td class="text-center"><a href="#" class="badge badge-sm badge-primary" ><i class="fa fa-info"></i></a></td>
	</tr>
	<?php $i++ ;?>
	<?php endforeach; ?>
</table>


