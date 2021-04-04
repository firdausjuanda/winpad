
    <p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    <p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
		<div class="col-md-12">
			<a href="<?= base_url('work/detail_work/').$this_work['work_id']; ?>" class="btn btn-default mb-2"><i class="fa fa-arrow-left"></i></a>
      <a href="<?= base_url('permit/new_permit/').$this_work['work_id'];?>" class="btn btn-primary mb-2" ><i class="fa fa-plus"></i> Add Permit</a>

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><?= $this_work['work_title'];?> di <?= $this_work['work_area'];?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
				<?php if($this_work_permit!=null): ?>
				  <?php	foreach( $this_work_permit as $mp) :?>
                  <tr>
					<td class="mailbox-date"><?= $mp['permit_date'];?></td>
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
                    <td class="mailbox-star"><a href="#"><?= number_format($mp['permit_no']);?></a></td>
                    <td class="mailbox-name"><a href="#"><?= $mp['permit_user'];?> (<?= $mp['permit_company'];?>)</a></td>
                    <td class="mailbox-subject"><?= $mp['permit_description'];?></td>
                    <td class="mailbox-attachment"></td>
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