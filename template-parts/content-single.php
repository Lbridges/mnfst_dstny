<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Mnfst_Dstny
 * @since Mnfst Dstny 1.0
 */
?>
<?php global $first_post; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php
		if ( has_post_thumbnail() ) { ?>
			<figure class="featured-image">
				<?php if ( $first_post == true ) { ?>
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
					<?php } else {
							the_post_thumbnail();
					}
					?>
				</figure>
		<?php }
		?>

		<?php
				if ( $first_post == true ) {
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				} else {
		 the_title( '<h1 class="entry-title">', '</h1>' ); 
		 }
		 ?>

		<?php
		if ( has_excerpt( $post->ID) ) {
			echo '<div class="deck">';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '</div><!-- deck -->';
		}
		?>

		<div class="entry-meta">
			<?php mnfst_dstny_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mnfst_dstny' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'mnfst_dstny' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'mnfst_dstny' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->