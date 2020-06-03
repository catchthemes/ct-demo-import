<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Catch_Sketch
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_portfolio_options( $wp_customize ) {
    // Add note to Jetpack Portfolio Section
    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'label'             => sprintf( esc_html__( 'For Portfolio Options for Catch Sketch Theme, go %1$shere%2$s', 'catch-sketch-pro' ),
                 '<a href="javascript:wp.customize.section( \'catch_sketch_portfolio\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'jetpack_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_sketch_portfolio', array(
            'panel'    => 'catch_sketch_theme_options',
            'title'    => esc_html__( 'Portfolio', 'catch-sketch-pro' ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'choices'           => catch_sketch_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'select',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_content_layout',
            'default'           => 'layout-three',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'active_callback'   => 'catch_sketch_is_portfolio_active',
            'choices'           => catch_sketch_sections_layout_options(),
            'label'             => esc_html__( 'Select Portfolio Layout', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'select',
        )
    );

    $type = catch_sketch_section_type_options();

    $type['jetpack-portfolio'] = esc_html__( 'Custom Post Type', 'catch-sketch-pro' );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_type',
            'default'           => 'category',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'active_callback'   => 'catch_sketch_is_portfolio_active',
            'choices'           => $type,
            'description'       => sprintf( esc_html__( 'For Custom Post Type Content, install %1$sEssential Content Types%2$s Plugin with Portfolio Content Type Enabled', 'catch-sketch-pro' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'label'             => esc_html__( 'Select Type', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'select',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Sketch_Note_Control',
            'active_callback'   => 'catch_sketch_is_jetpack_portfolio_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-sketch-pro' ),
                 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'description',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_headline',
            'default'           => esc_html__( 'Portfolio', 'catch-sketch-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_cpt_portfolio_inactive',
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_subheadline',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_cpt_portfolio_inactive',
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_number',
            'default'           => '6',
            'sanitize_callback' => 'catch_sketch_sanitize_number_range',
            'active_callback'   => 'catch_sketch_is_portfolio_active',
            'label'             => esc_html__( 'Number of items to show', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_select_category',
            'sanitize_callback' => 'catch_sketch_sanitize_category_list',
            'active_callback'   => 'catch_sketch_is_category_portfolio_active',
            'custom_control'    => 'Catch_Sketch_Multi_Cat',
            'label'             => esc_html__( 'Select Categories', 'catch-sketch-pro' ),
            'name'              => 'catch_sketch_portfolio_select_category',
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'dropdown-categories',
        )
    );

    $number = get_theme_mod( 'catch_sketch_portfolio_number', 6 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for featured post content
        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_post_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_post_portfolio_active',
                'input_attrs'       => array(
                'style'             => 'width: 100px;'
                ),
                'label'             => esc_html__( 'Post', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_portfolio',
                'choices'           => catch_sketch_generate_post_array(),
                'type'              => 'select',
            )
        );

        //for CPT
        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_cpt_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_jetpack_portfolio_active',
                'label'             => esc_html__( 'Portfolio', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_portfolio',
                'type'              => 'select',
                'choices'           => catch_sketch_generate_post_array( 'jetpack-portfolio' ),
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_page_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_post',
                'active_callback'   => 'catch_sketch_is_page_portfolio_active',
                'label'             => esc_html__( 'Page', 'catch-sketch-pro' ) . ' ' . $i ,
                'section'           => 'catch_sketch_portfolio',
                'type'              => 'dropdown-pages',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_note_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'custom_control'    => 'Catch_Sketch_Note_Control',
                'active_callback'   => 'catch_sketch_is_image_portfolio_active',
                'label'             => esc_html__( 'Portfolio #', 'catch-sketch-pro' ) .  $i,
                'section'           => 'catch_sketch_portfolio',
                'type'              => 'description',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_image_' . $i,
                'custom_control'      => 'WP_Customize_Image_Control',
                'sanitize_callback' => 'catch_sketch_sanitize_image',
                'active_callback'   => 'catch_sketch_is_image_portfolio_active',
                'label'             => esc_html__( 'Image', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_portfolio',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_link_' . $i,
                'sanitize_callback' => 'esc_url_raw',
                'active_callback'   => 'catch_sketch_is_image_portfolio_active',
                'label'             => esc_html__( 'Link', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_portfolio',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_target_' . $i,
                'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
                'active_callback'   => 'catch_sketch_is_image_portfolio_active',
                'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_portfolio',
                'custom_control'    => 'Catch_Sketch_Toggle_Control',
            )
        );

        catch_sketch_register_option( $wp_customize, array(
                'name'              => 'catch_sketch_portfolio_title_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'active_callback'   => 'catch_sketch_is_image_portfolio_active',
                'label'             => esc_html__( 'Name', 'catch-sketch-pro' ),
                'section'           => 'catch_sketch_portfolio',
                'type'              => 'text',
            )
        );
    } // End for().

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_portfolio_meta_show',
            'default'           => 'show-meta',
            'active_callback'   => 'catch_sketch_is_portfolio_post_product_tag_category_cpt_content_active',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'choices'           => catch_sketch_meta_show(),
            'label'             => esc_html__( 'Display Meta', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_portfolio',
            'type'              => 'select',
        )
    );
}
add_action( 'customize_register', 'catch_sketch_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'catch_sketch_is_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_portfolio_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_sketch_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( catch_sketch_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_post_portfolio_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_post_portfolio_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'post' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_jetpack_portfolio_active' ) ) :
    /**
    * Return true if jetpack portfolio is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_jetpack_portfolio_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'jetpack-portfolio' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_page_portfolio_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_page_portfolio_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'page' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_category_portfolio_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_category_portfolio_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'category' === $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_image_portfolio_inactive' ) ) :
    /**
    * Return true image portfolio is not active
    *
    * * @since 1.0
    */
    function catch_sketch_is_image_portfolio_inactive( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'image' !== $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_cpt_portfolio_inactive' ) ) :
    /**
    * Return true if cpt portfolio is not active
    *
    * * @since 1.0
    */
    function catch_sketch_is_cpt_portfolio_inactive( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'jetpack-portfolio' !== $type );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_image_portfolio_active' ) ) :
    /**
    * Return true if page content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_image_portfolio_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && 'custom' === $type );
    }
endif;

if( ! function_exists( 'catch_sketch_is_product_portfolio_content_active' ) ) :
    /**
    * Return true if product content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_product_portfolio_content_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        return ( catch_sketch_is_portfolio_active( $control ) && ( 'product' === $type ) );
    }
endif;

if ( ! function_exists( 'catch_sketch_is_portfolio_post_product_tag_category_cpt_content_active' ) ) :
    /**
    * Return true if page/post/category/image content is active
    *
    * * @since 1.0
    */
    function catch_sketch_is_portfolio_post_product_tag_category_cpt_content_active( $control ) {
        $type = $control->manager->get_setting( 'catch_sketch_portfolio_type' )->value();

        //return true only if previwed page on customizer matches the type of content option selected and is or is not selected type
        return ( catch_sketch_is_portfolio_active( $control ) && ( 'category' === $type || 'post' === $type || 'tag' === $type || 'jetpack-portfolio' === $type || 'product' === $type ) );
    }
endif;
