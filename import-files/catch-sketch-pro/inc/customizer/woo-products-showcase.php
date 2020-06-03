<?php
/**
 * Adding support for WooCommerce Products Showcase Option
 */

/**
 * Add WooCommerce Product Showcase Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_woo_products_showcase( $wp_customize ) {
   $wp_customize->add_section( 'catch_sketch_woo_products_showcase', array(
        'title' => esc_html__( 'WooCommerce Products Showcase', 'catch-sketch-pro' ),
        'panel' => 'catch_sketch_theme_options',
    ) );

   catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'choices'           => catch_sketch_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'select',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_headline',
            'default'           => esc_html__( 'Our Store', 'catch-sketch-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_subheadline',
            'default'           => esc_html__( 'Order Online', 'catch-sketch-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'catch-sketch-pro' ),
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'textarea',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_number',
            'default'           => 8,
            'sanitize_callback' => 'catch_sketch_sanitize_number_range',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'description'       => esc_html__( 'Save and refresh the customizer if this option is changed. Set -1 to display all', 'catch-sketch-pro' ),
            'input_attrs'       => array(
                'style' => 'width: 50px;',
                'min'   => -1,
            ),
            'label'             => esc_html__( 'No of Products', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'number',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'               => 'catch_sketch_woo_products_showcase_columns',
            'default'            => 4,
            'sanitize_callback'  => 'catch_sketch_sanitize_number_range',
            'active_callback'    => 'catch_sketch_is_woo_products_showcase_active',
            'description'        => esc_html__( 'Theme supports up to 6 columns', 'catch-sketch-pro' ),
            'label'              => esc_html__( 'No of Columns', 'catch-sketch-pro' ),
            'section'            => 'catch_sketch_woo_products_showcase',
            'type'               => 'number',
            'input_attrs'       => array(
                'style' => 'width: 50px;',
                'min'   => 1,
                'max'   => 6,
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'               => 'catch_sketch_woo_products_showcase_paginate',
            'default'            => 'false',
            'sanitize_callback'  => 'catch_sketch_sanitize_select',
            'active_callback'    => 'catch_sketch_is_woo_products_showcase_active',
            'label'              => esc_html__( 'Paginate', 'catch-sketch-pro' ),
            'section'            => 'catch_sketch_woo_products_showcase',
            'type'               => 'radio',
            'choices'            => array(
                'false' => esc_html__( 'No', 'catch-sketch-pro' ),
                'true' => esc_html__( 'Yes', 'catch-sketch-pro' ),
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'               => 'catch_sketch_woo_products_showcase_orderby',
            'default'            => 'title',
            'sanitize_callback'  => 'catch_sketch_sanitize_select',
            'active_callback'    => 'catch_sketch_is_woo_products_showcase_active',
            'label'              => esc_html__( 'Order By', 'catch-sketch-pro' ),
            'section'            => 'catch_sketch_woo_products_showcase',
            'type'               => 'select',
            'choices'            => array(
                'date'       => esc_html__( 'Date - The date the product was published', 'catch-sketch-pro' ),
                'id'         => esc_html__( 'ID - The post ID of the product', 'catch-sketch-pro' ),
                'menu_order' => esc_html__( 'Menu Order - The Menu Order, if set (lower numbers display first)', 'catch-sketch-pro' ),
                'popularity' => esc_html__( 'Popularity - The number of purchases', 'catch-sketch-pro' ),
                'rand'       => esc_html__( 'Random', 'catch-sketch-pro' ),
                'rating'     => esc_html__( 'Rating - The average product rating', 'catch-sketch-pro' ),
                'title'      => esc_html__( 'Title - The product title', 'catch-sketch-pro' ),
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'               => 'catch_sketch_woo_products_showcase_products_filter',
            'default'            => 'none',
            'sanitize_callback'  => 'catch_sketch_sanitize_select',
            'active_callback'    => 'catch_sketch_is_woo_products_showcase_active',
            'label'              => esc_html__( 'Products Filter', 'catch-sketch-pro' ),
            'section'            => 'catch_sketch_woo_products_showcase',
            'type'               => 'radio',
            'choices'            => array(
                'none'         => esc_html__( 'None', 'catch-sketch-pro' ),
                'on_sale'      => esc_html__( 'Retrieve on sale products', 'catch-sketch-pro' ),
                'best_selling' => esc_html__( 'Retrieve best selling products', 'catch-sketch-pro' ),
                'top_rated'    => esc_html__( 'Retrieve top rated products', 'catch-sketch-pro' ),
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_border',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Border to products?', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_round_thumbnail',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Make product image round', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_featured',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Show only Products that are marked as Featured Products', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'               => 'catch_sketch_woo_products_showcase_order',
            'default'            => 'ASC',
            'sanitize_callback'  => 'catch_sketch_sanitize_select',
            'active_callback'    => 'catch_sketch_is_woo_products_showcase_active',
            'label'              => esc_html__( 'Order', 'catch-sketch-pro' ),
            'section'            => 'catch_sketch_woo_products_showcase',
            'type'               => 'radio',
            'choices'            => array(
                'ASC'  => esc_html__( 'Ascending', 'catch-sketch-pro' ),
                'DESC' => esc_html__( 'Descending', 'catch-sketch-pro' ),
            ),
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_skus',
            'description'       => esc_html__( 'Comma separated list of product SKUs', 'catch-sketch-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'SKUs', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'text',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_category',
            'description'       => esc_html__( 'Comma separated list of category slugs', 'catch-sketch-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Category', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'textarea',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_text',
            'default'           => esc_html__( 'Go to Shop Page', 'catch-sketch-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Button Text', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'type'              => 'text',
        )
    );

    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_link',
            'default'           =>  esc_url( $shop_page_url ),
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Button Link', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woo_products_showcase_target',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'active_callback'   => 'catch_sketch_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woo_products_showcase',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'catch_sketch_woo_products_showcase', 10 );

/** Active Callback Functions **/
if( ! function_exists( 'catch_sketch_is_woo_products_showcase_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * * * @since 1.0
    */
    function catch_sketch_is_woo_products_showcase_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_sketch_woo_products_showcase_option' )->value();

        return ( catch_sketch_check_section( $enable ) );
    }
endif;
