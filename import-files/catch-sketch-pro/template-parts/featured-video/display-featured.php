<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_featured_video_option', 'disabled' );
$quantity = get_theme_mod( 'catch_sketch_featured_video_number', 4 );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if featured video is disabled.
	return;
}

$classes[] = 'featured-video-section section';

$catch_sketch_title     = get_theme_mod( 'catch_sketch_featured_video_archive_title', esc_html__( 'Featured Video', 'catch-sketch-pro' ) );
$sub_title = get_theme_mod( 'catch_sketch_featured_video_sub_title' );

$background = get_theme_mod( 'catch_sketch_featured_video_bg_image' );

if ( $background ) {
	$classes[] = 'has-background-image';
}

if( '1' == $quantity ) {
	$classes[] = 'single-item';
}
?>

<div id="featured-video-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $catch_sketch_title || $sub_title ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<?php if ( $catch_sketch_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
						$sub_title = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrapper featured-video-content-wrapper">
			<?php
				get_template_part( 'template-parts/featured-video/video', 'featured' );
			?>

			<?php
				$target = get_theme_mod( 'catch_sketch_featured_video_target' ) ? '_blank': '_self';
				$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_featured_video_link', '#' );
				$text   = get_theme_mod( 'catch_sketch_featured_video_text', esc_html__( 'View All', 'catch-sketch-pro' ) );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
