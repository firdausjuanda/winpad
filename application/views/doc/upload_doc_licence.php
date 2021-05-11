

    <div class="mb-2">
        <div class="col-12">
            <a class="btn btn-default" href="<?= base_url('permit'); ?>"> <i class="fa fa-arrow-left"></i> </a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Upload Document</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <?php $action = base_url('docline/upload_licence_doc/').$this_licence['licence_id']; ?>
            <?php echo form_open_multipart($action);?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="licence_company">Company</label>
                                <input class="form-control" required value="<?= $this_licence['licence_company'];?>" type="text" name="licence_company" readonly>
                            </div>
                            <div class="form-group">
                                <label for="licence_name">Licence Name</label>
                                <input class="form-control" required value="<?= $this_licence['licence_name'];?>" type="text" name="licence_name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="licence_no">Licence Number</label>
                                <input class="form-control" required value="<?= $this_licence['licence_no'];?>" type="text" name="licence_no" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="licence_start_date">Licence Name</label>
                                <input class="form-control" required value="<?= $this_licence['licence_start_date'];?>" type="text" name="licence_start_date" readonly>
                            </div>
                            <div class="form-group">
                                <label for="licence_expire_date">Licence Name</label>
                                <input class="form-control" required value="<?= $this_licence['licence_expire_date'];?>" type="text" name="licence_expire_date" readonly>
                            </div>
                            <label for="licence_no">Document</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input" name="upload_licence_doc" required id="licence_attach">
                                    <label class="custom-file-label" for="licence_attach">Upload Doc (pdf)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="licence_id" value="<?= $this_licence['licence_id'];?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>