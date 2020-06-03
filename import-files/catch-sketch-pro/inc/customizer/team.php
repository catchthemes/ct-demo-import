<?php
/**
 * Team options
 *
 * @package Catch_Sketch
 */

/**
 * Add team content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_team_options( $wp_customize ) {

	$wp_customize->add_section( 'catch_sketch_team', array(
			'title' => esc_html__( 'Team', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_layout',
			'default'           => 'layout-four',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_team_active',
			'choices'           => catch_sketch_sections_layout_options(),
			'label'             => esc_html__( 'Select Featured Content Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_title',
			'default'           => esc_html__( 'Our Team', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_team_active',
			'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_team_active',
			'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_team_active',
			'choices'           => catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_text_align',
			'default'           => 'text-aligned-center',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_team_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_number',
			'default'           => 4,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_team_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_team_post_page_category_content_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_meta_show',
			'default'           => 'hide-meta',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_team_post_page_category_content_active',
			'choices'           => catch_sketch_meta_show(),
			'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'select',
		)
	);


	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_team_category_content_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_team_select_category',
			'section'           => 'catch_sketch_team',
			'type'              => 'dropdown-categories',
		)
	);

	$number = get_theme_mod( 'catch_sketch_team_number', 4 );

	//loop for team post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_post_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'catch_sketch_is_team_post_content_active',
				'input_attrs'       => array(
					'style'             => 'width: 40px;'
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_team',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select'
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_page_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_team_page_content_active',
				'label'             => esc_html__( 'Team Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_team',
				'type'              => 'dropdown-pages',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'catch_sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Team #', 'catch-sketch-pro' ) .  $i,
				'section'           => 'catch_sketch_team',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_image_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_link_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_target_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_title_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_position_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Position', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_content_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_team_image_content_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_social_link_one_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_team_active',
				'label'             => esc_html__( 'Team #', 'catch-sketch-pro' ) .  $i . esc_html__( ': Social Link #1', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_social_link_two_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_team_active',
				'label'             => esc_html__( 'Team #', 'catch-sketch-pro' ) .  $i . esc_html__( ': Social Link #2', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_social_link_three_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_team_active',
				'label'             => esc_html__( 'Team #', 'catch-sketch-pro' ) .  $i . esc_html__( ': Social Link #3', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_team_social_link_four_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_team_active',
				'label'             => esc_html__( 'Team #', 'catch-sketch-pro' ) .  $i . esc_html__( ': Social Link #4', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_team',
			)
		);
	} // End for().

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_text',
			'default'           => esc_html__( 'View All', 'catch-sketch-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_team_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_team_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_team_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_team_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_team',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_team_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_team_active' ) ) :
	/**
	* Return true if team content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_team_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_team_post_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_team_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_team_active( $control ) && ( 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_team_page_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_team_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_team_active( $control ) && ( 'page' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_team_category_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_team_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_team_active( $control ) && ( 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_team_post_page_category_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_post_page_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_team_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_team_active( $control ) && ( 'category' === $type || 'page' === $type || 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_team_image_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_team_image_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_team_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_team_active( $control ) && ( 'custom' === $type ) );
	}
endif;
