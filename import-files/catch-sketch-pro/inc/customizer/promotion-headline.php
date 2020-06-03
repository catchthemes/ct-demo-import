<?php
/**
 * Promotion Headline Options
 *
 * @package Catch_Sketch
 */

/**
 * Add promotion headline options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_promotion_headline_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_promotion_headline_options', array(
			'title' => esc_html__( 'Promotion Headline', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_layout',
			'default'			=> 'default',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'label'             => esc_html__( 'Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'choices'           => array(
				'default'           => esc_html__( 'Default', 'catch-sketch-pro' ),
				'full-width-layout' => esc_html__( 'Full Width', 'catch-sketch-pro' ),
			),
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_type',
			'default'           => 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'choices'           => catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_page',
			'default'           => '0',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_page_promotion_headline_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_post',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_post_promotion_headline_active',
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'choices'           => catch_sketch_generate_post_array(),
			'type'              => 'select',
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
			'name'              => 'catch_sketch_promotion_headline_category',
			'default'           => '0',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_category_promotion_headline_active',
			'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
			'type'              => 'select',
			'choices'           => $cats,
			'section'           => 'catch_sketch_promotion_headline_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_promotion_headline_title',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'active_callback'   => 'catch_sketch_is_post_page_category_promotion_headline_active',
			'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'label'             => esc_html__( 'Subtitle', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_post_page_category_promotion_headline_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_align',
			'default'           => 'content-aligned-right',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'choices'           => array(
				'content-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'content-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
				'content-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_box_design',
			'default'           => 'style-one',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'choices'           => array(
				'style-one'  => esc_html__( 'Style One', 'catch-sketch-pro' ),
				'style-two'  => esc_html__( 'Style Two', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Box Style', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_promotion_headline_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Image Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'custom_control'    => 'catch_sketch_Toggle_Control',
		)
	);
	
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_more_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_more_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_promotion_headline_more_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_custom_promotion_headline_active',
			'label'             => esc_html__( 'Open Button Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_promotion_headline_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_promotion_headline_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_promotion_headline_active' ) ) :
	/**
	* Return true if promotion headline is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_promotion_headline_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_promotion_headline_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_promotion_headline_active' ) ) :
	/**
	* Return true if post content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_promotion_headline_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_promotion_headline_type' )->value();

		return ( catch_sketch_is_promotion_headline_active( $control ) && 'post' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_page_promotion_headline_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_page_promotion_headline_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_promotion_headline_type' )->value();

		return ( catch_sketch_is_promotion_headline_active( $control ) && 'page' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_category_promotion_headline_active' ) ) :
	/**
	* Return true if hero category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_category_promotion_headline_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_promotion_headline_type' )->value();

		return ( catch_sketch_is_promotion_headline_active( $control ) && 'category' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_page_category_promotion_headline_active' ) ) :
	/**
	* Return true if hero post/page/category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_page_category_promotion_headline_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_promotion_headline_type' )->value();

		return ( catch_sketch_is_promotion_headline_active( $control ) && ( 'page' === $type || 'post' === $type || 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_custom_promotion_headline_active' ) ) :
	/**
	* Return true if hero custom content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_custom_promotion_headline_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_promotion_headline_type' )->value();

		return ( catch_sketch_is_promotion_headline_active( $control ) && ( 'custom' === $type ) );
	}
endif;
