<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Members</h1>
  <ol class="breadcrumb">
	<li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Settings</li>
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
	<div class="col-md-12">
	  <div class="box box-primary">
	  <div class="box-body no-padding">
		<div class="mailbox-controls">
		<!-- Check all button -->
		<div class="btn-group">
		<button type="submit" name="delet_user" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
		</div>
		<div class="btn-group">
		  <a class="btn btn-default btn-sm" href="admin/users"><i class="fa fa-reply"></i></a>
		  <?= $this->pagination->create_links(); ?>
		  
		  <a class="btn btn-default btn-sm" href="admin/users"><i class="fa fa-share"></i></a>
		</div><!-- /.btn-group -->
		<div class="btn-group addproduct">
		  <a class="btn btn-primary btn-sm" href="admin/add_user">Add New</a>
		</div>
		</div>
		<div class="table-responsive mailbox-messages">
		<table class="table table-hover table-striped">
		  <tbody>
			<tr>
			  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
			  <td class="tab"><b>Image</b></td>
			  <td class="tab"><b>Name</b></td>
			  <td class="tab"><b>Role</b></td>
			  <td class="tab"><b>Username</b></td>
			  <td class="tab"><b>Mobile No</b></td>
			  <td class="tab"><b>Email</b></td>
			  <td class="tab"><b>Crete Date</b></td>
			  <td class="tab"><b class="pull-right">Action</b></td>
			</tr>
			<?php if(! empty($results)): ?>
			<?php foreach($results as $row): ?>
			<tr>  
			  <td><input name="user_id[]" type="checkbox" value="55"></td>
			  <td><img src="support/admin/media/<?= $image=$row->image; if($image){$row->image;}else{ echo"defoult.png"; } ?>" alt="<?= $row->image; ?>" height="50px" width="50px"></td>
			  <td><a href="<?= "admin/edit_user/{$row->ID}"; ?>"><b><?= $row->fname; ?></b> <b><?= $row->lname; ?></b></a></td>
			  <td><?= $row->role; ?></td>
			  <td><b><?= $row->username; ?></b></td>
			  <td><?= $row->mobileno; ?></td>
			  <td><?= $row->email; ?></td>
			  <td><?= date('M-d-Y', strtotime($row->create_date)); ?></td>
			  <td>
				<?= form_open('admin/delete_user'), form_hidden('user_id', $row->ID); ?>
				<span class="pull-right"><button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button></span>
				<?= form_close(); ?>
				<span class="pull-right"><a href="<?= "admin/edit_user/{$row->ID}"; ?>" class="btn btn-default btn-sm"><i class="fa fa-file-text-o"></i></a></span>
			  </td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
		</div>
	  </div>
	  </div>
	</div>
  </div>
</section>
<!-- //Main content over-->

<script type="text/javascript">
	$(document).ready(function(e) {
		$('.members_page').addClass('active');
	});
</script>