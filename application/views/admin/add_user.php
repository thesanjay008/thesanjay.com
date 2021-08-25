<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart ('admin/store_user'); ?>
			<div class="row">
				<div class="col-md-3">
					<div class="box-body">
						<div class="form-group">
							<label>Select Role</label>
							<select class="form-control" name="role" style="width: 100%;">
							 <option value="user">User</option>
							 <option value="subscriber">Subscriber</option>
							 <option value="administrator">Administrator</option>
							</select>
							
						</div>
						<div class="form-group">
							<label>First Name</label>
							<?php echo form_input (['name'=>'fname','class'=>'form-control','placeholder'=>'First Name','value'=>set_value('fname')]); ?>
							<span><?php echo form_error('fname','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<?php echo form_input (['name'=>'lname','class'=>'form-control','placeholder'=>'Last Name','value'=>set_value('lname')]); ?>
							<span><?php echo form_error('lname','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">
							<label>Username</label>
							<?php echo form_input (['name'=>'username','class'=>'form-control','placeholder'=>'Username','value'=>set_value('username')]); ?>
							<span><?php echo form_error('username','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<?php echo form_input (['type'=>'email','name'=>'email','class'=>'form-control','placeholder'=>'Email','value'=>set_value('email')]); ?>
							<span><?php echo form_error('email','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">
							<label>Mobile No.</label>
							<?php echo form_input (['name'=>'mobileno','class'=>'form-control','placeholder'=>'Mobile No','value'=>set_value('mobileno')]); ?>
							<span><?php echo form_error('mobileno','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">
							<label>password</label>
							<?php echo form_password (['name'=>'password','class'=>'form-control','placeholder'=>'Password']); ?>
							<span><?php echo form_error('password','<p class="text-danger">','</p>'); ?></span>
						</div>
						<div class="form-group">							
							<button type="submit" name="add_user" class="btn btn-primary">Add New User</button>								
						</div>
					</div>	
				</div>
			</div>
		</form>
	</section>
    <!-- //Main content over-->
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.users').addClass('active');
			$('.users_add').addClass('active');
		});
	</script>