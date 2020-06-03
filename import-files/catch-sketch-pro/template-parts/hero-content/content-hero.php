<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_section = get_theme_mod( 'catch_sketch_hero_content_visibility', 'homepage' );

if ( ! catch_sketch_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_hero_content_type', 'page' );

if ( 'page' === $catch_sketch_type || 'post' === $catch_sketch_type || 'category' === $catch_sketch_type ) :
	get_template_part( 'template-parts/hero-content/post-type', 'hero' );
else :
	get_template_part( 'template-parts/hero-content/custom', 'hero' );
endif;
