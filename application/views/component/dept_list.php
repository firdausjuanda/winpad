<style>
.dept-title{
	padding: 0 15px;
}
.dept-thumb{
	width: 45px;
	height: 45px;
	margin-right: 10px;
	border-radius: 50%;
	position: relative;
	display: flex;
	align-items: center;
	justify-content: center;
}
.dept-list{
	margin: 10px;
	padding: 5px;
}
.dept-item{
	display: flex;
	align-items: center;
	margin-bottom: 10px;
	background-color: #eaeaea;
	border-radius: 30px;
	padding: 10px;
	cursor: pointer;
}
.dept-item:hover{
	background-color: white;
}
.dept-code{
	position: absolute;
	font-weight: bold;
	color: white;
}
.dept-name{
	font-size: 16px;
	color: black;
}

.deptCreate{
	padding: 10px 20px;
}


</style>
<div class="col-md-12">
	<div class="dept-title">
		<h5>Department</h5>
	</div>
	<div class="dept-list">
		<a class="dept-item deptCreate" href="<?= base_url('dept/create_dept');?>">Create Department</a>
		<?php foreach($depts as $val):?>
		<a href="<?= base_url('dept/d/').$val['dept_id'];?>">
		<div class="dept-item">
			<div class="dept-thumb" style="background-color: #149AE8; ?>;"><span class="dept-code"><?= $val['dept_code']; ?></span></div>
			<div class="dept-name"><?= $val['dept_name']?></div>
		</div>
		</a>
		<?php endforeach; ?>
	</div>
</div>
