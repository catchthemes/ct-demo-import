<?php
/**
 * The template used for displaying gallery
 *
 * @package My Music Band Pro
 */
?>

<?php

$catch_sketch_type = get_theme_mod( 'catch_sketch_gallery_type', 'page' );

if ( 'page' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_gallery' ) ) {
	$args['page_id'] = absint( $catch_sketch_id );
} elseif ( 'post' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_gallery_post' ) ) {
	$args['p'] = absint( $catch_sketch_id );
} elseif ( 'category' === $catch_sketch_type && $catch_sketch_cat = get_theme_mod( 'catch_sketch_gallery_category' ) ) {
	$args['cat'] = absint( $catch_sketch_cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$gallery_query = new WP_Query( $args );
if ( $gallery_query->have_posts() ) :
	while ( $gallery_query->have_posts() ) :
		$gallery_query->the_post();
		?>

		<?php
			$classes[] = 'gallery-section';
			$classes[] = 'section';
		?>

		<div id="gallery-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="wrapper">

				<div class="section-heading-wrapper featured-section-headline">
					<?php
					if ( get_theme_mod( 'catch_sketch_display_gallery_title', 1 ) ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title">
								<?php the_title(); ?>
							</h2>
						</div><!-- .entry-header -->
					<?php endif; ?>

					<?php
					$subtitle = get_theme_mod( 'catch_sketch_gallery_subtitle' );

					if ( $subtitle ) : ?>
						<div class="section-description">
							<?php
							$subtitle = apply_filters( 'the_content', $subtitle );
							echo wp_kses_post( str_replace( ']]>', ']]&gt;', $subtitle ) );
							?>
						</div><!-- .section-description -->
					<?php endif; ?>
				</div><!-- .section-heading-wrapper -->

				<div class="section-content-wrapper gallery-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">

						<?php if ( has_post_thumbnail() ) :
							$thumb = get_the_post_thumbnail_url( get_the_ID() );
							?>
							<div class="post-thumbnail" style="background-image: url( '<?php echo esc_url( $thumb ); ?>' )">
								<a class="cover-link" href="<?php the_permalink(); ?>"></a>
							</div><!-- .post-thumbnail -->
							<div class="entry-container">
						<?php else : ?>
							<div class="entry-container full-width">
						<?php endif; ?>

							<div class="entry-content">
								<?php
										the_content();
								?>
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
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
