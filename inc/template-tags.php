<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MNFST_DSTNY
 */

if ( ! function_exists( 'mnfst_dstny_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mnfst_dstny_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'mnfst_dstny' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'mnfst_dstny' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Display the author avatar if the author has a gravatar
	$author_id = get_the_author_meta( 'ID' );
	if ( mnfst_dstny_validate_gravatar( $author_id ) ) { 
			echo '<div class="meta-content has-avatar">';
			echo '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>';
  } else {
  		echo '<div class="meta-content">';
  }

	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mnfst_dstny' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
	echo '</div><!-- .meta-content -->';

}
endif;

if ( ! function_exists( 'mnfst_dstny_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mnfst_dstny_index_posted_on() {

	$author_id = get_the_author_meta( 'ID' );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'mnfst_dstny' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'mnfst_dstny' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	
  echo '<div class="meta-content">';
	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mnfst_dstny' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
	echo '</div><!-- .meta-content -->';

}
endif;

if ( ! function_exists( 'mnfst_dstny_entry_footer' ) ) :
	//end index_posted_on

function mnfst_dstny_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'mnfst_dstny' ) );
		if ( $categories_list && mnfst_dstny_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'mnfst_dstny' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'mnfst_dstny' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'mnfst_dstny' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mnfst_dstny' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'mnfst_dstny' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mnfst_dstny_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mnfst_dstny_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mnfst_dstny_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mnfst_dstny_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mnfst_dstny_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mnfst_dstny_categorized_blog.
 */
function mnfst_dstny_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mnfst_dstny_categories' );
}
add_action( 'edit_category', 'mnfst_dstny_category_transient_flusher' );
add_action( 'save_post',     'mnfst_dstny_category_transient_flusher' );



/**
 * Utility function to check if a gravatar exists for a given email or id
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @return bool if the gravatar exists or not
 */

function mnfst_dstny_validate_gravatar($id_or_email) {
  //id or email code borrowed from wp-includes/pluggable.php
	$email = '';
	if ( is_numeric($id_or_email) ) {
		$id = (int) $id_or_email;
		$user = get_userdata($id);
		if ( $user )
			$email = $user->user_email;
	} elseif ( is_object($id_or_email) ) {
		// No avatar for pingbacks or trackbacks
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
			return false;

		if ( !empty($id_or_email->user_id) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_userdata($id);
			if ( $user)
				$email = $user->user_email;
		} elseif ( !empty($id_or_email->comment_author_email) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}

	$hashkey = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hashkey . '?d=404';

	$data = wp_cache_get($hashkey);
	if (false === $data) {
		$response = wp_remote_head($uri);
		if( is_wp_error($response) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
	    wp_cache_set($hashkey, $data, $group = '', $expire = 60*5);

	}		
	if ($data == '200'){
		return true;
	} else {
		return false;
	}
}

// Customize excerpt read more indicator

function mnfst_dstny_excerpt_more( $more ) {
	return" ...";
}
add_filter( 'excerpt_more', 'mnfst_dstny_excerpt_more' );

if ( ! function_exists( 'mnfst_dstny_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Mnfst_Dstny 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function mnfst_dstny_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'mnfst_dstny' ),
		'next_text' => __( 'Next &rarr;', 'mnfst_dstny' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mnfst_dstny' ); ?></h1>		
		<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;