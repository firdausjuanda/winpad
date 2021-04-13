
	<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
 
<div class="row">
              
	<div class="col-md-12">
      <?php $path = 'work/complete_work/'.$work['work_id'];?>
      <?= form_open_multipart($path);?>
        <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <a class="btn btn-default mb-2" href="<?= base_url('work/detail_work/').$work['work_id']; ?>"><i class="fa fa-arrow-left"></i></a>
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="<?= base_url('assets/vendor/admin-lte/').'/dist/img/user1-128x128.jpg';?>" alt="User Image">
                  <span class="username"><a href="#" style="color: black;" ><?= $work['work_user'];?> (<?= $work['work_company'];?>)</a></span>
                  <span class="description"><?= $work['work_area'];?> | Start work: <?= date_format(date_create($work['work_date_open']),"j M y");?> | Created : <?= date_format(date_create($work['work_date_created']),'j M y (H:i)');?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <strong><p class="mb-0"><span class="badge badge-success">Title:</span> <?= $work['work_title'];?></p></strong>
			  	      <p class="mb-2" ><span class="badge badge-success">Analysis:</span> <?= $work['work_description'];?></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                            Initial Picture
                            </div>
                            <div class="card-body p-0">
                            <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_open'];?>" alt="Photo">  
                            </div>
                        </div>
                        </div>
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                            Final Picture
                            </div>
                            <?php if(!$work['work_img_close']):?>
                            <?php else:?>
                                <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_close'];?>" alt="Photo">
                            <?php endif?>
                            <div class="card-body p-0">
                                <div class="input-group m-5" style="width: 75%;">
                                    <div class="custom-file">
                                        <input  type="file" class="custom-file-input" name="work_img_close" required id="work_img_close">
                                        <label class="custom-file-label" for="work_img_close">Add Picture</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="work_id" value="<?= $work['work_id'];?>">
                        <input type="hidden" name="work_date_open" value="<?= $work['work_date_open'];?>">
                        <input type="hidden" name="work_area" value="<?= $work['work_area'];?>">
                        <input type="hidden" name="work_title" value="<?= $work['work_title'];?>">
                        <input type="hidden" name="work_user" value="<?= $work['work_user'];?>">
                        <input type="hidden" name="work_company" value="<?= $work['work_company'];?>">
                        
                        
                    </div>
                </div>
                <div class="col-md-12 float-left callout callout-danger">
                    <h5>Warning!</h5>
                    <p>Once you complete this work, you cannot reverse anything.</p>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  
                  <!-- /.comment-text -->
                </div>
                
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                  <div class="img-push">
                    <button type="sumbit" class="form-control btn btn-success btn-sm">Complete this work</button>
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
	</div>