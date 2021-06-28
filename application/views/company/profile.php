<?php $this->load->view($component_cover, $company); ?>
<?php $this->load->view($component_companyProfile, [$company, $userData]); ?>
<div class="row">
	<div class="col-md-4">
		<?php $this->load->view($component_deptList, [$depts, $userData]); ?>
	</div>
	<div class="col-md-8">
		<?php $this->load->view($component_workList); ?>
	</div>
</div>
