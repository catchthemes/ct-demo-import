<?php
/**
 * Catch Sketch Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Catch_Sketch
 */

/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
function catch_sketch_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};

		settings.features = settings.features || mejs.MepDefaults.features;

		settings.features.push( 'catch_sketch_class' );

		MediaElementPlayer.prototype.buildcatch_sketch_class = function(player, controls, layers, media) {
			if ( ! player.isVideo ) {
				var container = player.container[0] || player.container;

				container.style.height = '';
				container.style.width = '';
				player.options.setDimensions = false;
			}

			if ( jQuery( '#' + player.id ).parents('#sticky-playlist-section').length ) {
				player.container.addClass( 'catch_sketch-mejs-container catch_sketch-mejs-sticky-playlist-container' );

				jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').addClass('displaynone');

				var volume_slider = controls[0].children[5];

				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var playlist_button =
					jQuery('<div class="mejs-button mejs-playlist-button mejs-toggle-playlist">' +
						'<button type="button" aria-controls="mep_0" title="Toggle Playlist"></button>' +
					'</div>')

					// append it to the toolbar
					.appendTo( jQuery( '#' + player.id ) )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').slideToggle();
						jQuery( this ).toggleClass('is-open')
					});

					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-button mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="Next Track"></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-button mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="Previous Track"></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			} else {
				player.container.addClass( 'catch_sketch-mejs-container' );
				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-button mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="Next Track"></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-button mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="Previous Track"></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			}
		}
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'catch_sketch_mejs_add_container_class' );

