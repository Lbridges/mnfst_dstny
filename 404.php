<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MNFST_DSTNY
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php get_template_part('template-parts/content', 'none'); ?>

		</main>
	</div><<!-- end primary -->

			

<?php
get_sidebar();
get_footer();
