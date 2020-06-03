<?php
/**
 * The template for displaying services content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_service_option', 'disabled' );
$text_align     = get_theme_mod( 'catch_sketch_service_text_align', 'text-aligned-left' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_service_type', 'category' );

if ( 'custom' !== $catch_sketch_type ) {
	$services_posts = catch_sketch_get_services_posts();

	if ( empty( $services_posts ) ) {
		return;
	}
}

if ( 'ect-service' === $catch_sketch_type ) {
	$catch_sketch_title    = get_option( 'ect_service_title', esc_html__( 'Services', 'catch-sketch-pro' ) );
	$subtitle = get_option( 'ect_service_content' );
} else {
	$catch_sketch_title    = get_theme_mod( 'catch_sketch_service_archive_title', esc_html__( 'Services', 'catch-sketch-pro' ) );
	$subtitle = get_theme_mod( 'catch_sketch_service_sub_title' );
}

$classes[] = 'services-section-wrapper';
$classes[] = 'section';
$classes[] = $text_align;

if ( $catch_sketch_title && ! $subtitle ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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

		<?php

		$wrapper_classes[] = 'section-content-wrapper';

		$wrapper_classes[] = get_theme_mod( 'catch_sketch_service_layout', 'layout-three' );
		?>

		<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">
			<?php
			if ( 'custom' === $catch_sketch_type ) {
				get_template_part( 'template-parts/services/content', 'custom' );
			} else {
				foreach ( $services_posts as $post ) {
					setup_postdata( $post );

					// Include the services content template.
					get_template_part( 'template-parts/services/content', 'services' );
				}

				wp_reset_postdata();
			}
			?>
		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
