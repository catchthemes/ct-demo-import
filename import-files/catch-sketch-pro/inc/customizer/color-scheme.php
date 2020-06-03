<?php
/**
 * Theme Customizer
 *
 * @package Catch_Sketch
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_color_scheme_register( $wp_customize ) {
	//Color Scheme
	$color_scheme = catch_sketch_get_color_scheme();

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'color_scheme',
			'default'           => 'default',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'transport'         => 'postMessage',
			'label'             => esc_html__( 'Base Color Scheme', 'catch-sketch-pro' ),
			'section'           => 'colors',
			'type'              => 'select',
			'choices'           => catch_sketch_get_color_scheme_choices(),
			'priority'          => 1,
		)
	);

	$color_options = catch_sketch_color_options();

	$i = 30;
	foreach ( $color_options as $key => $value ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => $key,
				'default'           => $value['default'],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
				'custom_control'    => 'WP_Customize_Color_Control',
				'label'             => $value['label'],
				'section'           => 'colors',
				'priority'          => $i,
			)
		);

		$i = $i + 10;
	}

	$wp_customize->get_control( 'secondary_background_color' )->priority = 40;
	$wp_customize->get_control( 'main_text_color' )->priority = 50;
	$wp_customize->get_control( 'button_background_color' )->priority = 90;


	$wp_customize->get_control( 'button_gradient_background_color_first' )->active_callback        = 'catch_sketch_is_music_scheme_active';
	$wp_customize->get_control( 'button_gradient_background_color_second' )->active_callback       = 'catch_sketch_is_music_scheme_active';
	$wp_customize->get_control( 'button_gradient_background_hover_color_first' )->active_callback  = 'catch_sketch_is_music_scheme_active';
	$wp_customize->get_control( 'button_gradient_background_hover_color_second' )->active_callback = 'catch_sketch_is_music_scheme_active';

	$wp_customize->get_control( 'button_background_color' )->active_callback       = 'catch_sketch_is_music_scheme_inactive';
	$wp_customize->get_control( 'button_hover_background_color' )->active_callback = 'catch_sketch_is_music_scheme_inactive';

	$classes[] = esc_attr( 'color-scheme-' . get_theme_mod( 'color_scheme', 'default' ) );
}
add_action( 'customize_register', 'catch_sketch_color_scheme_register' );

if ( ! function_exists( 'catch_sketch_is_music_scheme_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_music_scheme_active( $control ) {
		$type = $control->manager->get_setting( 'color_scheme' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( 'music' === $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_music_scheme_inactive' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_music_scheme_inactive( $control ) {
		$type = $control->manager->get_setting( 'color_scheme' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( 'music' !== $type );
	}
endif;
