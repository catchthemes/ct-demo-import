<?php
/**
 * Gallery Options
 *
 * @package  Catch Sketch Pro
 */

/**
 * Add gallery options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_gallery_options( $wp_customize ) {
	// Add note to Gallery Colors Section.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_colors_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'catch_sketch_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Gallery Options, go %1$shere%2$s', 'catch-sketch-pro' ),
				'<a href="javascript:wp.customize.section( \'catch_sketch_gallery_options\' ).focus();">',
				 '</a>'
			),
			'section'           => 'catch_sketch_colors_gallery',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	// Add note to Gallery Section so that user can move to colors section quickly.

	$wp_customize->add_section( 'catch_sketch_gallery_options', array(
			'title' => esc_html__( 'Gallery', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'type'              => 'select',
		)
	);
	
	$types = catch_sketch_section_type_options();

	// Unset image as gallery content has no image
	unset( $types['custom'] );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_type',
			'default'           => 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_gallery_active',
			'choices'           => $types,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_gallery_page_content_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_post',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_gallery_post_content_active',
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'choices'           => catch_sketch_generate_post_array(),
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_gallery_active',
			'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'type'              => 'text',
		)
	);

	// create an empty array.
	$cats = array();

	$cats['0'] = esc_html__( '-- Select --', 'catch-sketch-pro' );

	// we loop over the categories and set the names and
	// labels we need.
	foreach ( get_categories() as $categories => $category ) {
		$cats[ $category->term_id ] = $category->name;
	}

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_gallery_category',
			'default'           => '0',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_gallery_category_content_active',
			'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
			'type'              => 'select',
			'choices'           => $cats,
			'section'           => 'catch_sketch_gallery_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_gallery_title',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'active_callback'   => 'catch_sketch_is_gallery_post_page_category_content_active',
			'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_gallery_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_gallery_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_gallery_active' ) ) :
	/**
	* Return true if gallery content is active
	*
	* * * @since 1.0
	*/
	function catch_sketch_is_gallery_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_gallery_visibility' )->value();

		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_gallery_post_content_active' ) ) :
	/**
	* Return true if post content is active
	*
	* * * @since 1.0
	*/
	function catch_sketch_is_gallery_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_gallery_type' )->value();

		return ( catch_sketch_is_gallery_active( $control ) && 'post' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_gallery_page_content_active' ) ) :
	/**
	* Return true if gallery page content is active
	*
	* * * @since 1.0
	*/
	function catch_sketch_is_gallery_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_gallery_type' )->value();

		return ( catch_sketch_is_gallery_active( $control ) && 'page' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_gallery_category_content_active' ) ) :
	/**
	* Return true if gallery category content is active
	*
	* * * @since 1.0
	*/
	function catch_sketch_is_gallery_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_gallery_type' )->value();

		return ( catch_sketch_is_gallery_active( $control ) && 'category' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_gallery_post_page_category_content_active' ) ) :
	/**
	* Return true if gallery post/page/category content is active
	*
	* * * @since 1.0
	*/
	function catch_sketch_is_gallery_post_page_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_gallery_type' )->value();

		return ( catch_sketch_is_gallery_active( $control ) && ( 'page' === $type || 'post' === $type || 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_gallery_bg_active' ) ) :
    /**
    * Return true if background is set
    *
    * * @since 1.0
    */
    function catch_sketch_is_gallery_bg_active( $control ) {
        $bg_image = $control->manager->get_setting( 'catch_sketch_gallery_bg_image' )->value();

        return ( catch_sketch_is_gallery_active( $control ) && '' !== $bg_image );
    }
endif;
