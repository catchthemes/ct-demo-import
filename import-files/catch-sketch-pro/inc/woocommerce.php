<?php
/**
 * Adding support for WooCommerce Plugin
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}


if ( ! function_exists( 'catch_sketch_woocommerce_setup' ) ) :
    /**
     * Sets up support for various WooCommerce features.
     */
    function catch_sketch_woocommerce_setup() {
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 596,
        ) );

        if ( get_theme_mod( 'catch_sketch_product_gallery_zoom', 1 ) ) {
            add_theme_support('wc-product-gallery-zoom');
        }

        if ( get_theme_mod( 'catch_sketch_product_gallery_lightbox', 1 ) ) {
            add_theme_support('wc-product-gallery-lightbox');
        }

        if ( get_theme_mod( 'catch_sketch_product_gallery_slider', 1 ) ) {
            add_theme_support('wc-product-gallery-slider');
        }
    }
endif; //catch_sketch_woocommerce_setup
add_action( 'after_setup_theme', 'catch_sketch_woocommerce_setup' );


/**
 * Add WooCommerce Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_woocommerce_options( $wp_customize ) {
    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_woocommerce_layout',
            'default'           => 'no-sidebar-full-width',
            'sanitize_callback' => 'catch_sketch_sanitize_select',
            'description'       => esc_html__( 'Layout for WooCommerce Pages', 'catch-sketch-pro' ),
            'label'             => esc_html__( 'WooCommerce Layout', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_layout_options',
            'type'              => 'radio',
            'choices'           => array(
                'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-sketch-pro' ),
                'left-sidebar'          => esc_html__( 'Left Sidebar ( Primary Sidebar, Content )', 'catch-sketch-pro' ),
                'no-sidebar'            => esc_html__( 'No Sidebar', 'catch-sketch-pro' ),
                'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-sketch-pro' ),
            ),
        )
    );

    // WooCommerce Options
    $wp_customize->add_section( 'catch_sketch_woocommerce_options', array(
        'title'       => esc_html__( 'WooCommerce Options', 'catch-sketch-pro' ),
        'panel'       => 'catch_sketch_theme_options',
        'description' => esc_html__( 'Since these options are added via theme support, you will need to save and refresh the customizer to view the full effect.', 'catch-sketch-pro' ),
    ) );

    //WooCommerce Shop Page Subtitle Option
      catch_sketch_register_option( $wp_customize, array(
              'name'              => 'catch_sketch_shop_subtitle',
              'sanitize_callback' => 'wp_kses_post',
              'label'             => esc_html__( 'Shop Page Subtitle', 'catch-sketch-pro' ),
              'default'           => esc_html__( 'This is where you can add new products to your store.', 'catch-sketch-pro' ),
              'section'           => 'catch_sketch_woocommerce_options',
              'type'              => 'textarea',
          )
      );

    // WooCommerce Options
    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_product_gallery_zoom',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'default'           => 1,
            'label'             => esc_html__( 'Product Gallery Zoom', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woocommerce_options',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_product_gallery_lightbox',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'default'           => 1,
            'label'             => esc_html__( 'Product Gallery Lightbox', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woocommerce_options',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );

    catch_sketch_register_option( $wp_customize, array(
            'name'              => 'catch_sketch_product_gallery_slider',
            'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
            'default'           => 1,
            'label'             => esc_html__( 'Product Gallery Slider', 'catch-sketch-pro' ),
            'section'           => 'catch_sketch_woocommerce_options',
            'custom_control'    => 'Catch_Sketch_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'catch_sketch_woocommerce_options' );

/**
 * Make Shop Page Sub Title dynamic
 */
function catch_sketch_woocommerce_shop_subtitle( $args ) {
    if ( is_shop() ) {
        return wp_kses_post( get_theme_mod( 'catch_sketch_shop_subtitle', esc_html__( 'This is where you can add new products to your store.', 'catch-sketch-pro' ) ) );
    }

    return $args;
}
add_filter( 'get_the_archive_description', 'catch_sketch_woocommerce_shop_subtitle', 20 );

/**
* woo_hide_page_title
*
* Removes the "shop" title on the main shop page
*
* @access      public
* @since       1.0
* @return      void
*/
 
function catch_sketch_woocommerce_hide_page_title() { 
    if ( is_shop() && catch_sketch_has_header_media_text() ) {
        return false;
    }

    return true;  
}
add_filter( 'woocommerce_show_page_title', 'catch_sketch_woocommerce_hide_page_title' ); 

