<?php
/**
 * Customizer functionality
 *
 * @package Catch_Sketch
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * * @since 1.0
 *
 * @see catch_sketch_header_style()
 */
function catch_sketch_custom_header_and_background() {
	$color_scheme             = catch_sketch_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[1], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Foodie World.
	 *
	 * * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'catch_sketch_custom_background_args', array(
		'default-color'    => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Foodie World.
	 *
	 * * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'catch_sketch_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 540,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'catch_sketch_header_style',
		'video'                  => true,
	) ) );

	$default_headers_args = array(
		'main' => array(
			'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-thumb-275x77.jpg',
			'url'           => get_stylesheet_directory_uri() . '/assets/images/header.jpg',
		),
	);

	register_default_headers( $default_headers_args );
}
add_action( 'after_setup_theme', 'catch_sketch_custom_header_and_background' );

function catch_sketch_color_options() {
	//Color Scheme
	$default_color = catch_sketch_get_color_scheme();

	// We do not add Background Color and Header Text Color here as if comes from WordPress Core
	return apply_filters( 'catch_sketch_color_options', array(
			'page_background_color'           => array(
				'label'   => esc_html__( 'Page Background Color', 'catch-sketch-pro' ),
				'default' => $default_color[2],
			),
			'secondary_background_color' => array(
				'label'   => esc_html__( 'Secondary Background Color', 'catch-sketch-pro' ),
				'default' => $default_color[3],
			),
			'main_text_color'                 => array(
				'label'   => esc_html__( 'Main Text Color', 'catch-sketch-pro' ),
				'default' => $default_color[4],
			),
			'heading_text_color'              => array(
				'label'   => esc_html__( 'Heading Text Color', 'catch-sketch-pro' ),
				'default' => $default_color[5],
			),
			'absolute_header_text_color'                 => array(
				'label'   => esc_html__( 'Absolute Header Text Color', 'catch-sketch-pro' ),
				'default' => $default_color[6],
			),
			'link_color'                      => array(
				'label'   => esc_html__( 'Link Color', 'catch-sketch-pro' ),
				'default' => $default_color[7],
			),
			'link_hover_color'                => array(
				'label'   => esc_html__( 'Link Hover Color', 'catch-sketch-pro' ),
				'default' => $default_color[8],
			),
			'secondary_link_color'            => array(
				'label'   => esc_html__( 'Secondary Link Color', 'catch-sketch-pro' ),
				'default' => $default_color[9],
			),
			'button_background_color'         => array(
				'label'   => esc_html__( 'Button Background Color', 'catch-sketch-pro' ),
				'default' => $default_color[10],
			),
			'button_text_color'               => array(
				'label'   => esc_html__( 'Button Text Color', 'catch-sketch-pro' ),
				'default' => $default_color[11],
			),
			'button_hover_background_color'   => array(
				'label'   => esc_html__( 'Button Hover Background Color', 'catch-sketch-pro' ),
				'default' => $default_color[12],
			),
			'button_hover_text_color'         => array(
				'label'   => esc_html__( 'Button Hover Text Color', 'catch-sketch-pro' ),
				'default' => $default_color[13],
			),
			'border_color'                    => array(
				'label'   => esc_html__( 'Border Color', 'catch-sketch-pro' ),
				'default' => $default_color[14],
			),
			'text_color_with_background'                    => array(
				'label'   => esc_html__( 'Text Color with Background', 'catch-sketch-pro' ),
				'default' => $default_color[15],
			),

			'tertiary_background_color'                    => array(
				'label'   => esc_html__( 'Tertiary Background Color', 'catch-sketch-pro' ),
				'default' => $default_color[16],
			),
			'testimonial_color_with_background_image'                    => array(
				'label'   => esc_html__( 'Color with background image', 'catch-sketch-pro' ),
				'default' => $default_color[17],
			),
			'button_gradient_background_color_first'                    => array(
				'label'   => esc_html__( 'Button Gradient Background Color First', 'catch-sketch-pro' ),
				'default' => $default_color[18],
			),
			'button_gradient_background_color_second'                    => array(
				'label'   => esc_html__( 'Button Gradient Background Color Second', 'catch-sketch-pro' ),
				'default' => $default_color[19],
			),
			'button_gradient_background_hover_color_first'                    => array(
				'label'   => esc_html__( 'Button Gradient Background Hover Color First', 'catch-sketch-pro' ),
				'default' => $default_color[20],
			),
			'button_gradient_background_hover_color_second'                    => array(
				'label'   => esc_html__( 'Button Gradient Background Hover Color Second', 'catch-sketch-pro' ),
				'default' => $default_color[21],
			),
		)
	);
}

/**
 * Registers color schemes for Foodie World.
 *
 * Can be filtered with {@see 'catch_sketch_color_schemes'}.
 *
 * 0. Background Color
 * 1. Header Text Color
 * 2. Page Background Color
 * 3. Secondary Background Color
 * 4. Main Text Color
 * 5. Heading Text Color
 * 6. Link Color
 * 7. Link Hover Color
 * 8. Secondary Link Color
 * 9. Button Background Color
 * 10. Button Text Color
 * 11. Button Hover Background Color
 * 12. Button Hover Text Color
 * 13. Border Color
 * 14. Text Color with background
 * 15. Color with background image
 * 16. Button Gradient Background Color First
 * 17. Button Gradient Background Color Second 
 * 18. Button Gradient Background Hover Color First 
 * 19. Button Gradient Background Hover Color Second 
 * 20. Absolute Header Text Color

 *
 * * @since 1.0
 *
 * @return array An associative array of color scheme options.
 */
