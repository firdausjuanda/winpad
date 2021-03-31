<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title;?></title>
</head>
<body>
	<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
	<br>
	<a class="btn btn-primary m-2" href="<?= base_url('new_permit/new_permit/').$work['work_id']; ?>">Add New Permit</a>
	<a class="btn btn-primary m-2" href="<?= base_url('my_permit/this_work_permit/').$work['work_id']; ?>">See This Work Permit</a>

	<a class="btn btn-primary m-2" href="<?= base_url('work'); ?>">Back</a>
</body>
</html>

<div class="row">
	<div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user1-128x128.jpg';?>" alt="User Image">
                  <span class="username"><a href="#"><?= $work['work_user'];?> (<?= $work['work_company'];?>)</a></span>
                  <span class="description"><?= $work['work_status'];?> | Start at: <?= $work['work_date_open'];?> | Created at: <?= $work['work_date_created'];?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  	<p class="mb-2" ><?= $work['work_title'];?></p>
                <a href="<?= base_url('work/detail_work/').$work['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/img_open/').$work['work_img_open'];?>" alt="Photo"></a><br>
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user3-128x128.jpg';?>" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user4-128x128.jpg';?>" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user4-128x128.jpg';?>" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
	</div>