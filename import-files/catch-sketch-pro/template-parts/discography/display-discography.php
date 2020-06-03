<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_discography_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_discography_type', 'category' );


if ( 'custom' !== $catch_sketch_type ) {
	$featured_posts = catch_sketch_get_discography_posts();

	if ( empty( $featured_posts ) ) {
		return;
	}
}


$catch_sketch_title      = get_theme_mod( 'catch_sketch_discography_title', esc_html__( 'Discography', 'catch-sketch-pro' ) );
$subtitle   = get_theme_mod( 'catch_sketch_discography_sub_title' );
$layout     = get_theme_mod( 'catch_sketch_discography_layout', 'layout-three' );
$text_align = get_theme_mod( 'catch_sketch_discography_text_align', 'text-aligned-left' );

$classes[] = 'discography-section';
$classes[] = 'section';
$classes[] = $text_align;

?>

<div id="discography-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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
				get_template_part( 'template-parts/discography/content-custom' );
			} else {
				foreach ( $featured_posts as $post ) {
					setup_postdata( $post );

					// Include the featured content template.
					get_template_part( 'template-parts/discography/content-discography' );
				}

				wp_reset_postdata();
			}
			?>

			<?php
				$target = get_theme_mod( 'catch_sketch_discography_target' ) ? '_blank': '_self';
				$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_discography_link', '#' );
				$text   = get_theme_mod( 'catch_sketch_discography_text' );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>

		</div><!-- .discography-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #discography-section -->
