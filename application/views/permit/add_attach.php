

    <div class="mb-2">
        <div class="col-12">
            <a class="btn btn-default" href="<?= base_url('permit'); ?>"> <i class="fa fa-arrow-left"></i> </a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Input attachment</h3>
            </div>
            <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
            <?php $action = base_url('permit/add_attach/').$workData['permit_id']; ?>
            <?php echo form_open_multipart($action);?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="permit_area">Category</label>
                                <input class="form-control" required value="<?= $workData['permit_category'];?>" type="text" name="permit_category" readonly>
                            </div>
                            <div class="form-group">
                                <label for="permit_area">Area</label>
                                <input class="form-control" required value="<?= $workData['permit_area'];?>" type="text" name="permit_area" readonly>
                            </div>

                            <div class="form-group">
                                <label for="permit_title">Title</label>
                                <input class="form-control" required value="<?= $workData['permit_title'];?>" type="text" name="permit_title" readonly>
                            </div>

                            <div class="form-group">
                                <label for="permit_description">Work Description</label>
                                <input class="form-control" required value="<?= $workData['permit_description'];?>" type="text" name="permit_description" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permit_title">Acknowledged by</label>
                                <input class="form-control" required type="text" name="permit_giver" placeholder="Permit giver">
                            </div>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input" name="permit_attach" required id="permit_attach">
                                    <label class="custom-file-label" for="permit_attach">Add Attachment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="permit_id" value="<?= $workData['permit_id'];?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>