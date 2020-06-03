<?php 
/**
 * The template used for displaying hero content
 *
 * @package My Music Band
 */
$enable_section = get_theme_mod( 'catch_sketch_app_section_visibility', 'disabled' );

if ( ! catch_sketch_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_app_section_type', 'page' );

if ( 'page' === $catch_sketch_type || 'post' === $catch_sketch_type || 'category' === $catch_sketch_type ) {
	get_template_part( 'template-parts/app-section/post-type-app' );
} else {
	get_template_part( 'template-parts/app-section/custom-app' );
}
