<?php
/**
 * The template used for displaying playlist
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_section = get_theme_mod( 'catch_sketch_sticky_playlist_visibility', 'disabled' );

if ( ! catch_sketch_check_section( $enable_section ) ) {
	// Bail if playlist is not enabled
	return;
}

get_template_part( 'template-parts/sticky-playlist/post-type', 'playlist' );
