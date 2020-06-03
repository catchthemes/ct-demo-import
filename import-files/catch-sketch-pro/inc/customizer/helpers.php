<?php

/**
 * Function to register control and setting
 */
function catch_sketch_register_option( $wp_customize, $option ) {
	// Initialize Setting.
	$wp_customize->add_setting( $option['name'], array(
		'sanitize_callback'    => $option['sanitize_callback'],
		'default'              => isset( $option['default'] ) ? $option['default'] : '',
		'transport'            => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
		'theme_supports'       => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
	) );

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => isset( $option['settings'] ) ? $option['settings'] : $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * * * @since 1.0
 * @see catch_sketch_customize_register()
 *
 * @return void
 */
function catch_sketch_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * * * @since 1.0
 * @see catch_sketch_customize_register()
 *
 * @return void
 */
function catch_sketch_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Alphabetically sort theme options sections
 *
 * @param  wp_customize object $wp_customize wp_customize object.
 */
function catch_sketch_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'catch_sketch_' ) && 'catch_sketch_important_links' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority = $priority++;
	}
}
add_action( 'customize_register', 'catch_sketch_sort_sections_list' );

/**
 * Returns an array of visibility options for featured sections
 *
 * * @since 1.0
 */
function catch_sketch_section_visibility_options() {
	$options = array(
		'disabled'    => esc_html__( 'Disabled', 'catch-sketch-pro' ),
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'catch-sketch-pro' ),
		'entire-site' => esc_html__( 'Entire Site', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_section_visibility_options', $options );
}

/**
 * Returns an array of featured content options
 *
 * * @since 1.0
 */
function catch_sketch_sections_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'catch-sketch-pro' ),
		'layout-two'   => esc_html__( '2 columns', 'catch-sketch-pro' ),
		'layout-three' => esc_html__( '3 columns', 'catch-sketch-pro' ),
		'layout-four'  => esc_html__( '4 columns', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_sections_layout_options', $options );
}

/**
 * Returns an array of section types
 *
 * * @since 1.0
 */
function catch_sketch_section_type_options() {
	$options = array(
		'post'     => esc_html__( 'Post', 'catch-sketch-pro' ),
		'page'     => esc_html__( 'Page', 'catch-sketch-pro' ),
		'category' => esc_html__( 'Category', 'catch-sketch-pro' ),
		'custom'   => esc_html__( 'Custom', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_section_type_options', $options );
}

/**
 * Returns an array of comment options for Foodie World.
 *
 * * @since 1.0
 */
function catch_sketch_comment_options() {
	$comment_options = array(
		'use-wordpress-setting' => esc_html__( 'Use WordPress Setting', 'catch-sketch-pro' ),
		'disable-in-pages'      => esc_html__( 'Disable in Pages', 'catch-sketch-pro' ),
		'disable-completely'    => esc_html__( 'Disable Completely', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_comment_options', $comment_options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * * @since 1.0
 */
function catch_sketch_get_pagination_types() {
	$pagination_types = array(
		'default' => esc_html__( 'Default(Older Posts/Newer Posts)', 'catch-sketch-pro' ),
		'numeric' => esc_html__( 'Numeric', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_get_pagination_types', $pagination_types );
}

/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function catch_sketch_generate_post_array( $post_type = 'post' ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	$output['0']= esc_html__( '-- Select --', 'catch-sketch-pro' );

	foreach ( $posts as $post ) {
		/* translators: 1: post id. */
		$output[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : sprintf( __( '#%d (no title)', 'catch-sketch-pro' ), $post->ID );
	}

	return $output;
}

/**
 * Generate a list of all available taxonomy
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function catch_sketch_generate_taxonomy_array( $taxonomy = 'category' ) {
	$output = array();
	$taxonomy = get_categories( array( 'taxonomy' => $taxonomy ) );

	$output['0']= esc_html__( '-- Select --', 'catch-sketch-pro' );

	foreach ( $taxonomy as $tax ) {
		$output[ $tax->term_id ] = ! empty($tax->name ) ?$tax->name : sprintf( __( '#%d (no title)', 'catch-sketch-pro' ), $tax->term_id );
	}

	return $output;
}

if ( ! function_exists( 'catch_sketch_get_default_sections_value' ) ) :
	/**
	 * Returns default sections value
	 */
	function catch_sketch_get_default_sections_value() {
		$sections = catch_sketch_get_sortable_sections();
		$value    = array_keys( $sections );
		$value    = implode( ',', $value );

		return $value;
	}
endif;

/**
 * Returns an array of feature slider transition effects
 *
 * * @since 1.0
 */
function catch_sketch_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'catch-sketch-pro' ),
		'fadeout'    => esc_html__( 'Fade Out', 'catch-sketch-pro' ),
		'none'       => esc_html__( 'None', 'catch-sketch-pro' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'catch-sketch-pro' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'catch-sketch-pro' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'catch-sketch-pro' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'catch-sketch-pro' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'catch-sketch-pro' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'catch-sketch-pro' ),
		'shuffle'    => esc_html__( 'Shuffle', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_slider_transition_effects', $options );
}

/**
 * Returns an array of featured content show registered for catch sketch.
 *
 * * @since 1.0
 */
function catch_sketch_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'catch-sketch-pro' ),
		'full-content' => esc_html__( 'Full Content', 'catch-sketch-pro' ),
		'hide-content' => esc_html__( 'Hide Content', 'catch-sketch-pro' ),
	);
	return apply_filters( 'catch_sketch_content_show', $options );
}

/**
 * Returns an array of featured content show registered for catch sketch.
 *
 * * @since 1.0
 */
function catch_sketch_meta_show() {
	$options = array(
		'show-meta' => esc_html__( 'Show Meta', 'catch-sketch-pro' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'catch-sketch-pro' ),
	);
	return apply_filters( 'catch_sketch_meta_show', $options );
}

/**
 * Returns an array of featured content show registered for catch sketch.
 *
 * * @since 1.0
 */
function catch_sketch_category_show() {
	$options = array(
		'show-cat' => esc_html__( 'Show Category', 'catch-sketch-pro' ),
		'hide-cat' => esc_html__( 'Hide Category', 'catch-sketch-pro' ),
	);
	return apply_filters( 'catch_sketch_content_show', $options );
}
