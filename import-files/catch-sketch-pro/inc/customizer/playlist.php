<?php
/**
 * Playlist Options
 *
 * @package Catch_Sketch
 */

/**
 * Add playlist options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_playlist( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_playlist', array(
			'title' => esc_html__( 'Playlist', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_playlist_bg_image',
            'sanitize_callback' => 'catch_sketch_sanitize_image',
            'active_callback'   => 'catch_sketch_is_playlist_active',
            'custom_control'    => 'WP_Customize_Image_Control',
            'label'             => esc_html__( 'Background Image', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_playlist',
        )
    );

	$types = catch_sketch_section_type_options();

	unset( $types['custom'] );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_type',
			'default'           => 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_playlist_active',
			'choices'           => $types,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist',
			'default'           => '0',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_page_playlist_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'type'              => 'dropdown-pages',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_post',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_post_playlist_active',
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'choices'           => catch_sketch_generate_post_array(),
			'type'              => 'select',
		)
	);

	// Create an empty array.
	$cats = array();

	$cats['0'] = esc_html__( '-- Select --', 'catch-sketch-pro' );

	// We loop over the categories and set the names and labels we need.
	foreach ( get_categories() as $categories => $category ) {
		$cats[ $category->term_id ] = $category->name;
	}

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_category',
			'default'           => '0',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_category_playlist_active',
			'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
			'type'              => 'select',
			'choices'           => $cats,
			'section'           => 'catch_sketch_playlist',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_section_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_playlist_active',
			'label'             => esc_html__( 'Sub Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_playlist_title',
			'default'           => '1',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_post_page_category_playlist_active',
			'label'             => esc_html__( 'Display title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_playlist_image_alignment',
			'default'           => 'content-align-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_playlist_active',
			'choices'           => array(
				'content-align-right' => esc_html__( 'Right', 'catch-sketch-pro' ),
				'content-align-left'  => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_playlist',
			'type'              => 'radio',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_playlist', 12 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_playlist_active' ) ) :
	/**
	* Return true if playlist is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_playlist_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_playlist_visibility' )->value();

		return catch_sketch_check_section( $enable );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_playlist_active' ) ) :
	/**
	* Return true if post content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_playlist_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_playlist_type' )->value();

		return ( catch_sketch_is_playlist_active( $control ) && 'post' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_page_playlist_active' ) ) :
	/**
	* Return true if page playlist is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_page_playlist_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_playlist_type' )->value();

		return ( catch_sketch_is_playlist_active( $control ) && 'page' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_category_playlist_active' ) ) :
	/**
	* Return true if category playlist is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_category_playlist_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_playlist_type' )->value();

		return ( catch_sketch_is_playlist_active( $control ) && 'category' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_page_category_playlist_active' ) ) :
	/**
	* Return true if post/page/category playlist is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_page_category_playlist_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_playlist_type' )->value();

		return ( catch_sketch_is_playlist_active( $control ) && ( 'page' == $type || 'post' == $type || 'category' == $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_playlist_custom_active' ) ) :
	/**
	* Return true if custom playlist is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_playlist_custom_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_playlist_type' )->value();

		return ( catch_sketch_is_playlist_active( $control ) && 'custom' == $type );
	}
endif;
