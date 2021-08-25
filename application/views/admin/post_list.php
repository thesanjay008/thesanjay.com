	<style>
	  .m-l-5{margin: 0 5px;}
	</style>
	<section class="content-header">
      <h1><?php echo $page_title; ?> <a class="btn btn-sm btn-default" href="admin/add_new/<?php echo $post_type; ?>">Add New <?php echo $page_title; ?></a></h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><h1><?php echo $page_title; ?></h1></li>
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
              <a class="btn btn-default btn-sm" href="admin/users"><i class="fa fa-share"></i></a>
            </div><!-- /.btn-group -->
            </div>
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
                  <td class="tab"><b>Image</b></td>
                  <td class="tab"><b>Name</b></td>
                  <td class="tab"><b>Author</b></td>
                  <td class="tab"><b>Categories</b></td>
                  <td class="tab"><b>Status</b></td>
                  <td class="tab"><b>Create Date</b></td>
                  <td class="tab"><b class="pull-right">Action</b></td>
                </tr>
                <?php foreach($post_data as $list){ ?>
                <tr>  
                  <td><input class="checkbox-toggle" name="post_id[]" type="checkbox" value="<?php echo $list['post_id']; ?>"></td>
                  <td><img src="<?php echo $list['post_image']; ?>" height="50px" width="50px"></td>
                  <td><a href="admin/edit/<?php echo $list['post_id']; ?>"><?php echo $list['post_title']; ?></a></td>
				  <td><?php echo ucfirst($list['author_name']); ?></td>
                  <td><?php if(!empty($list['categories'])){ foreach($list['categories'] as $cat){ echo '<small class="label bg-aqua">'. $cat['category_title'] .'</small>';  }} ?></td>
                  <td><?php echo ucfirst($list['post_status']); ?></td>
                  <td><?php echo ucfirst($list['post_date']); ?></td>
                  <td>
                    <span class="pull-right m-l-5"><a href="<?php echo $list['post_slug']; ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a></span>
                    <span class="pull-right"><a href="admin/edit/<?php echo $list['post_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a></span>
                  </td>
                </tr>
				<?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
	<script type="text/javascript">
	$(document).ready(function(e) {
		$('#nav-<?php echo $post_type; ?>').addClass('active');
		$('.<?php echo $post_type; ?>all').addClass('active');
	});
	</script>