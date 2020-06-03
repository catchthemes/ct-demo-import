<?php
/**
 * App section Options
 *
 * @package My Music Band
 */

/**
 * Add app section options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_app_section_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_app_section', array(
			'title' => esc_html__( 'App Section', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_image_position',
			'default'           => 'content-align-right',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_app_section_active',
			'choices'           => array(
				'content-align-right' => esc_html__( 'Right Align', 'catch-sketch-pro' ),
				'content-align-left'  => esc_html__( 'Left Align', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_app_section_active',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-align-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-align-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'select',
		)
	);

	$types = catch_sketch_section_type_options();

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_type',
			'default'           => 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_app_section_active',
			'choices'           => $types,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section',
			'default'           => '0',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_app_section_page_content_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'dropdown-pages',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_post',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_app_section_post_content_active',
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
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
			'name'              => 'catch_sketch_app_section_category',
			'default'           => '0',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_app_section_category_content_active',
			'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
			'type'              => 'select',
			'choices'           => $cats,
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Main Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_app_section_title',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'active_callback'   => 'catch_sketch_is_app_section_post_page_category_product_content_active',
			'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_subtitle',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_app_section_active',
			'label'             => esc_html__( 'Subtitle', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'text',
		)
	);

	   catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_app_section_logo_image',
            'sanitize_callback' => 'catch_sketch_sanitize_image',
            'custom_control'    => 'WP_Customize_Image_Control',
            'active_callback'   => 'catch_sketch_is_app_section_active',
            'label'             => esc_html__( 'Logo Image', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_app_section',
        )
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_show',
			'default'           => 'full-content',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_app_section_post_page_category_product_content_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_content',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_first_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image First', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_first_image_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image First Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_second_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image Second', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_second_image_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image Second Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_third_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image Third', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_third_image_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'App Image Third Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_button_one_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Button #1 Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_button_one_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Button #1 Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_button_two_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Button #2 Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_button_two_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Button #2 Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_app_section_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_app_section_custom_content_active',
			'label'             => esc_html__( 'Open Links in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_app_section',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_app_section_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_app_section_active' ) ) :
	/**
	* Return true if promotion headline is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_app_section_visibility' )->value();

		return ( catch_sketch_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'catch_sketch_is_app_section_post_content_active' ) ) :
	/**
	* Return true if post content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && 'post' === $type );
	}
endif;


if ( ! function_exists( 'catch_sketch_is_app_section_page_content_active' ) ) :
	/**
	* Return true if promotion headline page content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && 'page' === $type );
	}
endif;


if ( ! function_exists( 'catch_sketch_is_app_section_category_content_active' ) ) :
	/**
	* Return true if promotion headline category content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && 'category' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_app_section_post_page_category_product_content_active' ) ) :
	/**
	* Return true if promotion headline post/page/category content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_post_page_category_product_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && ( 'page' === $type || 'post' === $type || 'category' === $type || 'product' === $type ) );
	}
endif;


if ( ! function_exists( 'catch_sketch_is_app_section_custom_content_active' ) ) :
	/**
	* Return true if promotion headline custom content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_custom_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && 'custom' === $type );
	}
endif;

if( ! function_exists( 'catch_sketch_is_app_section_product_content_active' ) ) :
	/**
	* Return true if promotion headline product content is active
	*
	* @since My Music Band Pro 1.0
	*/
	function catch_sketch_is_app_section_product_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_app_section_type' )->value();

		return ( catch_sketch_is_app_section_active( $control ) && 'product' === $type );
	}
endif;
