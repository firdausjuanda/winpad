<style>
.postContainer{
    padding: 0;
    margin: 0;
    background-color: white;
    border-radius: 10px;
    min-height: 400px;
    margin-bottom: 10px;
}

.postHeader {
    padding: 10px;
    display: flex;
    align-items: center;
    position: relative;
    border-bottom: 1px #eaeaea solid;

}

.postHeaderImg {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 1px #eaeaea solid;
}

.postHeaderName {
    font-weight: bold;
	font-size:16px;
}

.postHeaderSub {
    font-size: 10px;
    color: grey;
    margin-top: 5px;
}

.postHeaderOption {
    position: absolute;
    right: 0;
    padding: 20px;
    cursor: pointer;
}

.postBodyImg {
    width: 100%;
    height: 320px;
    object-fit: cover;
    cursor: pointer;
}

.postTitle {
    padding: 10px;
}

.postTitleText {
    font-weight: bold;
}
.postTitleSubText {
    font-weight: normal;
}

.postAction {
    border-bottom: 1px #eaeaea solid;
}

.postActionList {
    list-style: none;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    
}

.postActionListItem {
    margin-right: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: start;
}

.postActionText {
    margin-left: 10px;
}

.commentBox{
	margin: 0;
	padding: 0;
}

.postComment {
    padding: 10px;
	display: flex;
	align-items:flex-start;
	margin-bottom: 10px;
	border-bottom: 1px solid #eee;

}

.commentProfileImg {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 1px #eaeaea solid;
}

.commentProfile {
    flex: 3;
}

.commentText {
    flex: 9;
}

.commentInputWrap{
	padding: 10px;
	display: flex;
	align-items: flex-start;
}

.commenterImg{
	width: 32px;
	height: 32px;
	border-radius: 50%;
	object-fit: cover;
	margin-right: 10px;
}

.commentInput{
	margin: 0;
	width: 100%;
	border: none;
	padding: 10px 20px;
	border-radius: 20px;
	background-color: #eee;
}
.commentInput:focus{
	outline: none;
}

.postTitleSubText{
	margin-bottom: 0px;
}

.commentUser{
	padding: 20px 0px;
	font-weight: bold;
	font-size: 14px;
	margin-bottom: 5px;
}
.commentBody{
	margin-bottom: 10px;
}

.commentTime{
	font-weight: normal;
	color:grey;
	font-size:10px;
}
</style>
<?php foreach($work as $w):?>
<div class="col-md-12">
<div class="postContainer">
		<div class="postHeader">
			<img src="<?= base_url('assets/img/profile/').$w['user_profile'];?>" alt="" class="postHeaderImg" />
			<div class="postHeaderText">
				<span class="postHeaderName"><a href="<?= base_url('profile/user/').$w['user_username'];?>"><?= $w['work_user'];?></a></span><br>
				<span class="postHeaderSub">
				<?php 
				$date = $w['work_date_created'];
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
				
				?> | <?= $w['work_status'];?> | 
				<?php foreach($depts as $dn):?>
					<?php if($dn['dept_id'] == $w['work_area']):?>
						<?= $dn['dept_name'];?>
					<?php else:?>
					<?php endif;?>
				<?php endforeach;?>
				</span>
			</div>
			<span class="postHeaderOption"><i class="postHeaderOptionIcon"></i></span>
		</div>
		<div class="postTitle">
			<span class="postTitleText"><?= $w['work_title'];?></span>
			<p class="postTitleSubText"><?= $w['work_description'];?></p>
		</div>
		<div class="postBody">
		<?php if($w['work_img_close'] == null): ?>
		<a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="postBodyImg" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
		<?php else:?>
		<div class="row">
			<div class="col-md-6">
			<a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="postBodyImg" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
			</div>
			<div class="col-md-6">
			<a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="postBodyImg" src="<?= base_url('assets/img/work/').$w['work_img_close'];?>" alt="Photo"></a><br>
			</div>
		</div>
		<?php endif; ?>
			
		</div>
		<!-- <div class="postAction">
			<ul class="postActionList">
				<li class="postActionListItem">
					<FiHeart/>
					<span class="postActionText">Like</span>
				</li>
				<li class="postActionListItem">
					<FiMessageCircle/>
					<span class="postActionText">Comment</span>
				</li>
				<li class="postActionListItem">
					<FiShare/>
					<span class="postActionText">Share</span>
				</li>
			</ul>
		</div> -->

		<?php foreach($comment as $c):?>
		<div class="row">
			<div class="col-md-12">
				<div class="postComment">
					<?php if($w['work_id']==$c['comment_work_id']): ?>
					<img src="<?= base_url('assets/img/profile/').$c['user_profile'];?>" alt="" class="commentProfileImg" />
					<div class="commentBody">
						<span class="commentUser"><?= $c['user_firstname'];?> <?= $c['user_lastname'];?> <span class="commentTime"> (
						
							<?php 
							$date = $c['comment_date_created'];
							if(empty($date)) {
								return "No date provided";
							}
							
							$periods         = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
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
						
							)</span></span><br>
						<span class="commentText">
						<?= $c['comment_text'];?>
						</span>
					</div>
					<?php else: ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php endforeach; ?>

		<form action="<?= base_url('work/add_comment'); ?>" method="post">
		<div class="commentInputWrap">
			<img src="<?= base_url('assets/img/profile/profile01.jpeg')?>" alt="" class="commenterImg">
			<input type="text" name="comment_text" placeholder="Type your comment..." class="commentInput" >
			<input type="hidden" name="comment_work_id" value="<?=$w['work_id']?>">
			<input type="hidden" name="comment_user_id" value="<?=$userData['user_id']?>">
		</div>
		</form>
	</div>
</div>
<?php endforeach; ?>
