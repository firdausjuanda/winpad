
    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-default" href="<?= base_url('work/detail_work/').$workData['work_id']; ?>"> <i class="fa fa-arrow-left"></i> </a>
		</div>
	</div>
    <br>
    
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Input new Permit</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <form action="<?=$workData['work_id'];?>" method="post">
                <div class="card-body">

                    <div class="form-group">
                        <label for="permit_date">Work Date</label>
                        <input class="form-control" type="date" required name="permit_date" value="<?= form_error('permit_date');?>" placeholder="Permit Date">
                    </div>

                    <div class="form-group">
                        <label for="permit_category">Category</label>
                        <select class="form-control" required name="permit_category" name="permit_category">
                            <option value="">(Select Permit Permit Cetegory)</option>
                            <option value="HOWP">Hot Work Permit</option>
                            <option value="COWP">Cold Work Permit</option>
                            <option value="WAHP">Work at Height Permit</option>
                            <option value="LOWP">LOTO Work Permit</option>
                            <option value="EXWP">Excapation Work Permit</option>
                            <option value="DIWP">Dig Work Permit</option>
                            <option value="HWP">Hot Work Permit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="permit_no">Permit Serial Number</label>
                        <input class="form-control" required type="number" min=0 name="permit_no" placeholder="Serial Number">  
                    </div>

                    <div class="form-group">
                        <label for="permit_area">Area</label>
                        <input class="form-control" required value="<?= $workData['work_area'];?>" type="text" name="permit_area" readonly>
                    </div>

                    <div class="form-group">
                        <label for="permit_title">Title</label>
                        <input class="form-control" required value="<?= $workData['work_title'];?>" type="text" name="permit_title" readonly>
                    </div>

                    <div class="form-group">
                        <label for="permit_description">Desciption</label>
                        <textarea class="form-control" required type="text" name="permit_description" placeholder="Description"></textarea>
                    </div>

                    <input type="hidden" name="permit_user" value="<?= $userData['user_username'];?>">
                    
                    <input type="hidden" name="permit_company" value="<?= $userData['user_company'];?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>