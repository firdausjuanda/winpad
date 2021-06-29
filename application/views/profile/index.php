<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>    


<h5 style="color: red;"><?php echo validation_errors(); ?></h5>
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
								<?php if($userData['user_company']==null): ?>
									<h6><a href="<?= base_url('company/'); ?>">Search Company</a></h6>
								<?php else: ?>
									<h6>Working at <a href="<?= base_url('company/c/').$userDataCompany['company_code']; ?>" class="mb-10" ><?= $userDataCompany['company_name'] ?></a></h6>
								<?php endif;?>
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
									<li class="list-group-item">
										
										<div class="form-group  m-0 mt-1">
											<form action="<?= base_url('profile/dark_mode');?>" method="post" id="changeDark">
												<input type="hidden" name="user_id" value="<?= $userData['user_id']; ?>">
												<div class="custom-control custom-switch">
													<label class="custom-control-label" for="customSwitch1">Dark mode</label>
													<input type="checkbox" <?php if($userData['user_dark'] == '1'){ echo 'checked';}else{}?> value=1 name="user_dark" class="custom-control-input float-right" onchange="changeDark.submit()" id="customSwitch1">
												<!-- <label class="custom-control-label" for="customSwitch1">Dark mode</label> -->
												</div>
											</form>
										</div>
									</li>	
                </ul>
								<div class="row">
									<div class="col-md-6">
										<a href="#" class="btn btn-default btn-block mb-1"><b>Change Profile</b></a>
									</div>
									<div class="col-md-6">
										<a href="<?= base_url('company/create_company')?>" class="btn btn-default btn-block mb-1"><b>Create Company</b></a>
									</div>
								</div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-pills">
                  <li class="nav-item">Edit Profile</li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <form class="form-horizontal"  method="post" action="<?= base_url('profile/edit_profile/').$userData['user_id'];?>">
                      <div class="form-group row">
                        <label for="user_username" class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                          <input type="text" required class="form-control" name="user_username" value="<?= $userData['user_username'];?>" readonly placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_firstname" class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                          <input type="text" required class="form-control" name="user_firstname" value="<?= $userData['user_firstname'];?>" placeholder="First Name">
                        </div>
                      </div><div class="form-group row">
                        <label for="user_lastname" class="col-sm-4 col-form-label">Last Name</label>
                        <div class="col-sm-8">
                          <input type="text" required class="form-control" name="user_lastname" value="<?= $userData['user_lastname'];?>" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email" required class="form-control" name="user_email" value="<?= $userData['user_email'];?>" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_phone" class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                          <input type="number" required minlength="0" maxlength="12" class="form-control" name="user_phone" value="<?= $userData['user_phone'];?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_company" class="col-sm-4 col-form-label">Company</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" value="<?php if($userData['user_company']==null){echo 'You are not joined in any company yet'; }else{echo $userDataCompany['company_name'].', '.$userDataCompany['company_location'];}?>" readonly placeholder="Name">
                        </div>
                      </div><div class="form-group row">
                        <label for="user_dept" class="col-sm-4 col-form-label">Department</label>
                        <div class="col-sm-8">
                        <select class="form-control" required name="user_dept" name="user_dept">
                            <?php if($userData['user_dept']==null):?>
                            <option value="">-Select Department-</option>
                            <?php else:?>
                            <option value="<?= $userData['user_dept']?>"><?= $userDataDept['dept_name']?> (current)</option>
                            <?php endif;?>
														<?php foreach($userDataDeptByCompany as $val): ?>
                            <option value="<?= $val['dept_id']; ?>"><?= $val['dept_name']; ?></option>
														<?php endforeach;?>
                        </select>

                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-4 col-sm-8">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
