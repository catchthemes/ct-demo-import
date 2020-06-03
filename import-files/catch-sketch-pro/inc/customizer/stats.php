<?php
/**
 * Stats options
 *
 * @package Catch_Sketch
 */

/**
 * Add stats content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_stats_options( $wp_customize ) {

    $wp_customize->add_section( 'catch_sketch_stats', array(
			'title' => esc_html__( 'Stats', 'catch-sketch-pro' ),
			'panel' => 'catch_sketch_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_layout',
			'default'           => 'layout-four',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'choices'           => catch_sketch_sections_layout_options(),
			'label'             => esc_html__( 'Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_archive_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_cpt_stats_inactive',
			'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_sketch_is_cpt_stats_inactive',
			'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'textarea',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_type',
			'default'           => 'category',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_stats_active',
            'choices'           => catch_sketch_section_type_options(),
			'label'             => esc_html__( 'Type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'select',
		)
	);

    catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_number',
			'default'           => 4,
			'sanitize_callback' => 'catch_sketch_sanitize_number_range',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'description'       => esc_html__( 'Save and refresh the customizer if this option is changed.', 'catch-sketch-pro' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_text_align',
			'default'           => 'text-aligned-left',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_stats_post_page_category_cpt_content_active',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_select_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_stats_category_content_active',
			'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
			'name'              => 'catch_sketch_stats_select_category',
			'section'           => 'catch_sketch_stats',
			'type'              => 'dropdown-categories',
		)
	);

	$number = get_theme_mod( 'catch_sketch_stats_number', 4 );

	//loop for stats post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_post_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'catch_sketch_is_stats_post_content_active',
				'input_attrs'       => array(
					'style'             => 'width: 40px;'
				),
				'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_stats',
				'choices'           => catch_sketch_generate_post_array(),
				'type'              => 'select'
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_page_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_post',
				'active_callback'   => 'catch_sketch_is_stats_page_content_active',
				'label'             => esc_html__( 'Stats Page', 'catch-sketch-pro' ) . ' ' . $i ,
				'section'           => 'catch_sketch_stats',
				'type'              => 'dropdown-pages',
			)
		);


		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_note_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'custom_control'    => 'Catch_Sketch_Note_Control',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Stats #', 'catch-sketch-pro' ) .  $i,
				'section'           => 'catch_sketch_stats',
				'type'              => 'description',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_image_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_link_' . $i,
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_target_' . $i,
				'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
				'custom_control'    => 'Catch_Sketch_Toggle_Control',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_title_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Title', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
				'type'              => 'text',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_content_' . $i,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'Content', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
				'type'              => 'textarea',
			)
		);

		catch_sketch_register_option( $wp_customize, array(
				'name'              => 'catch_sketch_stats_more_button_text_' . $i,
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => 'catch_sketch_is_stats_image_content_active',
				'label'             => esc_html__( 'More Button Text', 'catch-sketch-pro' ),
				'section'           => 'catch_sketch_stats',
				'type'              => 'text',
			)
		);
	} // End for().

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'type'              => 'text',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_stats_target',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'active_callback'   => 'catch_sketch_is_stats_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_stats',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_stats_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_sketch_is_stats_active' ) ) :
	/**
	* Return true if stats content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_sketch_stats_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_sketch_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_cpt_stats_inactive' ) ) :
	/**
	* Return true if CPT stats content is inactive
	*
	* * @since 1.0
	*/

	function catch_sketch_is_cpt_stats_inactive( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		return ( catch_sketch_is_stats_active( $control ) && 'ect-service' !== $type );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_post_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_post_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_page_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_page_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'page' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_cpt_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_cpt_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'ect-service' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_category_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_category_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'category' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_post_page_category_cpt_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_post_page_category_cpt_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'category' === $type || 'page' === $type || 'post' === $type ) );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_stats_image_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_stats_image_content_active( $control ) {
		$type = $control->manager->get_setting( 'catch_sketch_stats_type' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( catch_sketch_is_stats_active( $control ) && ( 'custom' === $type ) );
	}
endif;
