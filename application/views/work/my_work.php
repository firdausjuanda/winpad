
		<div class="col-md-12">    
		<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
		<?php if($title=='My Work'):?>
		<a href="<?= base_url('work/my_all_work') ;?>" class="btn btn-default mb-2">All Work</a>
		<a href="<?= base_url('work/my_prog_work') ;?>" class="btn btn-default mb-2">In Progress</a>
		<?php if($userData['user_role']== 0):?>
      	<a href="<?= base_url('work/release_work');?>" class="btn btn-success btn-mute mb-2" ><i class="fa fa-check"></i> Release All</a>
		<?php else:?>
		<?php endif;?>
		<?php elseif($title=='My All Work'):?>
		<a href="<?= base_url('work/my_work') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<?php else:?>
		<a href="<?= base_url('work') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<?php if($userData['user_role']== 0):?>
		<a href="<?= base_url('work/complete_work');?>" class="btn btn-info btn-mute mb-2" ><i class="fa fa-check"></i> Complete All</a>
		<?php else:?>
		<?php endif;?>
		<?php endif;?>
          <div class="card card-default card-outline">
            <div class="card-header">
              <h3 class="card-title"><?= $title;?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
              </div>
              <div style="min-height: 400px;" class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody >
                    <?php if($my_permit!=null): ?>
                      <?php	foreach( $my_permit as $mp) :?>
                        <tr>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['work_date_open']),'j M y');?></td>
							<td class="mailbox-star"><a href="#" class="badge 
							<?php 
								if($mp['work_status']=='OPN')
								{
								echo "badge-danger";
								}
								elseif($mp['work_status']=='COM')
								{
								echo "badge-info";
								}
								elseif($mp['work_status']=='CLS')
								{
								echo "badge-light";
								}
								else
								{
								echo "badge-secondary";
								}
							?>"><?= $mp['work_status'];?></a></td>
							<td class="mailbox-star"><a style="color: #000;" href="#"><?= number_format($mp['work_id']);?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['work_user'];?> (<?= $mp['work_company'];?>)</a></td>
							<td class="mailbox-subject"><?= $mp['work_area'];?></td>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['work_id']?>"><?= $mp['work_title'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['work_id']?>"><?= $mp['work_description'];?></td></a>
							<td class="mailbox-attachment">
							<!-- <div class="btn-group">
								<button style="color: <?php if($mp['work_status']=='OPN'){echo 'red';}elseif($mp['work_status']=='COM'){echo 'skyblue';}else{echo 'green';}?>;" class="btn btn-default"><i class="fa <?php if($mp['work_status']=='OPN'){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
									<div class="dropdown-menu" role="menu">
										<?php if($mp['work_status']=='OPN'):?>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['work_id'];?>">Add Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['work_id'];?>">Delete Permit</a>
										<?php else:?>
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['work_status'];?>">See Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['work_id'];?>">Change Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['work_id'];?>">Delete Permit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['work_id'];?>">Mark Complete</a>
										<?php endif;?>
									</div>
							</div> -->
							</td>
						</tr>
                      <?php endforeach;?>
                              <?php else:?>
                      <tr>
                        <td>No <?=$title;?> </td>
                      </tr>
                      <?php endif;?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->
        </div>

<!-- MODAL -->
		<div class="modal fade" id="modal-add-attach">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
					<h4 class="modal-title">Extra Large Modal</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<div class="modal-body">
					<p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			<!-- /.modal-content -->
			</div>
        <!-- /.modal-dialog -->
      	</div>
