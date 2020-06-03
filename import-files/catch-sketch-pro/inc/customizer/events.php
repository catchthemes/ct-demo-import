<?php
/**
* The template for adding Events Settings in Customizer
*
* @package Catch_Sketch
*/

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_events_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_events', array(
			'panel' => 'catch_sketch_theme_options',
			'title' => esc_html__( 'Events', 'catch-sketch-pro' ),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_bg_image',
			'active_callback'   => 'catch_sketch_is_events_active',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
		)
	);

	$choices = catch_sketch_section_type_options();

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_events_active',
			'choices'           => $choices,
			'label'             => esc_html__( 'Select Content Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_headline',
			'default'           => esc_html( 'Tour Dates', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_events_active',
			'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_subheadline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_events_active',
			'label'             => esc_html__( 'Sub-headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_number',
			'default'           => 3,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_events_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_enable_title',
			'default'           => 1,
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_post_page_cagetory_events_active',
			'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_display_date',
			'default'           => 1,
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_post_page_cagetory_events_active',
			'label'             => esc_html__( 'Display Event Date', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_category_events_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_events_select_category',
			'section'           => 'catch_sketch_events',
			'settings'          => 'catch_sketch_events_select_category',
			'type'              => 'dropdown-categories',
		)
	);

	$number = get_theme_mod( 'catch_sketch_events_number', 3 );

	for ( $i=1; $i <= $number; $i++ ) {
		//for post events
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_post_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_post_events_active',
				'input_attrs'       => array(
					'style' => 'width: 100px;'
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_events',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_page_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_page_events_active',
				'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_events',
				'type'              => 'dropdown-pages',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_note_'. $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Event #', 'catch-sketch-pro' ) .  $i,
				'section'           => 'catch_sketch_events',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_link_'. $i,
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_target_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_title_'. $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_date_day_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_number_range',
				'default'           => '1',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Date Day', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'type'              => 'number',
				'input_attrs'       => array(
					'style' => 'width: 45px;',
					'min'   => 1,
					'max'   => 31
				),
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_date_month_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_number_range',
				'default'           => '1',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Date Month', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'type'              => 'number',
				'input_attrs'       => array(
					'style' => 'width: 45px;',
					'min'   => 1,
					'max'   => 12
				),
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_date_year_'. $i,
				'sanitize_callback' => 'catch_sketch_sanitize_number_range',
				'default'           => '2019',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Date Year', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'type'              => 'number',
				'input_attrs'       => array(
					'style' => 'width: 100px;',
					'min'   => 1000,
					'max'   => 9999
				),
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_content_'. $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_custom_events_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_events',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_events_individual_text_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_events_active',
				'label'             => esc_html__( 'More Text', 'catch-sketch-pro' ) . ' ' . $i,
				'section'           => 'catch_sketch_events',
				'type'              => 'text',
			)
		);
	}

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_events_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_link',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_events_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_events_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_events_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_events',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_events_options', 10 );

/** Active Callbacks **/
if ( ! function_exists( 'catch_sketch_is_events_active' ) ) :
	/**
	* Return true if events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_events_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_events_option' )->value();

		return catch_sketch_check_section( $enable );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_events_active' ) ) :
	/**
	* Return true if page events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_post_events_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_events_type' )->value();

		return ( catch_sketch_is_events_active( $control ) && 'post' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_page_events_active' ) ) :
	/**
	* Return true if page events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_page_events_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_events_type' )->value();

		return ( catch_sketch_is_events_active( $control ) && 'page' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_category_events_active' ) ) :
	/**
	* Return true if page events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_category_events_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_events_type' )->value();

		return ( catch_sketch_is_events_active( $control ) && 'category' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_page_cagetory_events_active' ) ) :
	/**
	* Return true if post/page/category events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_post_page_cagetory_events_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_events_type' )->value();

		return ( catch_sketch_is_events_active( $control ) && ( 'post' == $type || 'page' == $type || 'category' == $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_image_events_active' ) ) :
	/**
	* Return true if image events is active
	*
	* * @since 2.0
	*/
	function catch_sketch_is_custom_events_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_events_type' )->value();

		return ( catch_sketch_is_events_active( $control ) && 'custom' === $type );
	}
endif;
