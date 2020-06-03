<?php
/**
 * The template used for displaying promotion_headline content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_section = get_theme_mod( 'catch_sketch_promotion_headline_visibility', 'homepage' );

if ( ! catch_sketch_check_section( $enable_section ) ) {
	// Bail if promotion_headline content is not enabled
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_promotion_headline_type', 'page' );

if ( 'page' === $catch_sketch_type || 'post' === $catch_sketch_type || 'category' === $catch_sketch_type ) :
	get_template_part( 'template-parts/promotion-headline/post-type', 'promotion-headline' );
else :
	get_template_part( 'template-parts/promotion-headline/custom', 'promotion-headline' );
endif;
