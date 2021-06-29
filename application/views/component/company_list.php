<style>
.companyImg{
	width: 100%;
	height: 250px;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
}

.winpadWrapper{
	padding: 10px;
}

.items{
	background-color: white;
	padding: 10px;
	border-bottom-left-radius: 20px;
	border-bottom-right-radius: 20px;
}

.companyName{
	color: black;
	font-weight: bold;
	font-size: 16px;
}
.companyLocation{
	color: black;
}
.companyCountry{
	color: grey;
}

</style>
<?php foreach($company_data as $val):?>
	<div class="col-md-4">
		<a href="<?= base_url('company/c/').$val['company_code'];?>">
		<div class="winpadWrapper">
			<img src="<?= base_url('assets/img/company/cover/default-logo.jpg')?>" alt="" class="companyImg">
			<div class="items">
				<span class="companyName"><?= $val['company_name']; ?> (<?= $val['company_code']; ?>)</span><br>
				<span class="companyLocation"><?= $val['company_location']; ?></span><br>
				<span class="companyCountry"><?= $val['company_country']; ?></span>
			</div>
		</div>
	</a>
</div>
<?php endforeach;?>
