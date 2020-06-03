<?php
/**
 * Header Media Options
 *
 * @package Catch_Sketch
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'catch-sketch-pro' );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_option',
			'default'           => 'disable',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-sketch-pro' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'catch-sketch-pro' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'catch-sketch-pro' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-sketch-pro' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'catch-sketch-pro' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'catch-sketch-pro' ),
				'disable'                => esc_html__( 'Disabled', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_content_align',
			'default'           => 'content-aligned-center',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => array(
				'content-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'content-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'content-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_text_align',
			'default'           => 'text-aligned-center',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_opacity',
			'default'			=> 0,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Tagline', 'catch-sketch' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Sub Title', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'catch-sketch-pro' ),
			'section'           => 'header_image',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'catch-sketch-pro' ),
			'section'           => 'header_image',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_header_url_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'header_image',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_header_media_options' );
