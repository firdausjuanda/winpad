<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

		<div class="col-md-12">    
		<?php if($title=='My Work'):?>
		<a href="<?= base_url('work/my_all_work') ;?>" class="btn btn-default mb-2">All Work</a>
		<!-- <a href="<?= base_url('work/my_prog_work') ;?>" class="btn btn-default mb-2">In Progress</a> -->
		<?php if($userData['user_role']== 0):?>
      	<!-- <a href="<?= base_url('work/release_work');?>" class="btn btn-success btn-mute mb-2" ><i class="fa fa-check"></i> Release All</a> -->
		<?php else:?>
		<?php endif;?>
		<?php elseif($title=='My All Work'):?>
		<a href="<?= base_url('user') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<?php else:?>
		<a href="<?= base_url('admin') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<?php if($userData['user_role']== 0):?>
		<!-- <a href="<?= base_url('work/complete_work');?>" class="btn btn-info btn-mute mb-2" ><i class="fa fa-check"></i> Complete All</a> -->
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
                    <?php if($allUser!=null): ?>
                      <?php	foreach( $allUser as $mp) :?>
                        <tr>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['user_date_created']),'j M y');?></td>
							<td class="mailbox-star"><a style="color: #000;" href="<?= base_url('profile/user/').$mp['user_username'];?>"><?= number_format($mp['user_id']);?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="<?= base_url('profile/user/').$mp['user_username'];?>"><?= $mp['user_username'];?> (<?= $mp['user_company'];?>)</a></td>
							<td class="mailbox-subject"><?= $mp['user_email'];?></td>
							<td class="mailbox-subject"><?= $mp['user_phone'];?></td>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('profile/user/').$mp['user_username'];?>"><?= $mp['user_firstname'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('profile/user/').$mp['user_username'];?>"><?= $mp['user_lastname'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('profile/user/').$mp['user_username'];?>"><?= $mp['user_dept'];?></td></a>
							<td class="mailbox-subject">
							<?php if($mp['user_status']==1):?>
							<a class="badge badge-default badge-sm">Enabled</a>
							<?php else:?>
							<a class="badge badge-danger badge-sm">Dissabled</a>
							<?php endif;?>
							<?php if($mp['user_role']==1):?>
							<a class="badge badge-success badge-sm">Admin</a>
							<?php else:?>
							<a class="badge badge-default badge-sm">Main</a>
							<?php endif;?>
							<?php if($mp['user_is_manage']==1):?>
							<a class="badge badge-primary badge-sm">Management</a>
							<?php else:?>
							<a class="badge badge-default badge-sm">Default</a>
							<?php endif;?>
							</td>
							<td class="mailbox-attachment">
							<div class="btn-group">
								<button style="color: <?php if($mp['user_status']==0){echo 'red';}elseif($mp['user_status']==1){echo 'green';}?>;" class="btn btn-default"><i class="fa <?php if($mp['user_status']==0){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
									<div class="dropdown-menu" role="menu">
                                        <?php if($mp['user_role']==0):?>
										<a class="dropdown-item" href="<?= base_url('admin/set_admin/').$mp['user_id'];?>">Set as Admin</a>
										<?php else:?>
										<a class="dropdown-item" href="<?= base_url('admin/unset_admin/').$mp['user_id'];?>">Unset from Admin</a>
										<?php endif;?>
                                        <?php if($mp['user_is_manage']==0):?>
                                        <a class="dropdown-item" href="<?= base_url('admin/set_manage/').$mp['user_id'];?>">Set as Management</a>
                                        <?php else:?>
                                        <a class="dropdown-item" href="<?= base_url('admin/unset_manage/').$mp['user_id'];?>">Unset from Management</a>
                                        <?php endif;?>
										<div class="dropdown-divider"></div>
                                        <?php if($mp['user_status']==0):?>
										<a class="dropdown-item" href="<?= base_url('admin/enable_user/').$mp['user_id'];?>">Enable</a>
                                        <?php else:?>
										<a class="dropdown-item" href="<?= base_url('admin/dissable_user/').$mp['user_id'];?>">Dissable</a>
                                        <?php endif;?>
										<a class="dropdown-item" href="<?= base_url('admin/delete_user/').$mp['user_id'];?>">Delete User</a>
										
									</div>
							</div>
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
