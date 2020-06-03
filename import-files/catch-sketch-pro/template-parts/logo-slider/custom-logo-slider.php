<?php
/**
 * The template for displaying featured image content
 *
 * @package Catch_Sketch
 */
?>

<?php
$quantity = get_theme_mod( 'catch_sketch_logo_slider_number', 5 );

for ( $i = 1; $i <= $quantity; $i++ ) {
	$target               = get_theme_mod( 'catch_sketch_logo_slider_target_' . $i ) ? '_blank' : '_self';
	$catch_sketch_title   = get_theme_mod( 'catch_sketch_logo_slider_title_' . $i );
	$catch_sketch_catlink = get_theme_mod( 'catch_sketch_logo_slider_link_' . $i ) ? get_theme_mod( 'catch_sketch_logo_slider_link_' . $i ) : '#';

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$catch_sketch_catlink = qtrans_convertURL( $catch_sketch_catlink );
	}

	echo '
	<article id="featured-post-' . esc_attr( $i ) . '" class="hentry featured-image-content">';

		$image   = get_theme_mod( 'catch_sketch_logo_slider_image_' . $i ) ? get_theme_mod( 'catch_sketch_logo_slider_image_' . $i ) :  trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-226x180.jpg';

		echo '
		<div class="clients-section-thumbnail post-thumbnail">
			<a href="' . esc_url( $catch_sketch_catlink ) . '" target="' . $target . '" >
				<img src="' . esc_url( $image ) . '" class="wp-post-image" alt="' . esc_attr( $catch_sketch_title ) . '" title="' . esc_attr( $catch_sketch_title ) . '">
			</a>
		</div>
	</article><!-- .featured-post-' . esc_attr( $i ) . ' -->';
} // End for().