if ( ! function_exists( 'catch_sketch_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function catch_sketch_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Catch Sketch Pro, use a find and replace
		 * to change 'catch-sketch-pro' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'catch-sketch-pro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in Recent Posts, Featured Content
		set_post_thumbnail_size( 596, 447, true ); // Ratio 4:3

		// Used in Slider
		add_image_size( 'catch-sketch-slider', 950, 950, true ); // Image Ratio 1:1

		// Used in Promotion
		add_image_size( 'catch-sketch-promotion', 1980, 711, true ); // Custom Ratio

		// Used in Custom Header for single and archive pages
		add_image_size( 'catch-sketch-header-inner', 1920, 480, true );

		//Used in Hero Content
		add_image_size( 'catch-sketch-hero-content', 440, 587, true ); // Image Ratio 3:4

		// Used in Testimonial Section
		add_image_size( 'catch-sketch-testimonial', 71, 71, true ); // Image Ratio 1:1

		// Used in App Section
		add_image_size( 'catch-sketch-app', 680, 680, true ); // Image Ratio 1:1

		// Used in Playlist Section
		add_image_size( 'catch-sketch-playlist', 780, 580, true ); // Image Ratio 4:3

		// Used in Team and Shop Sections.
		add_image_size( 'catch-sketch-team', 356, 356, true ); //  Image Ratio 1:1

		// Used in Logo Sections.
		add_image_size( 'catch-sketch-logo-slider', 216, 108, true ); //  Image Ratio 16:8

		// Used in Blog.
		add_image_size( 'catch-sketch-blog', 940, 528, true ); //  Image Ratio 16:9

		// Used in Stats Section and Services Section
		add_image_size( 'catch-sketch-stats', 85, 85, true ); // Image Ratio 1:1

		// Used in Portfolio Section
		add_image_size( 'catch-sketch-portfolio', 640, 999, true ); // Flexible by Height

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'         => esc_html__( 'Primary', 'catch-sketch-pro' ),
			'social-top'     => esc_html__( 'Social on Header Top', 'catch-sketch-pro' ),
			'social'         => esc_html__( 'Social on Header', 'catch-sketch-pro' ),
			'social-footer'  => esc_html__( 'Social On Footer', 'catch-sketch-pro' ),
			'social-contact' => esc_html__( 'Social on Contact Info', 'catch-sketch-pro' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for Block Styles.
		//add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'catch-sketch-pro' ),
					'shortName' => esc_html__( 'S', 'catch-sketch-pro' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'catch-sketch-pro' ),
					'shortName' => esc_html__( 'M', 'catch-sketch-pro' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'catch-sketch-pro' ),
					'shortName' => esc_html__( 'L', 'catch-sketch-pro' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'catch-sketch-pro' ),
					'shortName' => esc_html__( 'XL', 'catch-sketch-pro' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'catch-sketch-pro' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'catch-sketch-pro' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Medium Black', 'catch-sketch-pro' ),
				'slug'  => 'medium-black',
				'color' => '#333333',
			),
			array(
				'name'  => esc_html__( 'Gray', 'catch-sketch-pro' ),
				'slug'  => 'gray',
				'color' => '#999999',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'catch-sketch-pro' ),
				'slug'  => 'light-gray',
				'color' => '#f6f6f6',
			),
			array(
				'name'  => esc_html__( 'Yellow', 'catch-sketch-pro' ),
				'slug'  => 'yellow',
				'color' => '#e87785',
			),
		) );

		add_editor_style( array( 'assets/css/editor-style.css', catch_sketch_fonts_url() ) );

		// Support Alternate image for services, testimonials when using Essential Content Types Pro.
		if ( class_exists( 'Essential_Content_Types_Pro' ) ) {
			add_theme_support( 'ect-alt-featured-image-jetpack-testimonial' );
		}

		/**
		 * Add Support for Sticky Menu.
		 */
		add_theme_support( 'catch-sticky-menu', apply_filters( 'catch_sketch_sticky_menu_args', array(
			'sticky_desktop_menu_selector' => '#masthead',
			'sticky_mobile_menu_selector'  => '#masthead',
			'sticky_background_color'      => '#ffffff',
			'sticky_text_color'            => '#000000',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'catch_sketch_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function catch_sketch_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'catch_sketch_content_width', 1040 );
}
add_action( 'after_setup_theme', 'catch_sketch_content_width', 0 );

if ( ! function_exists( 'catch_sketch_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function catch_sketch_template_redirect() {
		$layout = catch_sketch_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1520;
		}
	}
endif;
add_action( 'template_redirect', 'catch_sketch_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function catch_sketch_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'catch-sketch-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'catch-sketch-pro' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'catch-sketch-pro' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'catch-sketch-pro' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'catch-sketch-pro' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		//Optional Primary Sidebar for Shop
		register_sidebar( array(
			'name' 				=> esc_html__( 'WooCommerce Sidebar', 'catch-sketch-pro' ),
			'id' 				=> 'sidebar-6',
			'description'		=> esc_html__( 'This is Optional Sidebar for WooCommerce Pages', 'catch-sketch-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	// Registering 404 Error Page Content
	register_sidebar( array(
		'name'					=> esc_html__( '404 Page Not Found Content', 'catch-sketch-pro' ),
		'id' 					=> 'sidebar-notfound',
		'description'			=> esc_html__( 'Replaces the default 404 Page Not Found Content', 'catch-sketch-pro' ),
		'before_widget'			=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'			=> '</div></section>',
		'before_title'			=> '<h2 class="widget-title">',
		'after_title'			=> '</h2>',
	) );

	//Optional Sidebar for Hompeage instead of main sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Homepage Sidebar', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-homepage',
		'description'		=> esc_html__( 'This is Optional Sidebar for Homepage', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar for Archive instead of main sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Archive Sidebar', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-archive',
		'description'		=> esc_html__( 'This is Optional Sidebar for Archive', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar for Page instead of main sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Page Sidebar', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-page',
		'description'		=> esc_html__( 'This is Optional Sidebar for Page', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar for Post instead of main sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Post Sidebar', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-post',
		'description'		=> esc_html__( 'This is Optional Sidebar for Post', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar one for page and post
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Sidebar One', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-one',
		'description'		=> esc_html__( 'This is Optional Sidebar One', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar two for page and post
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Sidebar Two', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-two',
		'description'		=> esc_html__( 'This is Optional Sidebar Two', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar Three for page and post
	register_sidebar( array(
		'name' 				=> esc_html__( 'Optional Sidebar Three', 'catch-sketch-pro' ),
		'id' 				=> 'sidebar-optional-three',
		'description'		=> esc_html__( 'This is Optional Sidebar Three', 'catch-sketch-pro' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  	=> '</div></section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>'
	) );

	//Optional Sidebar Five Footer Instagram
	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Instagram', 'catch-sketch-pro' ),
			'id'            => 'sidebar-instagram',
			'description'   => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'catch-sketch-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<div class="section-title-wrapper"><h2 class="section-title">',
			'after_title'   => '</h2></div>',
		) );
	}

	//Optional Sidebar Six Footer Newsletter
	register_sidebar( array(
		'name'          => esc_html__( 'Newsletter', 'catch-sketch-pro' ),
		'id'            => 'sidebar-newsletter',
		'description'   => esc_html__( 'This is for Newsletter Template Widget Area.', 'catch-sketch-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<div class="section-title-wrapper"><h2 class="section-title">',
		'after_title'   => '</h2></div>'
	) );
}
add_action( 'widgets_init', 'catch_sketch_widgets_init' );

if ( ! function_exists( 'catch_sketch_fonts_url' ) ) :
	/**
	 * Register Google fonts for Verity Pro.
	 *
	 * Create your own catch_sketch_fonts_url() function to override in a child theme.
	 *
	 * * @since 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function catch_sketch_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		$font_values   = array();
		$font_values[] = get_theme_mod( 'catch_sketch_body_font', 'rubik' );
		$font_values[] = get_theme_mod( 'catch_sketch_site_title_font', 'roboto' );
		$font_values[] = get_theme_mod( 'catch_sketch_site_tagline_font', 'ebgaramond' );
		$font_values[] = get_theme_mod( 'catch_sketch_menu_font', 'rubik' );
		$font_values[] = get_theme_mod( 'catch_sketch_title_font', 'ebgaramond' );
		$font_values[] = get_theme_mod( 'catch_sketch_headings_font', 'ebgaramond' );

		$web_fonts = array(
			'allan'             => 'Allan',
			'allerta'           => 'Allerta',
			'amaranth'          => 'Amaranth',
			'amatic-sc'         => 'Amatic SC',
			'arizonia'          => 'Arizonia',
			'bitter'            => 'Bitter',
			'cabin'             => 'Cabin',
			'cantarell'         => 'Cantarell',
			'cousine'			=> 'Cousine',
			'crimson-text'      => 'Crimson+Text',
			'cuprum'            => 'Cuprum',
			'dancing-script'    => 'Dancing Script',
			'droid-sans'        => 'Droid Sans',
			'droid-serif'       => 'Droid Serif',
			'exo'               => 'Exo',
			'exo-2'             => 'Exo 2',
			'ebgaramond'        => 'EB Garamond',
			'great-vibes'       => 'Great Vibes',
			'istok-web'         => 'Istok Web',
			'josefin-sans'      => 'Josefin Sans',
			'lato'              => 'Lato',
			'lobster'           => 'Lobster',
			'lora'              => 'Lora',
			'montserrat'        => 'Montserrat',
			'merriweather'      => 'Merriweather',
			'nobile'            => 'Nobile',
			'noto-serif'        => 'Noto Serif',
			'neuton'            => 'Neuton',
			'open-sans'         => 'Open Sans',
			'oswald'            => 'Oswald',
			'patua-one'         => 'Patua One',
			'playfair-display'  => 'Playfair Display',
			'poppins'			=> 'Poppins',
			'pt-sans'           => 'PT Sans',
			'pt-serif'          => 'PT Serif',
			'rubik'             => 'Rubik',
			'quattrocento-sans' => 'Quattrocento Sans',
			'roboto'            => 'Roboto',
			'roboto-slab'       => 'Roboto Slab',
			'source-sans-pro'   => 'Source Sans Pro',
			'ubuntu'            => 'Ubuntu',
			'varela'            => 'Varela',
			'yanone-kaffeesatz' => 'Yanone Kaffeesatz',
		);

		$font_values = array_unique( $font_values ); // Make the array of fonts unique so that same font is not loaded twice.

		$font_values = array_intersect( $font_values, array_keys( $web_fonts ) ); // Intersect selected fonts and webfonts to only recover fonts that need loading.

		foreach ( $font_values as $font_value ) {
			$fonts[] = $web_fonts[ $font_value ] . ':300,400,500,700,900';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return esc_url( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 */
function catch_sketch_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'catch-sketch-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'catch_sketch_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function catch_sketch_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

	wp_enqueue_style( 'catch-sketch-fonts', catch_sketch_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/font-awesome/css/font-awesome' . $min . '.css', array(), '4.7.0', 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'catch-sketch-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'catch-sketch-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'catch-sketch-style' ), '1.0' );

	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.matchHeight' . $min . '.js', array( 'jquery' ), '20171226', true );

	$deps[] = 'jquery';
	$deps[] = 'jquery-match-height';

	$enable_portfolio = get_theme_mod( 'catch_sketch_portfolio_option', 'disabled' ); 

	$grid_style = get_theme_mod( 'catch_sketch_blog_style' ); 

	if ( catch_sketch_check_section( $enable_portfolio ) || $grid_style ) {
		$deps[] = 'jquery-masonry';
	}

	wp_enqueue_script( 'catch-sketch-custom-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'custom-scripts' . $min . '.js', $deps, '20171226', true );

	wp_localize_script( 'catch-sketch-custom-script', 'catchSketchScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'catch-sketch-pro' ),
		'collapse' => esc_html__( 'collapse child menu', 'catch-sketch-pro' ),
	) );

	wp_enqueue_script( 'catch-sketch-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'navigation' . $min . '.js', array(), '20171226', true );

	wp_enqueue_script( 'catch-sketch-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'skip-link-focus-fix' . $min . '.js', array(), '20171226', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$enable_video   = catch_sketch_check_section( get_theme_mod( 'catch_sketch_featured_video_option', 'disabled' ) );
	$video_lightbox = get_theme_mod( 'catch_sketch_featured_video_show_lightbox', 'enabled' );

	$promotion_video = get_theme_mod( 'catch_sketch_featured_video_link' );

	if ( ( $enable_video && 'enabled' === $video_lightbox ) || $promotion_video ) {
		//Flashy for video section
		wp_enqueue_style( 'catch_sketch-flashy', get_theme_file_uri( 'assets/css/flashy.min.css' ) );

		wp_enqueue_script( 'catch_sketch-jquery-flashy', get_theme_file_uri( $path . 'jquery.flashy' . $min . '.js' ), array( 'jquery' ), '201800703', true );

		$deps[] = 'catch_sketch-jquery-flashy';
	}

	if ( $enable_video ) {
		// Enqueue fitvid
		wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'fitvids' . $min . '.js', array( 'jquery' ), '1.1', true );

		wp_enqueue_script( 'jquery-simplebar', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'simplebar' . $min . '.js', array( 'jquery' ), '4.0.0-alpha.5', true );

		wp_enqueue_style( 'jquery-simplebar', get_theme_file_uri( 'assets/css/simplebar.css' ), null );
	}

	//Slider Scripts
	$enable_slider       = catch_sketch_check_section( get_theme_mod( 'catch_sketch_slider_option', 'disabled' ) );
	$enable_testimonial  = catch_sketch_check_section( get_theme_mod( 'catch_sketch_testimonial_option', 'disabled' ) );
	$enable_logo         = catch_sketch_check_section( get_theme_mod( 'catch_sketch_logo_slider_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial || $enable_logo ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			get_theme_mod( 'catch_sketch_slider_transition_effect', 'fade' ),
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition.
		if ( in_array( 'scrollVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-scrollVert', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2.scrollVert' . $min . '.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Flip transition plugin addition.
		if ( in_array( 'flipHorz', $transition_effects, true ) || in_array( 'flipVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-flip', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2.flip' . $min . '.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'tileSlide', $transition_effects, true ) || in_array( 'tileBlind', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-tile', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2.tile' . $min . '.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'shuffle', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-shuffle', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2.shuffle' . $min . '.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Carousel transition plugin addition.
		if ( catch_sketch_check_section( $enable_logo ) ) {
			wp_enqueue_script( 'jquery-cycle2-carousel', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.cycle/jquery.cycle2.carousel' . $min . '.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}
	}

	// Remove Media CSS, we have ouw own CSS for this.
	wp_deregister_style('wp-mediaelement');
}
add_action( 'wp_enqueue_scripts', 'catch_sketch_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function catch_sketch_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'catch-sketch-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'catch-sketch-fonts', catch_sketch_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'catch_sketch_block_editor_styles' );

if ( ! function_exists( 'catch_sketch_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * * @since 1.0
	 */
	function catch_sketch_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'catch_sketch_excerpt_length', 10 );
		return absint( $length );
	}
endif; //catch_sketch_excerpt_length
add_filter( 'excerpt_length', 'catch_sketch_excerpt_length', 999 );

if ( ! function_exists( 'catch_sketch_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer.
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function catch_sketch_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text	= get_theme_mod( 'catch_sketch_excerpt_more_text',  esc_html__( 'Continue reading', 'catch-sketch-pro' ) );

		$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'catch_sketch_excerpt_more' );


if ( ! function_exists( 'catch_sketch_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'catch_sketch_excerpt_more_text', esc_html__( 'Continue reading', 'catch-sketch-pro' ) );

			$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$link = ' &hellip; ' . $link;

			$output .= $link;
		}

		return $output;
	}
endif; //catch_sketch_custom_excerpt
add_filter( 'get_the_excerpt', 'catch_sketch_custom_excerpt' );


if ( ! function_exists( 'catch_sketch_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'catch_sketch_excerpt_more_text', esc_html__( 'Continue reading', 'catch-sketch-pro' ) );

		return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //catch_sketch_more_link
add_filter( 'the_content_more_link', 'catch_sketch_more_link', 10, 2 );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * * @since 1.0
 */
function catch_sketch_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // WPCS: XSS OK.
	}
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function catch_sketch_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'catch-sketch-pro',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'catch_sketch_register_required_plugins' );

/**
 * Checks if there are options already present in free version and adds it to the Pro version
 *
 * * @since 1.0
 * @hook after_theme_switch
 */
function catch_sketch_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );

		$free_version_slug = 'catch-sketch';
		$pro_version_slug  = 'catch-sketch-pro';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if options of free version exists and theme is being switched from free version
		if ( $free_version_slug === $old_theme_slug && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'catch_sketch_setup_options', 100 );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/color-scheme.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Add theme admin page.
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'inc/about.php' );
}

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Featured Slider
 */
require get_parent_theme_file_path( '/inc/featured-slider.php' );

/**
 * Metabox Options
 */
require get_parent_theme_file_path( '/inc/metabox/metabox.php' );

/**
 * WooCommerce Support
 */
require get_parent_theme_file_path( '/inc/woocommerce.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widget
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * EDD Update support
 */
require get_parent_theme_file_path( '/inc/updater/theme-updater.php' );

/**
 * Include Events
 */
require get_parent_theme_file_path( '/inc/events.php' );
