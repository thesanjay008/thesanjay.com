    <section class="content-header">
      <h1><?php echo $page_title; ?></h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
	  <form  id="save_genraloptions" class="form-horizontal" method="POST" enctype="multipart/form-data">
		<div class="row">
		  <div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Site Options</h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="row">
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Site Title</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_title" value="<?php echo $genraloptions['site_title']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Logo</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_logo" value="<?php echo $genraloptions['site_logo']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Logo</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_logo" value="<?php echo $genraloptions['site_logo']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-6">
						  <button type="submit" class="btn btn-primary" name="">Save</button>
						</div>
					  </div>
				  </div>
				</div>
			</div>
		  </div>
		  
		  <div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Email Options</h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="row">
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Site Title</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_title" value="<?php echo $genraloptions['site_title']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Logo</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_logo" value="<?php echo $genraloptions['site_logo']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Logo</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="site_logo" value="<?php echo $genraloptions['site_logo']; ?>" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-6">
						  <button type="submit" class="btn btn-primary" name="">Save</button>
						</div>
					  </div>
				  </div>
				</div>
			</div>
		  </div>
		</div>
      </form>
	</section>
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.settings').addClass('active');
			$('.settings_general').addClass('active');
		});
		
		$( "#save_genraloptions" ).on('submit', function(event) {
			event.preventDefault();
			alert();
		});
	</script>