<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

<div class="col-md-4">
	<a class="btn btn-default mb-2" href="<?= base_url('admin/userManage'); ?>"><i class="fa fa-user"></i> User Management</a>
	<a class="btn btn-default mb-2" href="<?= base_url('bc'); ?>"><i class="fa fa-bullhorn"></i> Broadcast</a>
</div>
