
	<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
<div class="row">
	<div class="col-md-12">
                <a class="btn btn-default mb-2" href="<?= base_url('work'); ?>"><i class="fa fa-arrow-left"></i></a>
                <a href="<?= base_url('permit/this_work_permit/').$work['work_id'];?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-eye"></i> See Permit</a>
                <?php if($work['work_user']!=$userData['user_username']):?>
                <?php else:?>
                <a href="<?= base_url('work/complete_work/').$work['work_id'];?>" class="btn btn-outline-success mb-2"><i class="fa fa-check"></i> Complete Work</a>
                <?php endif;?>
                <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
              <div class="user-block">
                  <img class="img-circle" src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>" alt="User Image">
                  <span class="username" ><a style="color: black;" href="#"><?= $work['work_user'];?> (<?= $work['work_company'];?>)</a></span>
                  <span class="description"><span class="badge <?php $status = $work['work_status']; if($status == 'OPN'){ echo 'badge-danger'; }else{echo 'badge-success';} ?> "><?= $work['work_status'];?></span> | <?= $work['work_area'];?> | Start work: <?= date_format(date_create($work['work_date_open']),"j M y");?> | Created : <?= date_format(date_create($work['work_date_created']),'j M y (H:i)');?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><p class="mb-0"><span class="badge badge-success">Work ID:</span> <?= $work['work_id'];?></p></strong>
                <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $work['work_title'];?></p></strong>
			  	      <p class="mb-2" ><span class="badge badge-success">Analysis:</span> <?= $work['work_description'];?></p>
                <?php if($status == 'OPN'): ?>
                <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_open'];?>" alt="Photo"><br>
                <?php else:?>
                <div class="row">
                  <div class="col-md-6">
                  <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_open'];?>" alt="Photo"><br>
                  </div>
                  <div class="col-md-6">
                  <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_close'];?>" alt="Photo"><br>
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
                <?php if($work['work_id']==$c['comment_work_id']): ?>
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
                    <input type="hidden" name="comment_work_id" value="<?=$work['work_id']?>">
                    <input type="hidden" name="comment_user_id" value="<?=$userData['user_id']?>">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
	</div>