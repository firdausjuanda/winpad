<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-default" href="<?= base_url('work') ?>"><i class="fa fa-arrow-left"></i></a>
		</div>
	</div>
    <br>
    
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Input new Work</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <?php echo form_open_multipart('work/new_work');?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="work_date_open">Start Date</label>
                                <input class="form-control" required type="date" name="work_date_open" value="<?= form_error('work_date_open');?>" placeholder="Date">
                            </div>
                            <div class="form-group">
                                <label for="work_company">Supply for company</label>
                                <select class="form-control" required name="work_company" name="work_company">
                                    <option value="">-Select Company-</option>
									<?php foreach($companies as $val):?>
										<option value="<?= $val['company_id']; ?>">(<?= $val['company_code'];?>) <?= $val['company_name']; ?>, <?= $val['company_location']; ?></option>
									<?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <label for="work_area">Department</label>
                                <select class="form-control" required name="work_area" name="work_area">
                                    <option value="">-Select area-</option>
                                    <?php foreach($depts as $val):?>
										<option value="<?= $val['dept_id']; ?>">(<?= $val['dept_name'];?>) <?= $val['company_name']; ?>, <?= $val['company_location']; ?></option>
									<?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="work_exact_place">Specific place</label>
                                <input class="form-control" type="text" name="work_exact_place" required value="<?= form_error('work_exact_place');?>" placeholder="Specific place">  
                            </div>

							<div class="form-group">
                                <label for="work_title">Title</label>
                                <input class="form-control"  type="text" name="work_title" required value="<?= form_error('work_title');?>" maxlength="40" placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="work_description">Desciption</label>
                                <textarea class="form-control"  type="text" name="work_description" value="<?= form_error('work_description');?>" placeholder="Description"></textarea>
                            </div>

                        </div>
                        <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="work_img_open">Initial Picture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="work_img_open" required id="work_img_open" onchange="showWork(this); previewWork()">
                                        <label class="custom-file-label" for="work_img_open"><span id="work_img_open_display"> Select a picture ...</span></label>
                                    </div>
                                </div>
                            </div> 
							<img id="frameWork" style="border-radius:20px" src="<?php echo base_url('assets/img/logo/no-img.jpg') ;?>" width="100px" height="100px"/><br>
                            <div class="form-group">
                                <label for="work_jsea">JSEA</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="work_jsea" required id="work_jsea" onchange="showJsea(this); previewJsea()">
                                        <label class="custom-file-label" for="work_jsea"><span id="work_jsea_display"> Select JSEA ..</span></label>
                                    </div>
                                </div>
                            </div>
							<img id="frameJsea" style="border-radius:20px" src="<?php echo base_url('assets/img/logo/no-img.jpg') ;?>" width="100px" height="100px"/>
                        </div>
                    </div>

                    <input type="hidden" name="work_user" value="<?= $userData['user_username'];?>" placeholder="User">
                    
                    <input type="hidden" name="work_vendor" value="<?= $userData['user_company'];?>" placeholder="Company">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript">
    function showWork(input) {
        var fileName = input.files[0].name;
        var filename = fileName;  
		document.getElementById("work_img_open_display").innerHTML = fileName;             
    }

    function showJsea(input) {
        var fileName = input.files[0].name;
        var filename = fileName;  
		document.getElementById("work_jsea_display").innerHTML = fileName;             
    }

	function previewWork() {
    frameWork.src=URL.createObjectURL(event.target.files[0]);
	}

	function previewJsea() {
    frameJsea.src=URL.createObjectURL(event.target.files[0]);
	}
</script>
