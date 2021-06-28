<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

	<?php foreach($notif as $n):?>
	<div class="col-md-8 card card-primary">
		<a href="<?= base_url('notif/goto/').$n['notif_id'];?>" style="
						font-weight:<?php if($n['notif_status']==0){echo 'bold';}else{ echo 'normal';}?>; color:black;
					">
			<!-- Message Start -->
			<div class="media">
				<img src="<?= base_url('assets/img/profile/').$n['user_profile'];?>" alt="User Avatar" class="img-size-50 m-3 img-circle">
				<div class="card-body">
					<h3  class="card-title">
					</h3>
					<?= $n['user_firstname'];?> <?= $n['user_lastname'];?> (<?= $n['user_company'];?>)
					<p class="text-sm"><?= $n['notif_message'];?></p>
					<p class="text-sm text-muted">
					
					<?php 
					$date = $n['notif_date_created'];
					if(empty($date)) {
						return "No date provided";
					}
					
					$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
					$lengths         = array("60","60","24","7","4.35","12","10");
					$now             = time();
					$unix_date         = strtotime($date);
					
						// check validity of date
					if(empty($unix_date)) {   
						return "Bad date";
					}
				
					// is it future date or past date
					if($now > $unix_date) {   
						$difference     = $now - $unix_date;
						$tense         = "ago";
						
					} else {
						$difference     = $unix_date - $now;
						$tense         = "from now";
					}
					
					for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
						$difference /= $lengths[$j];
					}
					
					$difference = round($difference);
					
					if($difference != 1) {
						$periods[$j].= "s";
					}
					
					echo "$difference $periods[$j] {$tense}";
					
					?>
					
					
					</p>
				</div>
			</div>
			<!-- Message End -->
		</a>
		</div>
		<hr>	
	<?php endforeach ;?>
	


		
