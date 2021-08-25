	<!-- Froala Editor -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/froala_editor.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/froala_style.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/code_view.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/colors.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/emoticons.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/image_manager.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/image.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/line_breaker.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/table.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/char_counter.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/video.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/fullscreen.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/file.css">
	<link rel="stylesheet" href="<?php echo $library_url; ?>/admin/froala_editor/css/plugins/quick_insert.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
	<!-- Froala Editor Over -->
	
	<section class="content">
	  <form name="form" action="AdminApis/save_post" method="POST" enctype="multipart/form-data">
	  <div class="row">  
		<div class="col-md-12">
		  <div>
			<h3><?php echo $page_title; ?></h3>
		  </div>
		</div>
		
		<div class="col-md-9">					
			<div class="box-title">				
				<div class="form-group">
					<input type="text" class="form-control" name="post_title" value="<?php echo $details['post_title']; ?>" placeholder="Enter title" />
				</div>
			</div>		
			<div class="box-title">				
				<div class="form-group" id="froala_editor">
				  <textarea id="froala-editor" style="margin-top: 30px;" name="post_content"><?php echo $details['post_content']; ?></textarea> 
				</div>
			</div>
			
			<div class="box box-default">
			 <div class="box-header with-border">
			  <h3 class="box-title">Select SEO</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			  </div>
			 </div>
			 <div class="box-body">
				<div class="form-group">
				 <span>SEO Title</span>
				 <input type="text" class="form-control" name="post_meta_title" value="" placeholder="Enter Custom page title for this"/>
				</div>
			 </div>
			 <div class="box-body">
				<div class="form-group">
				 <span>Meta Keywords</span>
				 <input type="text" class="form-control" name="post_meta" value="" placeholder="Like 'best post', 'xyz' etc.." />
				</div>
			 </div>
			 <div class="box-body">
				<div class="form-group">
				 <span>Meta Description</span>
				 <input type="text" class="form-control" name="post_description" value="" placeholder="Enter meta description for this" />
				</div>
			 </div>
			</div>
			
		</div><!-- /.row -->			

		<div  class="col-md-3 box-title">
			<div class="box box-default">
			 <div class="box-header with-border">
			  <h3 class="box-title">Post Options</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			  </div>
			 </div>
			 <div class="box-body">
				<?php if($details['post_status'] == 'draft'){ ?>
				<button type="submit" name="post_status" value="draft" class="btn">Save Draft</button>
				<?php } ?>
			    <div class="box-header with-border">
				  <p><i class="fa fa-map-pin"></i> Status: <label class="text-light-blue"><?php echo ucfirst($details['post_status']); ?></label></p>
				  <p><i class="fa fa-eye"></i> Visibility: <label class="text-light-blue"><?php if($details['post_status'] == 'publish'){echo"Public";}else{ echo ucfirst($details['post_status']);} ?></label></p>
				</div>
				<div class="box-header with-border">
				 <?php if($details['post_status'] == 'publish'){ ?>
				 <button type="submit" class="btn btn-none text-danger" name="post_status" value="trash">Move to Trash</button>
				 <?php } ?>
				 <div class="pull-right">
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
					<button type="submit" name="post_status" value="publish" class="btn btn-primary"> <?php if($details['post_status'] == 'publish'){echo"Update";}else{echo"Publish";} ?></button>
				 </div>
				</div>
			 </div>
			</div>
			
			<div class="box box-default">
			 <div class="box-header with-border">
			  <h3 class="box-title">Featured Image</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			  </div>
			 </div>
			  <div class="box-body">
				<div class="box-header with-border">
				  
				  <td><img data-u="image" src="media/enduser/posts/default_image.png" width="100%"/></td>  
				 
				  
				</div>
				<div class="box-header pull-right with-border">
				 <div class="btn btn-default btn-file">
					Browse<input type="file" name="post_image" multiple="multiple">
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
		$('#nav-<?php echo $post_type; ?>').addClass('active');
	});
	</script>
	<!-- Froala Editor -->
	<!--
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
	-->

	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/froala_editor.min.js" ></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/align.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/char_counter.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/code_beautifier.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/code_view.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/colors.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/draggable.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/emoticons.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/entities.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/file.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/font_size.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/font_family.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/fullscreen.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/image.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/image_manager.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/line_breaker.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/inline_style.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/link.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/lists.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/paragraph_format.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/paragraph_style.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/quick_insert.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/quote.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/table.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/save.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/url.min.js"></script>
	<script type="text/javascript" src="<?php echo $library_url; ?>/admin/froala_editor/js/plugins/video.min.js"></script>

	<script>
		$('#froala-editor').froalaEditor();
	</script>
	<!-- Froala Editor Over -->