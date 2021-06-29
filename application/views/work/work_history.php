
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <!-- <div class="div col-6">
        <a href="<?= base_url('work/new_work') ?>" class="btn btn-default bg-gradient btn-block mb-2"><i class="fas fa-list mr-1"> </i>  Archieve</a>
      </div> -->
		<div class="mb-2">
			<div class="col-12">
				<a class="btn btn-default" href="<?= base_url('work') ?>"><i class="fa fa-arrow-left"></i></a>
			</div>
		</div>
    </div>
	
    <p class="m-1" style="font-style: italic; color:dimgray;">Only Work status CLS will be listed here.</p>
	<?php foreach( $work as $w) :?>
      <div class="row">
      <div class="col-md-12">
                <!-- Box Comment -->
                <div class="card card-widget">
                  <div class="card-header">
                    <div class="user-block">
                      <img class="img-circle" src="<?= base_url('assets/img/profile/').$w['user_profile'];?>" alt="User Image">
                      <span class="username" ><a style="color: black;" href="<?= base_url('profile/user/').$w['user_username'];?>"><?= $w['work_user'];?> (<?= $w['work_company'];?>)</a></span>
                      <span class="description"><span class="badge <?php $status = $w['work_status']; if($status == 'OPN'){ echo 'badge-danger'; }else{echo 'badge-success';} ?> "><?= $w['work_status'];?></span> | <?= $w['work_area'];?> | Start work: <?= date_format(date_create($w['work_date_open']),"j M y");?> | Created : <?= date_format(date_create($w['work_date_created']),'j M y (H:i)');?></span>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><p class="mb-0"><span class="badge badge-success">Completed:</span> <?= date_format(date_create($w['work_date_close']),"j M y")?></p></strong>
                    <strong><p class="mb-0"><span class="badge badge-success">Work ID:</span> <?= $w['work_id'];?></p></strong>
                    <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $w['work_title'];?></p></strong>
                    <p class="mb-2" ><span class="badge badge-success">Analysis:</span> <?= $w['work_description'];?></p> 
                    <div class="row">
                      <div class="col-md-6">
                      <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
                      </div>
                      <div class="col-md-6">
                      <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_close'];?>" alt="Photo"></a><br>
                      </div>
                    </div>
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
	<?php endforeach;?>
  </div>
  </div>


