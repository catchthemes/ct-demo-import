<?php
/**
 * Contact Info options
 *
 * @package Catch_Sketch
 */

/**
 * Add contact options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_contact_options( $wp_customize ) {
    $wp_customize->add_section( 'catch_sketch_contact', array(
			'title' => esc_html__( 'Contact Info', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_layout',
			'default'			=> 'default',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'choices'           => array(
				'default'  		=> esc_html__( 'Default', 'catch-sketch-pro' ),
				'full-width' 	=> esc_html__( 'Full Width', 'catch-sketch-pro' ),
			),
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_title',
			'default'           => esc_html__( 'Say Hello', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_data',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_description',
			'sanitize_callback' => 'wp_kses_data',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Description', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_email_label',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Email Label', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_email',
			'default'           => 'someone@somewhere.com',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Email', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_phone_label',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Phone Label', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_phone',
			'default'           => '123-456-7890',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Phone', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_address_label',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Address Label', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_address',
			'default'           => 'Boston, MA, USA',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Address', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_address_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Address Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_address_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_info_note',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'custom_control'    => 'Catch_Sketch_Note_Control',
			'label'             => sprintf( esc_html__( 'Click %1$shere%2$s to set Social Menu', 'catch-sketch-pro' ),
                '<a href="javascript:wp.customize.control( \'nav_menu_locations[social-contact]\' ).focus();">',
                 '</a>'
            ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'description',
        )
    );

    $map_type = catch_sketch_contact_map_types();

    catch_sketch_register_option( $wp_customize, array(
    		'name'              => 'catch_sketch_contact_map_type',
    		'default'           => 'image',
    		'active_callback'   => 'catch_sketch_is_contact_active',
    		'sanitize_callback' => 'catch_sketch_sanitize_select',
    		'choices'           => $map_type, 
    		'label'             => esc_html__( 'Map Type', 'catch-sketch-pro' ),
    		'section'           => 'catch_sketch_contact',
    		'type'              => 'select',
    	)
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_map',
			'default'           => trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/contact-map.jpg',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_sketch_is_contact_map_image',
			'label'             => esc_html__( 'Map Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_map_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_contact_map_image',
			'label'             => esc_html__( 'Map Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_map_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_contact_map_image',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_footer_contact_custom_code',
			'sanitize_callback' => 'wp_kses_stripslashes',
			'active_callback'   => 'catch_sketch_is_contact_map_custom_code',
			'description'       => esc_html__( 'Add google iframe maps code', 'catch-sketch-pro' ),
			'label'             => esc_html__( 'Custom Content Code', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_social_title',
			'default'           => esc_html__( 'Follow Us', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_data',
			'active_callback'   => 'catch_sketch_is_contact_active',
			'label'             => esc_html__( 'Social Link Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact',
			'type'              => 'text',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_contact_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_contact_active' ) ) :
	/**
	* Return true if contact is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_contact_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

/**
 * Returns an array of visibility options for featured sections
 *
 * * @since 1.0
 */
function catch_sketch_contact_map_types() {
	$options = array(
		'image'    => esc_html__( 'Image', 'catch-sketch-pro' ),
		'custom-code'    => esc_html__( 'Custom Code', 'catch-sketch-pro' ),
	);

	return apply_filters( 'catch_sketch_section_visibility_options', $options );
}

if ( ! function_exists( 'catch_sketch_is_contact_map_image' ) ) :
	/**
	* Return true if contact is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_map_image( $control ) {
		$map_type = $control->manager->get_setting( 'catch_sketch_contact_map_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_is_contact_active( $control ) && ( 'image' === $map_type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_contact_map_custom_code' ) ) :
	/**
	* Return true if contact is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_map_custom_code( $control ) {
		$map_type = $control->manager->get_setting( 'catch_sketch_contact_map_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_is_contact_active( $control ) && ( 'custom-code' === $map_type ) );
	}
endif;
