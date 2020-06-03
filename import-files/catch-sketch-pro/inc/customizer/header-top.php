<?php
/**
 * Header Options
 *
 * @package Catch_Sketch
 */

/**
 * Add header options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_header_top( $wp_customize ) {
	$wp_customize->add_section( 'catch_sketch_header_top', array(
		'panel' => 'catch_sketch_theme_options',
		'title' => esc_html__( 'Header Top', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_top',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Display Header Top', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

    catch_sketch_register_option( $wp_customize, array(
	        'name'              => 'catch_sketch_phone_label',
	        'default'           => esc_html__( 'Call Us', 'catch-sketch-pro' ),
	        'sanitize_callback' => 'sanitize_text_field',
	        'active_callback'   => 'catch_sketch_is_header_top_enabled',
	        'label'             => esc_html__( 'Phone Label', 'catch-sketch-pro' ),
	        'section'           => 'catch_sketch_header_top',
	        'type'              => 'text',
    	)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_phone',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'default'           => '+123-456-6780',
			'label'             => esc_html__( 'Phone', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'text',
		)
	);

    catch_sketch_register_option( $wp_customize, array(
	        'name'              => 'catch_sketch_email_label',
	        'default'           => esc_html__( 'Email', 'catch-sketch-pro' ),
	        'sanitize_callback' => 'sanitize_text_field',
	        'active_callback'   => 'catch_sketch_is_header_top_enabled',
	        'label'             => esc_html__( 'Email Label', 'catch-sketch-pro' ),
	        'section'           => 'catch_sketch_header_top',
	        'type'              => 'text',
    	)
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_email',
			'default'           => 'info@example.com',
			'sanitize_callback' => 'sanitize_email',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Email', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_hours_label',
            'default'           => esc_html__( 'Hours', 'catch-sketch-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_sketch_is_header_top_enabled',
            'label'             => esc_html__( 'Hours Label', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_header_top',
            'type'              => 'text',
        )
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_hours',
			'default'           => esc_html__( '10:00 AM - 6:00 PM (Mon-Fri)', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Hours', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_address_label',
            'default'           => esc_html__( 'Address', 'catch-sketch-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_sketch_is_header_top_enabled',
            'label'             => esc_html__( 'Address Label', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_header_top',
            'type'              => 'text',
        )
    );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_address',
			'default'           => esc_html__( 'Baltimore, USA', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Address', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_address_link',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Address Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'url',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              =>'catch_sketch_address_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Open Link in New Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'checkbox',
	    )
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_quote',
			'default'           => esc_html__( 'Request a Quote', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Quote Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_quote_link',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Quote Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'url',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              =>'catch_sketch_quote_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_header_top_enabled',
			'label'             => esc_html__( 'Open Link in New Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_header_top',
			'type'              => 'checkbox',
	    )
	);
}
add_action( 'customize_register', 'catch_sketch_header_top' );

if( ! function_exists( 'catch_sketch_is_header_top_enabled' ) ) :
	/**
	* Return true if header top is enabled
	*
	* * @since 2.0
	*/
	function catch_sketch_is_header_top_enabled( $control ) {
		return ( true === $control->manager->get_setting( 'catch_sketch_header_top' )->value() );
	}
endif;
