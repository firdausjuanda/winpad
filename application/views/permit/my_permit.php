    <p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    <p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
		<div class="col-md-12">
		<a href="<?= base_url('work/detail_work/') ;?>" class="btn btn-default mb-2"><i class="fa fa-list"> </i> All Permit</a>
      	<a href="<?= base_url('permit/new_permit/');?>" class="btn btn-outline-success btn-mute mb-2" ><i class="fa fa-check"></i> Release All</a>

          <div class="card card-default card-outline">
            <div class="card-header">
              <h3 class="card-title">Uncompleted Permits</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php if($my_permit!=null): ?>
                      <?php	foreach( $my_permit as $mp) :?>
                        <tr>
							<td style="width: 10%;" class="mailbox-date"><?= date_format(date_create($mp['permit_date']),'j M y');?></td>
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
							<td class="mailbox-star"><a style="color: #000;" href="#"><?= number_format($mp['permit_no']);?></a></td>
							<td class="mailbox-name"><a style="color: #000;" href="#"><?= $mp['permit_user'];?> (<?= $mp['permit_company'];?>)</a></td>
							<td class="mailbox-subject"><?= $mp['permit_status'];?></td>
							<td class="mailbox-subject"><?= $mp['permit_area'];?></td>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['permit_work_id']?>"><?= $mp['permit_title'];?></td></a>
							<td class="mailbox-subject"><a style="color: #000;" href="<?= base_url('work/detail_work/').$mp['permit_work_id']?>"><?= $mp['permit_description'];?></td></a>
							<td class="mailbox-attachment">
							<div class="btn-group">
								<button style="color: <?php if($mp['permit_attach']==null){echo 'red';}else{echo 'green';}?>;" class="btn btn-default"><i class="fa <?php if($mp['permit_attach']==null){echo 'fa-times';}else{echo 'fa-check';}?>"></i></button>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
									<div class="dropdown-menu" role="menu">
										<?php if($mp['permit_attach']==null):?>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Add Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
										<?php else:?>
										<a class="dropdown-item" target="_blank" href="<?= base_url('assets/img/permit/').$mp['permit_attach'];?>">See Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Change Attachment</a>
										<a class="dropdown-item" href="<?= base_url('permit/delete_permit/').$mp['permit_id'];?>">Delete Permit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('permit/add_attach/').$mp['permit_id'];?>">Mark Complete</a>
										<?php endif;?>
									</div>
							</div>
							</td>
						</tr>
                      <?php endforeach;?>
                              <?php else:?>
                      <tr>
                        <td>No permit yet :(</td>
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
