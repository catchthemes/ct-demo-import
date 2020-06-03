<?php
/**
 * Hero Content Options
 *
 * @package Catch_Sketch
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_layout',
			'default'           => 'default',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_hero_content_active',
			'choices'           => array(
				'default'           => esc_html__( 'Default', 'catch-sketch-pro' ),
				'full-width-layout' => esc_html__( 'Full Width', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_type',
			'default'           => 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_hero_content_active',
			'choices'           => catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_hero_page_content_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_post',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_hero_post_content_active',
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
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
			'name'              => 'catch_sketch_hero_content_category',
			'default'           => '0',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_hero_category_content_active',
			'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
			'type'              => 'select',
			'choices'           => $cats,
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_hero_content_meta',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_hero_post_category_content_active',
			'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_hero_content_title',
			'default'           => 1,
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_hero_post_page_category_content_active',
			'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_show',
			'default'           => 'full-content',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_hero_post_page_category_content_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_hero_content_author',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_hero_post_page_category_content_active',
			'label'             => esc_html__( 'Display Author', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_position',
			'default'           => 'content-aligned-right',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_hero_content_active',
			'choices'           => array(
				'content-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'content-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_hero_content_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_meta',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_subtitle',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_content_active',
			'label'             => esc_html__( 'Subtitle', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_content',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Image Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_more_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_more_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_more_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Open Button Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_author_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Author Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_author_name',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Author Name', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hero_content_author_desc',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_hero_custom_content_active',
			'label'             => esc_html__( 'Author Description', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_hero_content_options',
			'type'              => 'text',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_post_content_active' ) ) :
	/**
	* Return true if post content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && 'post' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_page_content_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && 'page' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_category_content_active' ) ) :
	/**
	* Return true if hero category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && 'category' == $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_post_page_category_content_active' ) ) :
	/**
	* Return true if hero post/page/category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_post_page_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && ( 'page' == $type || 'post' == $type || 'category' == $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_post_category_content_active' ) ) :
	/**
	* Return true if hero post/page/category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_post_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && ( 'post' == $type || 'category' == $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_hero_custom_content_active' ) ) :
	/**
	* Return true if hero custom content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_hero_custom_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_hero_content_type' )->value();

		return ( catch_sketch_is_hero_content_active( $control ) && ( 'custom' == $type ) );
	}
endif;
