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
<hr class="m-0 mb-2">
		<?php if($my_permit!=null): ?>
				<?php	foreach( $my_permit as $mp) :?>
				<div class="col-md-12 p-0">
					<div class="p-1">
						<div class="row" style="border-radius: 5px">
							<div class="pl-2 p-1" style="width: 20%;">	
								<?= date_format(date_create($mp['permit_date']),'j M y');?> <br>
								<a href="#" class="badge 
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
								"><?= $mp['permit_status'];?></a> 
								
								<?php if($title=='Unreleased Permit'||'This Work Permit'):?>
									<a style="color: <?php if($mp['permit_attach_status']==0){echo 'red';}elseif($mp['permit_attach_status']==1){echo 'green';}else{echo 'blue';}?>;"class="badge badge-sm"><i class="fa <?php if($mp['permit_attach_status']==0){echo 'fa-times';}else{echo 'fa-check';}?>"></i></a>
								<?php elseif($title=='In Progress Permit'):?>
									<a style="color: <?php if($mp['permit_attach_status']==1){echo 'red';}else{echo 'green';}?>;"class="badge badge-sm"><i class="fa <?php if($mp['permit_attach_status']==1){echo 'fa-times';}else{echo 'fa-check';}?>"></i></a>
								<?php endif;?>

								<br>
								<a href="#" class="badge 
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
								?>"><?= $mp['permit_category'];?></a> <?= $mp['permit_no'];?><br>
							</div>
							<div class="p-1" style="width: 55%;">
								<strong><a href="#"><?= $mp['permit_user'];?>(<?= $mp['permit_company'];?>)</a> - <a style="text-decoration: none;" href="<?= base_url('work/detail_work/').$mp['permit_work_id']?>"><?= $mp['permit_title'];?></a></strong>
								<br>
								<p style="font-size: 12px; color:grey; margin:0px; padding:0px;"> <a href="#" class='badge badge-sm badge-dark'>Description:</a> <?= $mp['permit_description'];?></p>								
								<p style="font-size: 12px; color:grey; margin:0px; padding:0px;"> <a href="#" class='badge badge-sm badge-dark'> <?= $mp['work_area'];?></a> <?php $giver = $mp['permit_giver']; if ($mp['permit_giver']) { echo "permit given by $giver"; } else { echo 'No one'; } ?></p>								
								<p style="font-size: 12px; color:grey; margin:0px; padding:0px;"> <a href="#" class='badge badge-sm badge-dark'> Tools:</a> <?= $mp['permit_tools'];?></p>
								<p style="font-size: 12px; color:grey; margin:0px; padding:0px;"> <a href="#" class='badge badge-sm badge-dark'> Safety Eq:</a> <?= $mp['permit_apd'];?></p>
							</div>

							<!-- Picture section -->
							<div class="p-1 text-center" style="width: 20%;">
								<?php if($mp['permit_status'] == 'OPN'): ?>
								
								<?php else: ?>
									<?php if($mp['permit_complete_pic'] == null ): ?>
										<a href="#"><img style="width:60px; height:60px; border-radius:5px" src="<?php echo base_url().'assets/img/logo/no-img.jpg';?>"></a>
									<?php else: ?>
										<a target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>"><img style="width:60px; height:60px; border-radius:5px" src="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>"></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							
							<!-- Toggle section -->
							<div class="p-2 text-center" style="width: 5%;">
								<a data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a>
								<?php if($title=='Unreleased Permit'):?>
							<div class="dropdown-menu" role="menu">
							<?php if($mp['work_company'] != $userData['user_company']):?>
								<?php if($mp['permit_attach_status']==1):?>
									<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
								<?php elseif($mp['permit_attach_status']==2):?>
									<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>">See Picture</a>
									<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
								<?php else:?>
								<?php endif;?>
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
									<div class="dropdown-menu" role="menu">
									<?php if($mp['permit_attach_status']==1):?>
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
									<?php elseif($mp['permit_attach_status']==2):?>
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit_complete/').$mp['permit_complete_pic'];?>">See Picture</a>
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
									<?php else:?>
									<?php endif;?>
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
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
									<?php else:?>
										<a class="dropdown-item" href="<?= base_url('permit/add_complete_pic/').$mp['permit_id'];?>">Add Picture</a>
									<?php endif;?>
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
						</div>
						<hr class="m-0">
					</div>
				</div>
				<?php endforeach;?>
				<?php else:?>
					<h6><?=$title;?> is not available</h6> 
				<?php endif;?>
				</div>


