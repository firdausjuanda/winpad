<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
.table-full{
	width: 100%;
}
.tableWrapper{
	width: 100%;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

<a href="<?= base_url('permit/') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
<a href="<?= base_url('stock/topup_filter') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-up"> </i> Top up</a>
<div class="tableWrapper">
	<table class="table table-condense table-full">
		<tr>
			<th>No</th>
			<th>Reference</th>
			<th>Description</th>
			<th>Qty</th>
			<th>UoM</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach($permits as $val): ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $val['mat_no']; ?></td>
			<td><?php echo $val['mat_desc']; ?></td>
			<td>
			<?php if($val['mat_type'] == 'HOWP'){
				echo $HOWPadded['pa_qty'] - $HOWPused;
			} 
			elseif($val['mat_type'] == 'COWP') {
				echo $COWPadded['pa_qty'] - $COWPused;
			}
			elseif($val['mat_type'] == 'WAHP') {
				echo $WAHPadded['pa_qty'] - $WAHPused;
			}
			elseif($val['mat_type'] == 'LOWP') {
				echo $LOWPadded['pa_qty'] - $LOWPused;
			}
			elseif($val['mat_type'] == 'LIWP') {
				echo $LIWPadded['pa_qty'] - $LIWPused;
			}
			elseif($val['mat_type'] == 'CSEP') {
				echo $CSEPadded['pa_qty'] - $CSEPused;
			}
			elseif($val['mat_type'] == 'EXWP') {
				echo $EXWPadded['pa_qty'] - $EXWPused;
			}
			elseif($val['mat_type'] == 'HLWP') {
				echo $HLWPadded['pa_qty'] - $HLWPused;
			}
			?>
			</td>
			<td><?php echo $val['mat_unit']; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</div>
