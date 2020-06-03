<?php
/**
 * The template for displaying logo-slider items
 *
 * @package Catch_Sketch
 */
?>

<?php
$number = get_theme_mod( 'catch_sketch_logo_slider_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$catch_sketch_type = get_theme_mod( 'catch_sketch_logo_slider_type', 'category' );

if ( 'post' === $catch_sketch_type || 'page' === $catch_sketch_type  ) {
	$args['post_type'] = $catch_sketch_type;

	for ( $i = 1; $i <= $number; $i++ ) {
		$catch_sketch_post_id = '';

		if ( 'post' === $catch_sketch_type ) {
			$catch_sketch_post_id = get_theme_mod( 'catch_sketch_logo_slider_post_' . $i );
		} elseif ( 'page' === $catch_sketch_type ) {
			$catch_sketch_post_id = get_theme_mod( 'catch_sketch_logo_slider_page_' . $i );
		}

		if ( $catch_sketch_post_id && '' !== $catch_sketch_post_id ) {
			// Polylang Support.
			if ( class_exists( 'Polylang' ) ) {
				$catch_sketch_post_id = pll_get_post( $catch_sketch_post_id, pll_current_language() );
			}

			$post_list = array_merge( $post_list, array( $catch_sketch_post_id ) );

			$no_of_post++;
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby'] = 'post__in';
}
elseif ( 'category' === $catch_sketch_type ) {
	$no_of_post = $number;

	if ( get_theme_mod( 'catch_sketch_logo_slider_select_category' ) ) {
		$args['category__in'] = (array) get_theme_mod( 'catch_sketch_logo_slider_select_category' );
	}

	$args['post_type'] = 'post';
}

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop                   = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		get_template_part( 'template-parts/logo-slider/content', 'logo-slider' );

	endwhile;
	wp_reset_postdata();
endif;