/**
 * uses remove_action to remove the WooCommerce Wrapper and add_action to add Main Wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'catch_sketch_woocommerce_container_start' ) ) :
    function catch_sketch_woocommerce_container_start() {
        echo '<div class="singular-content-wrapper site-content-wrapper">';
    }
endif; //catch_sketch_woocommerce_start
add_action( 'woocommerce_before_main_content', 'catch_sketch_woocommerce_container_start', 10 );

if ( ! function_exists( 'catch_sketch_woocommerce_container_end' ) ) :
    function catch_sketch_woocommerce_container_end() {
        echo '</div><!-- .singular-content-wrapper -->';
    }
endif; //catch_sketch_woocommerce_end
add_action( 'woocommerce_sidebar', 'catch_sketch_woocommerce_container_end', 20 );


if ( ! function_exists( 'catch_sketch_woocommerce_start' ) ) :
    function catch_sketch_woocommerce_start() {
    	echo '<div id="primary" class="content-area"><main role="main" class="site-main woocommerce" id="main"><div class="woocommerce-posts-wrapper">';
    }
endif; //catch_sketch_woocommerce_start
add_action( 'woocommerce_before_main_content', 'catch_sketch_woocommerce_start', 20 );


if ( ! function_exists( 'catch_sketch_woocommerce_end' ) ) :
    function catch_sketch_woocommerce_end() {
    	echo '</div><!-- .woocommerce-posts-wrapper --></main><!-- #main --></div><!-- #primary -->';
    }
endif; //catch_sketch_woocommerce_end
add_action( 'woocommerce_after_main_content', 'catch_sketch_woocommerce_end', 20 );


function catch_sketch_woocommerce_shorting_start() {
	echo '<div class="woocommerce-shorting-wrapper">';
}
add_action( 'woocommerce_before_shop_loop', 'catch_sketch_woocommerce_shorting_start', 10 );


function catch_sketch_woocommerce_shorting_end() {
	echo '</div><!-- .woocommerce-shorting-wrapper -->';
}
add_action( 'woocommerce_before_shop_loop', 'catch_sketch_woocommerce_shorting_end', 40 );


function catch_sketch_woocommerce_product_container_start() {
	echo '<div class="product-container">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'catch_sketch_woocommerce_product_container_start', 20 );


function catch_sketch_woocommerce_product_container_end() {
	echo '</div><!-- .product-container -->';
}
add_action( 'woocommerce_after_shop_loop_item', 'catch_sketch_woocommerce_product_container_end', 20 );

/**
 * Remove breadcrumb from default position
 * Check template-parts/header/breadcrumb.php
 */
function catch_sketch_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'catch_sketch_remove_wc_breadcrumbs' );

if ( ! function_exists( 'catch_sketch_header_cart' ) ) {
    /**
     * Display Header Cart
     *
     * @since  1.0.0
     * @uses  catch_sketch_is_woocommerce_activated() check if WooCommerce is activated
     * @return void
     */
    function catch_sketch_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <div id="site-header-cart-wrapper" class="menu-wrapper">
            <ul id="site-header-cart" class="site-header-cart menu">
                <li class="<?php echo esc_attr( $class ); ?>">
                    <?php catch_sketch_cart_link(); ?>
                </li>
                <li>
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </li>
            </ul>
        </div>
        <?php
    }
}

if ( ! function_exists( 'catch_sketch_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function catch_sketch_cart_link() {
        ?>
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'catch-sketch-pro' ); ?>"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?><span class="count"><?php echo wp_kses_data( sprintf( _n( 'CART (%d)', 'CART (%d)', WC()->cart->get_cart_contents_count(), 'catch-sketch-pro' ), WC()->cart->get_cart_contents_count() ) );?></span></a>
        <?php
    }
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function catch_sketch_woocommerce_scripts() {
    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style( 'catch-sketch-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_woocommerce_scripts' );

if ( ! function_exists( 'catch_sketch_woocommerce_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function catch_sketch_woocommerce_product_columns_wrapper() {
        // Get option from Customizer=> WooCommerce=> Product Catlog=> Products per row.
        echo '<div class="columns-' . absint( get_option( 'woocommerce_catalog_columns', 4 ) ) . '">';
    }
}
add_action( 'woocommerce_before_shop_loop', 'catch_sketch_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'catch_sketch_woocommerce_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function catch_sketch_woocommerce_product_columns_wrapper_close() {
        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop', 'catch_sketch_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Include Woo Products Showcase
 */
require get_parent_theme_file_path( 'inc/customizer/woo-products-showcase.php' );
