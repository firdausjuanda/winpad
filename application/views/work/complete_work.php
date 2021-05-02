
	<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
 
<div class="row">
              
	<div class="col-md-12">
        <?php $path = 'work/upload_work_img_close/'.$work['work_id'];?>
        <?= form_open_multipart($path);?>
        <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <a class="btn btn-default mb-2" href="<?= base_url('work/detail_work/').$work['work_id']; ?>"><i class="fa fa-arrow-left"></i></a>
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                <div class="user-block">
                  <img class="img-circle" src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>" alt="User Image">
                  <span class="username" ><a style="color: black;" href="#"><?= $work['work_user'];?> (<?= $work['work_company'];?>)</a></span>
                  <span class="description"><span class="badge <?php $status = $work['work_status']; if($status == 'OPN'){ echo 'badge-danger'; }else{echo 'badge-success';} ?> "><?= $work['work_status'];?></span> | <?= $work['work_area'];?> | Start work: <?= date_format(date_create($work['work_date_open']),"j M y");?> | Created : <?= date_format(date_create($work['work_date_created']),'j M y (H:i)');?></span>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <strong><p class="mb-0"><span class="badge badge-success">Work ID:</span> <?= $work['work_id'];?></p></strong>
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
                              <div class="card-body p-0">
                                <div class="input-group m-5" style="width: 75%;">
                                    <div class="custom-file">
                                        <input  type="file" class="custom-file-input" name="work_img_close" required id="work_img_close">
                                        <label class="custom-file-label" for="work_img_close">Add Picture</label>
                                    </div>
                                    <button  type="submit" class="btn btn-primary ml-2" class="custom-file-input">Upload</button>

                                </div>
                              </div>
                            <?php else:?>
                                <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/work/').$work['work_img_close'];?>" alt="Photo">
                                <?php if($work['work_status']=='OPN'):?>
                                <a class="p-2 btn btn-sm btn-danger" href="<?= base_url('work/delete_img_close/').$work['work_id'];?>">Delete</a>
                              
                                <?php else:?>
                                <?php endif;?>
                            <?php endif?>
                        </div>
                        <input type="hidden" name="work_id" value="<?= $work['work_id'];?>">
                        <input type="hidden" name="work_date_open" value="<?= $work['work_date_open'];?>">
                        <input type="hidden" name="work_area" value="<?= $work['work_area'];?>">
                        <input type="hidden" name="work_title" value="<?= $work['work_title'];?>">
                        <input type="hidden" name="work_user" value="<?= $work['work_user'];?>">
                        <input type="hidden" name="work_company" value="<?= $work['work_company'];?>">
                        <?= form_close();?> 
                    </div>
                </div>
                <?php $path = 'work/upload_work_permit_close/'.$work['work_id'];?>
                <?= form_open_multipart($path);?>
                <div class="row">
                <div class="input-group mb-2">
                  <?php if($work['work_status']=='CLS'):?>
                    <?php if($work['work_close_permit']==null):?>
                    <?php else:?>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                            Closing Permit
                            </div>
                            <div class="card-body p-0">
                            <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/permit_complete_work/').$work['work_close_permit'];?>" alt="Photo">  
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                  <?php else:?>
                  
                    <?php if($work['work_close_permit']==null):?>
                    <div class="custom-file">
                        <input  type="file" class="custom-file-input" style="width: 75%" name="work_close_permit" required id="work_close_permit">
                        <label class="custom-file-label" for="work_close_permit">Add Closing Permit</label>
                    </div>
                    <button  type="submit" class="btn btn-primary ml-2" class="custom-file-input">Upload</button>
                    
                    <?php else:?>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                            Closing Permit
                            </div>
                            <div class="card-body p-0">
                            <img class="img-fluid pad mb-2" style="width: 100%;" src="<?= base_url('assets/img/permit_complete_work/').$work['work_close_permit'];?>" alt="Photo">  
                            </div>
                        </div>
                        <a class="mb-2 btn btn-sm btn-danger btn-block" href="<?= base_url('work/delete_work_close_permit/').$work['work_id'];?>">Delete Permit</a>
                    </div>
                    <?php endif;?>
                    
                    
                  <?php endif;?>
                  <input type="hidden" name="work_id" value="<?= $work['work_id'];?>">
                  <input type="hidden" name="work_date_open" value="<?= $work['work_date_open'];?>">
                  <input type="hidden" name="work_area" value="<?= $work['work_area'];?>">
                  <input type="hidden" name="work_title" value="<?= $work['work_title'];?>">
                  <input type="hidden" name="work_user" value="<?= $work['work_user'];?>">
                  <input type="hidden" name="work_company" value="<?= $work['work_company'];?>">
                  <?= form_close();?>
                </div>
                <!-- <div class="col-md-12 float-left callout callout-danger">
                    <h5>Warning!</h5>
                    <p>Pastikan area kerja sudah bersih dan rapi sebelum melakukan.</p>
                </div> -->
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
                  <?php if($work['work_status']=='CLS'):?>
                    <a href="<?= base_url('work/revise_work/').$work['work_id'];?>" class="btn btn-block btn-default btn-sm">Revise this work</a>
                  <?php else:?>
                    <?php if($work['work_is_revised']==0):?>
                    <a href="<?= base_url('work/close_work/').$work['work_id'];?>" class="btn btn-block btn-success btn-sm">Complete this work</a>
                    <?php else:?>
                    <a href="<?= base_url('work/close_work/').$work['work_id'];?>" class="btn btn-block btn-success btn-sm">Complete this work</a>
                    <?php endif;?>
                  <?php endif;?>
                  </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
	</div>