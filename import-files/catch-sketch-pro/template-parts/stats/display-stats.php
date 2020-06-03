<?php
/**
 * The template for displaying stats content
 *
 * @package Catch_Sketch
 */
?>

<?php

$enable_content = get_theme_mod( 'catch_sketch_stats_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if stats content is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_stats_type', 'category' );

if ( 'custom' !== $catch_sketch_type ) {
	$stats_posts = catch_sketch_get_stats_posts();

	if ( empty( $stats_posts ) ) {
		return;
	}

}

$catch_sketch_title      = get_theme_mod( 'catch_sketch_stats_archive_title' );
$sub_title  = get_theme_mod( 'catch_sketch_stats_sub_title' );
$text_align = get_theme_mod( 'catch_sketch_stats_text_align', 'text-aligned-left' );

$layout = get_theme_mod( 'catch_sketch_stats_layout', 'layout-four' );

$classes[] = 'stats-section';
$classes[] = 'section';
$classes[] = $text_align;

if ( $catch_sketch_title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}

?>

<div id="stats-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">

			<?php if ( $catch_sketch_title || $sub_title ) : ?>
				<div class="section-heading-wrapper">
					<?php if ( $catch_sketch_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
						</div><!-- .page-title-wrapper -->
					<?php endif; ?>

					<?php if ( $sub_title ) : ?>
						<div class="section-description">
							<?php echo wp_kses_post( $sub_title ); ?>
						</div><!-- .section-description -->
					<?php endif; ?>
				</div><!-- .section-heading-wrapper -->
			<?php endif; ?>

			<div class="section-content-wrapper <?php echo esc_attr( $layout ); ?>">

				<?php
				if ( 'custom' === $catch_sketch_type ) {
					get_template_part( 'template-parts/stats/content', 'custom' );
				} else {
					foreach ( $stats_posts as $post ) {
						setup_postdata( $post );

						// Include the stats content template.
						get_template_part( 'template-parts/stats/content', 'stats' );
					}

					wp_reset_postdata();
				}
				?>

				<?php
					$target = get_theme_mod( 'catch_sketch_stats_target' ) ? '_blank': '_self';
					$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_stats_link', '#' );
					$text   = get_theme_mod( 'catch_sketch_stats_text' );

					if ( $text ) :
				?>
				<p class="view-all-button">
					<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a></span>
				</p>
				<?php endif; ?>

			</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #stats-section -->
