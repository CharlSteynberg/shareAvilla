<div class="section address">
	<div class="grid-wide nopad">
		
			<?php 
			$page = esc_attr( get_theme_mod('address'));
			$arg = array('post_type' => 'page', 'post__in'=> array($page));

			$address = new WP_Query( $arg );
			if( $address->have_posts() ) {
				echo"<div class='col-6-12 address-content colcenter'>";
				while( $address->have_posts() ){
					$address->the_post();

					the_title("<h2 class='address-title'>","</h2>");
					the_content();
				}
				wp_reset_postdata();
				echo"</div>";
				}?>
		
		<div class="col-6-12 address-form">
		<?php 
			$cf7_id = esc_attr( get_theme_mod('contact_form_id'));

			$cf7 = sprintf(
						'[contact-form-7 ID="%1$s"]',
   						 $cf7_id
						);
			echo do_shortcode( $cf7 );
			 ?>
		</div>
	</div>
</div>