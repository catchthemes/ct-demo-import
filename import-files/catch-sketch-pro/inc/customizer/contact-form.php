<?php
/**
 * Contact Form options
 *
 * @package Catch_Sketch
 */

/**
 * Add Contact options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_contact_form_options( $wp_customize ) {
    $wp_customize->add_section( 'catch_sketch_contact_form', array(
			'title' => esc_html__( 'Contact Form', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	 catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_archive_title',
			'default'           => esc_html__( 'Contact Form', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_contact_form_active',
			'label'             => esc_html__( 'Contact Section Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_contact_form_active',
			'label'             => esc_html__( 'Contact Section Sub Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'textarea',
		)
	);

	// Contact Form Start.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable Contact Form on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'select',
		)
	);

	$type = catch_sketch_section_type_options();

	unset( $type['category'] );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_type',
			'default'			=> 'page',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_contact_form_active',
            'choices'           => $type,
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_contact_form_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_post',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'default'           => 0,
			'active_callback'   => 'catch_sketch_is_contact_form_post_active',
			'input_attrs'       => array(
				'style' => 'width: 40px;'
			),
			'label'             => esc_html__( 'Post', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'choices'           => catch_sketch_generate_post_array(),
			'type'              => 'select'
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_page',
			'sanitize_callback' => 'catch_sketch_sanitize_post',
			'active_callback'   => 'catch_sketch_is_contact_form_page_active',
			'label'             => esc_html__( 'Page', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_contact_form_custom',
			'sanitize_callback' => 'wp_kses_post',
			'description'       => esc_html__( 'Add custom shortcodes from Contact Form 7 or Jetpack', 'catch-sketch-pro' ),
			'active_callback'   => 'catch_sketch_is_contact_form_custom_active',
			'label'             => esc_html__( 'Custom Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_contact_form',
			'type'              => 'textarea',
		)
	);
	// Reservation Form End.
}
add_action( 'customize_register', 'catch_sketch_contact_form_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_contact_form_active' ) ) :
	/**
	* Return true if reservation is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_form_active( $control ) {
		$enable_form = $control->manager->get_setting( 'catch_sketch_contact_form_option' )->value();

		return ( catch_sketch_check_section( $enable_form ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_contact_form_post_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_form_post_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_contact_form_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_contact_form_active( $control ) && 'post' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_contact_form_page_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_form_page_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_contact_form_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_contact_form_active( $control ) && 'page' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_contact_form_custom_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_contact_form_custom_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_contact_form_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_contact_form_active( $control ) && 'custom' === $type );
	}
endif;