function catch_sketch_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Foodie World.
	 *
	 * The default schemes include 'default', dark', 'gray' and 'yellow'.
	 *
	 * * @since 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'catch_sketch_color_schemes', array(
		'default' => array(
			'label'  => esc_html__( 'Default', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f8f8', /* Secondary Background Color */
				'#191e23', /* Main Text Color */
				'#000000', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#191e23', /* Link Color */
				'#654990', /* Link Hover Color */
				'#999999', /* Secondary Link Color */
				'#654990', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#000000', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'dark' => array(
			'label'  => esc_html__( 'Dark', 'catch-sketch-pro' ),
			'colors' => array(
				'#101010', /* Main Background Color */
				'#ffffff', /* Header Text Color */
				'#181818', /* Page Background Color */
				'#1d1c1c', /* Secondary Background Color */
				'#999999', /* Main Text Color */
				'#ffffff', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#ffffff', /* Link Color */
				'#714aad', /* Link Hover Color */
				'#999999', /* Secondary Link Color */
				'#212121', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#654990', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#282828', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#1d1c1c', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'yellow' => array(
			'label'  => esc_html__( 'Yellow', 'catch-sketch-pro' ),
			'colors' => array(
				'#edd100', /* Main Background Color */
				'#ffffff', /* Header Text Color */
				'#dbc300', /* Page Background Color */
				'#edc900', /* Secondary Background Color */
				'#666666', /* Main Text Color */
				'#ffffff', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#ffffff', /* Link Color */
				'#714aad', /* Link Hover Color */
				'#ffffff', /* Secondary Link Color */
				'#ecb100', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#654990', /* Button Hover Background Color */
				'#eaeaea', /* Button Hover Text Color */
				'#d8ce2b', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#edc900', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'gray' => array(
			'label'  => esc_html__( 'Gray', 'catch-sketch-pro' ),
			'colors' => array(
				'#565656', /* Main Background Color */
				'#ffffff', /* Header Text Color */
				'#4b4b4b', /* Page Background Color */
				'#4f4f4f', /* Secondary Background Color */
				'#999999', /* Main Text Color */
				'#ffffff', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#ffffff', /* Link Color */
				'#9e9e9e', /* Link Hover Color */
				'#e8e8e8', /* Secondary Link Color */
				'#868383', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#714aad', /* Button Hover Background Color */
				'#eaeaea', /* Button Hover Text Color */
				'#626262', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#4f4f4f', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'modern' => array(
			'label'  => esc_html__( 'Modern', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f9fb', /* Secondary Background Color */
				'#666666', /* Main Text Color */
				'#252525', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#000000', /* Link Color */
				'#dd5252', /* Link Hover Color */
				'#666666', /* Secondary Link Color */
				'#252525', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#dd5252', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#252525', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'minimal' => array(
			'label'  => esc_html__( 'Minimal', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f9fb', /* Secondary Background Color */
				'#505050', /* Main Text Color */
				'#2d2d2d', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#191e23', /* Link Color */
				'#cf987e', /* Link Hover Color */
				'#666666', /* Secondary Link Color */
				'#cf987e', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#000000', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#2d2d2d', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'blog' => array(
			'label'  => esc_html__( 'Blog', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f8f8', /* Secondary Background Color */
				'#505050', /* Main Text Color */
				'#2d2d2d', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#191e23', /* Link Color */
				'#654990', /* Link Hover Color */
				'#666666', /* Secondary Link Color */
				'#dff2f1', /* Button Background Color */
				'#666666', /* Button Text Color */
				'#000000', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#efefef', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'music' => array(
			'label'  => esc_html__( 'Music', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f8f8', /* Secondary Background Color */
				'#191e23', /* Main Text Color */
				'#000000', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#191e23', /* Link Color */
				'#c4a362', /* Link Hover Color */
				'#666666', /* Secondary Link Color */
				'#654990', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#000000', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'corporate' => array(
			'label'  => esc_html__( 'Corporate', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f8f8', /* Secondary Background Color */
				'#191e23', /* Main Text Color */
				'#000000', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#191e23', /* Link Color */
				'#f2525a', /* Link Hover Color */
				'#999999', /* Secondary Link Color */
				'#f2525a', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#000000', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#ffffff', /* Text Color with background */
				'#1a2b61', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
		'wedding' => array(
			'label'  => esc_html__( 'Wedding', 'catch-sketch-pro' ),
			'colors' => array(
				'#ffffff', /* Main Background Color */
				'#000000', /* Header Text Color */
				'#ffffff', /* Page Background Color */
				'#f8f8f8', /* Secondary Background Color */
				'#505050', /* Main Text Color */
				'#2d2d2d', /* Heading Text Color */
				'#ffffff', /* Absolute Header Text Color */
				'#505050', /* Link Color */
				'#f2525a', /* Link Hover Color */
				'#999999', /* Secondary Link Color */
				'#f2525a', /* Button Background Color */
				'#ffffff', /* Button Text Color */
				'#bababa', /* Button Hover Background Color */
				'#ffffff', /* Button Hover Text Color */
				'#e9e9e9', /* Border Color */
				'#2d2d2d', /* Text Color with background */
				'#654990', /* Tertiary Background Color */
				'#ffffff', /* Color with background image */
				'#ffafbd', /* Button Gradient Background Color First */
				'#ffc3a0', /* Button Gradient Background Color Second */
				'#ffafbd', /* Button Gradient Background Hover Color First  */
				'#ffc3a0', /* Button Gradient Background Hover Color Second  */
			),
		),
	) );
}

if ( ! function_exists( 'catch_sketch_get_color_scheme' ) ) :
/**
 * Retrieves the current Foodie World color scheme.
 *
 * Create your own catch_sketch_get_color_scheme() function to override in a child theme.
 *
 * * @since 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function catch_sketch_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = catch_sketch_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // catch_sketch_get_color_scheme

if ( ! function_exists( 'catch_sketch_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Foodie World.
 *
 * Create your own catch_sketch_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * * @since 1.0
 *
 * @return array Array of color schemes.
 */
function catch_sketch_get_color_scheme_choices() {
	$color_schemes                = catch_sketch_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // catch_sketch_get_color_scheme_choices

/**
 * Enqueues front-end CSS for color scheme.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = catch_sketch_get_color_scheme();

	// Convert header text hex color to rgba.
	$header_textcolor_rgb = catch_sketch_hex2rgb( $color_scheme[1] );
	
	// Convert Heading Text Color hex color to rgba.
	$heading_text_color_rgb = catch_sketch_hex2rgb( $color_scheme[5] );


	// If the rgba values are empty return early.
	if ( empty( $header_textcolor_rgb ) && empty( $heading_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'                     		     => $color_scheme[0],
		'header_textcolor'                     		     => $color_scheme[1],
		'header_eighty_textcolor'   				     => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.8)', $header_textcolor_rgb ),	
		'page_background_color'                		     => $color_scheme[2],
		'secondary_background_color'           		     => $color_scheme[3],
		'main_text_color'                      		     => $color_scheme[4],
		'heading_text_color'                   		     => $color_scheme[5],
		'heading_eighty_text_color'   				     => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.8)', $heading_text_color_rgb ),
		'absolute_header_text_color'                     => $color_scheme[6],
		'link_color'                           		     => $color_scheme[7],
		'link_hover_color'                     		     => $color_scheme[8],
		'secondary_link_color'                 		     => $color_scheme[9],
		'button_background_color'              		     => $color_scheme[10],
		'button_text_color'                    		     => $color_scheme[11],
		'button_hover_background_color'        		     => $color_scheme[12],
		'button_hover_text_color'              		     => $color_scheme[13],
		'border_color'                         		     => $color_scheme[14],
		'text_color_with_background'           		     => $color_scheme[15],
		'tertiary_background_color'					     => $color_scheme[16],
		'testimonial_color_with_background_image'        => $color_scheme[17],
		'button_gradient_background_color_first'         => $color_scheme[18],
		'button_gradient_background_color_second'        => $color_scheme[19],
		'button_gradient_background_hover_color_first'   => $color_scheme[20],
		'button_gradient_background_hover_color_second'  => $color_scheme[21],
	);

	$color_scheme_css = catch_sketch_get_color_scheme_css( $colors );

	wp_add_inline_style( 'catch-sketch-block-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * * @since 1.0
 */
function catch_sketch_customize_control_js() {
	wp_enqueue_script( 'catch-sketch-color-scheme-control', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/color-scheme-control.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20170816', true );

	$colors['colorScheme'] = catch_sketch_get_color_schemes();

	$color_options = catch_sketch_color_options();

	// Add background color and header text color index values
	$color_options = array_merge( array( 'background_color', 'header_textcolor' ), array_keys( $color_options ) );

	$colors['colorOptions'] = $color_options;

	wp_localize_script( 'catch-sketch-color-scheme-control', 'catchSketchColorMain', $colors );

	wp_enqueue_script( 'catch-sketch-custom-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/js/customize-custom-controls.min.js', array( 'jquery-ui-sortable' ), '20180802', true );

	wp_enqueue_style( 'catch-sketch-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'catch_sketch_customize_control_js' );

/**
 * Returns CSS for the color schemes.
 *
 * * @since 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function catch_sketch_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'                     		      => '',
		'header_textcolor'                     		      => '',
		'header_eighty_textcolor'					      => '',
		'page_background_color'                		      => '',
		'secondary_background_color'           		      => '',
		'main_text_color'                      		      => '',
		'heading_text_color'                   		      => '',
		'absolute_header_text_color'                      => '',
		'heading_eighty_text_color'     			      => '',
		'link_color'                           		      => '',
		'link_hover_color'                     		      => '',
		'secondary_link_color'                 		      => '',
		'button_background_color'              		      => '',
		'button_text_color'                    		      => '',
		'button_hover_background_color'        		      => '',
		'button_hover_text_color'              		      => '',
		'border_color'                         		      => '',
		'text_color_with_background'           		      => '',
		'tertiary_background_color'					      => '',
		'testimonial_color_with_background_image'         => '',
		'button_gradient_background_color_first'          => '',
		'button_gradient_background_color_second'         => '',
		'button_gradient_background_hover_color_first'    => '',
		'button_gradient_background_hover_color_second'   => '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body  {
		background-color: {$colors['background_color']};
	}

	/* Header Text Color */
	.site-title a {
		color: {$colors['header_textcolor']};
	}

	/* Page Background Color */
	.slider-content-wrapper .controllers .cycle-prev,
	.slider-content-wrapper .controllers .cycle-next,
	.color-scheme-modern .stats-section,
	.color-scheme-wedding .stats-section,
	.color-scheme-minimal .stats-section,
	.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper,
	.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper,
	.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper,
	.section.testimonials-content-wrapper.style-two .entry-content,
	.section.testimonials-content-wrapper.style-two .entry-summary,
	.color-scheme-modern .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-content,
	.color-scheme-wedding .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-content,
	.color-scheme-minimal .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-summary,
	.color-scheme-modern .section:nth-child(2n-1).team-section .hentry .hentry-inner,
	.color-scheme-wedding .section:nth-child(2n-1).team-section .hentry .hentry-inner,
	.color-scheme-minimal .section:nth-child(2n-1).team-section .hentry .hentry-inner,
	.color-scheme-modern .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
	.color-scheme-wedding .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
	.color-scheme-minimal .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	select,
	.select2-container--default .select2-selection--single,
	.main-navigation .sub-menu,
	.main-navigation .children,
	.screen-reader-text:focus,
	.mobile-social-search,
	.team-section .team-content-wrapper .hentry .entry-container:before,
	.contact-section .entry-container,
	.boxed-layout .site,
	.widget_shopping_cart,
	.navigation-classic .main-navigation .sub-menu,
	.navigation-classic .main-navigation .children,
	#primary-search-wrapper .menu-inside-wrapper,
	.menu-inside-wrapper,
	.nav-menu .sub-menu,
	.nav-menu .chidren,
	.ui-state-active, 
	.ui-widget-content .ui-state-active, 
	.ui-widget-header .ui-state-active,
	[class*="color-scheme"]:not(.color-scheme-default):not(.color-scheme-dark):not(.color-scheme-yellow):not(.color-scheme-gray).boxed-layout,
	.stats-section .view-all-button .more-button .more-link,
	.color-scheme-modern .services-section-wrapper .hentry-inner,
	.color-scheme-wedding .services-section-wrapper .hentry-inner,
	.color-scheme-minimal .services-section-wrapper .hentry-inner {
		background-color: {$colors['page_background_color']};
	}

	.section:nth-child(2n-1).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-content:after, 
	.section:nth-child(2n-1).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-summary:after,
	.color-scheme-default #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
	.color-scheme-default #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
	.color-scheme-corporate #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
	.color-scheme-corporate #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
	.color-scheme-dark #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
	.color-scheme-dark #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
	.color-scheme-gray #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
	.color-scheme-gray #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
	.color-scheme-music #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
    .color-scheme-music #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after {
	    border-color: {$colors['page_background_color']};
	}

	/* Secondary Background Color */
	#sticky-playlist-section,
	.mejs-container,
	.header-top-bar .header-top-content .header-top-left-content span.mobile-hours,
	.gallery-caption,
	.color-scheme-music #featured-video-section,
	#sticky-playlist-section .wp-playlist-tracks,
	.color-scheme-music #footer-newsletter,
	.color-scheme-corporate #footer-newsletter,
	.color-scheme-blog #footer-newsletter,
	.color-scheme-modern .section.services-section-wrapper:nth-child(2n)  .hentry-inner,
	.color-scheme-wedding .section.services-section-wrapper:nth-child(2n)  .hentry-inner,
	.color-scheme-minimal .services-section-wrapper:nth-child(2n)  .hentry-inner,
	.color-scheme-modern .section:nth-child(2n-1),
	.color-scheme-wedding .section:nth-child(2n-1),
	.color-scheme-minimal .section:nth-child(2n-1),
	.color-scheme-modern .section:nth-child(2n) + #footer-newsletter, 
	.color-scheme-wedding .section:nth-child(2n) + #footer-newsletter, 
	.color-scheme-minimal .section:nth-child(2n) + #footer-newsletter,
	.section:nth-child(2n-1).testimonials-content-wrapper.style-two,
	.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
	.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
	.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
	.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
	.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
	.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
	.color-scheme-modern .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
	.color-scheme-wedding .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
	.color-scheme-minimal .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
	.color-scheme-modern .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
	.color-scheme-wedding .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
	.color-scheme-modern .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
	.color-scheme-wedding .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
	.color-scheme-minimal .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
	.color-scheme-minimal .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
	.promotion-headline-section .inner-container,
	.footer-newsletter,
	#site-generator,
	.sidebar .widget-wrap,
	.testimonials-content-wrapper,
	mark, 
	ins,
	.portfolio-section .hentry .hentry-inner:after,
	.navigation-classic .main-navigation .sub-menu, 
	.navigation-classic .main-navigation .children, 
	ul.tabs.wc-tabs li.active a,
	.woocommerce-Tabs-panel,
	.shop_table thead th,
	.team-section .hentry .hentry-inner,
	.boxed-layout,
	ul.wc_payment_methods.payment_methods.methods li,
	.comment-respond,
	.menu-inside-wrapper #site-header-cart-wrapper a:hover,
	.menu-inside-wrapper #site-header-cart-wrapper a:focus,
	.widget_shopping_cart_content,
	pre,
	.color-scheme-modern .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
	.color-scheme-wedding .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
	.color-scheme-minimal .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
	.widget .ui-tabs .ui-tabs-panel,
	.no-header-media-image .custom-header:after,
	.slider-content-wrapper .controllers:before {
		background-color: {$colors['secondary_background_color']};
	}

	.section:nth-child(2n).testimonials-content-wrapper.style-two .section-content-wrap .hentry  .entry-container .entry-content:after, 
	.section:nth-child(2n).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container  .entry-summary:after,
	.header-top-bar .header-top-content .header-top-left-content span.mobile-hours:before {
	    border-color: {$colors['secondary_background_color']};
	}

	/* Main Text Color */
	body,
	button,
	input,
	select,
	optgroup,
	textarea,
	.author-title,
	.entry-title .sub-title,
	.entry-title span,
	.section-title-wrapper > .subtitle,
	.section-title-wrapper + .section-description,
	.section-title + .section-description,
	.section-title-wrapper + .section-subtitle,
	.entry-container .subtitle,
	.no-header-media-image .custom-header-content .entry-container,
	.no-header-media-image .custom-header-content .entry-container .entry-title,
	.no-header-media-image .custom-header-content .entry-container .entry-title .sub-title,
	.no-header-media-image .custom-header-content .breadcrumb a,
	.color-scheme-dark .header-top-bar .header-top-content .header-top-left-content ul li .fa,
	.color-scheme-modern .stats-section .hentry .entry-summary,
	.color-scheme-modern .stats-section .hentry .entry-content,
	.color-scheme-wedding .stats-section .hentry .entry-summary,
	.color-scheme-wedding .stats-section .hentry .entry-content,
	.color-scheme-minimal .stats-section .hentry .entry-summary,
	.color-scheme-minimal .stats-section .hentry .entry-content {
		color: {$colors['main_text_color']};
	}
	
	/*Header Text Color */
	.site-title a {
		color: {$colors['header_textcolor']};
	}

	/* 80% of Header Text Color */
	.site-description {
		color: {$colors['header_eighty_textcolor']};
	}

	/* Heading Text Color */
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.featured-video-section .entry-title span,
	.color-scheme-default .sticky-playlist-section .mejs-container button:before,
	.color-scheme-music #scrollup:before,
	.color-scheme-music input[type="submit"],
	.color-scheme-music button[type="submit"],
	.wp-playlist-item .wp-playlist-caption,
	.mejs-button button:before,
	.header-top-bar a,
	.header-top-bar .hours,
	.color-scheme-music .more-link,
	[class*="color-scheme-"] .events-section .more-link,	
	.color-scheme-music button,
	.color-scheme-music .button,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link,
	.color-scheme-music .background-image:not(.events-section) .entry-container .entry-content button,
	.color-scheme-music .background-image:not(.events-section) .entry-container .entry-summary button,
	.color-scheme-blog .team-section .hentry .hentry-inner:hover .team-social-profile a,
	.entry-title,
	.entry-title a,
	.team-section .entry-meta,
	.menu-toggle {
		color: {$colors['heading_text_color']};
	}

	/* 80% of Heading Text Color */
	.stats-section .hentry .entry-title a:hover,
	.stats-section .hentry .entry-title a:focus,
	.team-section.section .hentry .hentry-inner .entry-title a:hover,
	.team-section.section .hentry .hentry-inner .entry-title a:focus {
		color: {$colors['heading_eighty_text_color']};
	}

	/* Absolute Header Text Color */

	.absolute-header .site-title a,
	.absolute-header .site-description,
	.absolute-header .search-social-container .menu-toggle,
	.absolute-header .menu-toggle {
		color: {$colors['absolute_header_text_color']};
	}

	@media screen and (min-width: 1024px) {
    .absolute-header .site-header-cart a.cart-contents:before,
    .absolute-header .site-header-menu .social-navigation a,
    .absolute-header.navigation-classic .site-header-menu .main-navigation ul:not(.sub-menu) > li > a {
         color: {$colors['absolute_header_text_color']};
	    }    
	}

	.absolute-header.navigation-classic .bars {
	    background-color: {$colors['absolute_header_text_color']};
	}

	/* Table Border Color */
	table,
	table thead tr,
	thead th,
	tbody th,
	tbody td,
	tbody tr,
	table.shop_table_responsive tr td,
	table tbody tr,
	table.shop_table_responsive tbody tr:last-child,
	.shop_table tfoot tr td,
	.shop_table tfoot tr th,
	table.shop_table.woocommerce-checkout-review-order-table .cart_item td,
	table.shop_table.woocommerce-checkout-review-order-table tr td,
	table.shop_table.woocommerce-checkout-review-order-table tr th,
	.rtl tbody td:last-child, 
	.rtl table thead th:last-child  {
		border-color: {$colors['heading_text_color']};
	}

	.bars {
		background-color: {$colors['heading_text_color']};
	}

	/* Link Color */
	a,
	table a,
	.site-header-menu button,
	.discography-section .hentry .more-link,
	.services-section-wrapper .more-link,
	.archive-content-wrap .more-link,
	.singular-content-wrap .more-link,
	.contact-section .entry-container a,
	.archive .section-content-wrapper .more-link,
	.featured-content-section .hentry .more-link,
	.testimonials-content-wrapper .entry-title a,
	.slider-content-wrapper .scroll-down,
	.team-section .hentry .more-link,
	.ui-state-active a, 
	.ui-state-active a:link, 
	.ui-state-active a:visited,
	.stats-section .view-all-button .more-button .more-link {
		color: {$colors['link_color']};
	}

	.bars {
		background-color: {$colors['link_color']};
	}

	/* Link Hover Color */
	a:hover,
	a:focus,
	.absolute-header .site-title a:hover,
	.absolute-header .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:hover,
	[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:focus,
	.text-white .entry-title a:hover,
	.text-white .entry-title a:focus,
	.text-white .entry-meta a:hover,
	.text-white .entry-meta a:focus,
	.discography-section .hentry .more-link:hover,	
	.discography-section .hentry .more-link:focus,	
	.wp-playlist-item .wp-playlist-caption:hover,
	.wp-playlist-item .wp-playlist-caption:focus,
	.has-background-image .wp-playlist-item .wp-playlist-caption:hover,
	.has-background-image .wp-playlist-item .wp-playlist-caption:focus,
	.has-background-image  .entry-container .entry-meta a:hover,
	.has-background-image  .entry-container .entry-meta a:focus,
	.has-background-image  .entry-container .entry-title a:hover,
	.has-background-image  .entry-container .entry-title a:focus,
	button.dropdown-toggle:hover,
	button.dropdown-toggle:focus,
	.site-title a:hover,
	.site-title a:focus,
	.header-top-bar a:hover,
	.header-top-bar a:focus,
	.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:hover,
	.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:focus,
	.entry-meta a:hover,
	.entry-meta a:focus,
	nav.social-navigation ul li a:hover,
	nav.social-navigation ul li a:focus,
	#hero-section.hero-section.section .section-content-wrap .cat-links a:hover,
	#hero-section.hero-section.section .section-content-wrap .cat-links a:focus,
	.archive .section-content-wrapper .more-link:hover,
	.archive .section-content-wrapper .more-link:focus,
	.menu-inside-wrapper .main-navigation .nav-menu li a:hover,
	.menu-inside-wrapper .main-navigation .nav-menu li a:focus,
	#social-search-toggle:hover,
	#social-search-toggle:focus,
	.has-background-image .entry-container .entry-content a:not(button):not(.more-link):hover,
	.has-background-image .entry-container .entry-content a:not(button):not(.more-link):focus,
	.portfolio-section .hentry .hentry-inner .entry-container a:hover,
	.portfolio-section .hentry .hentry-inner .entry-container a:focus,
	.archive-content-wrap .more-link:hover,
	.archive-content-wrap .more-link:focus,
	.singular-content-wrap .more-link:hover,
	.singular-content-wrap .more-link:focus,
	#featured-video-section.featured-content-section .hentry .more-link:hover,
	#featured-video-section.featured-content-section .hentry .more-link:focus,
	#services-section.services-section-wrapper .more-link:hover,
	#services-section.services-section-wrapper .more-link:focus,
	#discography-section.discography-section .hentry .more-link:hover,	
	#discography-section.discography-section .hentry .more-link:focus,	
	#portfolio-content-section .more-link:hover,
	#portfolio-content-section .more-link:focus,
	.site-header-menu .menu-wrapper .menu-inside-wrapper .main-navigation .nav-menu li a:hover,
	.site-header-menu .menu-wrapper .menu-inside-wrapper .main-navigation .nav-menu li a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus,
	button#wp-custom-header-video-button:hover,
	button#wp-custom-header-video-button:focus,
	.site-info a:hover,
	.site-info a:focus,
	.widget .ui-state-default a:hover, 
	.widget .ui-widget-content .ui-state-default a:hover, 
	.widget .ui-widget-header .ui-state-default a:hover,
	.widget .ui-state-default a:focus, 
	.widget .ui-widget-content .ui-state-default a:focus, 
	.widget .ui-widget-header .ui-state-default a:focus,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .entry-title a:hover,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .entry-title a:focus,
	.portfolio-content-wrapper .hentry .entry-container .entry-title a:hover,
	.portfolio-content-wrapper .hentry .entry-container .entry-title a:focus,
	.custom-header-content .breadcrumb a:hover,
	.custom-header-content .breadcrumb a:focus,
	.color-scheme-modern .stats-section .more-link:hover,
	.color-scheme-modern .stats-section .more-link:focus,
	.color-scheme-minimal .stats-section .more-link:hover,
	.color-scheme-minimal .stats-section .more-link:focus,
	.color-scheme-wedding .stats-section .more-link:hover,
	.color-scheme-wedding .stats-section .more-link:focus,
	.color-scheme-modern .stats-section .entry-title a:hover,
	.color-scheme-modern .stats-section .entry-title a:focus,
	.color-scheme-minimal .stats-section .entry-title a:hover,
	.color-scheme-minimal .stats-section .entry-title a:focus,
	.color-scheme-wedding .stats-section .entry-title a:hover,
	.color-scheme-wedding .stats-section .entry-title a:focus,
	[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:hover,
	[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:focus,
	#hero-section.hero-section.section .section-content-wrap .cat-links a:hover,
	#hero-section.hero-section.section .section-content-wrap .cat-links a:focus,
	.no-header-media-image .custom-header-content .breadcrumb a:hover,
	.no-header-media-image .custom-header-content .breadcrumb a:focus,
	.contact-section .entry-container a:hover,
	.contact-section .entry-container a:focus,
	.absolute-header .site-header-menu .social-navigation a:hover,
	.absolute-header .site-header-menu .social-navigation a:focus {
		color: {$colors['link_hover_color']};
	}

	.screen-reader-text:focus,
	.absolute-header .menu-toggle:hover,
	.absolute-header .menu-toggle:focus,
	.absolute-header .site-header-cart a.cart-contents:hover:before,
	.absolute-header .site-header-cart a.cart-contents:focus:before,
	.menu-inside-wrapper .main-navigation .nav-menu .current_page_item > a,
	td#today,
	.star-rating span:before,
	p.stars:hover a:before,
	p.stars:focus a:before,
	.color-scheme-default .sticky-playlist-section .mejs-container button:hover:before,
	.color-scheme-default .sticky-playlist-section .mejs-container button:focus:before,
	.header-top-bar .header-top-content .header-top-left-content ul li a:hover .fa,
	.header-top-bar .header-top-content .header-top-left-content ul li a:focus .fa,
	p.stars.selected a.active:before, 
	p.stars.selected a:not(.active):before,
	#reviews .comment-respond .comment-form-rating .stars span a.active:before,
	#reviews .comment-respond .comment-form-rating .stars.selected span a:not(.active):before,
	.catch-breadcrumb.breadcrumb-area span.breadcrumb:last-child,
	.clients-content-wrapper .controller .cycle-pager span.cycle-pager-active,
	.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-prev:hover:before,
	.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-prev:focus:before,
	.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-next:hover:before,
	.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-next:focus:before,
	#menu-toggle:hover,
	.toggled-on.active:before,
	.product-container .woocommerce-LoopProduct-link:hover *,
	.product-container .woocommerce-LoopProduct-link:focus *,
	.mejs-button button:hover:before,
	.mejs-button button:focus:before,
	.playlist-section .mejs-container button:hover:before,
	.playlist-section .mejs-container button:focus:before,
	.color-scheme-music .menu-item-has-children .dropdown-toggle:hover:before,
	.color-scheme-music .menu-item-has-children .dropdown-toggle:focus:before {
		color: {$colors['link_hover_color']};
	}

	#menu-toggle:hover .bars,
	#menu-toggle:focus .bars {
		background-color: {$colors['link_hover_color']};
	}

	/* Secondary Link Color */
	.app-section .section-content-wrapper .entry-header span,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	.author-bio,
	.entry-meta,
	.price,
	.wp-playlist-item-artist,
	.nav-menu .menu-item-has-children > a:before,
	.nav-menu .page_item_has_children > a:before,
	input,
	select,
	.stars a,
	p.stars a:before, 
	p.stars a:hover~a:before, 
	p.stars.selected a.active~a:before,
	optgroup,
	textarea,
	.entry-meta,
	.site-info a,
	.nav-subtitle,
	.entry-meta a,
	input::placeholder,
	#site-generator .site-info,
	.nav-menu .menu-item-has-children > a:before,
	.nav-menu .page_item_has_children > a:before,
	.widget-wrap span.post-date,
	.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:hover,
	.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:focus,
	.color-scheme-modern .team-section .hentry .hentry-inner:hover a,
	.color-scheme-modern .team-section .hentry .hentry-inner:focus a,
	.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-meta span time,
	.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-container,
	.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-container .entry-meta,
	.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:before,
	.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:after,
	.testimonials-content-wrapper.section.testimonial-wrapper .cycle-next:before,
	.controller:before,
	.clients-content-wrapper .controller .cycle-pager span,
	.testimonials-content-wrapper .cycle-pager:after,
	.author-section-title,
	#contact-form-section .section-content-wrapper .contact-us-form form span input,
	#contact-form-section .section-content-wrapper .contact-us-form form span textarea,
	.comment-permalink,
	#hero-section.hero-section.section .section-content-wrap .cat-links a,
	.comment-edit-link {
		color: {$colors['secondary_link_color']};
	}

	.testimonials-content-wrapper.section.testimonial-wrapper .cycle-pager:before {
		background-color: color: {$colors['secondary_link_color']};;
	}


	/* Button Background Color */
	.more-link,
	.button,
	.added_to_cart,
	button,
	.mejs-time-hovered,
    .mejs-horizontal-volume-current,
    .catch_sketch-mejs-container.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
    .mejs-time-handle-content,
	.team-section .hentry .hentry-inner:before,
	.color-scheme-modern .stats-section .view-all-button .more-button .more-link,
	.color-scheme-wedding .stats-section .view-all-button .more-button .more-link,
	.color-scheme-minimal .stats-section .view-all-button .more-button .more-link,
	input[type="submit"],
	button[type="submit"],
	.scrollup a,
	.wp-block-button__link,
	#infinite-handle .ctis-load-more button,
	.menu-inside-wrapper #site-header-cart-wrappe li > a,
	#wp-calendar caption,
	.team-section .hentry .hentry-inner:before,
	.contact-section .entry-container ul.contact-details li .fa ,
	nav.navigation.posts-navigation .nav-links a,
	.woocommerce-pagination ul.page-numbers li .page-numbers.current,
	.page-links .post-page-numbers.current,
	.archive-content-wrap .pagination .page-numbers.current,
	.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
	.onsale,
	.catch-instagram-feed-gallery-widget-wrapper .button,
	.sticky-label {
		background-color: {$colors['button_background_color']};
	}

	.contact-section .entry-container .stay-connected li a,
	.header-top-bar .header-top-content .header-top-left-content ul li .fa {
		color: {$colors['button_background_color']};
	}

	.services-section-wrapper.section .hentry .hentry-inner .post-thumbnail a:before,
	.search-form .search-submit,
	input[type]:focus,
	textarea:focus,
	select:focus,
	#footer-newsletter .ewnewsletter .hentry form input:focus,
	.contact-section.section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li {
		border-color: {$colors['button_background_color']};
	}

    .color-scheme-music .more-link,
    .color-scheme-music .added_to_cart,
    .color-scheme-music .button,
    .color-scheme-music button,
    .color-scheme-music .mejs-time-hovered,
    .color-scheme-music .mejs-horizontal-volume-current,
    .color-scheme-music .catch_sketch-mejs-container.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
    .color-scheme-music .mejs-time-handle-content,
    .color-scheme-music .team-section .hentry .hentry-inner:before,
    .color-scheme-music .stats-section .view-all-button .more-button .more-link,
    .color-scheme-music .stats-section .view-all-button .more-button .more-link,
    .color-scheme-music input[type="submit"],
    .color-scheme-music button[type="submit"],
    .color-scheme-music .scrollup a,
    .color-scheme-music .wp-block-button__link,
    .color-scheme-music #infinite-handle .ctis-load-more button,
    .color-scheme-music .menu-inside-wrapper #site-header-cart-wrappe li > a,
    .color-scheme-music #wp-calendar caption,
    .color-scheme-music .contact-section .entry-container ul.contact-details li .fa ,
    .color-scheme-music nav.navigation.posts-navigation .nav-links a,
    .color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers.current,
    .color-scheme-music .page-links .post-page-numbers.current,
    .color-scheme-music .archive-content-wrap .pagination .page-numbers.current,
    .color-scheme-music .cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
    .color-scheme-music .onsale,
    .color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .button,
    .color-scheme-music .sticky-label {
        background-image: linear-gradient(to left, {$colors['button_gradient_background_color_first']}, {$colors['button_gradient_background_color_second']});
    }

	/* Button Text Color */
	.more-link,
	button,
	.added_to_cart,
	.sticky-label,
	.button,
	.scroll-down,
	.scrollup a:before,
	.events-section.has-background-image .hentry .entry-container .more-link,
	.events-section.has-background-image .hentry .entry-container button,
	input[type="submit"],
	.page-numbers:hover,
	.page-links .post-page-numbers:hover,
	.page-links .post-page-numbers:focus,
	button[type="submit"],
	.color-scheme-modern .stats-section .view-all-button .more-button .more-link,
	.color-scheme-wedding .stats-section .view-all-button .more-button .more-link,
	.color-scheme-minimal .stats-section .view-all-button .more-button .more-link,
	button#wp-custom-header-video-button,
	#infinite-handle .ctis-load-more button,
	nav.navigation.posts-navigation .nav-links a,
	#primary-search-wrapper .search-container button,
	.woocommerce-pagination ul.page-numbers li:hover,
	.archive-content-wrap .pagination .page-numbers:hover,
	.woocommerce-pagination ul.page-numbers li .page-numbers.current,
	.page-links .post-page-numbers.current,
	.archive-content-wrap .pagination .page-numbers.current,
	#portfolio-content-section .entry-container,
	span.onsale,
	#wp-calendar caption,
	.contact-details li .fa,
	.nav-menu .menu-item-has-children > a:hover:before,
	.nav-menu .page_item_has_children > a:hover:before,
	.nav-menu .page_item_has_children > a:focus:before,
	.nav-menu .menu-item-has-children > a:focus:before,
	.contact-section .entry-container ul.contact-details li .fa,
	.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover a,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus a {
		color: {$colors['button_text_color']};
	}

	/* Button Hover Text Color */
	.more-link:hover,
	.more-link:focus,
	[class*="color-scheme-"] .events-section .more-link:hover,	
	[class*="color-scheme-"] .events-section .more-link:focus,	
	.added_to_cart:hover,
	.added_to_cart:focus,
	.color-scheme-music #scrollup:hover,	
	.color-scheme-music #scrollup:focus,	
	.color-scheme-music input[type="submit"]:hover,
	.color-scheme-music input[type="submit"]:focus,
	.color-scheme-music button[type="submit"]:hover,
	.color-scheme-music button[type="submit"]:focus,
	.color-scheme-music .section:not(.events-section) .more-link:hover,
	.color-scheme-music .section:not(.events-section) .more-link:focus,
	.color-scheme-music .section:not(.events-section) button:hover,
	.color-scheme-music .section:not(.events-section) button:focus,
	.color-scheme-music .section:not(.events-section) .button:hover,
	.color-scheme-music .section:not(.events-section) .button:focus,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link:hover,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link:focus,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link:hover,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link:focus,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content button:hover,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content button:focus,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary button:hover,
	.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary button:focus,
	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	button[type="submit"]:hover,
	button[type="submit"]:focus,
	#infinite-handle .ctis-load-more button:hover,
	#infinite-handle .ctis-load-more button:focus,
	nav.navigation.posts-navigation .nav-links a:hover,
	nav.navigation.posts-navigation .nav-links a:focus,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
	.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover,
	.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus {
		color: {$colors['button_hover_text_color']};
	}

	.slider-content-wrapper #featured-slider-prev:hover:before,
	.slider-content-wrapper #featured-slider-next:hover:before,
	.slider-content-wrapper #featured-slider-prev:focus:before,
	.slider-content-wrapper #featured-slider-next:focus:before,
	.scrollup a:hover:before,
	.scrollup a:focus:before,
	.color-scheme-music .scrollup #scrollup:hover:before,
	.color-scheme-music .scrollup #scrollup:focus:before {
	    color: {$colors['button_hover_text_color']};
	}
	
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li {
		background-color: {$colors['button_text_color']};
	}

	/* Button Hover Background Color */
	.playlist-section .mejs-container,
	.more-link:hover,
	.more-link:focus,
	[class*="color-scheme-*"] .events-section .more-link:hover,
	[class*="color-scheme-*"] .events-section .more-link:focus, 
	.added_to_cart:hover,
	.added_to_cart:focus,
	.button:hover,
	.button:focus,
	button:hover,
	button:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.scrollup a:hover,
	.scrollup a:focus,
	button[type="submit"]:hover,
	button[type="submit"]:focus,
	#featured-slider-prev:hover,
	#featured-slider-prev:focus,
	#featured-slider-next:hover,
	#featured-slider-next:focus,
	.wp-block-button__link:hover,
	.wp-block-button__link:focus,
	#infinite-handle .ctis-load-more button:hover,
	#infinite-handle .ctis-load-more button:focus,
	.slider-content-wrapper .cycle-next:hover,
	.slider-content-wrapper .cycle-next:focus,
	.slider-content-wrapper .cycle-prev:hover,
	.slider-content-wrapper .cycle-prev:focus,
	.color-scheme-modern .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-modern .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-wedding .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-wedding .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-minimal .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-minimal .stats-section .view-all-button .more-button .more-link:focus,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
	.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
	nav.navigation.posts-navigation .nav-links a:hover,
	nav.navigation.posts-navigation .nav-links a:focus,
	.woocommerce-pagination ul.page-numbers li .page-numbers:hover,
	.woocommerce-pagination ul.page-numbers li .page-numbers:focus,
	.page-links .post-page-numbers:hover,
	.page-links .post-page-numbers:focus,
	.archive-content-wrap .pagination .page-numbers:hover,
	.archive-content-wrap .pagination .page-numbers:focus,
	.home .slider-content-wrapper.section.style-two #featured-slider-next:hover,
	.home .slider-content-wrapper.section.style-two #featured-slider-next:focus,
	.home .slider-content-wrapper.section.style-two #featured-slider-prev:hover,
	.home .slider-content-wrapper.section.style-two #featured-slider-prev:focus,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
	.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
	.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
	.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
	.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover, 
	.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus,
	.has-background-image.events-section .more-link:hover,
	.has-background-image.events-section .more-link:focus {
		background-color: {$colors['button_hover_background_color']};
	}

	.color-scheme-music .more-link:hover,
	.color-scheme-music .more-link:focus,
	.color-scheme-music .added_to_cart:hover,
	.color-scheme-music .added_to_cart:focus,
	.color-scheme-music .button:hover,
	.color-scheme-music .button:focus,
	.color-scheme-music button:hover,
	.color-scheme-music button:focus,
	.color-scheme-music input[type="submit"]:hover,
	.color-scheme-music input[type="submit"]:focus,
	.color-scheme-music .scrollup a:hover,
	.color-scheme-music .scrollup a:focus,
	.color-scheme-music button[type="submit"]:hover,
	.color-scheme-music button[type="submit"]:focus,
	.color-scheme-music #featured-slider-prev:hover,
	.color-scheme-music #featured-slider-prev:focus,
	.color-scheme-music #featured-slider-next:hover,
	.color-scheme-music #featured-slider-next:focus,
	.color-scheme-music .wp-block-button__link:hover,
	.color-scheme-music .wp-block-button__link:focus,
	.color-scheme-music #infinite-handle .ctis-load-more button:hover,
	.color-scheme-music #infinite-handle .ctis-load-more button:focus,
	.color-scheme-music .slider-content-wrapper .cycle-next:hover,
	.color-scheme-music .slider-content-wrapper .cycle-next:focus,
	.color-scheme-music .slider-content-wrapper .cycle-prev:hover,
	.color-scheme-music .slider-content-wrapper .cycle-prev:focus,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-music .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
	.color-scheme-music .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
	.color-scheme-music nav.navigation.posts-navigation .nav-links a:hover,
	.color-scheme-music nav.navigation.posts-navigation .nav-links a:focus,
	.color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
	.color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers:focus,
	.color-scheme-music .page-links .post-page-numbers:focus,
	.color-scheme-music .page-links .post-page-numbers:hover,
	.color-scheme-music .archive-content-wrap .pagination .page-numbers:hover,
	.color-scheme-music .archive-content-wrap .pagination .page-numbers:focus,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-prev:hover,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-prev:focus,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-next:hover,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-next:focus,
	.color-scheme-music .has-background-image.events-section .more-link:hover,
	.color-scheme-music .has-background-image.events-section .more-link:focus
	.color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover, 
	.color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus {
		background-image: linear-gradient(to right, {$colors['button_gradient_background_hover_color_first']}, {$colors['button_gradient_background_hover_color_second']});
	}

	.stats-section .more-link:hover,
	.stats-section .more-link:focus {
		color: {$colors['button_hover_background_color']};
	}

	.scrollup a:hover:before,
	.scrollup a:focus:before {
		color: {$colors['button_hover_text_color']};
	}

	/* Border Color */
	.events-content-wrapper .more-link,
	.events-content-wrapper button,
	nav.navigation,
	.header-top-bar,
	#sticky-playlist-section,
	.wp-playlist-light .wp-playlist-tracks .wp-playlist-item,
	.events-section .events-content-wrapper .hentry,
	.archive-content-wrap .section-content-wrapper .hentry .entry-container,
	#wp-calendar tbody td,
	#wp-calendar thead th,
	#wp-calendar tbody th,
	#wp-calendar,
	#wp-calendar tfoot tr td,
	#wp-calendar thead  tr,
	#wp-calendar tfoot tr td,
	.woocommerce-tabs ul.tabs.wc-tabs li,
	#colophon .footer-widget-area .wrapper:after,
	#colophon .footer-widget-area .wrapper:before,
	.color-scheme-modern .section.promotion-headline-section.style-one,
	.color-scheme-wedding .section.promotion-headline-section.style-one,
	.color-scheme-minimal .section.promotion-headline-section.style-one,
	.color-scheme-corporate .section.promotion-headline-section.style-one,
	.menu-wrapper .widget_shopping_cart ul.woocommerce-mini-cart li,
	.entry-summary form.cart,
	.site-header-menu .menu-inside-wrapper .main-navigation .nav-menu li,
	.site-header-menu  #site-header-cart-wrapper a.cart-contents,
	.team-section .team-content-wrapper .hentry .team-social-profile .social-links-menu,
	input[type="submit"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	.select2-container--default .select2-selection--single,
	table.woocommerce-grouped-product-list.group_table,
	table.woocommerce-grouped-product-list.group_table td,
	table.variations,
	table.variations td,
	.woocommerce-pagination ul.page-numbers li .page-numbers,
	.page-links .post-page-numbers,
	.archive-content-wrap .navigation.pagination .page-numbers,
	.woocommerce-posts-wrapper .summary.entry-summary .woocommerce-product-rating,
	.cart-collaterals .order-total,
	#payment .wc_payment_methods .payment_box,
	.product-border .products .product,
	select,
	header .site-header-main,
	blockquote.alignright,
	blockquote.alignleft,
	abbr,
	acronym,
	.product-quantity input[type="number"],
	.coupon input[type="text"],
	figure.wp-block-pullquote.alignleft blockquote,
	figure.wp-block-pullquote.alignright blockquote,
	.site-header-main .menu-inside-wrapper,
	.catch-instagram-feed-gallery-widget-wrapper .button,
	.site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .sub-menu,
	.site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .children,
	.site-header-cart .widget_shopping_cart,
	.navigation-classic .site-header-menu #primary-menu-wrapper .menu-inside-wrapper,
	.woocommerce-grouped-product-list tr,
	.site-main nav.post-navigation:before,
	.mobile-social-search,
	.color-scheme-modern .section:nth-child(2n) + .site-content,
	.color-scheme-wedding .section:nth-child(2n) + .site-content,
	.color-scheme-minimal .section:nth-child(2n) + .site-content,
	.widget .ui-tabs .ui-tabs-panel,
	.site-header-menu .menu-inside-wrapper .nav-menu button:focus,
	.navigation-default .site-header-menu .menu-inside-wrapper .nav-menu li button:focus,
	header .site-header-menu .menu-inside-wrapper .main-navigation .sub-menu li:last-child,
	header .site-header-menu .menu-inside-wrapper .main-navigation .children li:last-child,
	.stats-section .view-all-button .more-button .more-link:hover,
	.stats-section .view-all-button .more-button .more-link:focus {
		border-color: {$colors['border_color']};
	}

	/* Quotes Color */
	blockquote:not(.alignleft):not(.alignright):before {
		color: {$colors['border_color']};
	}

	hr,
	.color-scheme-minimal .slider-content-wrapper.section #featured-slider-prev:after,
	td#today,
	.slider-content-wrapper .controllers:before {
		background-color: {$colors['border_color']};
	}

	/* Text Color with background */	
	.stats-section .section-description,
	.stats-section .hentry .entry-title a,
	.stats-section .more-link,
	.stats-section .hentry,
	.custom-header-content .entry-title .sub-title,
	.custom-header-content .breadcrumb a,
	.custom-header-content .breadcrumb .sep,
	.team-section .hentry .hentry-inner:hover a,
	.team-content- .hentry-inner:hover .entry-title a,
	.team-section .hentry .hentry-inner:hover .entry-container,
	.team-section .hentry .hentry-inner:hover .entry-meta,
	.hero-section.has-background-image .entry-container,
	.portfolio-content-wrapper .hentry .entry-container .entry-title a,
	.portfolio-content-wrapper .hentry .entry-container .entry-meta a,
	.custom-header-content .entry-container,
	.custom-header-content .entry-container .entry-title,
	.stats-section .section-title,
	.playlist-section .mejs-container,
	.playlist-section .mejs-container button:before,
	.ewnewsletter.has-background-image .section-title,
	.custom-header-content .catch-breadcrumb.breadcrumb-area span.breadcrumb a:hover,
	.custom-header-content .catch-breadcrumb.breadcrumb-area span.breadcrumb a:focus,
	.custom-header-content .catch-breadcrumb.breadcrumb-area span.breadcrumb-current {
		color: {$colors['text_color_with_background']};
	}

	/* Tertiary Background Color */
	.stats-section,
	.color-scheme-corporate .testimonials-content-wrapper:after {
		background-color: {$colors['tertiary_background_color']};
	}

	/**  Color with background image  **/

	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image  .cycle-pager:after,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image  .cycle-pager:after,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:hover:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:hover:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:focus:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:focus:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:active:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:active:before,
	.testimonials-content-wrapper.testimonial-wrapper.has-background-image .section-description,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-pager-active:before,
	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .controls > div:before,
	.has-background-image .section-title,
	.has-background-image  .entry-container .entry-meta a,
	.has-background-image  .entry-container .entry-summary a:not(button):not(.more-link),
	.has-background-image  .entry-container .entry-content a:not(button):not(.more-link),
	.has-background-image  .entry-container .entry-title a,
	.has-background-image  .entry-container .entry-title,
	.has-background-image  .entry-container .entry-title span,
	.has-background-image  .entry-container .entry-summary,
	.has-background-image  .entry-container .entry-summary p,
	.has-background-image  .entry-container .entry-content,
	.has-background-image  .entry-container .entry-content p,
	.has-background-image .woocommerce-loop-product__title,
	.has-background-image .entry-title .sub-title,
	.has-background-image .entry-title span,
	.has-background-image .section-title-wrapper > .subtitle,
	.has-background-image .section-title-wrapper + .section-description,
	.has-background-image .section-title + .section-description,
	.has-background-image .section-title-wrapper + .section-subtitle,
	.has-background-image .entry-container .subtitle,
	.text-white .entry-title a,
	.text-white .entry-meta a,
	.text-white .entry-summary,
	.text-white .entry-content {
	    color: {$colors['testimonial_color_with_background_image']};
	}	

	.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-pager:before {
		background-color: {$colors['testimonial_color_with_background_image']};
	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * * @since 1.0
 */
function catch_sketch_color_scheme_css_template() {
	$color_options = catch_sketch_color_options();

	// Add background color ahd header text color index values
	$color_options = array_keys( $color_options );

	foreach ( $color_options as $color ) {
		$colors[ $color ] = '{{ data.' . $color . '}}';
	}

	$colors['header_eighty_textcolor']      		= '{{ data.header_textcolor}}';
	$colors['heading_eighty_text_color']      		= '{{ data.heading_text_color}}';

	?>
	<script type="text/html" id="tmpl-catch-sketch-color-scheme">
		<?php echo catch_sketch_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'catch_sketch_color_scheme_css_template' );

/**
 * Enqueues front-end CSS for the page background color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_page_background_color_css() {
	$color_scheme          = catch_sketch_get_color_scheme();
	$default_color         = $color_scheme[2];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Page Background Color */
		.slider-content-wrapper .controllers .cycle-prev,
		.slider-content-wrapper .controllers .cycle-next,
		.color-scheme-modern .stats-section,
		.color-scheme-wedding .stats-section,
		.color-scheme-minimal .stats-section,
		.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper,
		.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper,
		.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper,
		.section.testimonials-content-wrapper.style-two .entry-content,
		.section.testimonials-content-wrapper.style-two .entry-summary,
		.color-scheme-modern .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-content,
		.color-scheme-wedding .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-content,
		.color-scheme-minimal .section:nth-child(2n-1).testimonials-content-wrapper.style-two .entry-summary,
		.color-scheme-modern .section:nth-child(2n-1).team-section .hentry .hentry-inner,
		.color-scheme-wedding .section:nth-child(2n-1).team-section .hentry .hentry-inner,
		.color-scheme-minimal .section:nth-child(2n-1).team-section .hentry .hentry-inner,
		.color-scheme-modern .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
		.color-scheme-wedding .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
		.color-scheme-minimal .section:nth-child(2n-1)#promotion-headline-section.promotion-headline-section.no-background.style-two .inner-container,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select,
		.select2-container--default .select2-selection--single,
		.main-navigation .sub-menu,
		.main-navigation .children,
		.screen-reader-text:focus,
		.mobile-social-search,
		#primary-search-wrapper .menu-inside-wrapper,
		.team-section .team-content-wrapper .hentry .entry-container:before,
		.skill-content-wrapper .hentry .skillbar .skillbar-content,
		.contact-section .entry-container,
		.boxed-layout .site,
		#primary-search-wrapper .menu-inside-wrapper,
		.menu-inside-wrapper,
		.nav-menu .sub-menu,
		.nav-menu .children,
		.ui-state-active, 
		.ui-widget-content .ui-state-active, 
		.ui-widget-header .ui-state-active,
		[class*="color-scheme"]:not(.color-scheme-default):not(.color-scheme-dark):not(.color-scheme-yellow):not(.color-scheme-gray).boxed-layout,
		.stats-section .view-all-button .more-button .more-link,
		.color-scheme-modern .services-section-wrapper .hentry-inner,
		.color-scheme-wedding .services-section-wrapper .hentry-inner,
		.color-scheme-minimal .services-section-wrapper .hentry-inner {
			background-color: %1$s;
		}

		.section:nth-child(2n-1).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-content:after, 
		.section:nth-child(2n-1).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-summary:after,
		.color-scheme-default #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
		.color-scheme-default #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
		.color-scheme-corporate #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
		.color-scheme-corporate #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
		.color-scheme-dark #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
		.color-scheme-dark #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
		.color-scheme-gray #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
		.color-scheme-gray #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after,
		.color-scheme-music #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-content:after,
        .color-scheme-music #testimonials-section.testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container .entry-summary:after {
		    border-color: %1$s;
		}

	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary background color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_secondary_background_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[3];
	$secondary_background_color 	= get_theme_mod( 'secondary_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_background_color === $default_color ) {
		return;
	}


	$css = '
		/* Secondary Background Color */
		#sticky-playlist-section,
		.mejs-container,
		.header-top-bar .header-top-content .header-top-left-content span.mobile-hours,
		.gallery-caption,
		.color-scheme-music #featured-video-section,
		#sticky-playlist-section .wp-playlist-tracks,
		.color-scheme-music #footer-newsletter,
		.color-scheme-corporate #footer-newsletter,
		.color-scheme-blog #footer-newsletter,
		.color-scheme-modern .section.services-section-wrapper:nth-child(2n)  .hentry-inner,
		.color-scheme-wedding .section.services-section-wrapper:nth-child(2n)  .hentry-inner,
		.color-scheme-minimal .services-section-wrapper:nth-child(2n)  .hentry-inner,
		.color-scheme-modern .section:nth-child(2n-1),
		.color-scheme-wedding .section:nth-child(2n-1),
		.color-scheme-minimal .section:nth-child(2n-1),
		.color-scheme-modern .section:nth-child(2n) + #footer-newsletter, 
		.color-scheme-wedding .section:nth-child(2n) + #footer-newsletter, 
		.color-scheme-minimal .section:nth-child(2n) + #footer-newsletter,
		.section:nth-child(2n-1).testimonials-content-wrapper.style-two,
		.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
		.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
		.color-scheme-modern .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
		.color-scheme-wedding .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
		.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-summary,
		.color-scheme-minimal .section:nth-child(2n).testimonials-content-wrapper.style-two .entry-content,
		.color-scheme-modern .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
		.color-scheme-wedding .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
		.color-scheme-minimal .section:nth-child(2n-1) + .team-section .hentry .hentry-inner,
		.color-scheme-modern .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
		.color-scheme-wedding .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
		.color-scheme-modern .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
		.color-scheme-wedding .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
		.color-scheme-minimal .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="text"],
		.color-scheme-minimal .section:nth-child(2n-1) + #footer-newsletter .ewnewsletter .hentry form input[type="email"],
		.promotion-headline-section .inner-container,
		.footer-newsletter,
		#site-generator,
		.sidebar .widget-wrap,
		.testimonials-content-wrapper,
		mark, 
		ins,
		.portfolio-section .hentry .hentry-inner:after,
		.navigation-classic .main-navigation .sub-menu,
		.navigation-classic .main-navigation .children,
		ul.tabs.wc-tabs li.active a,
		.woocommerce-Tabs-panel,
		.shop_table thead th,
		.team-section .hentry .hentry-inner,
		.boxed-layout,
		ul.wc_payment_methods.payment_methods.methods li,
		.comment-respond,
		.menu-inside-wrapper #site-header-cart-wrapper a:hover,
		.widget_shopping_cart_content,
		pre,
		.color-scheme-modern .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
		.color-scheme-wedding .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
		.color-scheme-minimal .portfolio-content-wrapper .hentry .entry-container .inner-wrap,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev,
		.widget .ui-tabs .ui-tabs-panel,
		.no-header-media-image .custom-header:after,
		.slider-content-wrapper .controllers:before {
			background-color: %1$s;
		}

		.section:nth-child(2n).testimonials-content-wrapper.style-two .section-content-wrap .hentry  .entry-container .entry-content:after, 
		.section:nth-child(2n).testimonials-content-wrapper.style-two .section-content-wrap .hentry .entry-container  .entry-summary:after,
		.header-top-bar .header-top-content .header-top-left-content span.mobile-hours:before {
		    border-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $secondary_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_secondary_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_main_text_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[4];
	$main_text_color 	= get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Main Text Color */
		body,
		button,
		input,
		select,
		optgroup,
		textarea,
		.author-title,
		.entry-title .sub-title,
		.entry-title span,
		.section-title-wrapper > .subtitle,
		.section-title-wrapper + .section-description,
		.section-title + .section-description,
		.section-title-wrapper + .section-subtitle,
		.entry-container .subtitle,
		.no-header-media-image .custom-header-content .entry-container,
		.no-header-media-image .custom-header-content .entry-container .entry-title,
		.no-header-media-image .custom-header-content .entry-container .entry-title .sub-title,
		.no-header-media-image .custom-header-content .breadcrumb a,
		.color-scheme-dark .header-top-bar .header-top-content .header-top-left-content ul li .fa,
		.color-scheme-modern .stats-section .hentry .entry-summary,
		.color-scheme-modern .stats-section .hentry .entry-content,
		.color-scheme-wedding .stats-section .hentry .entry-summary,
		.color-scheme-wedding .stats-section .hentry .entry-content,
		.color-scheme-minimal .stats-section .hentry .entry-summary,
		.color-scheme-minimal .stats-section .hentry .entry-content {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $main_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the heading text color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_heading_text_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[5];
	$heading_text_color 	= get_theme_mod( 'heading_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $heading_text_color === $default_color ) {
		return;
	}

	// Convert gradient text hex color to rgba.
	$heading_text_color_rgb = catch_sketch_hex2rgb( $heading_text_color );

	// If the rgba values are empty return early.
	if ( empty( $heading_text_color_rgb ) ) {
		return;
	}

	$heading_eighty_text_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.8)', $heading_text_color_rgb );

	$css = '
		/* Heading Text Color */
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.featured-video-section .entry-title span,
		.color-scheme-default .sticky-playlist-section .mejs-container button:before,
		.color-scheme-music #scrollup:before,
		.color-scheme-music input[type="submit"],
		.color-scheme-music button[type="submit"],
		.color-scheme-music .more-link,
		[class*="color-scheme-"] .events-section .more-link, 
		.color-scheme-music button,
		.color-scheme-music .button,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link,
		.color-scheme-music .background-image:not(.events-section) .entry-container .entry-content button,
		.color-scheme-music .background-image:not(.events-section) .entry-container .entry-summary button,
		.wp-playlist-item .wp-playlist-caption,
		.mejs-button button:before,
		.header-top-bar a,
		.header-top-bar .hours,
		.color-scheme-blog .team-section .hentry .hentry-inner:hover .team-social-profile a,
		.entry-title,
		.entry-title a,
		.team-section .entry-meta,
		.menu-toggle {
			color: %1$s;
		}

		/* 80% of Heading Text Color */
		.stats-section .hentry .entry-title a:hover,
		.stats-section .hentry .entry-title a:focus,
		.team-section.section .hentry .hentry-inner .entry-title a:hover,
		.team-section.section .hentry .hentry-inner .entry-title a:focus {
			color: %2$s;
		}

		/* Table Border Color */
		table,
		table thead tr,
		thead th,
		tbody th,
		tbody td,
		tbody tr,
		table.shop_table_responsive tr td,
		table tbody tr,
		table.shop_table_responsive tbody tr:last-child,
		.shop_table tfoot tr td,
		.shop_table tfoot tr th,
		table.shop_table.woocommerce-checkout-review-order-table .cart_item td,
		table.shop_table.woocommerce-checkout-review-order-table tr td,
		table.shop_table.woocommerce-checkout-review-order-table tr th,
		.rtl tbody td:last-child, 
		.rtl table thead th:last-child  {
			border-color: %2$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $heading_text_color, $heading_eighty_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_heading_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the Absolute Header Text Color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_absolute_header_text_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[6];
	$absolute_header_text_color 	= get_theme_mod( 'absolute_header_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $absolute_header_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Absolute Header Text Color */

		.absolute-header .site-title a,
		.absolute-header .site-description,
		.absolute-header .menu-toggle,
		.absolute-header .search-social-container .menu-toggle {
			color: %1$s;
		}

		@media screen and (min-width: 1024px) {
    	.absolute-header .site-header-cart a.cart-contents:before,
    	.absolute-header .site-header-menu .social-navigation a,
	    .absolute-header.navigation-classic .site-header-menu .main-navigation ul:not(.sub-menu) > li > a {
	         color: %1$s;
		    }    
		}

		.absolute-header.navigation-classic .bars {
		    background-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $absolute_header_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_absolute_header_text_color_css', 11 );


/**
 * Enqueues front-end CSS for the link color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_link_color_css() {
	$color_scheme  = catch_sketch_get_color_scheme();
	$default_color = $color_scheme[7];
	$link_color    = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Link Color */
		a,
		table a,
		.site-header-menu button,	
		.discography-section .hentry .more-link,
		.services-section-wrapper .more-link,
		.archive-content-wrap .more-link,
		.singular-content-wrap .more-link,
		.contact-section .entry-container a,
		.archive .section-content-wrapper .more-link,
		.featured-content-section .hentry .more-link,
		.testimonials-content-wrapper .entry-title a,
		.team-section.section .hentry .hentry-inner .entry-title a:hover,
		.team-section.section .hentry .hentry-inner .entry-title a:focus,
		.slider-content-wrapper .scroll-down,
		.team-section .hentry .more-link,
		.ui-state-active a, 
		.ui-state-active a:link, 
		.ui-state-active a:visited,
		.stats-section .view-all-button .more-button .more-link {
			color: %1$s;
		}

		.bars {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link hover color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_link_hover_color_css() {
	$color_scheme          = catch_sketch_get_color_scheme();
	$default_color         = $color_scheme[8];
	$link_hover_color = get_theme_mod( 'link_hover_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_hover_color === $default_color ) {
		return;
	}

	$css = '
		/* Link hover Color */
		a:hover,
		a:focus,
		.absolute-header .site-title a:hover,
		.absolute-header .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.color-scheme-wedding .team-section.section .hentry .hentry-inner .entry-title a:hover,
		.color-scheme-wedding .team-section.section .hentry .hentry-inner .entry-title a:focus,
		.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:hover,
		.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:focus,
		.color-scheme-minimal .team-section.section .hentry .hentry-inner .entry-title a:hover,
		.color-scheme-minimal .team-section.section .hentry .hentry-inner .entry-title a:focus,
		.text-white .entry-title a:hover,
		.text-white .entry-title a:focus,
		.text-white .entry-meta a:hover,
		.text-white .entry-meta a:focus,
		.discography-section .hentry .more-link:hover,	
		.discography-section .hentry .more-link:focus,
		.wp-playlist-item .wp-playlist-caption:hover,
		.wp-playlist-item .wp-playlist-caption:focus,
		.has-background-image .wp-playlist-item .wp-playlist-caption:hover,
		.has-background-image .wp-playlist-item .wp-playlist-caption:focus,
		.has-background-image  .entry-container .entry-meta a:hover,
		.has-background-image  .entry-container .entry-meta a:focus,
		.has-background-image  .entry-container .entry-title a:hover,
		.has-background-image  .entry-container .entry-title a:focus,
		button.dropdown-toggle:hover,
		button.dropdown-toggle:focus,
		.site-title a:hover,
		.site-title a:focus,
		.header-top-bar a:hover,
		.header-top-bar a:focus,
		.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:hover,
		.testimonials-content-wrapper.section.testimonial-wrapper .entry-title a:focus,
		.entry-meta a:hover,
		.entry-meta a:focus,
		#hero-section.hero-section.section .section-content-wrap .cat-links a:hover,
		#hero-section.hero-section.section .section-content-wrap .cat-links a:focus,
		nav.social-navigation ul li a:hover,
		nav.social-navigation ul li a:focus,
		.archive .section-content-wrapper .more-link:hover,
		.archive .section-content-wrapper .more-link:focus,
		.menu-inside-wrapper .main-navigation .nav-menu li a:hover,
		.menu-inside-wrapper .main-navigation .nav-menu li a:focus,
		#social-search-toggle:hover,
		#social-search-toggle:focus,
		.portfolio-section .hentry .hentry-inner .entry-container a:hover,
		.portfolio-section .hentry .hentry-inner .entry-container a:focus,
		.archive-content-wrap .more-link:hover,
		.archive-content-wrap .more-link:focus,
		.singular-content-wrap .more-link:hover,
		.singular-content-wrap .more-link:focus,
		#featured-video-section.featured-content-section .hentry .more-link:hover,
		#featured-video-section.featured-content-section .hentry .more-link:focus,
		#services-section.services-section-wrapper .more-link:hover,
		#services-section.services-section-wrapper .more-link:focus,
		#discography-section.discography-section .hentry .more-link:hover,	
		#discography-section.discography-section .hentry .more-link:focus,	
		#portfolio-content-section .more-link:hover,
		#portfolio-content-section .more-link:focus,
		#menu-toggle:hover,
		#menu-toggle:focus,
		.has-background-image .entry-container .entry-content a:not(button):not(.more-link):hover,
		.has-background-image .entry-container .entry-content a:not(button):not(.more-link):focus,
		.site-header-menu .menu-wrapper .menu-inside-wrapper .main-navigation .nav-menu li a:hover,
		.site-header-menu .menu-wrapper .menu-inside-wrapper .main-navigation .nav-menu li a:focus,
		.menu-toggle:focus,
		.menu-toggle:hover,
		button#wp-custom-header-video-button:hover,
		button#wp-custom-header-video-button:focus,
		.site-info a:focus,
		.site-info a:hover,
		.color-scheme-modern .stats-section .more-link:hover,
		.color-scheme-modern .stats-section .more-link:focus,
		.color-scheme-minimal .stats-section .more-link:hover,
		.color-scheme-minimal .stats-section .more-link:focus,
		.color-scheme-wedding .stats-section .more-link:hover,
		.color-scheme-wedding .stats-section .more-link:focus,
		.color-scheme-modern .stats-section .entry-title a:hover,
		.color-scheme-modern .stats-section .entry-title a:focus,
		.color-scheme-minimal .stats-section .entry-title a:hover,
		.color-scheme-minimal .stats-section .entry-title a:focus,
		.color-scheme-wedding .stats-section .entry-title a:hover,
		.color-scheme-wedding .stats-section .entry-title a:focus,
		[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:hover,
		[class*="color-scheme"]:not(.color-scheme-default) .team-section.section .hentry .hentry-inner .entry-title a:focus,
		.widget .ui-state-default a:hover, 
		.widget .ui-state-default a:focus, 
		.widget .ui-widget-content .ui-state-default a:hover, 
		.widget .ui-widget-content .ui-state-default a:focus, 
		.widget .ui-widget-header .ui-state-default a:hover,
		.widget .ui-widget-header .ui-state-default a:focus,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .entry-title a:hover,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .entry-title a:focus,
		.portfolio-content-wrapper .hentry .entry-container .entry-title a:hover,
		.portfolio-content-wrapper .hentry .entry-container .entry-title a:focus,
		.custom-header-content .breadcrumb a:hover,
		.custom-header-content .breadcrumb a:focus,
		#hero-section.hero-section.section .section-content-wrap .cat-links a:hover,
		#hero-section.hero-section.section .section-content-wrap .cat-links a:focus,
		.no-header-media-image .custom-header-content .breadcrumb a:hover,
		.no-header-media-image .custom-header-content .breadcrumb a:focus,
		.contact-section .entry-container a:hover,
		.contact-section .entry-container a:focus,
		.absolute-header .site-header-menu .social-navigation a:hover,
		.absolute-header .site-header-menu .social-navigation a:focus {
			color: %1$s;
		}

		.screen-reader-text:focus,
		.absolute-header .menu-toggle:hover,
		.absolute-header .menu-toggle:focus,
		.absolute-header .site-header-cart a.cart-contents:hover:before,
		.absolute-header .site-header-cart a.cart-contents:focus:before,
		td#today,
		.star-rating span:before,
		p.stars:hover a:before,
		p.stars:focus a:before,
		.color-scheme-default .sticky-playlist-section .mejs-container button:hover:before,
		.color-scheme-default .sticky-playlist-section .mejs-container button:focus:before,
		.menu-inside-wrapper .main-navigation .nav-menu .current_page_item > a,
		.header-top-bar .header-top-content .header-top-left-content ul li a:hover .fa,
		.header-top-bar .header-top-content .header-top-left-content ul li a:focus .fa,
		p.stars.selected a.active:before, 
		p.stars.selected a:not(.active):before,
		.catch-breadcrumb.breadcrumb-area span.breadcrumb:last-child,		
		#reviews .comment-respond .comment-form-rating .stars span a.active:before,
		#reviews .comment-respond .comment-form-rating .stars.selected span a:not(.active):before,
		.clients-content-wrapper .controller .cycle-pager span.cycle-pager-active,
		.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-prev:hover:before,
		.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-prev:focus:before,
		.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-next:hover:before,
		.testimonials-content-wrapper.section.testimonial-wrapper:not(.has-background-image) .cycle-next:focus:before,
		#menu-toggle:hover,
		#menu-toggle:focus,
		.toggled-on.active:before,
		.product-container .woocommerce-LoopProduct-link:hover *,
		.product-container .woocommerce-LoopProduct-link:focus *,
		.mejs-button button:hover:before,
		.mejs-button button:focus:before,
		.playlist-section .mejs-container button:hover:before,
		.playlist-section .mejs-container button:focus:before,
		.color-scheme-music .menu-item-has-children .dropdown-toggle:hover:before,
		.color-scheme-music .menu-item-has-children .dropdown-toggle:focus:before {
			color: %1$s;
		}

		#menu-toggle:hover .bars,
		#menu-toggle:focus .bars {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $link_hover_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_link_hover_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary link color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_secondary_link_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[9];
	$secondary_link_color 	= get_theme_mod( 'secondary_link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_link_color === $default_color ) {
		return;
	}
	$css = '
		/* Secondary Link Color */
		.app-section .section-content-wrapper .entry-header span,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		.author-bio,
		.entry-meta,
		.price,
		.wp-playlist-item-artist,
		.nav-menu .menu-item-has-children > a:before,
		.nav-menu .page_item_has_children > a:before,
		input,
		select,
		.stars a,
		p.stars a:before, 
		p.stars a:hover~a:before,
		p.stars a:focus~a:before,
		p.stars.selected a.active~a:before,
		optgroup,
		textarea,
		.entry-meta,
		.site-info a,
		.nav-subtitle,
		.entry-meta a,
		input::placeholder,
		#site-generator .site-info,
		.widget-wrap span.post-date,
		.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:hover,
		.color-scheme-modern .team-section.section .hentry .hentry-inner .entry-title a:focus,
		.color-scheme-modern .team-section .hentry .hentry-inner:hover a,
		.color-scheme-modern .team-section .hentry .hentry-inner:focus a,
		.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-meta span time,
		.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-container,
		.color-scheme-modern .team-section .hentry .hentry-inner:hover .entry-container .entry-meta,
		.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:before,
		.testimonials-content-wrapper.section.testimonial-wrapper .cycle-prev:after,
		.testimonials-content-wrapper.section.testimonial-wrapper .cycle-next:before,
		.controller:before,
		.clients-content-wrapper .controller .cycle-pager span,
		.testimonials-content-wrapper .cycle-pager:after,
		.author-section-title,
		#contact-form-section .section-content-wrapper .contact-us-form form span input,
		#contact-form-section .section-content-wrapper .contact-us-form form span textarea,
		#hero-section.hero-section.section .section-content-wrap .cat-links a,
		.comment-permalink,
		.comment-edit-link {
			color: %1$s;
		}

		.testimonials-content-wrapper.section.testimonial-wrapper .cycle-pager:before {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $secondary_link_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_secondary_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the button background color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_background_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[10];
	$button_background_color 	= get_theme_mod( 'button_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $button_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Button Background Color */
		.more-link,
		.button,
		.added_to_cart,
		button,
		.mejs-time-hovered,
	    .mejs-horizontal-volume-current,
	    .catch_sketch-mejs-container.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
	    .mejs-time-handle-content,
		.team-section .hentry .hentry-inner:before,
		.color-scheme-modern .stats-section .view-all-button .more-button .more-link,
		.color-scheme-wedding .stats-section .view-all-button .more-button .more-link,
		.color-scheme-minimal .stats-section .view-all-button .more-button .more-link,
		input[type="submit"],
		button[type="submit"],
		.scrollup a,
		.wp-block-button__link,
		#infinite-handle .ctis-load-more button,
		.menu-inside-wrapper #site-header-cart-wrappe li > a,
		#wp-calendar caption,
		.team-section .hentry .hentry-inner:before,
		.contact-section .entry-container ul.contact-details li .fa ,
		nav.navigation.posts-navigation .nav-links a,
		.woocommerce-pagination ul.page-numbers li .page-numbers.current,
		.page-links .post-page-numbers.current,
		.archive-content-wrap .pagination .page-numbers.current,
		.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
		.onsale,
		.catch-instagram-feed-gallery-widget-wrapper .button,
		.sticky-label {
			background-color: %1$s;
		}

		.contact-section .entry-container .stay-connected li a,
		.header-top-bar .header-top-content .header-top-left-content ul li .fa {
			color: %1$s;
		}
	
		.services-section-wrapper.section .hentry .hentry-inner .post-thumbnail a:before,
		.search-form .search-submit,
		input[type]:focus,
		textarea:focus,
		select:focus,
		#footer-newsletter .ewnewsletter .hentry form input:focus,
		.contact-section.section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li {
			border-color: %1$s;
		}

		.woocommerce .product-container .button {
			border-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Button Gradient Background Color
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_gradient_background_color_css() {
	$color_scheme                   = catch_sketch_get_color_scheme();
	$button_gradient_background_color_first  = get_theme_mod( 'button_gradient_background_color_first', $color_scheme[18] );
	$button_gradient_background_color_second = get_theme_mod( 'button_gradient_background_color_second', $color_scheme[19] );

	// Don't do anything if the current color is the default.
	if ( $button_gradient_background_color_first === $color_scheme[18] && $button_gradient_background_color_second === $color_scheme[19] ) {
		return;
	}

	$css = '
	/* Button Background Color */
	.color-scheme-music .more-link,
    .color-scheme-music .added_to_cart,
    .color-scheme-music .button,
    .color-scheme-music button,
    .color-scheme-music .mejs-time-hovered,
    .color-scheme-music .mejs-horizontal-volume-current,
    .color-scheme-music .catch_sketch-mejs-container.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
    .color-scheme-music .mejs-time-handle-content,
    .color-scheme-music .team-section .hentry .hentry-inner:before,
    .color-scheme-music .stats-section .view-all-button .more-button .more-link,
    .color-scheme-music .stats-section .view-all-button .more-button .more-link,
    .color-scheme-music input[type="submit"],
    .color-scheme-music button[type="submit"],
    .color-scheme-music .scrollup a,
    .color-scheme-music .wp-block-button__link,
    .color-scheme-music #infinite-handle .ctis-load-more button,
    .color-scheme-music .menu-inside-wrapper #site-header-cart-wrappe li > a,
    .color-scheme-music #wp-calendar caption,
    .color-scheme-music .contact-section .entry-container ul.contact-details li .fa ,
    .color-scheme-music nav.navigation.posts-navigation .nav-links a,
    .color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers.current,
    .color-scheme-music .page-links .post-page-numbers.current,
    .color-scheme-music .archive-content-wrap .pagination .page-numbers.current,
    .color-scheme-music .cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
    .color-scheme-music .onsale,
    .color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .button,
    .color-scheme-music .sticky-label {
 		background-image: linear-gradient(to left, %1$s, %2$s);
	}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_gradient_background_color_first, $button_gradient_background_color_second ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_gradient_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the button text color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_text_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[11];
	$button_text_color 	= get_theme_mod( 'button_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $button_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Button Text Color */
		.more-link,
		.added_to_cart,
		button,
		.sticky-label,
		.button,
		.scroll-down,
		.events-section.has-background-image .hentry .entry-container .more-link,
		.events-section.has-background-image .hentry .entry-container button,
		.scrollup a:before,
		input[type="submit"],
		.page-numbers:hover,
		.page-numbers:focus,
		.page-links .post-page-numbers:hover,
		.page-links .post-page-numbers:focus,
		button[type="submit"],
		.color-scheme-modern .stats-section .view-all-button .more-button .more-link,
		.color-scheme-wedding .stats-section .view-all-button .more-button .more-link,
		.color-scheme-minimal .stats-section .view-all-button .more-button .more-link,
		button#wp-custom-header-video-button,
		#infinite-handle .ctis-load-more button,
		nav.navigation.posts-navigation .nav-links a,
		#primary-search-wrapper .search-container button,
		.woocommerce-pagination ul.page-numbers li:hover,
		.woocommerce-pagination ul.page-numbers li:focus,
		.archive-content-wrap .pagination .page-numbers:hover,
		.archive-content-wrap .pagination .page-numbers:focus,
		.woocommerce-pagination ul.page-numbers li .page-numbers.current,
		.page-links .post-page-numbers.current,
		.archive-content-wrap .pagination .page-numbers.current,
		#portfolio-content-section .entry-container,
		span.onsale,
		#wp-calendar caption,
		.contact-details li .fa,
		.nav-menu .menu-item-has-children > a:hover:before,
		.nav-menu .page_item_has_children > a:hover:before,
		.nav-menu .page_item_has_children > a:focus:before,
		.nav-menu .menu-item-has-children > a:focus:before,
		.contact-section .entry-container ul.contact-details li .fa,
		.cart-collaterals .shop_table.shop_table_responsive .cart-subtotal,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover a,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus a {
			color: %1$s;
		}

		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li {
			background-color: %1$s;
		}
		
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the button hover background color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_hover_background_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[12];
	$button_hover_background_color 	= get_theme_mod( 'button_hover_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $button_hover_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Button Hover Background Color */
		.playlist-section .mejs-container,
		.more-link:hover,
		.more-link:focus,
		[class*="color-scheme-*"] .events-section .more-link:hover, 		
		[class*="color-scheme-*"] .events-section .more-link:focus, 		
		.added_to_cart:hover,
		.added_to_cart:focus,
		.button:hover,
		.button:focus,
		button:hover,
		button:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.scrollup a:hover,
		.scrollup a:focus,
		button[type="submit"]:hover,
		button[type="submit"]:focus,
		#featured-slider-prev:hover,
		#featured-slider-prev:focus,
		#featured-slider-next:hover,
		#featured-slider-next:focus,
		.wp-block-button__link:hover,
		.wp-block-button__link:focus,
		#infinite-handle .ctis-load-more button:hover,
		#infinite-handle .ctis-load-more button:focus,
		.slider-content-wrapper .cycle-next:hover,
		.slider-content-wrapper .cycle-next:focus,
		.slider-content-wrapper .cycle-prev:hover,
		.slider-content-wrapper .cycle-prev:focus,
		.color-scheme-modern .stats-section .view-all-button .more-button .more-link:hover,
		.color-scheme-modern .stats-section .view-all-button .more-button .more-link:focus,
		.color-scheme-wedding .stats-section .view-all-button .more-button .more-link:hover,
		.color-scheme-wedding .stats-section .view-all-button .more-button .more-link:focus,
		.color-scheme-minimal .stats-section .view-all-button .more-button .more-link:hover,
		.color-scheme-minimal .stats-section .view-all-button .more-button .more-link:focus,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
		nav.navigation.posts-navigation .nav-links a:hover,
		nav.navigation.posts-navigation .nav-links a:focus,
		.woocommerce-pagination ul.page-numbers li .page-numbers:hover,
		.woocommerce-pagination ul.page-numbers li .page-numbers:focus,
		.page-links .post-page-numbers:hover,
		.page-links .post-page-numbers:focus,
		.archive-content-wrap .pagination .page-numbers:hover,
		.archive-content-wrap .pagination .page-numbers:focus,
		.has-background-image.events-section .more-link:hover,
		.has-background-image.events-section .more-link:focus,
		.home .slider-content-wrapper.section.style-two #featured-slider-next:hover,
		.home .slider-content-wrapper.section.style-two #featured-slider-next:focus,
		.home .slider-content-wrapper.section.style-two #featured-slider-prev:hover,
		.home .slider-content-wrapper.section.style-two #featured-slider-prev:focus,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
		.color-scheme-modern .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
		.color-scheme-wedding .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:hover,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-next:focus,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:hover,
		.color-scheme-minimal .section:nth-child(2n-1).slider-content-wrapper.style-one #featured-slider-prev:focus,
		.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover, 
		.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus {
			background-color: %1$s;
		}

		.stats-section .more-link:hover,
		.stats-section .more-link:focus {
			color: %1$s;
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_hover_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_hover_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Button Gradient Hover Background Color
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_background_hover_color_css() {
	$color_scheme                   = catch_sketch_get_color_scheme();
	$button_gradient_background_hover_color_first  = get_theme_mod( 'button_gradient_background_hover_color_first', $color_scheme[20] );
	$button_gradient_background_hover_color_second = get_theme_mod( 'button_gradient_background_hover_color_second', $color_scheme[21] );

	// Don't do anything if the current color is the default.
	if ( $button_gradient_background_hover_color_first === $color_scheme[20] && $button_gradient_background_hover_color_second === $color_scheme[21] ) {
		return;
	}

	$css = '
	/* Button Hover Background Color */
	.color-scheme-music .more-link:hover,
	.color-scheme-music .more-link:focus,
	.color-scheme-music .added_to_cart:hover,
	.color-scheme-music .added_to_cart:focus,
	.color-scheme-music .button:hover,
	.color-scheme-music .button:focus,
	.color-scheme-music button:hover,
	.color-scheme-music button:focus,
	.color-scheme-music input[type="submit"]:hover,
	.color-scheme-music input[type="submit"]:focus,
	.color-scheme-music .scrollup a:hover,
	.color-scheme-music .scrollup a:focus,
	.color-scheme-music button[type="submit"]:hover,
	.color-scheme-music button[type="submit"]:focus,
	.color-scheme-music .wp-block-button__link:hover,
	.color-scheme-music .wp-block-button__link:focus,
	.color-scheme-music #infinite-handle .ctis-load-more button:hover,
	.color-scheme-music #infinite-handle .ctis-load-more button:focus,
	.color-scheme-music .slider-content-wrapper .cycle-next:hover,
	.color-scheme-music .slider-content-wrapper .cycle-next:focus,
	.color-scheme-music .slider-content-wrapper .cycle-prev:hover,
	.color-scheme-music .slider-content-wrapper .cycle-prev:focus,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:hover,
	.color-scheme-music .stats-section .view-all-button .more-button .more-link:focus,
	.color-scheme-music .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
	.color-scheme-music .contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
	.color-scheme-music nav.navigation.posts-navigation .nav-links a:hover,
	.color-scheme-music nav.navigation.posts-navigation .nav-links a:focus,
	.color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
	.color-scheme-music .woocommerce-pagination ul.page-numbers li .page-numbers:focus,
	.color-scheme-music .page-links .post-page-numbers:hover,
	.color-scheme-music .page-links .post-page-numbers:focus,
	.color-scheme-music .archive-content-wrap .pagination .page-numbers:hover,
	.color-scheme-music .archive-content-wrap .pagination .page-numbers:focus,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-prev:hover,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-prev:focus,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-next:hover,
	.color-scheme-music .slider-content-wrapper.section #featured-slider-next:focus,
	.color-scheme-music .has-background-image.events-section .more-link:hover,
	.color-scheme-music .has-background-image.events-section .more-link:focus,
	.color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover, 
	.color-scheme-music .catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus  {
		background-image: linear-gradient(to right, %1$s, %2$s);
	}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_gradient_background_hover_color_first, $button_gradient_background_hover_color_second ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_background_hover_color_css', 11 );

/**
 * Enqueues front-end CSS for the button hover text color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_button_hover_text_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[13];
	$button_hover_text_color 	= get_theme_mod( 'button_hover_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $button_hover_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Button Hover Text Color */
		.more-link:hover,
		.more-link:focus,
		[class*="color-scheme-"] .events-section .more-link:hover,	
		[class*="color-scheme-"] .events-section .more-link:focus,		
		.added_to_cart:hover,
		.added_to_cart:focus,
		.color-scheme-music #scrollup:hover,	
		.color-scheme-music #scrollup:focus,
		.color-scheme-music input[type="submit"]:hover,
		.color-scheme-music input[type="submit"]:focus,
		.color-scheme-music button[type="submit"]:hover,
		.color-scheme-music button[type="submit"]:focus,
		.color-scheme-music .section:not(.events-section) .more-link:hover,
		.color-scheme-music .section:not(.events-section) .more-link:focus,
		.color-scheme-music .section:not(.events-section) button:hover,
		.color-scheme-music .section:not(.events-section) button:focus,
		.color-scheme-music .section:not(.events-section) .button:hover,
		.color-scheme-music .section:not(.events-section) .button:focus,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link:hover,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content .more-link:focus,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link:hover,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary .more-link:focus,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content button:hover,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-content button:focus,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary button:hover,
		.color-scheme-music .has-background-image:not(.events-section) .entry-container .entry-summary button:focus,
		button:hover,
		button:focus,
		.button:hover,
		.button:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		button[type="submit"]:hover,
		button[type="submit"]:focus,
		#infinite-handle .ctis-load-more button:hover,
		#infinite-handle .ctis-load-more button:focus,
		nav.navigation.posts-navigation .nav-links a:hover,
		nav.navigation.posts-navigation .nav-links a:focus,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:hover,
		.contact-section .section-content-wrap .hentry .entry-container .stay-connected .social-links-menu li:focus,
		.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:hover,
		.catch-instagram-feed-gallery-widget-wrapper .instagram-button .button:focus {
			color: %1$s;
		}

		.slider-content-wrapper #featured-slider-prev:hover:before,
		.slider-content-wrapper #featured-slider-next:hover:before,
		.slider-content-wrapper #featured-slider-prev:focus:before,
		.slider-content-wrapper #featured-slider-next:focus:before,
		.scrollup a:hover:before,
		.scrollup a:focus:before,
		.color-scheme-music .scrollup #scrollup:hover:before,
		.color-scheme-music .scrollup #scrollup:focus:before {
		    color: map-get($theme-color, color-white-light);
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $button_hover_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_button_hover_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the border color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_border_color_css() {
	$color_scheme  = catch_sketch_get_color_scheme();
	$default_color = $color_scheme[14];
	$border_color  = get_theme_mod( 'border_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $border_color === $default_color ) {
		return;
	}

	$css = '
		/* Border Color */
		.events-content-wrapper .more-link,
		.events-content-wrapper button,
		nav.navigation,
		.header-top-bar,
		#sticky-playlist-section,
		.wp-playlist-light .wp-playlist-tracks .wp-playlist-item,
		.events-section .events-content-wrapper .hentry,
		.archive-content-wrap .section-content-wrapper .hentry .entry-container,
		#wp-calendar tbody td,
		#wp-calendar thead th,
		#wp-calendar tbody th,
		#wp-calendar,
		#wp-calendar tfoot tr td,
		#wp-calendar thead  tr,
		#wp-calendar tfoot tr td,
		.woocommerce-tabs ul.tabs.wc-tabs li,
		#colophon .footer-widget-area .wrapper:after,
		#colophon .footer-widget-area .wrapper:before,
		.color-scheme-modern .section.promotion-headline-section.style-one,
		.color-scheme-wedding .section.promotion-headline-section.style-one,
		.color-scheme-minimal .section.promotion-headline-section.style-one,
		.color-scheme-corporate .section.promotion-headline-section.style-one,
		.menu-wrapper .widget_shopping_cart ul.woocommerce-mini-cart li,
		.entry-summary form.cart,
		.site-header-menu .menu-inside-wrapper .main-navigation .nav-menu li,
		.site-header-menu  #site-header-cart-wrapper a.cart-contents,
		.team-section .team-content-wrapper .hentry .team-social-profile .social-links-menu,
		input[type="submit"],
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		.select2-container--default .select2-selection--single,
		table.woocommerce-grouped-product-list.group_table,
		table.woocommerce-grouped-product-list.group_table td,
		table.variations,
		table.variations td,
		#primary-search-wrapper .search-container,
		.woocommerce-pagination ul.page-numbers li .page-numbers,
		.page-links .post-page-numbers,
		.archive-content-wrap .navigation.pagination .page-numbers,
		.woocommerce-posts-wrapper .summary.entry-summary .woocommerce-product-rating,
		.cart-collaterals .order-total,
		#payment .wc_payment_methods .payment_box,
		.product-border .products .product,
		select,
		header .site-header-main,
		blockquote.alignright,
		blockquote.alignleft,
		abbr,
		acronym,
		.product-quantity input[type="number"],
		.coupon input[type="text"],
		figure.wp-block-pullquote.alignleft blockquote,
		figure.wp-block-pullquote.alignright blockquote,
		.site-header-main .menu-inside-wrapper,
		.catch-instagram-feed-gallery-widget-wrapper .button,
		.site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .sub-menu,
		.site-header-main .site-header-menu .menu-inside-wrapper .main-navigation .children,
		.site-header-cart .widget_shopping_cart,
		.navigation-classic .site-header-menu #primary-menu-wrapper .menu-inside-wrapper,
		.woocommerce-grouped-product-list tr,
		.site-main nav.post-navigation:before,
		.mobile-social-search,
		.color-scheme-modern .section:nth-child(2n) + .site-content,
		.color-scheme-wedding .section:nth-child(2n) + .site-content,
		.color-scheme-minimal .section:nth-child(2n) + .site-content,
		.widget .ui-tabs .ui-tabs-panel,
		.site-header-menu .menu-inside-wrapper .nav-menu button:focus,
		.navigation-default .site-header-menu .menu-inside-wrapper .nav-menu li button:focus,
		header .site-header-menu .menu-inside-wrapper .main-navigation .sub-menu li:last-child,
		header .site-header-menu .menu-inside-wrapper .main-navigation .children li:last-child,
		.stats-section .view-all-button .more-button .more-link:hover {
			border-color: %1$s;
		}

		/* Quotes Color */
		blockquote:not(.alignleft):not(.alignright):before {
			color: %1$s;
		}
	
		hr,
		.color-scheme-minimal .slider-content-wrapper.section #featured-slider-prev:after,
		td#today,
		.slider-content-wrapper .controllers:before {
			background-color:  %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_border_color_css', 11 );

/**
 * Enqueues front-end CSS for Text Color with Background
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_text_color_with_background_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[15];
	$text_color_with_background 	= get_theme_mod( 'text_color_with_background', $default_color );

	// Don't do anything if the current color is the default.
	if ( $text_color_with_background === $default_color ) {
		return;
	}

	$css = '

		/* Text Color with background */
		.stats-section .section-description,
		.stats-section .hentry .entry-title a,
		.stats-section .more-link,
		.stats-section .hentry,
		.custom-header-content .entry-title .sub-title,
		.custom-header-content .breadcrumb a,
		.custom-header-content .breadcrumb .sep,
		.team-section .hentry .hentry-inner:hover a,
		.team-content- .hentry-inner:hover .entry-title a,
		.team-section .hentry .hentry-inner:hover .entry-container,
		.team-section .hentry .hentry-inner:hover .entry-meta,
		.hero-section.has-background-image .entry-container,
		.team-section .hentry .hentry-inner:focus a,
		.team-content- .hentry-inner:focus .entry-title a,
		.team-section .hentry .hentry-inner:focus .entry-container,
		.team-section .hentry .hentry-inner:focus .entry-meta,
		.hero-section.has-background-image .entry-container,
		.portfolio-content-wrapper .hentry .entry-container .entry-title a,
		.custom-header-content .entry-container,
		.custom-header-content .entry-container .entry-title,
		.stats-section .section-title,
		.playlist-section .mejs-container,
		.playlist-section .mejs-container button:before,
		.ewnewsletter.has-background-image .section-title,
		.custom-header-content .catch-breadcrumb.breadcrumb-area span.breadcrumb a:hover,
		.custom-header-content .catch-breadcrumb.breadcrumb-area span.breadcrumb a:focus {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $text_color_with_background ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_text_color_with_background_css', 11 );

/**
 * Enqueues front-end CSS for the Tertiary Background color.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_tertiary_background_color_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[16];
	$tertiary_background_color 	= get_theme_mod( 'tertiary_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $tertiary_background_color === $default_color ) {
		return;
	}

	$css = '
		.stats-section,
		.color-scheme-corporate .testimonials-content-wrapper:after {
			background-color: %1$s;
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $tertiary_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_tertiary_background_color_css', 11 );


/**
 * Enqueues front-end CSS for the Color with background image.
 *
 * * @since 1.0
 *
 * @see wp_add_inline_style()
 */
function catch_sketch_testimonial_color_with_background_image_css() {
	$color_scheme          				= catch_sketch_get_color_scheme();
	$default_color         				= $color_scheme[17];
	$testimonial_color_with_background_image 	= get_theme_mod( 'testimonial_color_with_background_image', $default_color );

	// Don't do anything if the current color is the default.
	if ( $testimonial_color_with_background_image === $default_color ) {
		return;
	}

	$css = '
		/**  Color with background image  **/

		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-pager:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image  .cycle-pager:after,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:hover:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:hover:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:focus:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:focus:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-prev:active:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-next:active:before,
		.testimonials-content-wrapper.testimonial-wrapper.has-background-image .section-description,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-pager-active:before,
		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image  .controls > div:before,
		.has-background-image .section-title,
		.has-background-image  .entry-container .entry-meta a,
		.has-background-image  .entry-container .entry-summary a:not(button):not(.more-link),
		.has-background-image  .entry-container .entry-content a:not(button):not(.more-link),
		.has-background-image  .entry-container .entry-title a,
		.has-background-image  .entry-container .entry-title,
		.has-background-image  .entry-container .entry-title span,
		.has-background-image  .entry-container .entry-summary,
		.has-background-image  .entry-container .entry-summary p,
		.has-background-image  .entry-container .entry-content,
		.has-background-image  .entry-container .entry-content p,
		.has-background-image .woocommerce-loop-product__title,
		.has-background-image .entry-title .sub-title,
		.has-background-image .entry-title span,
		.has-background-image .section-title-wrapper > .subtitle,
		.has-background-image .section-title-wrapper + .section-description,
		.has-background-image .section-title + .section-description,
		.has-background-image .section-title-wrapper + .section-subtitle,
		.has-background-image .entry-container .subtitle,
		.text-white .entry-title a,
		.text-white .entry-meta a,
		.text-white .entry-summary,
		.text-white .entry-content {
		    color: %1$s;
		}

		.testimonials-content-wrapper.section.testimonial-wrapper.has-background-image .cycle-pager:before {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'catch-sketch-block-style', sprintf( $css, $testimonial_color_with_background_image ) );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_testimonial_color_with_background_image_css', 11 );

/**
 * Converts a HEX value to RGB.
 *
 * * @since 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function catch_sketch_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
