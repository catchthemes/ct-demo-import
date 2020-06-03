<?php
/**
 * The template used for displaying playlist
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_section = get_theme_mod( 'catch_sketch_playlist_visibility', 'disabled' );

if ( ! catch_sketch_check_section( $enable_section ) ) {
	// Bail if playlist is not enabled
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_playlist_type', 'page' );

if ( 'page' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_playlist' ) ) {
	$args['page_id'] = absint( $catch_sketch_id );
} elseif ( 'post' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_playlist_post' ) ) {
	$args['p'] = absint( $catch_sketch_id );
} elseif ( 'category' === $catch_sketch_type && $catch_sketch_cat = get_theme_mod( 'catch_sketch_playlist_category' ) ) {
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

		$img_alig          = get_theme_mod( 'catch_sketch_playlist_image_alignment', 'content-align-left' );
		$display_title     = get_theme_mod( 'catch_sketch_display_playlist_title', 1 );
		$section_sub_title = get_theme_mod( 'catch_sketch_playlist_section_sub_title' );

		$classes[] = 'playlist-section section';
		$classes[] = $img_alig;

		if ( ! $display_title && ! $section_sub_title ) {
			$classes[] = 'no-section-heading';
		}

		$background = get_theme_mod( 'catch_sketch_playlist_bg_image' );

		if ( $background ) {
			$classes[] = 'has-background-image';
		}
		?>
		<div id="playlist-section" class=" no-section-heading <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="wrapper">
				<div class="section-content-wrapper playlist-content-wrapper <?php echo esc_attr( $img_alig ); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'catch-sketch-playlist' );
									}
									else {
										$image = '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-596x447.jpg"/>';

										// Get the first image in page, returns false if there is no image.
										$first_image = catch_sketch_get_first_image( $post->ID, 'post-thumbnail', '' );

										// Set value of image as first image if there is an image present in the page.
										if ( $first_image ) {
											$image = $first_image;
										}

										echo $image;
									}
									?>
								</a>
							</div>

							<div class="entry-container">
								<span class="subtitle"><?php echo wp_kses_post( $section_sub_title ); ?></span>
								<?php if ( get_theme_mod( 'catch_sketch_display_playlist_title', 1 ) ) : ?>
								<header class="entry-header">
									<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
								</header><!-- .entry-header -->
								<?php endif; ?>

								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->

								<?php if ( get_edit_post_link() ) : ?>
									<footer class="entry-footer">
										<div class="entry-meta">
											<?php
												edit_post_link(
													sprintf(
														/* translators: %s: Name of current post */
														esc_html__( 'Edit %s', 'catch-sketch-pro' ),
														the_title( '<span class="screen-reader-text">"', '"</span>', false )
													),
													'<span class="edit-link">',
													'</span>'
												);
											?>
										</div>
									</footer><!-- .entry-footer -->
								<?php endif; ?>
							</div><!-- .entry-container -->
						</div><!-- .hentry-inner -->
					</article><!-- #post-## -->
				</div><!-- .wrapper -->
			</div><!-- .section-content -->
		</div><!-- #playlist-section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
