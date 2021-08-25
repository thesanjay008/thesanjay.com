<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
?>
	<div id="content" class="content clearfix home">
		<section id="section" class="light nopad-t nopad-b">
			<div class="row">
				<div class="col-12">
					<div id="face" class="face">
						<a href="#">
							<div id="designer" class="designer">
								<div id="designer-desc" class="description">
									<h1>designer</h1>
									<p>Web Designer with a passion for designing beautiful and functional user experiences.</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div id="coder" class="coder">
								<div id="coder-desc" class="description">
									<h1>&lt;coder&gt;</h1>
									<p>Back End Developer who focuses on writing clean, elegant and efficient code.</p>
								</div>
							</div>
						</a>
						<img id="face-img" class="face-img" src="<?php echo $library_url; ?>/images/adham-dannaway-designer-coder.jpg" alt="Sanjay Dhamecha - PHP Developer">
						<div id="designer-img" class="designer-img"></div>
						<div id="coder-img" class="coder-img"></div>
						<div id="designer-bg" class="designer-bg"></div>
						<div id="coder-bg" class="coder-bg"></div>
					</div>
				</div>
			</div>
		</section>
		<div >
			<section class="dark">
				<div class="row">
					<div class="col-12">
						<div id="content-detail">
							<!-- Show 3 random portfolio posts -->
							<div class="header-center"><h3>Some of my latest work</h3></div>
							<ul id="thumbs" class="thumbs clearfix">
								<li>
									<a href="https://cityreach.in" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="CityReach" src="<?php echo $library_url; ?>/images/portfolio/cityreach.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/cityreach.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Search Directory, Online Selling</h4>
											<p>Codeigniter</p>
										</div>
									</a>
								</li>
								<li>
									<a href="http://josephcarroll.com" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Joseph Carroll" src="<?php echo $library_url; ?>/images/portfolio/joseph-carroll.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/joseph-carroll.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Photography Personal</h4>
											<p>Wordpress, PHP</p>
										</div>
									</a>
								</li>
								<li>
									<a href="http://globaltruckland.com" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Global Truckland" src="<?php echo $library_url; ?>/images/portfolio/global-truckland.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/global-truckland.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Transportation Trucking</h4>
											<p>Wordpress, PHP</p>
										</div>
									</a>
								</li>
								<li>
									<a href="https://doctorsnynj.com" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Dr nynj" src="<?php echo $library_url; ?>/images/portfolio/drnynj.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/drnynj.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Find a Doctor Online</h4>
											<p>Codeigniter</p>
										</div>
									</a>
								</li>
								<li>
									<a href="http://falafal.co.in" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Falafal" src="<?php echo $library_url; ?>/images/portfolio/falafal.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/falafal.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Food Website</h4>
											<p>Wordpress, PHP</p>
										</div>
									</a>
								</li>
								<!--<li>
									<a href="javascript:void(0);" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Radhika Rai" src="<?php echo $library_url; ?>/images/portfolio/radhika-rai.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/radhika-rai.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Life Artist, Personal Website</h4>
											<p>Codeigniter</p>
										</div>
									</a>
								</li>-->
								<li>
									<a href="http://dreamexporter.com" target="_blank">
										<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Dream Exporter" src="<?php echo $library_url; ?>/images/portfolio/dream-exporter.jpg" srcset="<?php echo $library_url; ?>/images/portfolio/dream-exporter.jpg" sizes="(max-width: 628px) 100vw, 628px" />
										<div class="description">
											<span class="arrow-r"></span>
											<h4>Ecommerce Clothing Website</h4>
											<p>Wordpress, PHP</p>
										</div>
									</a>
								</li>
							</ul>
							<div class="header-center"><h3><a href="javascript:void(0);">View More</a></h3></div>
						</div>
					</div>
				</div>
			</section>
		</div><!-- / content-detail -->
	</div><!-- / content -->
<?php include_once('footer.php'); ?>