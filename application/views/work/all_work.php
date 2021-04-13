
<?= $this->session->flashdata('message'); ?>

<div class="row">
  <div class="col-md-7">
	    <a href="<?= base_url('work/new_work') ?>" class="btn btn-default btn-block mb-2"><i class="fas fa-plus"></i>  Create New Work</a>
	<?php foreach( $work as $w) :?>
	<div class="row">
	<div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user1-128x128.jpg';?>" alt="User Image">
                  <span class="username" ><a style="color: black;" href="#"><?= $w['work_user'];?> (<?= $w['work_company'];?>)</a></span>
                  <span class="description"><?= $w['work_area'];?> | Start work: <?= date_format(date_create($w['work_date_open']),"j M y");?> | Created : <?= date_format(date_create($w['work_date_created']),'j M y (H:i)');?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $w['work_title'];?></p></strong>
			  	      <p class="mb-2" ><span class="badge badge-success">Analysis:</span> <?= $w['work_description'];?></p>
                <a href="<?= base_url('work/detail_work/').$w['work_id'];?>"> <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$w['work_img_open'];?>" alt="Photo"></a><br>
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
	<?php endforeach;?>
  </div>
  </div>
			<script>
			$(function () {
				$("#workTable").DataTable({
				"responsive": true, "lengthChange": false, "autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
				$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
				});
			});
			</script>


