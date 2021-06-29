<style>

.company-profile-wrap{
	padding: 20px;
}
.companyName{
	font-size: 32px;
	font-weight: 800;
}
.btn-rounded{
	border-radius: 20px;
	padding: 10px 30px;
}
.btn-primary .btn-rounded:hover{
	background-color: white;
	color: #0069D9;
	border-radius: 20px;
	padding: 10px 30px;
}
.btn-danger .btn-rounded:hover{
	background-color: white;
	color: #BF2B39;
	border-radius: 20px;
	padding: 10px 30px;
}
.companyinfo{
	margin-bottom: 10px;
	padding-bottom: 20px;
	border-bottom: 1px solid #eee;
	display: flex;
	align-items: center;
}
.infoList{
	width: 100%;
	margin-bottom: 2px;
}
.listText{
	font-size: 12px;
}
.listIcon{
	font-size: 18px;
	margin-right: 10px;
}
.companyDetail{
	width: 80%;
	margin-right: 20px;
}

</style>

<div class="company-profile-wrap">
	<h3 class="companyName"><?php echo $company['company_name']; ?> (<?= $company['company_code'];?>)</h3>
	<div class="companyinfo">
		<div class="companyDetail">
			<div class="infoList">
				<span class="listText" ><?php echo $company['company_desc']; ?></span>
			</div>
			<div class="infoList">
				<span class="listIcon"><i class="fa fa-user"></i></span><span class="listText" ><?php echo $company['company_location']; ?>, <?php echo $company['company_country']; ?></span>
			</div>
			<div class="infoList">
				<span class="listIcon"><i class="fa fa-user"></i></span><span class="listText" ><?php echo $company['company_lead']; ?></span>
			</div>
		</div>
		<?php if($userData['user_company']==$company['company_id']):?>
			<a href="<?php echo base_url('profile/unjoin_company/').$company['company_id'];?>" class="btn btn-danger btn-rounded">Unjoin</a>
		<?php else:?>
			<a href="<?php echo base_url('profile/join_company/').$company['company_id'];?>" class="btn btn-primary btn-rounded">Join</a>
		<?php endif;?>
	</div>
</div>
