<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

<?= $this->session->flashdata('message'); ?>

<?php 
$today = date('Y-m-d');
$hidden_day = date('Y-m-d', strtotime($today. '- 3 days'));

?>


<div class="row">
  <div class="col-md-8">

	<?php if(!$bc):?>
	<?php else:?>
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-info"></i> <?= $bc['bc_title'];?></h5>
			<p><i class="icon fas fa-check"></i><?= $bc['bc_message'];?></p>
		</div>
		<?php endif;?>

    <div class="row">
      <div class="div col-6">
        <a href="<?= base_url('work/work_history') ?>" class="btn btn-default bg-gradient btn-block mb-2"><i class="fas fa-clock mr-1"> </i>  History</a>
      </div>
      <div class="div col-6">
        <a href="<?= base_url('work/new_work') ?>" class="btn btn-default bg-gradient btn-block mb-2"><i class="fas fa-plus mr-1"> </i>  New Work</a>
      </div>
    </div>
		
	    
      <p class="m-1" style="font-style: italic; color:dimgray;">Work will be dissapeared 3 days after status CLS.</p>
	<?php foreach( $work as $w) :?>
  <?php if($w['work_status'] == 'CLS'):?>
    <?php if($w['work_date_close'] > $hidden_day):?>
      <div class="row">
      <div class="col-md-12">
                <!-- Box Comment -->
                <div class="card card-widget">
                  <div class="card-header">
                    <div class="user-block">
                      <img class="img-circle" src="<?= base_url('assets/img/profile/').$w['user_profile'];?>" alt="User Image">
                      <span class="username" ><a href="<?= base_url('profile/user/').$w['user_username'];?>"><?= $w['work_user'];?> (<?= $w['work_company'];?>)</a></span>
                      <span class="description"><span class="badge <?php $status = $w['work_status']; if($status == 'OPN'){ echo 'badge-danger'; }else{echo 'badge-success';} ?> "><?= $w['work_status'];?></span> | <?= $w['work_area'];?> | Start work: <?= date_format(date_create($w['work_date_open']),"j M y");?> | Created : 
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
											
											?>
											</span>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <?php if(!$w['work_date_close']):?>
                    <?php else:?>
                    <strong><p class="mb-0"><span class="badge badge-success">Completed:</span> <?= date_format(date_create($w['work_date_close']),"j M y")?></p></strong>
                    <?php endif;?>
                    <strong><p class="mb-0"><span class="badge badge-success">Work ID:</span> <?= $w['work_id'];?></p></strong>
                    <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $w['work_title'];?></p></strong>
                    <p class="mb-2" > <?= $w['work_description'];?></p>
                    <?php if($w['work_img_close'] == null): ?>
                    <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="workline-pict" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
                    <?php else:?>
                    <div class="row">
                      <div class="col-md-6">
                      <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="workline-pict" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
                      </div>
                      <div class="col-md-6">
                      <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="workline-pict" src="<?= base_url('assets/img/work/').$w['work_img_close'];?>" alt="Photo"></a><br>
                      </div>
                    </div>
                    <?php endif; ?>
                    <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                    <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                    <span class="float-right text-muted">127 likes - 3 comments</span> -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer card-comments">
                  <?php foreach($comment as $c):?>
                    <?php if($w['work_id']==$c['comment_work_id']): ?>
                    <div class="card-comment">
                      <!-- User image -->
                      <img class="img-circle img-sm" src="<?= base_url('assets/img/profile/').$c['user_profile'];?>" alt="User Image">
                      <div class="comment-text">
                        <span class="username">
                          <?= $c['user_firstname'];?> <?= $c['user_lastname'];?> (<?= $c['user_company'];?>)
                          <span class="text-muted float-right"><?php echo date_format(date_create($c['comment_date_created']),'j M y (H:i)');?></span>
                        </span><!-- /.username -->
                        <?= $c['comment_text'];?>
                      </div>
                      <!-- /.comment-text -->
                    </div>
                    <?php else: ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- /.card-comment -->
                  </div>
                  <!-- /.card-footer -->
                  <div class="card-footer">
                    <form action="<?= base_url('work/add_comment'); ?>" method="post">
                      <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>" alt="Alt Text">
                      <!-- .img-push is used to add margin to elements next to floating images -->
                      <div class="img-push">
                        <input name="comment_text" type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                        <input type="hidden" name="comment_work_id" value="<?=$w['work_id']?>">
                        <input type="hidden" name="comment_user_id" value="<?=$userData['user_id']?>">
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
      </div>    
    <?php endif;?>
  <?php else:?>
    <div class="row">
    <div class="col-md-12">
              <!-- Box Comment -->
              <div class="card card-widget">
                <div class="card-header">
                  <div class="user-block">
                    <img class="img-circle" src="<?= base_url('assets/img/profile/').$w['user_profile'];?>" alt="User Image">
                    <span class="username" ><a href="<?= base_url('profile/user/').$w['user_username'];?>"><?= $w['work_user'];?> (<?= $w['work_company'];?>)</a></span>
                    <span class="description"><span class="badge <?php $status = $w['work_status']; if($status == 'OPN'){ echo 'badge-danger'; }else{echo 'badge-success';} ?> "><?= $w['work_status'];?></span> | <?= $w['work_area'];?> | Start work: <?= date_format(date_create($w['work_date_open']),"j M y");?> | Created : 
										
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
					
					?>
										</span>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><p class="mb-0"><span class="badge badge-success">Work ID:</span> <?= $w['work_id'];?></p></strong>
                  <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $w['work_title'];?></p></strong>
                  <p class="mb-2" ><span class="badge badge-success">Analysis:</span> <?= $w['work_description'];?></p>
                  <?php if($status == 'OPN'): ?>
                  <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
                  <?php else:?>
                  <div class="row">
                    <div class="col-md-6">
                    <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
                    </div>
                    <div class="col-md-6">
                    <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_close'];?>" alt="Photo"></a><br>
                    </div>
                  </div>
                  <?php endif; ?>
                  <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                  <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                  <span class="float-right text-muted">127 likes - 3 comments</span> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer card-comments">
                <?php foreach($comment as $c):?>
                  <?php if($w['work_id']==$c['comment_work_id']): ?>
                  <div class="card-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="<?= base_url('assets/img/profile/').$c['user_profile'];?>" alt="User Image">
                    <div class="comment-text">
                      <span class="username">
                        <a href="<?= base_url('profile/user/').$c['user_username'];?>"><?= $c['user_firstname'];?> <?= $c['user_lastname'];?> (<?= $c['user_company'];?>)</a>
                        <span class="text-muted float-right">
												
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

												</span>
                      </span><!-- /.username -->
                      <?= $c['comment_text'];?>
                    </div>
                    <!-- /.comment-text -->
                  </div>
                  <?php else: ?>
                  <?php endif; ?>
                  <?php endforeach; ?>
                  <!-- /.card-comment -->
                </div>
                <!-- /.card-footer -->
                <div class="card-footer">
                  <form action="<?= base_url('work/add_comment'); ?>" method="post">
                    <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>" alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                      <input name="comment_text" type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                      <input type="hidden" name="comment_work_id" value="<?=$w['work_id']?>">
                      <input type="hidden" name="comment_user_id" value="<?=$userData['user_id']?>">
                    </div>
                  </form>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
    </div>
  <?php endif;?>
	
	<?php endforeach;?>
  </div>
  </div>


