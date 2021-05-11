
    <div class="mb-2">
		<div class="col-12">
			<a class="btn btn-default" href="<?= base_url('docline/licence')?>"> <i class="fa fa-arrow-left"></i> </a>
		</div>
	</div>
    <br>
    
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><?= $title;?></h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <form action="<?= base_url('docline/licence_edit/').$this_licence['licence_id'];?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="licence_name">Licence Name</label>
                                <input class="form-control" type="text" required name="licence_name" value="<?= $this_licence['licence_name'];?>"  placeholder="Licence Name">
                            </div>

                            <div class="form-group">
                                <label for="licence_no">Licence Number</label>
                                <input class="form-control" type="text" required name="licence_no" value="<?= $this_licence['licence_no'];?>" placeholder="Licence Number">
                            </div>

                            <div class="form-group">
                                <label for="licence_category">Category</label>
                                <select class="form-control" required name="licence_category" name="licence_category">
                                    <option value="<?= $this_licence['licence_category'];?>"><?= $this_licence['licence_category'];?></option>
                                    <option value="">(Select Category)</option>
                                    <option value="Licence">Izin</option>
                                    <option value="Certificate">Sertifikat</option>
                                    <option value="Certificate">Pengujian</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="licence_company">Company</label>
                                <select class="form-control" required name="licence_company" name="licence_company">
                                    <option value="<?= $this_licence['licence_id'];?>"><?= $this_licence['licence_company'];?></option>
                                    <option value="">(Select Company)</option>
                                    <option value="NI74">WINA Padang</option>
                                    <option value="UI71">UIP</option>
                                    <option value="TB71">TBBT</option>
                                    <option value="WC70">WCI</option>
                                    <option value="NI70">WINA Bengkulu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="licence_by">Licenced by</label>
                                <input class="form-control" required type="text" value="<?= $this_licence['licence_by'];?>" name="licence_by" placeholder="Licenced by">  
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="licence_start_date">Start Date</label>
                                <input class="form-control" required type="date" value="<?= $this_licence['licence_start_date'];?>" name="licence_start_date" placeholder="Stat Date">  
                            </div>
                            <div class="form-group">
                                <label for="licence_expire_date">Expire Date</label>
                                <input class="form-control" required type="date" value="<?= $this_licence['licence_expire_date'];?>" name="licence_expire_date" placeholder="Expire Date">  
                            </div>
                            <div class="form-group">
                                <label for="licence_person">Person licenced (Optional)</label>
                                <input class="form-control" type="text" name="licence_person" value="<?= $this_licence['licence_person'];?>" placeholder="Person holder" >
                            </div>

                            <div class="form-group">
                                <label for="licence_note">Notes</label>
                                <textarea class="form-control" type="text" name="licence_note" value="<?= $this_licence['licence_note'];?>" placeholder="Notes"></textarea>
                            </div>
                        </div>
                    </div>
                
                    <input type="hidden" name="licence_user_id" value="<?= $userData['user_id'];?>">
                    <input type="hidden" name="licence_id" value="<?= $this_licence['licence_id'];?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

