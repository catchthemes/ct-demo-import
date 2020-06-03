<?php
/**
 * Logo Slider Options
 *
 * @package Catch_Sketch
 */

/**
 * Add Logo Slider options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_logo_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_logo_slider', array(
			'title' => esc_html__( 'Logo Slider', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable Logo Slider on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_transition_delay',
			'default'           => 4,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'catch-sketch-pro' ),
				'input_attrs' => array(
				'style'       => 'width: 40px;',
				'min'         => 0,
			),
			'label'             => esc_html__( 'Transition Delay', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_transition_length',
			'default'           => 1,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'Transition Length', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'choices'           => catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Logo Slider Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_sub_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'label'             => esc_html__( 'Sub Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_number',
			'default'           => 5,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_visible_items',
			'default'           => 5,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_logo_slider_active',
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 1,
				'max'   => 5,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of visible items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'active_callback'   => 'catch_sketch_is_logo_category_slider_active',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_logo_slider_select_category',
			'section'           => 'catch_sketch_logo_slider',
			'type'              => 'dropdown-categories',
		)
	);

	//loop for featured post sliders
	for ( $i=1; $i <= get_theme_mod( 'catch_sketch_logo_slider_number', 5 ); $i++ ) {
		//post content
		catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_logo_slider_post_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_logo_post_slider_active',
				'input_attrs'       => array( 'style' => 'width: 100px;'),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_logo_slider',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select',
			)
		);

		//page content
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_page_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_logo_page_slider_active',
				'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_logo_slider',
				'type'              => 'dropdown-pages',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_note_'. $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_logo_image_slider_active',
				'label'             => esc_html__( 'Item #', 'catch-sketch-pro' ) . $i,
				'section'           => 'catch_sketch_logo_slider',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_image_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_logo_image_slider_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_logo_slider',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_title_'. $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_logo_image_slider_active',
				'label'             => esc_html__( 'Title/Image Alt', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_logo_slider',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_link_'. $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_logo_image_slider_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_logo_slider',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_logo_slider_target_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_logo_image_slider_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_logo_slider',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);
	}
}
add_action( 'customize_register', 'catch_sketch_logo_slider_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_logo_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_logo_slider_option' )->value();

		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_logo_post_slider_active' ) ) :
	/**
	* Return true if post content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_logo_post_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_logo_slider_type' )->value();

		return ( catch_sketch_is_logo_slider_active( $control ) && 'post' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_logo_page_slider_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_logo_page_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_logo_slider_type' )->value();

		return ( catch_sketch_is_logo_slider_active( $control ) && 'page' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_logo_category_slider_active' ) ) :
	/**
	* Return true if hero category content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_logo_category_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_logo_slider_type' )->value();

		return ( catch_sketch_is_logo_slider_active( $control ) && 'category' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_logo_image_slider_active' ) ) :
	/**
	* Return true if image logo slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_logo_image_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_logo_slider_type' )->value();

		return ( catch_sketch_is_logo_slider_active( $control ) && 'custom' === $type );
	}
endif;
