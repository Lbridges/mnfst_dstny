<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MNFST_DSTNY
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( esc_html__( 'More work by %2$s', 'mnfst_dstny' ), 'mnfst_dstny', '<a href="http://LBridges.ninja/portfolio" rel="designer">LBridges</a>' ); ?>
		</div><!-- .site-info -->
		

		<?php // display site icon or first letter as logo ?>
			<div class="site-logo">
				<?php $site_title = get_bloginfo( 'name' ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<div class="screen-reader-text">
						<?php printf( esc_html__('Go to the home page of %1$s', 'mnfst_dstny'), $site_title); ?>
					</div>
					<?php if( has_custom_logo() ) {
						the_custom_logo();
					} else { ?>
					<div class="site-firstletter" aria-hidden="true">
						<?php echo substr($site_title, 0, 1); ?>
					</div>
					<?php } ?>
				</a>
			</div>

		<!-- Footer Navigation -->
		<div class="footer-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'seconday', 'menu_id' => 'secondary-menu', 'menu_class' => 'nav-menu' ) ); ?>
		</div>

			
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
