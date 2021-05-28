<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neptune WP
 */

?>

	</div><!-- #content -->
</div> <!--#page-->
<?php $bg = get_header_image(); ?>
	<footer id="colophon" class="site-footer" style="background-image: url('<?php echo esc_url($bg); ?>');background-size:cover;">
		<div class="footer-overlay"></div>
		<div class="grid-wide">
		<div class="col-3-12">
			<?php dynamic_sidebar('footer-1');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-2');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-3');?>
		</div>

		<div class="col-3-12">
			<?php dynamic_sidebar('footer-4');?>
		</div>
		<div class="site-info col-1-1">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'neptune-real-estate' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'neptune-real-estate' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>

			<a href="<?php echo esc_url( __( 'https://thepixeltribe.com/template/neptune-real-estate/', 'neptune-real-estate' ) ); ?>" class="imprint">
		<?php
		/* translators: Theme Author */
		 printf( esc_html__( 'Theme: %s', 'neptune-real-estate' ), 'Pixel Tribe' ); ?>
	</a>
		</div><!-- .site-info -->
	</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
