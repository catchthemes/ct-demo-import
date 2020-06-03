<?php
/**
 * The template for displaying portfolio items
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable = get_theme_mod( 'catch_sketch_portfolio_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_portfolio_type', 'category' );
$layout = get_theme_mod( 'catch_sketch_portfolio_content_layout', 'layout-three' );

if ( 'jetpack-portfolio' === $catch_sketch_type ) {
	$headline   = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'catch-sketch-pro' ) );
	$subheadline = get_option( 'jetpack_portfolio_content' );
} else {
	$headline = get_theme_mod( 'catch_sketch_portfolio_headline', esc_html__( 'Projects', 'catch-sketch-pro' ) );
	$subheadline = get_theme_mod( 'catch_sketch_portfolio_subheadline' );
}

$classes[] = 'portfolio-section section';

$classes[] = $layout;


if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-section-heading';
}

?>
<div id="portfolio-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div><!-- .section-title-wrapper -->
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="taxonomy-description-wrapper section-subtitle">
					<?php
	                $subheadline = apply_filters( 'the_content', $subheadline );
	                echo str_replace( ']]>', ']]&gt;', $subheadline );
	                ?>
				</div><!-- .taxonomy-description-wrapper -->
			<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper <?php echo esc_attr( $layout ); ?>">
			<div class="grid">
				<?php
				if( 'post' === $catch_sketch_type || 'jetpack-portfolio' === $catch_sketch_type || 'page' === $catch_sketch_type || 'category' === $catch_sketch_type || 'product' === $catch_sketch_type ) {
					get_template_part( 'template-parts/portfolio/post-types', 'portfolio' );
				} elseif ( 'custom' === $catch_sketch_type ) {
					get_template_part( 'template-parts/portfolio/image', 'portfolio' );
				}
				?>
			</div> <!-- .grid -->
		</div><!-- .portfolio-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-content-section -->
