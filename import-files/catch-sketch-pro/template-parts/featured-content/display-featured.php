<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_featured_content_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_featured_content_type', 'category' );

if ( 'custom' !== $catch_sketch_type ) {
	$featured_posts = catch_sketch_get_featured_posts();

	if ( empty( $featured_posts ) ) {
		return;
	}
}

if ( 'featured-content' === $catch_sketch_type ) {
	$catch_sketch_title    = get_option( 'featured_content_title', esc_html__( 'Contents', 'catch-sketch-pro' ) );
	$subtitle = get_option( 'featured_content_content' );
} else {
	$catch_sketch_title = get_theme_mod( 'catch_sketch_featured_content_archive_title', esc_html__( 'Featured Content', 'catch-sketch-pro' ) );
	$subtitle           = get_theme_mod( 'catch_sketch_featured_content_sub_title' );
}

$layout = get_theme_mod( 'catch_sketch_featured_content_layout', 'layout-three' );

$text_align  = get_theme_mod( 'catch_sketch_featured_content_text_align', 'text-aligned-left' );

$classes[] = 'featured-content-section';
$classes[] = 'section';
$classes[] = $text_align;

?>

<div id="featured-content" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $catch_sketch_title || $subtitle ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( $catch_sketch_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<div class="section-description">
						<?php
						$subtitle = apply_filters( 'the_content', $subtitle );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $subtitle ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper <?php echo esc_attr( $layout ); ?>">

			<?php
			if ( 'custom' === $catch_sketch_type ) {
				get_template_part( 'template-parts/featured-content/content', 'custom' );
			} else {
				foreach ( $featured_posts as $post ) {
					setup_postdata( $post );

					// Include the featured content template.
					get_template_part( 'template-parts/featured-content/content', 'featured' );
				}

				wp_reset_postdata();
			}
			?>

			<?php
				$target = get_theme_mod( 'catch_sketch_featured_content_target' ) ? '_blank': '_self';
				$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_featured_content_link', '#' );
				$text   = get_theme_mod( 'catch_sketch_featured_content_text', esc_html__( 'View All', 'catch-sketch-pro' ) );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>

		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
