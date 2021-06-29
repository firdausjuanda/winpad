<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>
<a href="<?= base_url('report/permit') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>

<div class="row">
	<div class="col-md-12">
		<table class="table table-hover">
			<tr>
				<td><strong>No.</strong></td>
				<td><strong>Date</strong></td>
				<td><strong>Type</strong></td>
				<td><strong>Status</strong></td>
				<td><strong>No</strong></td>
				<td><strong>Description</strong></td>
				<td><strong>Work</strong></td>
				<td><strong>Work Detail</strong></td>
				<td><strong>Released by</strong></td>
				<td><strong>L1 Approver</strong></td>
				<td><strong>L2 Approver</strong></td>
				<td><strong>Permit giver</strong></td>
			</tr>
			<?php $i = 1; ?>
			<?php foreach($permit_data as $val): ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $val['permit_date']; ?></td>
				<td><?= $val['permit_category']; ?></td>
				<td><?= $val['permit_status']; ?></td>
				<td><?= $val['permit_no']; ?></td>
				<td><?= $val['mat_desc']; ?></td>
				<td><?= $val['work_title']; ?></td>
				<td><?= $val['permit_description']; ?></td>
				<td><?= $val['permit_user']; ?></td>
				<td>
				<?php foreach($what_user as $u):?>
					<?php if($val['permit_approved1_by'] == $u['user_id']):?>
					<?= $u['user_username']; ?>
					<?php else:?>
					<?php endif;?>
				<?php endforeach; ?>
				</td>
				<td>
				<?php foreach($what_user as $u):?>
					<?php if($val['permit_approved2_by'] == $u['user_id']):?>
					<?= $u['user_username']; ?>
					<?php else:?>
					<?php endif;?>
				<?php endforeach; ?>
				</td>
				<td><?= $val['permit_giver']; ?></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
		</table>		
	</div>
</div>
