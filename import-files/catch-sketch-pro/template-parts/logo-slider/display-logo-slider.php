<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_logo_slider_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_sketch_type      = get_theme_mod( 'catch_sketch_logo_slider_type', 'category' );
$catch_sketch_title     = get_theme_mod( 'catch_sketch_logo_slider_title' );
$sub_title = get_theme_mod( 'catch_sketch_logo_slider_sub_title' );

$classes[] = $catch_sketch_type;
$classes[] = 'section';

?>

<div id="clients-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $catch_sketch_title || $sub_title ) : ?>
			<div class="section-heading-wrapper clients-section-headline">
				<?php if ( $catch_sketch_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .taxonomy-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper clients-content-wrapper">

			<div class="controller">
			    <!-- prev link -->


			    <div id="logo-slider-prev" class="cycle-prev fa fa-angle-left" aria-label="<?php esc_attr_e( 'Previous', 'catch-sketch-pro' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'catch-sketch-pro' ); ?></span></div>

			    <!-- empty element for pager links -->
			    <div id="logo-slider-pager" class="cycle-pager"></div>

			    <!-- next link -->


			    <div id="logo-slider-next" class="cycle-next fa fa-angle-right" aria-label="<?php esc_attr_e( 'Next', 'catch-sketch-pro' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'catch-sketch-pro' ); ?></span></div>

			</div><!-- #controller-->

			<div class="cycle-slideshow"
			data-cycle-log="false"
			data-cycle-pause-on-hover="true"
			data-cycle-swipe="true"
			data-cycle-auto-height=container
			data-cycle-fx=carousel
			data-cycle-speed="<?php echo esc_attr( get_theme_mod( 'catch_sketch_logo_slider_transition_length', 1 ) * 1000 ); ?>"
			data-cycle-timeout="<?php echo esc_attr( get_theme_mod( 'catch_sketch_logo_slider_transition_delay', 4 ) * 1000 ); ?>"
			data-cycle-loader=false
			data-cycle-slides="> article"
			data-cycle-carousel-fluid="true"
			data-cycle-prev= .cycle-prev
			data-cycle-next= .cycle-next
			data-cycle-pager="#logo-slider-pager"
			data-cycle-prev="#logo-slider-prev"
			data-cycle-next="#logo-slider-next"
			data-cycle-slides="> .post-slide"
			data-cycle-carousel-visible=<?php echo absint( get_theme_mod( 'catch_sketch_logo_slider_visible_items', 5 ) ); ?>
			>

				<?php
					if ( 'custom' === $catch_sketch_type ) {
						get_template_part( 'template-parts/logo-slider/custom', 'logo-slider' );
					} else {
						get_template_part( 'template-parts/logo-slider/post-types', 'logo-slider' );
					}
				?>
			</div><!-- .cycle-slideshow -->
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #clients-section -->
