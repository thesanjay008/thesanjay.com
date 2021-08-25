    <section class="content-header">
      <h1>Edit User</h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> <b>Users</b></a></li>
        <li class="active">Edit User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php if($feedback= $this->session->flashdata('feedback')): $feedback_class=$this->session->flashdata('feedback_class'); ?>
          <div class="col-md-6 col-lg-offset-3">
            <div class="alert alert-dismissible <?= $feedback_class; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?= $feedback; ?>
            </div>
          </div>
          <?php endif ?>
        </div>
        <div class="col-md-3">
          <?php echo form_open_multipart ('admin/update_user'); ?>
            <div class="box box-primary">
              <div class="box-body box-profile">
                <center>
                  <img class="profile-user-img img-responsive img-circle stc" src="support/admin/media/<?= $image=$user->image; if($image){$user->image;}else{ echo"defoult.png"; } ?>" alt="User profile picture">
                </center>
                <h3 class="profile-username text-center">Greycells Design</h3>
                <p class="text-muted text-center"><b>administrator</b></p>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <input type="file" name="file" required >
                    <input type="hidden" name="id" value="57"/>
                    <input type="hidden" name="oldimg" value="defoult.png"/>
                  </li>
                </ul>
                <button name="profile_pic" class="btn btn-primary btn-block disabled"><b>Upload</b></button>
              </div>
            </div>
          </form>
        </div>
    
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile Setting</a></li>            
            </ul>
            <div class="tab-content">
              <div class="active tab-pane " id="activity">
                <?php echo form_open ("admin/update_user/{$user->ID}",['class'=>'form-horizontal']); ?>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-1 control-label">Role</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="role" style="width: 50%;">
                        <option value="administrator"><?= $user->role; ?></option>
                        <option value="administrator">Administrator</option>
                        <option value="editor">Editor</option>
                        <option value="subscriber">Subscriber</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Name</label>
                    <div class="col-sm-6">
                      <?php echo form_input (['name'=>'fname','class'=>'form-control','placeholder'=>'First Name','value'=>set_value('fname', $user->fname)]); ?>
                      <span><?php echo form_error('fname','<p class="text-danger">','</p>'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Surname</label>
                    <div class="col-sm-6">
                      <?php echo form_input (['name'=>'lname','class'=>'form-control','placeholder'=>'Last Name','value'=>set_value('lname', $user->lname)]); ?>
                      <span><?php echo form_error('lname','<p class="text-danger">','</p>'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-1 control-label">Userame</label>
                    <div class="col-sm-6">
                      <?php echo form_input (['name'=>'username','class'=>'form-control','placeholder'=>'Username','value'=>set_value('username', $user->username)]); ?>
                      <span><?php echo form_error('username','<p class="text-danger">','</p>'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Email</label>
                    <div class="col-sm-6">
                      <?php echo form_input (['name'=>'email','class'=>'form-control','placeholder'=>'Mobile No','value'=>set_value('email', $user->email)]); ?>
                      <span><?php echo form_error('email','<p class="text-danger">','</p>'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Mobile No</label>
                    <div class="col-sm-6">
                      <?php echo form_input (['name'=>'mobileno','class'=>'form-control','placeholder'=>'Mobile No','value'=>set_value('mobileno', $user->mobileno)]); ?>
                      <span><?php echo form_error('mobileno','<p class="text-danger">','</p>'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-6">
                      <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- //Main content over-->