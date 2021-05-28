<?php
add_action( 'admin_menu', 'real_estate_lite_admin_menu' );

function real_estate_lite_admin_menu() {


	add_theme_page( 'Upgrade To PRO', 'Upgrade To PRO', 'manage_options', 'pro-upgrade', 'real_estate_lite_admin_page');

}

function real_estate_lite_admin_page(){
	?>
	<style type="text/css">
	.col-1-2 { width: 50%; float: left; text-align: left;}
	img {width: 100%;}
	.wrap h2.page-title { margin: 0 0 0px; font-size: 40px; font-weight: bold; text-align: center;}
	ul {margin: 0; padding: 20px 40px;}
	ul li {font-weight: bold;}
	ul li ul li { font-weight: normal;}
	ul ul { padding: 0 20px;}
	.padded h1 { padding: 0 40px}
	.aligncenter {text-align: center; padding: 20px 0;}
	a.demo {text-decoration: none; border-radius: 5px; background: #fff; color: #000; padding: 10px 15px;}
	a.buy {text-decoration: none; border-radius: 3px; background: red; color: #fff; padding: 10px 15px; margin-left: 10px;}
	a.support {text-decoration: none; border-radius: 3px; background: #000; color: #fff; padding: 10px 15px; margin-left: 10px;}

	li a {}
	</style>
	<div class="wrap">
		<h2 class="page-title">Upgrade to Real Estate PRO</h2>
		<div class="aligncenter"><i>Use the discount code " <b>wporg</b> " & get 25% OFF today</i></div>
		<div class="col-1-2">
			<img src="https://thepixeltribe.com/wp-content/uploads/2016/09/real-estate.png">
		</div>

		<div class="col-1-2 padded">
		<h1>5 Solid reasons to Upgrade Today</h1>
		<ul>
			<li>More Customization Options
			<ul>
				<li>Real Estate Plugin</li>
				<li>Property Slider</li>
				<li>Sort Home Page Sections</li>
				<li>Client Testimonials</li>
			</ul>
			</li>
			<li>Dedicated Property Plugin
			<ul>
				<li>Upload & Manage properties</li>
				<li>Add property details/amenities </li>
				<li>Separate Properties From Posts</li>
			</ul>
			</li>
			<li>Featured Property Slider
			<ul>
				<li>Feature your top Properties on a slider</li>
				<li>Multiple options to increase conversion</li>
			</ul>
			</li>
			<li>Client Testimonials
			<ul>
				<li>Testimonial Slider</li>
				<li>Easy to update</li>
			</ul>
			</li>
			<li>One on One Email Support
			<ul>
				<li>Professional support, from installation to upgrades</li>
				
			</ul>
			</li>

		</ul>
			<ul><li>
				<a class="demo" target="_blank" href="http://themes.thepixeltribe.com/?theme=Real%20Estate">Live Demo</a>
				<a class="support" target="_blank" href="http://support.thepixeltribe.com/docs/real-estate/">Documentation</a>
				<a class="buy" target="_blank" href="https://thepixeltribe.com/template/real-estate/">Upgrade Now</a>
			</li></ul>
		</div>
	</div>
<?php 

}