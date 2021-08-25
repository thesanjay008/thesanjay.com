<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
?>
	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="page-header">
		  <h1 class="page-title"><?php echo $post_data['post_title']; ?></h1>
		</div>
		<div class="row row-cards row-deck">
		  <div class="col-lg-12">
			<div class="card card-aside">
			  <a href="#" class="card-aside-column w-50" style="background-image: url(demo/photos/ilnur-kalimullin-218996-500.jpg)"></a>
			  <div class="card-body d-flex flex-column">
				<h4><a href="#"><?php echo $post_data['post_title']; ?></a></h4>
				<div class="text-muted">But, Aquaman, you cannot marry a woman without gills. You're from two different worlds… Oh, I've wasted my life. Son, when you participate in sporting events, it's not whether you win or lose: it's...</div>
				<div class="d-flex align-items-center pt-5 mt-auto">
				  <div class="avatar avatar-md mr-3" style="background-image: url(demo/faces/male/35.jpg)"></div>
				  <div>
					<a href="profile.html" class="text-default">Demo Author</a>
					<small class="d-block text-muted">3 days ago</small>
				  </div>
				  <div class="ml-auto text-muted">
					<a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
<?php include_once('footer.php'); ?>