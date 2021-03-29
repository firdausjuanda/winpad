
    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-primary" href="<?= base_url('work') ?>">Back</a>
		</div>
	</div>
    <br>
    
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Input new Work</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <?php echo form_open_multipart('work/new_work');?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="work_date_open">Date</label>
                        <input class="form-control" type="date" name="work_date_open" value="<?= form_error('work_date_open');?>" placeholder="Date">
                    </div>

                    <div class="form-group">
                        <label for="work_area">Area</label>
                        <select class="form-control" name="work_area" name="work_area">
                            <option value="">-Select area-</option>
                            <option value="Factory">Factory</option>
                            <option value="Utility">Utility</option>
                            <option value="Production">Production</option>
                            <option value="Office">Office</option>
                            <option value="WB">Weight Bridge</option>
                            <option value="Store">Store</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Tank Farm">Tank Farm</option>
                            <option value="Shipping">Shipping</option>
                            <option value="MBA">MBA</option>
                            <option value="TBBT">TBBT</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="work_exact_place">Exact place</label>
                        <input class="form-control" type="text" name="work_exact_place" placeholder="Exact place">  
                    </div>

                    <div class="form-group">
                        <label for="work_title">Title</label>
                        <input class="form-control"  type="text" name="work_title" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="work_description">Desciption</label>
                        <textarea class="form-control"  type="text" name="work_description" placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="work_img_open">Post Current Picture</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="work_img_open" id="work_img_open">
                                <label class="custom-file-label" for="work_img_open">Browse file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="work_user" value="<?= $userData['user_username'];?>" placeholder="User">
                    
                    <input type="hidden" name="work_company" value="<?= $userData['user_company'];?>" placeholder="Company">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>