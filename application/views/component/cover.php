<style>
.coverPict{
	width: 100%;
	height: 320px;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
	position: relative;
	object-fit: cover;
	position: relative;
}
.companyLogo{
	width: 180px;
	height: 180px;
	border-radius: 50%;
	object-fit: cover;
	position: absolute;
	top: -100px;
	right: 64px;
	border: 10px solid #F4f6f9;
}
</style>
<div class="row">
	<div class="col-md-12">
		<img src="<?php if($company['company_logo']!=null) { echo base_url('assets/img/company/cover/').$company['company_logo']; } else { echo base_url('assets/img/company/cover/').'default-logo.jpg';} ?>" alt="" class="coverPict">
	</div>
	<div class="col-md-12">
		<img src="<?php if($company['company_logo']!=null) { echo base_url('assets/img/company/logo/').$company['company_logo']; } else { echo base_url('assets/img/company/logo/').'no-img.png';} ?>" alt="" class="companyLogo">
	</div>
</div>
