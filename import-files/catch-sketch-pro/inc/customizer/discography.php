<?php
/**
 * Featured Content options
 *
 * @package Catch_Sketch
 */

/**
 * Add discography options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_discography_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_discography', array(
			'title' => esc_html__( 'Discography', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_layout',
			'default'           => 'layout-three',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'choices'           => catch_sketch_sections_layout_options(),
			'label'             => esc_html__( 'Select Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_title',
			'default'           => esc_html__( 'Discography', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'textarea',
		)
	);

	$type = catch_sketch_section_type_options();

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_discography_active',
            'choices'           => $type,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_number',
			'default'           => 6,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_show',
			'default'           => 'hide-content',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_post_page_category_discography_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_meta_show',
			'default'           => 'show-meta',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_post_page_category_discography_active',
			'choices'           => catch_sketch_meta_show(),
			'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_category_discography_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_discography_select_category',
			'section'           => 'catch_sketch_discography',
			'type'              => 'dropdown-categories',
		)
	);

	$number = get_theme_mod( 'catch_sketch_discography_number', 6 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_post_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'catch_sketch_is_post_discography_active',
				'input_attrs'       => array(
					'style'             => 'width: 40px;'
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_discography',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select'
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_page_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_page_discography_active',
				'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_discography',
				'type'              => 'dropdown-pages',
				'allow_addition'    => true,
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Item #', 'catch-sketch-pro' ) .  $i,
				'section'           => 'catch_sketch_discography',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_image_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_link_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_target_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_content_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_discography_more_button_text_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_custom_discography_active',
				'label'             => esc_html__( 'More Button Text', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_discography',
				'type'              => 'text',
			)
		);
	} // End for().

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_discography_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_discography_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_discography',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_discography_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_discography_active' ) ) :
	/**
	* Return true if discography is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_discography_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_discography_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_discography_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_discography_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_discography_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_discography_active( $control ) && ( 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_page_discography_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_page_discography_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_discography_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_discography_active( $control ) && ( 'page' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_category_discography_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_category_discography_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_discography_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_discography_active( $control ) && ( 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_post_page_category_discography_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_post_page_category_discography_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_discography_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_discography_active( $control ) && ( 'category' === $type || 'page' === $type || 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_custom_discography_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_custom_discography_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_discography_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_discography_active( $control ) && ( 'custom' === $type ) );
	}
endif;
