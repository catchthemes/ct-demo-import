<?php
/**
 * Theme Options
 *
 * @package Catch_Sketch
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_sketch_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'catch_sketch_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'catch-sketch-pro' ),
		'priority' => 130,
	) );

	// Font Family Options.
	$wp_customize->add_section( 'catch_sketch_font_family', array(
		'panel' => 'catch_sketch_theme_options',
		'title' => esc_html__( 'Font Family Options', 'catch-sketch-pro' ),
	) );

	$avaliable_fonts = catch_sketch_avaliable_fonts();

	$choices = array();

	foreach ( $avaliable_fonts as $font ) {
		$choices[ $font['value'] ] = str_replace( '"', '', $font['label'] );
	}

	$font_family_options = catch_sketch_font_family_options();

	foreach ( $font_family_options as $key => $value ) {
		catch_sketch_register_option( $wp_customize, array(
				'name'              => $key,
				'default'           => $value['default'],
				'sanitize_callback' => 'catch_sketch_sanitize_select',
				'choices'           => $choices,
				'label'             => $value['label'],
				'section'           => 'catch_sketch_font_family',
				'type'              => 'select',
			)
		);
	}

	// Footer Editor Options.
	$wp_customize->add_section( 'catch_sketch_footer_editor_options', array(
		'title'       => esc_html__( 'Footer Editor Options', 'catch-sketch-pro' ),
		'description' => esc_html__( 'You can either add html or plain text or custom shortcodes, which will be automatically inserted into your theme. Some shorcodes: [the-year], [site-link] and [privacy-policy-link] for current year, site link and privacy policy link respectively.', 'catch-sketch-pro' ),
		'panel'       => 'catch_sketch_theme_options',
	) );

	$theme_data = wp_get_theme();

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_footer_content',
			'default'           => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'catch-sketch-pro' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'catch-sketch-pro' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Footer Content', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_footer_editor_options',
			'type'              => 'textarea',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'catch_sketch_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'catch-sketch-pro' ),
		'panel' => 'catch_sketch_theme_options',
		)
	);

	/* Layout Type */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_layout_type',
			'default'           => 'fluid',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Site Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'fluid' => esc_html__( 'Fluid', 'catch-sketch-pro' ),
				'boxed' => esc_html__( 'Boxed', 'catch-sketch-pro' ),
			),
		)
	);

	/* Default Layout */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-sketch-pro' ),
				'left-sidebar'          => esc_html__( 'Left Sidebar ( Primary Sidebar, Content )', 'catch-sketch-pro' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'catch-sketch-pro' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-sketch-pro' ),
			),
		)
	);

	/* Homepage Layout */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_homepage_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Homepage Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-sketch-pro' ),
				'left-sidebar'          => esc_html__( 'Left Sidebar ( Primary Sidebar, Content )', 'catch-sketch-pro' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'catch-sketch-pro' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-sketch-pro' ),
			),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_homepage_columns',
			'default'           => 'layout-one',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Homepage Posts Column', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'layout-one'   => esc_html__( '1 Column', 'catch-sketch-pro' ),
				'layout-two'   => esc_html__( '2 Columns', 'catch-sketch-pro' ),
				'layout-three' => esc_html__( '3 Columns', 'catch-sketch-pro' ),
			),
		)
	);

	/* Blog Style */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_blog_style',
			'default'           => 0,
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Blog Style Grid', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	/* Blog Border */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_blog_article_border',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Border on posts', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	/* Blog/Archive Layout */
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Blog/Archive Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-sketch-pro' ),
				'left-sidebar'          => esc_html__( 'Left Sidebar ( Primary Sidebar, Content )', 'catch-sketch-pro' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'catch-sketch-pro' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-sketch-pro' ),
			),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_archive_columns',
			'default'           => 'layout-one',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Blog/Archive Posts Column', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'layout-one'   => esc_html__( '1 Column', 'catch-sketch-pro' ),
				'layout-two'   => esc_html__( '2 Columns', 'catch-sketch-pro' ),
				'layout-three' => esc_html__( '3 Columns', 'catch-sketch-pro' ),
			),
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_archive_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_content_show(),
			'label'             => esc_html__( 'Archive Content Layout', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_archive_meta_show',
			'default'           => 'show-meta',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_meta_show(),
			'label'             => esc_html__( 'Archive Display Meta', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
		)
	);

	// Single Page/Post Image
	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'disabled'            => esc_html__( 'Disabled', 'catch-sketch-pro' ),
				'post-thumbnail'      => esc_html__( 'Post Thumbnail (1060x596)', 'catch-sketch-pro' ),
				'catch-sketch-featured' => esc_html__( 'Featured (664x373)', 'catch-sketch-pro' ),
				'full'                => esc_html__( 'Original Image Size', 'catch-sketch-pro' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_sketch_excerpt_options', array(
		'panel' => 'catch_sketch_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'catch-sketch-pro' ),
			'section'  => 'catch_sketch_excerpt_options',
			'type'     => 'number',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'catch-sketch-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_sketch_search_options', array(
		'panel'     => 'catch_sketch_theme_options',
		'title'     => esc_html__( 'Search Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_search_text',
			'default'           => esc_html__( 'Search ...', 'catch-sketch-pro' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_search_options',
			'type'              => 'text',
		)
	);

	// Comment Option.
	$wp_customize->add_section( 'catch_sketch_comment_option', array(
		'description'   => esc_html__( 'Comments can also be disabled on a per post/page basis when creating/editing posts/pages.', 'catch-sketch-pro' ),
		'panel'         => 'catch_sketch_theme_options',
		'title'         => esc_html__( 'Comment Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_comment_option',
			'default'           => 'use-wordpress-setting',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_comment_options(),
			'label'             => esc_html__( 'Comment Option', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_comment_option',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_website_field',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Display Website Field', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_comment_option',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'catch_sketch_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'catch-sketch-pro' ),
		'panel'       => 'catch_sketch_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_homepage_posts',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Display Recent Posts/Content on homepage', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_homepage_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Blog', 'catch-sketch-pro' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_homepage_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_recent_posts_subheading',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Recent Posts Sub Heading', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_homepage_options',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_front_page_category',
			'sanitize_callback' => 'catch_sketch_sanitize_category_list',
			'custom_control'    => 'Catch_Sketch_Multi_Cat',
			'active_callback'   => 'catch_sketch_is_homepage_posts_enabled',
			'label'             => esc_html__( 'Categories', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Disable Recent post in static frontpage
    catch_sketch_register_option( $wp_customize, array(
		'name'              => 'catch_sketch_enable_static_page_posts',
		'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
		'label'             => esc_html__( 'Enable Recent Posts on Static Page', 'catch-sketch-pro' ),
		'section'           => 'catch_sketch_homepage_options',
		'custom_control'    => 'Catch_Sketch_Toggle_Control',
    ) );

	$wp_customize->add_section( 'catch_sketch_menu_options', array(
		'panel'       => 'catch_sketch_theme_options',
		'title'       => esc_html__( 'Menu Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_menu_style',
			'default'           => 'modern',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => array(
				'classic' => esc_html__( 'Classic', 'catch-sketch-pro' ),
				'modern'  => esc_html__( 'Modern', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Menu Style', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_menu_options',
			'type'              => 'radio',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_transparent_header',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Transparent Header', 'catch-sketch-pro' ),
			'description'       => esc_html__( 'Make header transparent when Header Media/Featured slider is enabled', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_menu_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_menu_alignment',
			'default'           => 'right',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'active_callback'   => 'catch_sketch_is_classic_menu_active',
			'choices'           => array(
				'left' 	 => esc_html__( 'Left', 'catch-sketch-pro' ),
				'center' => esc_html__( 'Center', 'catch-sketch-pro' ),
				'right'  => esc_html__( 'Right', 'catch-sketch-pro' ),
			),
			'label'             => esc_html__( 'Primary Menu Position', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_menu_options',
			'type'              => 'select',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_primary_search',
			'default'           => 1,
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Search On Primary Menu', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_menu_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_primary_cart',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'label'             => esc_html__( 'Cart On Primary Menu', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_menu_options',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	// Pagination Options.
	$wp_customize->add_section( 'catch_sketch_pagination_options', array(
		'panel'       => 'catch_sketch_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'catch_sketch_sanitize_select',
			'choices'           => catch_sketch_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_pagination_options',
			'type'              => 'select',
		)
	);

	// For WooCommerce layout: catch_sketch_woocommerce_layout, check woocommerce-options.php.
	/* Scrollup Options */
	$wp_customize->add_section( 'catch_sketch_scrollup', array(
		'panel'    => 'catch_sketch_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'catch-sketch-pro' ),
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_display_scrollup',
			'sanitize_callback' => 'catch_sketch_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Display Scroll Up', 'catch-sketch-pro' ),
			'section'           => 'catch_sketch_scrollup',
			'custom_control'    => 'Catch_Sketch_Toggle_Control',
		)
	);

	// Sections Sorter.
	$wp_customize->add_section( 'catch_sketch_sections_sort', array(
		'title'       => esc_html__( 'Sections Sorter', 'catch-sketch-pro' ),
		'description' => esc_html__( 'Drag and drop to sort your sections', 'catch-sketch-pro' ),
		'panel'       => 'catch_sketch_theme_options',
	) );

	catch_sketch_register_option( $wp_customize, array(
			'name'              => 'catch_sketch_sections_sort',
			'default'           => catch_sketch_get_default_sections_value(),
			'label'             => esc_html__( 'Sortable Sections', 'catch-sketch-pro' ),
			'custom_control'    => 'Catch_Sketch_Sortable_Custom_Control',
			'sanitize_callback' => 'sanitize_text_field',
			'section'           => 'catch_sketch_sections_sort',
			'type'              => 'custom-sortable',
		)
	);
}
add_action( 'customize_register', 'catch_sketch_theme_options' );


/**
 * Returns an array of avaliable fonts registered for Foodie World
 *
 * * @since 1.0
 */
function catch_sketch_avaliable_fonts() {
	$avaliable_fonts = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'amatic-sc' => array(
			'value' => 'amatic-sc',
			'label' => '"Amatic SC", cursive',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'arizonia' => array(
			'value' => 'arizonia',
			'label' => '"Arizonia", cursive',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'cousine' => array(
			'value' => 'cousine',
			'label' => '"Cousine", monospace',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),
		'ebgaramond' => array(
			'value' => 'ebgaramond',
			'label' => 'EB Garamond, serif',
		),
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'great-vibes' => array(
			'value' => 'great-vibes',
			'label' => '"Great Vibes", cursive',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'lucida-sans-unicode' => array(
			'value' => 'lucida-sans-unicode',
			'label' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		),
		'lucida-grande' => array(
			'value' => 'lucida-grande',
			'label' => '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'merriweather' => array(
			'value' => 'merriweather',
			'label' => '"Merriweather", serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'poppins' => array(
			'value' => 'poppins',
			'label' => '"Poppins", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'rubik' => array(
			'value' => 'rubik',
			'label' => '"Rubik", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'catch_sketch_avaliable_fonts', $avaliable_fonts );
}


/**
 * Returns an array of font family options
 *
 * * @since 1.0
 */
function catch_sketch_font_family_options() {
	$options = array(
		'catch_sketch_body_font'         => array(
			'label'    => esc_html__( 'Default', 'catch-sketch-pro' ),
			'default'  => 'rubik',
			'selector' => 'body, button, input, .entry-container .subtitle, select, optgroup, textarea, .testimonial-slider-wrap .more-link, .more-link cite, .author-title, .widget a,.edit-link, button,.catch-breadcrumb .entry-breadcrumbs, .woocommerce-breadcrumb,
			input[type="button"], input[type="reset"], input[type="submit"], input[type="search"], .site-main #infinite-handle span button, .button, .entry-meta a, .sticky-label, .comment-metadata a, .post-navigation .nav-subtitle, .nav-title, .posts-navigation a, .pagination a, .widget_categories ul li a, .widget_archive ul li a, .ew-archive ul li a, .ew-category ul li a, .comment-form label, .author-link, .entry-breadcrumbs a, .breadcrumb-current, .entry-breadcrumbs .sep, .stats-section .entry-content, .stats-section .entry-summary, #team-content-section .position, .pagination .nav-links > span, .testimonials-content-wrapper .entry-container:before, .testimonials-content-wrapper .position,
			#footer-newsletter .ewnewsletter .ew-newsletter-wrap .ew-newsletter-subbox, .contact-wrap > span, .pricing-section .package-price, .reservation-highlight-text span, .reserve-content-wrapper .contact-description strong, .info,#gallery-content-section .gallery-item figcaption,.section-description,.section-subtitle, .hero-content-wrapper .entry-title span, .promotion-sale-wrapper .entry-title span,.contact-section .entry-title span, #skill-section .entry-title span, .reserve-content-wrapper .entry-title span,.testimonials-content-wrapper .testimonial-slider-wrap .post-thumbnail .entry-header  .entry-title,	blockquote:not(.alignleft):not(.alignright):before,.testimonial-slider-wrap .post-thumbnail .entry-header,
			.testimonials-content-wrapper .testimonial-slider-wrap button,.testimonial-slider-wrap .post-thumbnail .entry-header,code,kbd,tt,var,.entry-title .sub-title,.entry-title .sub-title,.entry-title span,.section-title-wrapper + .section-description,.section-title + .section-description,.section-title-wrapper + .section-subtitle',
		),
		'catch_sketch_site_title_font'        => array(
			'label'    => esc_html__( 'Site Title', 'catch-sketch-pro' ),
			'default'  => 'roboto',
			'selector' => '.site-title',
		),
		'catch_sketch_site_tagline_font'      => array(
			'label'    => esc_html__( 'Site Tagline', 'catch-sketch-pro' ),
			'default'  => 'ebgaramond',
			'selector' => '.site-description',
		),
		'catch_sketch_menu_font'      => array(
			'label'    => esc_html__( 'Menu', 'catch-sketch-pro' ),
			'default'  => 'rubik',
			'selector' => '.main-navigation a',
		),
		'catch_sketch_title_font' => array(
			'label'    => esc_html__( 'Section Title', 'catch-sketch-pro' ),
			'default'  => 'ebgaramond',
			'selector' => '.section-title, .entry-title, .widget-title, .woocommerce-loop-product__title,
			.archive-content-wrap .entry-title a,.testimonials-content-wrapper .entry-content,.testimonials-content-wrapper .cycle-prev:before,.testimonials-content-wrapper .cycle-next:before,.site-main nav.posts-navigation .nav-links > div .nav-title,.site-main nav.post-navigation .nav-links > div a .nav-title,
			.testimonials-content-wrapper .cycle-pager',
		),
		'catch_sketch_headings_font'     => array(
			'label' => esc_html__( 'Headings Tags from h1 to h6', 'catch-sketch-pro' ),
			'default' => 'ebgaramond',
			'selector' => 'h1, h2, h3, h4, h5, h6',
		),
	);

	return apply_filters( 'catch_sketch_font_family_options', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'catch_sketch_is_homepage_posts_enabled' ) ) :
	/**
	* Return true if hommepage posts/content is enabled
	*
	* * @since 1.0
	*/
	function catch_sketch_is_homepage_posts_enabled( $control ) {
		return ( $control->manager->get_setting( 'catch_sketch_display_homepage_posts' )->value() );
	}
endif;

if ( ! function_exists( 'catch_sketch_is_classic_menu_active' ) ) :
	/**
	* Return true if page content is active
	*
	* * @since 1.0
	*/
	function catch_sketch_is_classic_menu_active( $control ) {
		$menu_type = $control->manager->get_setting( 'catch_sketch_menu_style' )->value();

		//return true only if previewed page on customizer matches the type of content option selected and is or is not selected type
		return ( 'classic' === $menu_type );
	}
endif;
