<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Catch_Sketch
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for this theme, go %1$shere%2$s', 'catch-sketch-pro' ),
                '<a href="javascript:wp.customize.section( \'catch_sketch_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_sketch_testimonials', array(
            'panel'    => 'catch_sketch_theme_options',
            'title'    => esc_html__( 'Testimonials', 'catch-sketch-pro' ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'choices'           => catch_sketch_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_bg_image',
            'default'           => trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/testimonial-bg.png',
            'sanitize_callback' => 'catch_sketch_sanitize_image',
            'active_callback'   => 'catch_sketch_is_testimonial_active',
            'custom_control'    => 'WP_Customize_Image_Control',
            'label'             => esc_html__( 'Section Background Image', 'catch-sketch-pro' ),
           'section'           => 'catch_sketch_testimonials',
            'mime_type'         => 'image',
        )
    );

    $type = catch_sketch_section_type_options();

    $type['jetpack-testimonial'] = esc_html__( 'Custom Post Type', 'catch-sketch-pro' );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_type',
            'default'           => 'category',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'active_callback'   => 'catch_sketch_is_testimonial_active',
            'choices'           => $type,
            'description'       => sprintf( esc_html__( 'For Custom Post Type Content, install %1$sEssential Content Types%2$s Plugin with Testimonial Content Type Enabled', 'catch-sketch-pro' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'label'             => esc_html__( 'Select Type', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'select',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'active_callback'   => 'catch_sketch_is_cpt_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-sketch-pro' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'description',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_headline',
            'default'           => esc_html__( 'Testimonials', 'catch-sketch-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_cpt_testimonial_inactive',
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_subheadline',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_cpt_testimonial_inactive',
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'catch_sketch_sanitize_number_range',
            'active_callback'   => 'catch_sketch_is_testimonial_active',
            'label'             => esc_html__( 'No of items', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 1,
                'max'               => 7,
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_display_title',
            'default'           => 1,
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'active_callback'   => 'catch_sketch_is_testimonial_active',
            'label'             => esc_html__( 'Display Title', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_testimonials',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_style',
            'default'           => 'style-one',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'active_callback'   => 'catch_sketch_is_testimonial_active',
            'choices'           => array(
                'style-one'  => esc_html__( 'Style One', 'catch-sketch-pro' ),
                'style-two'  => esc_html__( 'Style Two', 'catch-sketch-pro' ),
            ),
            'label'             => esc_html__( 'Testimonial Style', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'select',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_testimonial_select_category',
            'sanitize_callback' => 'catch_sketch_sanitize_category_list',
            'active_callback'   => 'catch_sketch_is_category_testimonial_active',
            'custom_control'    => 'Catch_Sketch_Multi_Cat',
            'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
            'name'              => 'catch_sketch_testimonial_select_category',
            'section'           => 'catch_sketch_testimonials',
            'type'              => 'dropdown-categories',
        )
    );

    $number = get_theme_mod( 'catch_sketch_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for featured post content
        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_post_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_post_testimonial_active',
                'input_attrs'       => array(
                'style'             => 'width: 100px;'
                ),
                'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_testimonials',
                'choices'           => catch_sketch_generate_post_array(),
                'type'              => 'select',
            )
        );

        //for CPT
        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_cpt_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_cpt_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'select',
                'choices'           => catch_sketch_generate_post_array( 'jetpack-testimonial' ),
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_page_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_page_testimonial_active',
                'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'dropdown-pages',
				'allow_addition'    => true,
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_note_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'custom_control'    => 'Catch_Sketch_Note_Control',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Testimonial #', 'catch-sketch-pro' ) .  $i,
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'description',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_image_' . $i,
                'custom_control'      => 'WP_Customize_Image_Control',
                'sanitize_callback' => 'catch_sketch_sanitize_image',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_pager_image_' . $i,
                'custom_control'      => 'WP_Customize_Image_Control',
                'sanitize_callback' => 'catch_sketch_sanitize_image',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Pager Image', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_link_' . $i,
                'sanitize_callback' => 'esc_url_raw',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_target_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
                'custom_control'    => 'Catch_Sketch_Toggle_Control',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_content_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Testimonial Text', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'textarea',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_title_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Name', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'text',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_testimonial_position_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'active_callback'   => 'catch_sketch_is_image_testimonial_active',
                'label'             => esc_html__( 'Position', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_testimonials',
                'type'              => 'text',
            )
        );
    } // End for().
}
add_action( 'customize_register', 'catch_sketch_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'catch_sketch_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_sketch_testimonial_option' )->value();

        //return true only if previewed page on customizer matches the type of content option selected
        return ( catch_sketch_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_post_testimonial_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_post_testimonial_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'post' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_cpt_testimonial_active' ) ) :
    /**
    * Return true if cpt testimonial is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_cpt_testimonial_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'jetpack-testimonial' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_page_testimonial_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_page_testimonial_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'page' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_category_testimonial_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_category_testimonial_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'category' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_cpt_testimonial_inactive' ) ) :
    /**
    * Return true if image page is not active
    *
    * * @since 1.0
    */
    function catch_sketch_is_cpt_testimonial_inactive( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'jetpack-testimonial' !== $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_image_testimonial_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_image_testimonial_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_testimonial_type' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && 'custom' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_testimonial_bg_active' ) ) :
    /**
    * Return true if background is set
    *
    * * @since 1.0
    */
    function catch_sketch_is_testimonial_bg_active( $control ) {
        $bg_image = $control->manager->get_setting( 'catch_sketch_testimonial_bg_image' )->value();

        return ( catch_sketch_is_testimonial_active( $control ) && '' !== $bg_image );
    }
endif;
