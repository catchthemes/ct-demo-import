<?php
/**
 * The template used for displaying promotion_headline content
 *
 * @package Catch_Sketch
 */

$catch_sketch_type = get_theme_mod( 'catch_sketch_promotion_headline_type', 'page' );

if ( 'page' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_promotion_headline_page' ) ) {
	$args['page_id'] = absint( $catch_sketch_id );
} elseif ( 'post' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_promotion_headline_post' ) ) {
	$args['p'] = absint( $catch_sketch_id );
} elseif ( 'category' === $catch_sketch_type && $catch_sketch_cat = get_theme_mod( 'catch_sketch_promotion_headline_category' ) ) {
	$args['cat']            = absint( $catch_sketch_cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$promotion_headline_query = new WP_Query( $args );
if ( $promotion_headline_query->have_posts() ) :
	while ( $promotion_headline_query->have_posts() ) :
		$promotion_headline_query->the_post();

		$classes[] = 'promotion-headline-section section'; 

		$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_align', 'content-aligned-right' );
		$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_text_align', 'text-aligned-left' );
		$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_box_design', 'style-one' );
		$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_layout', 'default' );
		
		// Bg image added from function catch_sketch_promo_headline_bg_css()
		if ( ! has_post_thumbnail() ) {
			$classes[] = 'no-background';
		}
		?>
		<div id="promotion-headline-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="wrapper">
				<div class="section-content-wrap">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'catch-sketch-promotion' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="entry-container">
							<div class="inner-container">
								<?php
								$subtitle = get_theme_mod( 'catch_sketch_promotion_headline_subtitle' );

								if ( get_theme_mod( 'catch_sketch_display_promotion_headline_title', 1 ) || $subtitle ) : ?>
									<header class="entry-header">
										<?php if ( get_theme_mod( 'catch_sketch_display_promotion_headline_title', 1 ) ) : ?>
											<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>
										<?php endif; ?>

										<?php if ( $subtitle ) : ?>
										<div class="section-description">
											<?php
											$subtitle = apply_filters( 'the_content', $subtitle );
											echo wp_kses_post( str_replace( ']]>', ']]&gt;', $subtitle ) );
											?>
										</div><!-- .section-description -->
										<?php endif; ?>
									</header><!-- .entry-header -->
								<?php endif; ?>

								<?php
									$show_content = get_theme_mod( 'catch_sketch_promotion_headline_show', 'excerpt' );

									if ( 'full-content' === $show_content ) {
										echo '<div class="entry-content">';
										the_content();
										echo '</div>';
									} elseif ( 'excerpt' === $show_content ) {
										echo '<div class="entry-summary">';
										echo '<p>' . get_the_excerpt() . '</p>';
										echo '</div>';
									}
								?>

								<?php if ( get_edit_post_link() ) : ?>
									<footer class="entry-footer">
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
									</footer><!-- .entry-footer -->
								<?php endif; ?>
							</div><!-- .inner-container -->
						</div><!-- .entry-container -->
					</article><!-- #post-## -->
				</div><!-- .section-content-wrap -->
			</div> <!-- Wrapper -->
		</div> <!-- promotion_headline-wrapper -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
