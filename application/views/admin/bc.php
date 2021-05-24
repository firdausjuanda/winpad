
    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-default" href="<?= base_url('admin'); ?>"> <i class="fa fa-arrow-left"></i> </a>
		</div>
	</div>
    <br>
    
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Broadcast</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <form action="<?= base_url('bc');?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bc_title">Title</label>
                                <input class="form-control" type="text" required name="bc_title" value="<?= $bc['bc_title'];?>" placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="bc_message">Message</label>
                                <textarea class="form-control" required rows="3" type="text" name="bc_message" placeholder="Message"><?= $bc['bc_message'];?></textarea>
                            </div>

							<div class="form-group">
								<div class="custom-control custom-switch">
								<input type="checkbox" <?php if($bc['bc_displayed'] == 'true'){ echo 'checked';}else{}?> value=true name="bc_displayed" class="custom-control-input" id="customSwitch1">
								<label class="custom-control-label" for="customSwitch1">Display in workline</label>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
	<script src="<?= base_url('assets/vendor/admin-lte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<script>
	$(function () {
	bsCustomFileInput.init();
	});
	</script>
