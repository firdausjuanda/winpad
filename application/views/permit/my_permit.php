
		<div class="col-md-12">    
		<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    	<p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
		<?php if($title=='Unreleased Permit'):?>
			<a href="<?= base_url('permit/my_all_permit') ;?>" class="btn btn-default mb-2">All Permit</a>
			<a href="<?= base_url('permit/my_prog_permit') ;?>" class="btn btn-default mb-2">In Progress</a>
			<?php if($my_permit==null):?>
			<?php else:?>
				<?php if($userData['user_is_manage']== 1):?>
				<?php elseif($userData['user_role']== 1):?>
				<?php else:?>
				<a href="<?= base_url('permit/release_permit');?>" class="btn btn-success btn-mute mb-2" ><i class="fa fa-check"></i> Release All</a>
				<?php endif;?>
			<?php endif;?>
		<?php elseif($title=='My All Permit'):?>
			<a href="<?= base_url('permit') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<?php elseif($title=='In Progress Permit'):?>
			<a href="<?= base_url('permit') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
			<?php if($userData['user_role']== 0):?>
				<?php if($my_permit==null):?>
				<?php else:?>
					<?php if($userData['user_is_manage']== 1):?>
					<?php elseif($userData['user_role']== 1):?>
					<?php else:?>
					<a href="<?= base_url('permit/complete_permit');?>" class="btn btn-info btn-mute mb-2" ><i class="fa fa-check"></i> Complete All</a>
					<?php endif;?>
				<?php endif;?>
			<?php else:?>
			<?php endif;?>
		<?php elseif($title == 'This Work Permit'):?>
			<a href="<?= base_url('work/detail_work/').$this_work['work_id']; ?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"></i></a>
			<?php if($this_work['work_user']!=$userData['user_username']):?>
			<?php else:?>
      		<a href="<?= base_url('permit/new_permit/').$this_work['work_id'];?>" class="btn btn-outline-primary <?php if($this_work['work_status']=='OPN'){}else{echo 'disabled';}?> btn-mute mb-2" ><i class="fa fa-plus"></i> Add Permit</a>
			<?php endif;?>
    	<?php else:?>
		<?php endif;?>
          <div class="card card-default card-outline">
            <div class="card-header">
              <h3 class="card-title"><?= $title;?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div style="min-height: 400px;" class="table-responsive p-0">
                <table class="table table-hover table-head-fixed">
                    <?php if($my_permit!=null): ?>
					<thead>
				  	<tr>
						<td><strong>Working Date</strong></td>
						<td><strong>Created</strong></td>
						<td><strong>Category</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Permit No</strong></td>
						<td><strong>User(Company)</strong></td>
						<td><strong>Area</strong></td>
						<td><strong>Title</strong></td>
						<td><strong>Description</strong></td>
						<td></td>
					  </tr>
				  </thead>
                  <tbody >
                      <?php	foreach( $my_permit as $mp) :?>
                        <tr>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['permit_date']),'j M y');?></td>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['permit_date_created']),'j M y (H:i)');?></td>
							<td class="mailbox-star"><a href="#" class="badge 
							<?php 
								if($mp['permit_category']=='HOWP')
								{
								echo "badge-danger";
								}
								elseif($mp['permit_category']=='COWP')
								{
								echo "badge-info";
								}
								elseif($mp['permit_category']=='WAHP')
								{
								echo "badge-light";
								}
								else
								{
								echo "badge-secondary";
								}
							?>"><?= $mp['permit_category'];?></a></td>
							<td class="mailbox-star"><a href="#" class="badge 
							<?php 
								if($mp['permit_status']=='OPN')
								{
								echo "badge-danger";
								}
								elseif($mp['permit_status']=='REL')
								{
								echo "badge-success";
								}
								elseif($mp['permit_status']=='CLS')
								{
								echo "badge-light";
								}
								else
								{
								echo "badge-secondary";
								}
							?>
							"><?= $mp['permit_status'];?></a></td>
							<td class="mailbox-star"><a style="color: #000;" href="#"><?= number_format($mp['permit_no']);?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['permit_user'];?> (<?= $mp['permit_company'];?>)</a></td>
							<td class="mailbox-subject"><?= $mp['permit_area'];?></td>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['permit_work_id']?>"><?= $mp['permit_title'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['permit_work_id']?>"><?= $mp['permit_description'];?></td></a>
							<td class="mailbox-attachment">
							
							<div class="btn-group">
								<?php if($title=='Unreleased Permit'||'This Work Permit'):?>
									<button style="color: <?php if($mp['permit_attach_status']==0){echo 'red';}elseif($mp['permit_attach_status']==1){echo 'green';}else{echo 'blue';}?>;" class="btn btn-default"><i class="fa <?php if($mp['permit_attach_status']==0){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<?php elseif($title=='In Progress Permit'):?>
									<button style="color: <?php if($mp['permit_attach_status']==1){echo 'red';}else{echo 'green';}?>;" class="btn btn-default"><i class="fa <?php if($mp['permit_attach_status']==1){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<?php endif;?>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
									<?php if($title=='Unreleased Permit'):?>
									<div class="dropdown-menu" role="menu">
									<?php if($mp['work_company'] != $userData['user_company']):?>
									<?php else:?>
										<?php if($mp['permit_attach']==null):?>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Add Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
										<?php else:?>
											<?php if($mp['work_status']=='OPN'):?>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
												<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Change Attachment</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php else:?>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
											<?php endif;?>
										<?php endif;?>
									<?php endif;?>
									</div>
									<?php elseif($title=='In Progress Permit'):?>
										<?php if($mp['work_company'] != $userData['user_company']):?>
										<?php else:?>
											<div class="dropdown-menu" role="menu">
											<?php if($mp['permit_attach_status']==1):?>
												<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Add Picture</a>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php elseif($mp['permit_attach_status']==2):?>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>">See Picture</a>
												<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Change Picture</a>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
												<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Change Attachment</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php else:?>
											<?php endif;?>
										<?php endif;?>
									</div>
									<?php elseif($title=='This Work Permit'):?>
										<div class="dropdown-menu" role="menu">
										<?php if($mp['permit_attach_status']==0):?>
											<?php if($this_work['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Add Attachment</a>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php endif;?>
										<?php elseif($mp['permit_attach_status']==1):?>
											<?php if($this_work['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Add Picture</a>
											<?php endif;?>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
											<?php if($this_work['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php endif;?>
										<?php elseif($mp['permit_attach_status']==2):?>
											<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>">See Picture</a>
												<?php if($this_work['work_company']!=$userData['user_company']):?>
												<?php else:?>
													<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_attach'];?>">Change Picture</a>
												<?php endif;?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
												<?php if($this_work['work_company']!=$userData['user_company']):?>
												<?php else:?>
													<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Change Attachment</a>
												<?php endif;?>
												<?php if($this_work['work_company']!=$userData['user_company']):?>
												<?php else:?>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
												<?php endif;?>
										<?php else:?>
										<?php endif;?>
										</div>
										<?php elseif($title=='My All Permit'):?>
										<div class="dropdown-menu" role="menu">
										<?php if($mp['permit_attach_status']==0):?>
											<?php if($mp['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Add Attachment</a>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php endif;?>
										<?php elseif($mp['permit_attach_status']==1):?>
											<?php if($mp['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Add Picture</a>
											<?php endif;?>
												<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
											<?php if($mp['work_company']!=$userData['user_company']):?>
											<?php else:?>
												<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
											<?php endif;?>
										<?php elseif($mp['permit_attach_status']==2):?>
											<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>">See Picture</a>
												<?php if($mp['work_company']!=$userData['user_company']):?>
												<?php else:?>
											<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_attach'];?>">Change Picture</a>
												<?php endif;?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
												<?php if($mp['work_company']!=$userData['user_company']):?>
												<?php else:?>
											<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Change Attachment</a>
												<?php endif;?>
												<?php if($mp['work_company']!=$userData['user_company']):?>
												<?php else:?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
												<?php endif;?>
										<?php else:?>
										<?php endif;?>
										</div>
									<?php endif;?>
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
