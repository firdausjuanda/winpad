    
<h5 style="color: red;"><?php echo validation_errors(); ?></h5>
<p style="color: red;"><?= $this->session->flashdata('message'); ?></p>
    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $userData['user_firstname']?> <?= $userData['user_lastname']?></h3>

                <p class="text-muted text-center"><?= $userData['user_username'];?> (<?= $userData['user_email'];?>)</p>
                <p class="text-muted text-center"><?= $userData['user_dept'];?> (<?= $userData['user_company'];?>)</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total Works</b> <a class="float-right"><?php if($count_user_work==null){Echo "No work yet";}else{echo number_format($count_user_work);};?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Permits</b> <a class="float-right"><?php if($count_user_permit==null){Echo "No permit yet";}else{echo number_format($count_user_permit);};?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Comments</b> <a class="float-right"><?php if($count_user_comment==null){Echo "No comment yet";}else{echo number_format($count_user_comment);};?></a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Change Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-pills">
                  <li class="nav-item">Detail Profile</li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                      <div class="form-group row">
                        <label for="user_username" class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                          <input type="text" style="background-color: white;" readonly class="form-control" name="user_username" value="<?= $userData['user_username'];?>" readonly placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_firstname" class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                          <input type="text" readonly style="background-color: white;" class="form-control" name="user_firstname" value="<?= $userData['user_firstname'];?>" placeholder="First Name">
                        </div>
                      </div><div class="form-group row">
                        <label for="user_lastname" class="col-sm-4 col-form-label">Last Name</label>
                        <div class="col-sm-8">
                          <input type="text" readonly style="background-color: white;" class="form-control" name="user_lastname" value="<?= $userData['user_lastname'];?>" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email" readonly style="background-color: white;" class="form-control" name="user_email" value="<?= $userData['user_email'];?>" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_phone" class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                          <input type="number" readonly style="background-color: white;" minlength="0" maxlength="12" class="form-control" name="user_phone" value="<?= $userData['user_phone'];?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_company" class="col-sm-4 col-form-label">Company</label>
                        <div class="col-sm-8">
                          <input type="text" readonly style="background-color: white;" class="form-control" name="user_company" value="<?= $userData['user_company'];?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_company" class="col-sm-4 col-form-label">Department</label>
                        <div class="col-sm-8">
                          <input type="text" readonly style="background-color: white;" class="form-control" name="user_dept" value="<?= $userData['user_dept'];?>" readonly placeholder="Dept">
                        </div>
                      </div>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>