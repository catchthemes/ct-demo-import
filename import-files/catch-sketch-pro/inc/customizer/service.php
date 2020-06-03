<?php
/**
 * Services options
 *
 * @package Catch_Sketch
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for this theme, go %1$shere%2$s', 'catch-sketch-pro' ),
                '<a href="javascript:wp.customize.section( \'catch_sketch_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_sketch_service', array(
			'title' => esc_html__( 'Services', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_layout',
			'default'           => 'layout-three',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_services_active',
			'choices'           => catch_sketch_sections_layout_options(),
			'label'             => esc_html__( 'Select Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_archive_title',
			'default'           => esc_html__( 'Services', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_cpt_services_inactive',
			'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_cpt_services_inactive',
			'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'textarea',
		)
	);

	$type = catch_sketch_section_type_options();

	$type['ect-service'] = esc_html__( 'Custom Post Type', 'catch-sketch-pro' );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_services_active',
			'description'       => sprintf( esc_html__( 'For Custom Post Type Content, install %1$sEssential Content Types%2$s Plugin with Services Type Enabled', 'catch-sketch-pro' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'choices'           => $type,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'active_callback'   => 'catch_sketch_is_services_cpt_content_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-sketch-pro' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_sketch_service',
            'type'              => 'description',
        )
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_number',
			'default'           => 6,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_services_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_services_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_services_post_page_category_cpt_content_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_meta_show',
			'default'           => 'hide-meta',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_services_post_page_category_cpt_content_active',
			'choices'           => catch_sketch_meta_show(),
			'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_service',
			'type'              => 'select',
		)
	);


	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_service_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_services_category_content_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_service_select_category',
			'section'           => 'catch_sketch_service',
			'type'              => 'dropdown-categories',
		)
	);

	$number = get_theme_mod( 'catch_sketch_service_number', 6 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_post_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'catch_sketch_is_services_post_content_active',
				'input_attrs'       => array(
					'style'             => 'width: 40px;'
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_service',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select'
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_page_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_services_page_content_active',
				'label'             => esc_html__( 'Services Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_service',
				'type'              => 'dropdown-pages',
				'allow_addition'    => true,
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_cpt_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_services_cpt_content_active',
				'label'             => esc_html__( 'Services', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_service',
				'type'              => 'select',
                'choices'           => catch_sketch_generate_post_array( 'ect-service' ),
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Services #', 'catch-sketch-pro' ) .  $i,
				'section'           => 'catch_sketch_service',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_image_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_link_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_target_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_content_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_service_more_button_text_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_services_image_content_active',
				'label'             => esc_html__( 'More Button Text', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_service',
				'type'              => 'text',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'catch_sketch_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_services_active' ) ) :
	/**
	* Return true if services content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_cpt_services_inactive' ) ) :
	/**
	* Return true if cpt services is inactive
	*
	* * @since 1.0
	*/
	function catch_sketch_is_cpt_services_inactive( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		return ( catch_sketch_is_services_active( $control ) && 'ect-service' !== $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_post_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_page_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'page' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_cpt_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_cpt_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'ect-service' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_category_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_post_page_category_cpt_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_post_page_category_cpt_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'category' === $type || 'ect-service' === $type || 'page' === $type || 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_services_image_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_services_image_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_service_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_services_active( $control ) && ( 'custom' === $type ) );
	}
endif;
