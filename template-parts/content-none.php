<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MNFST_DSTNY
 */

?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
	<header class="page-header">
		<h1 class="page-title">
		<?php
		if ( is_404() ) { esc_html_e( 'Page not available', 'mnfst_dstny');
		} else if ( is_search() ) {
			printf( esc_html__('Nothing found for &ldquo;%s&rdquo', 'mnfst_dstny'), '<em>' . get_search_query() );
		} else {
		    esc_html_e( 'Nothing Found', 'mnfst_dstny' );
		}
		 ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mnfst_dstny' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mnfst_dstny' ); ?></p>
			<?php
				get_search_form();

			elseif ( is_404() ) : ?>

				<p><?php esc_html_e( 'You seem to be lost. To find what you are looking for check out some of the recent articles below or try a search:', 'mnfst_dstny') ; ?></p>
				<?php 
					get_search_form(); 

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mnfst_dstny' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->

	<?php 
	if ( is_404() || is_search() ) {
	?>
		<h1 class="page-title secondary-title"><?php esc_html_e( 'Most recent posts:', 'mnfst_dstny' ); ?></h1>
		<?php 
		//get last 6 posts
		$args = array(
			'posts_per_page' => 6
		);
		$latest_posts_query = new WP_Query( $args );
		//The Loop
		if ( $latest_posts_query->have_posts() ) {
			while ( $latest_posts_query->have_posts() ) {
				$latest_posts_query->the_post();
				//Get index page content 
				get_template_part( 'template-parts/content', get_post_format() );
			}
	}
	/*Restore original post data */
	wp_reset_postdata();
}
?>
</section><!-- .no-results -->
