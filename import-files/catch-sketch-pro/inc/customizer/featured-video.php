<?php
/**
 * Featured Content options
 *
 * @package Catch_Sketch
 */

/**
 * Add featured video options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_featured_video_options( $wp_customize ) {
    $wp_customize->add_section( 'catch_sketch_featured_video', array(
			'title' => esc_html__( 'Featured Video', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_bg_image',
			'sanitize_callback' => 'catch_sketch_sanitize_image',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_show_lightbox',
			'default'           => 'enabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'choices'           => array(
				'enabled'       => esc_html__( 'Enabled', 'catch-sketch-pro' ),
				'disabled'      => esc_html__( 'Disabled', 'catch-sketch-pro' ) 
			),
			'label'             => esc_html__( 'Lightbox Option', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_archive_title',
			'default'           => esc_html__( 'Featured Video', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'label'             => esc_html__( 'Sub Title', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_number',
			'default'           => 4,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Video', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'catch_sketch_featured_video_number', 4 );

	for ( $i = 1; $i <= $number ; $i++ ) {
	    catch_sketch_register_option( $wp_customize, array(
	            'name'              => 'catch_sketch_featured_video_link_' . $i,
	            'sanitize_callback' => 'esc_url_raw',
	            'active_callback'   => 'catch_sketch_is_featured_video_active',
	            'label'             => esc_html__( 'Video Url', 'catch-sketch-pro' ) . ' ' . $i ,
	            'section'           => 'catch_sketch_featured_video',
	        )
	    );

	    catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_video_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_featured_video_active',
				'label'             => esc_html__( 'Video Title', 'catch-sketch-pro' ) . ' ' . $i,
				'section'           => 'catch_sketch_featured_video',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_featured_video_sub_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_featured_video_active',
				'label'             => esc_html__( 'Video Sub Title', 'catch-sketch-pro' ) . ' ' . $i,
				'section'           => 'catch_sketch_featured_video',
				'type'              => 'text',
			)
		);
	}

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_text',
			'default'           => esc_html__( 'View All', 'catch-sketch-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_featured_video_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_featured_video_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_featured_video',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_featured_video_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_featured_video_active' ) ) :
	/**
	* Return true if featured video is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_featured_video_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_featured_video_option' )->value();

		return catch_sketch_check_section( $enable );
	}
endif;
