<?php
/**
 * Featured Slider Options
 *
 * @package Catch_Sketch
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_featured_slider', array(
			'panel' => 'catch_sketch_theme_options',
			'title' => esc_html__( 'Featured Slider', 'catch-sketch-pro' ),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_style',
			'default'           => 'style-one',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => array(
				'style-one' => esc_html__( 'Style One', 'catch-sketch-pro' ),
				'style-two' => esc_html__( 'Style Two (Full Width)', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Style', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_transition_effect',
			'default'           => 'fade',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'choices'           => catch_sketch_slider_transition_effects(),
			'label'             => esc_html__( 'Transition Effect', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_transition_delay',
			'default'           => '4',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 40px;',
			),
			'label'             => esc_html__( 'Transition Delay', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_transition_length',
			'default'           => '1',
			'sanitize_callback' => 'absint',

			'active_callback'   => 'catch_sketch_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
			),
			'label'             => esc_html__( 'Transition Length', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_pager',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'active_callback'   => 'catch_sketch_is_slider_active',
			'label'             => esc_html__( 'Pager/navigation', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'choices'           =>  catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Select Slider Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',

			'active_callback'   => 'catch_sketch_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_exclude_slider_post',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_post_slider_active',
			'label'             => esc_html__( 'Exclude Slider post from Homepage posts', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_category_slider_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_slider_select_category',
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'dropdown-categories',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_post_page_category_slider_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_meta_show',
			'default'           => 'hide-meta',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_post_page_category_slider_active',
			'choices'           => catch_sketch_meta_show(),
			'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_content_align',
			'default'           => 'content-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'choices'           => array(
				'content-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'content-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_slider_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_slider_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'catch_sketch_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Post Sliders
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_slider_post_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_post_slider_active',
				'input_attrs'       => array(
					'style' => 'width: 80px;',
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' # ' . $i,
				'section'           => 'catch_sketch_featured_slider',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select',
			)
		);

		// Page Sliders
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_slider_page_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_page_slider_active',
				'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' # ' . $i,
				'section'           => 'catch_sketch_featured_slider',
				'type'              => 'dropdown-pages',
				'allow_addition'    => true,
			)
		);

		// Image Sliders
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_slider_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Slide #', 'catch-sketch-pro' ) . $i,
				'section'           => 'catch_sketch_featured_slider',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_slider_image_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_link_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_target_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_title_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_sub_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Subtitle', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_content_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_image_slider_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_featured_slider',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_text_white_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_slider_style_two_active',
				'label'             => esc_html__( 'White text color for slide #', 'catch-sketch-pro' ) . $i,
				'section'           => 'catch_sketch_featured_slider',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'catch_sketch_slider_options' );

/** Active Callback Functions */
if( ! function_exists( 'catch_sketch_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_slider_option' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if( ! function_exists( 'catch_sketch_is_slider_style_two_active' ) ) :
	/**
	* Return true if slider style two is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_slider_style_two_active( $control ) {
		$style = $control->manager->get_setting( 'catch_sketch_slider_style' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( catch_sketch_is_slider_active( $control ) && 'style-two' === $style );
	}
endif;

if( ! function_exists( 'catch_sketch_is_post_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_slider_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is or is not selected type
		return ( catch_sketch_is_slider_active( $control ) && ( 'post' === $type ) );
	}
endif;

if( ! function_exists( 'catch_sketch_is_page_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_page_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_slider_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is or is not selected type
		return ( catch_sketch_is_slider_active( $control ) && 'page' === $type );
	}
endif;

if( ! function_exists( 'catch_sketch_is_category_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_category_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_slider_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is or is not selected type
		return ( catch_sketch_is_slider_active( $control ) && 'category' === $type );
	}
endif;

if( ! function_exists( 'catch_sketch_is_image_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_image_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_slider_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is or is not selected type
		return ( catch_sketch_is_slider_active( $control ) && ( 'custom' === $type ) );
	}
endif;

if( ! function_exists( 'catch_sketch_is_post_page_category_slider_active' ) ) :
	/**
	* Return true if post page category slider is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_page_category_slider_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_slider_type' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected and is or is not selected type
		return ( catch_sketch_is_slider_active( $control ) && ( 'post' === $type || 'page' === $type || 'category' === $type ) );
	}
endif;
