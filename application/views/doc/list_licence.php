
		<div class="col-md-12">    
		<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
		<a href="<?= base_url('docline') ;?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"> </i></a>
		<a href="<?= base_url('docline/add_licence/') ;?>" class="btn btn-secondary mb-2"> Add Licence</a>
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
                    <?php if($all_licence!=null): ?>
                    <thead>
				  	    <tr>
                            <td><strong>No</strong></td>
                            <td><strong>Created</strong></td>
                            <td><strong>Company</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Category</strong></td>
                            <td><strong>Licenced by</strong></td>
                            <td><strong>Licence No</strong></td>
                            <td><strong>Start</strong></td>
                            <td><strong>Expire</strong></td>
                            <td><strong>Person Holder</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>User</strong></td>
                            <td></td>
                        </tr>
				    </thead>
                    <?php $i = 1; ?>
                      <?php	foreach( $all_licence as $mp) :?>
                        
                        <tr>
							<td class="mailbox-date"><?= $i;?></td>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['user_date_created']),'j M y');?></td>
							<td class="mailbox-star"><a style="color: #000;" href="#"><?= $mp['licence_company'];?></a></td>
							<td class="mailbox-star"><a style="color: #000;" href="#"><?= $mp['licence_name'];?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['licence_category'];?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['licence_by'];?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['licence_no'];?></a></td>
							<td class="mailbox-subject"><?= $mp['licence_start_date'];?></td>
							<td class="mailbox-subject"><?= $mp['licence_expire_date'];?></td>
							<td class="mailbox-subject"><a style="color: #000;" href="#"><?= $mp['licence_person'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="#"><?= $mp['licence_note'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="#"><?= $mp['user_username'];?></td></a>
							<td class="mailbox-attachment">
							<div class="btn-group">
								<button style="color: <?php if($mp['licence_doc']==null){echo 'red';}elseif($mp['licence_doc']==1){echo 'green';}?>;" class="btn btn-default"><i class="fa <?php if($mp['licence_doc']==null){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
									<div class="dropdown-menu" role="menu">
                                        <?php if($mp['licence_doc']==null):?>
										<a class="dropdown-item" href="<?= base_url('docline/upload_doc/').$mp['licence_id'];?>">Upload doc</a>
                                        <a class="dropdown-item" href="<?= base_url('docline/licence_edit/').$mp['licence_id'];?>">Edit</a>
                                        <a class="dropdown-item" href="<?= base_url('docline/licence_delete/').$mp['licence_id'];?>">Delete</a>
										<?php else:?>
										<a target="_blank" class="dropdown-item" href="<?= base_url('assets/doc/licence/').$mp['licence_doc'];?>">See Doc</a>
                                        <a class="dropdown-item" href="<?= base_url('docline/licence_edit/').$mp['licence_id'];?>">Edit</a>
                                        <a class="dropdown-item" href="<?= base_url('docline/licence_delete/').$mp['licence_id'];?>">Delete</a>
										<?php endif;?>
									</div>
							</div>
							</td>
						</tr>
                        <?php $i++;?>
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
