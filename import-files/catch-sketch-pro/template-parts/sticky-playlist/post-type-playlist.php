<?php
/**
 * The template used for displaying playlist
 *
 * @package Catch_Sketch
 */
?>

<?php

$catch_sketch_type = get_theme_mod( 'catch_sketch_sticky_playlist_type', 'page' );

if ( 'page' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_sticky_playlist' ) ) {
	$args['page_id'] = absint( $catch_sketch_id );
} elseif ( 'post' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_sticky_playlist_post' ) ) {
	$args['p'] = absint( $catch_sketch_id );
} elseif ( 'category' === $catch_sketch_type && $catch_sketch_cat = get_theme_mod( 'catch_sketch_sticky_playlist_category' ) ) {
	$args['cat']            = absint( $catch_sketch_cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}


// Create a new WP_Query using the argument previously created
$playlist_query = new WP_Query( $args );
if ( $playlist_query->have_posts() ) :
	while ( $playlist_query->have_posts() ) :
		$playlist_query->the_post();
		?>

		<div id="sticky-playlist-section" class="sticky-playlist-section section">
			<div class="wrapper">
				<div class="section-content-wrapper playlist-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-container">
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div><!-- .entry-container -->
					</article><!-- #post-## -->
				</div><!-- .wrapper -->
			</div><!-- .section-content -->
		</div><!-- #playlist-section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
