<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Catch_Sketch
 */

if ( ! function_exists( 'catch_sketch_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function catch_sketch_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( 'classic' == get_theme_mod( 'catch_sketch_menu_style', 'modern' ) ) {
			$classes[] = 'navigation-classic';
		} else {
			$classes[] = 'navigation-default';
		}

		// Adds a class of (full-width|box) to blogs.
		if ( 'boxed' === get_theme_mod( 'catch_sketch_layout_type', 'fluid' ) ) {
			$classes[] = 'boxed-layout';
		} else {
			$classes[] = 'fluid-layout';
		}

		// Adds a class with respect to layout selected.
		$layout  = catch_sketch_get_theme_layout();
		$sidebar = catch_sketch_get_sidebar_id();

		if ( 'no-sidebar' === $layout ) {
			$classes[] = 'no-sidebar content-width-layout';
		}
		elseif ( 'no-sidebar-full-width' === $layout ) {
			$classes[] = 'no-sidebar full-width-layout';
		} elseif ( 'left-sidebar' === $layout ) {
			if ( '' !== $sidebar ) {
				$classes[] = 'two-columns-layout content-right';
			}
		} elseif ( 'right-sidebar' === $layout ) {
			if ( '' !== $sidebar ) {
				$classes[] = 'two-columns-layout content-left';
			}
		}

		$header_image = catch_sketch_featured_overall_image();

		if ( '' == $header_image ) {
			$classes[] = 'no-header-media-image';
		}

		$header_text_enabled = catch_sketch_has_header_media_text();

		if ( ! $header_text_enabled ) {
			$classes[] = 'no-header-media-text';
		}

		$enable_slider = catch_sketch_check_section( get_theme_mod( 'catch_sketch_slider_option', 'disabled' ) );

		if ( ! $enable_slider ) {
			$classes[] = 'no-featured-slider';
		}

		if ( '' == $header_image && ! $header_text_enabled && ! $enable_slider ) {
			$classes[] = 'content-has-padding-top';
		}

		// Add Color Scheme to Body Class.
		$classes[] = esc_attr( 'color-scheme-' . get_theme_mod( 'color_scheme', 'default' ) );

		// Add Primary menu alignment to Body Class.
		$classes[] = esc_attr( 'primary-menu-' . get_theme_mod( 'catch_sketch_menu_alignment', 'right' ) );

		// Check Border top for articles.
		$blog_border_top = get_theme_mod( 'catch_sketch_blog_article_border' );
		
		if ( $blog_border_top ) {
			$classes[] = 'posts-border';
		}

		$enable_sticky_playlsit = get_theme_mod( 'catch_sketch_sticky_playlist_visibility', 'disabled' );

		if ( catch_sketch_check_section( $enable_sticky_playlsit ) ) {
			$classes[] = 'sticky-playlist-enabled';
		}

		$transparent_header = get_theme_mod( 'catch_sketch_transparent_header' );
		if ( $transparent_header && ( $enable_slider || $header_image || $header_text_enabled ) ) {
			$classes[] = 'absolute-header';
		}
		
		return $classes;
	}
endif; // catch_sketch_body_classes.
add_filter( 'body_class', 'catch_sketch_body_classes' );

if ( ! function_exists( 'catch_sketch_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function catch_sketch_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
endif; // catch_sketch_body_classes.
add_action( 'wp_head', 'catch_sketch_pingback_header' );

if ( ! function_exists( 'catch_sketch_comments' ) ) :
	/**
	 * Enable/Disable Comments
	 *
	 * @uses comment_form_default_fields filter
	 * * @since 1.0
	 */
	function catch_sketch_comments( $open, $post_id ) {
		$comment_select = get_theme_mod( 'catch_sketch_comment_option', 'use-wordpress-setting' );

		if( 'disable-completely' === $comment_select ) {
			return false;
		} elseif( 'disable-in-pages' === $comment_select && is_page() ) {
			return false;
		}

		return $open;
	}
endif; // catch_sketch_comments.
add_filter( 'comments_open', 'catch_sketch_comments', 10, 2 );

if ( ! function_exists( 'catch_sketch_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * * @since 1.0
	 */
	function catch_sketch_comment_form_fields( $fields ) {
		$disable_website = get_theme_mod( 'catch_sketch_website_field', 1 );

		if ( isset( $fields['url'] ) && ! $disable_website ) {
			unset( $fields['url'] );
		}

		return $fields;
	}
endif; // catch_sketch_comment_form_fields.
add_filter( 'comment_form_default_fields', 'catch_sketch_comment_form_fields' );

if ( ! function_exists( 'catch_sketch_get_font_family_css' ) ) :
	/**
	 * Adds font family custom CSS
	 */
	function catch_sketch_get_font_family_css() {
		$font_family_options = catch_sketch_font_family_options();

		$fonts = catch_sketch_avaliable_fonts();

		$css = array();

		foreach ( $font_family_options as $key => $value ) {
			$option = get_theme_mod( $key );
			if ( $option ) {
				$css[] = $value['selector'] . ' { font-family: ' . $fonts [ $option ]['label'] . '; }';
			}
		}

		$css = implode( PHP_EOL, $css );

		wp_add_inline_style( 'catch-sketch-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_get_font_family_css', 11 );

if ( ! function_exists( 'catch_sketch_testimonial_bg_css' ) ) :
	/**
	 * Adds testimonials background CSS
	 */
	function catch_sketch_testimonial_bg_css() {
		$background = get_theme_mod( 'catch_sketch_testimonial_bg_image', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/testimonial-bg.png' );

		if ( $background ) {
			$css = '.testimonials-content-wrapper {
				background-image: url("' . esc_url( $background ) . '");
			}';

			wp_add_inline_style( 'catch-sketch-style', $css );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_testimonial_bg_css', 11 );

if ( ! function_exists( 'catch_sketch_events_bg_css' ) ) :
	/**
	 * Adds events background CSS
	 */
	function catch_sketch_events_bg_css() {
		$background = get_theme_mod( 'catch_sketch_events_bg_image' );


		if ( $background ) {
			$css = '.events-section {
				background-image: url("' . esc_url( $background ) . '");
			}';
			
			wp_add_inline_style( 'catch-sketch-style', $css );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_events_bg_css', 11 );

if ( ! function_exists( 'catch_sketch_playlist_bg_css' ) ) :
	/**
	 * Adds playlist background CSS
	 */
	function catch_sketch_playlist_bg_css() {
		$background = get_theme_mod( 'catch_sketch_playlist_bg_image' );


		if ( $background ) {
			$css = '.playlist-section {
				background-image: url("' . esc_url( $background ) . '");
			}';
			
			wp_add_inline_style( 'catch-sketch-style', $css );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_playlist_bg_css', 11 );

if ( ! function_exists( 'catch_sketch_featured_video_bg_css' ) ) :
	/**
	 * Adds featured_video background CSS
	 */
	function catch_sketch_featured_video_bg_css() {
		$background = get_theme_mod( 'catch_sketch_featured_video_bg_image' );


		if ( $background ) {
			$css = '.featured-video-section {
				background-image: url("' . esc_url( $background ) . '");
			}';
			
			wp_add_inline_style( 'catch-sketch-style', $css );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_featured_video_bg_css', 11 );

if ( ! function_exists( 'catch_sketch_header_image_overlay_css' ) ) :
	/**
	 * Adds header image overlay for each section
	 */
	function catch_sketch_header_image_overlay_css() {
		$css = '';

		$overlay = get_theme_mod( 'catch_sketch_header_media_opacity', 0 );

		$overlay_bg = $overlay / 100;

		if ( '' !== $overlay ) {
			$css = '.custom-header:after { background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . '); } '; // Dividing by 100 as the option is shown as % for user
		}

		wp_add_inline_style( 'catch-sketch-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'catch_sketch_header_image_overlay_css', 11 );

if ( ! function_exists( 'catch_sketch_alter_home' ) ) :
	/**
	 * Remove first post from blog as it is already show via recent post template
	 */
	function catch_sketch_alter_home( $query ) {
		if ( $query->is_home() && $query->is_main_query() ) {
			$cats = get_theme_mod( 'catch_sketch_front_page_category' );

			if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
				$query->query_vars['category__in'] = $cats;
			}

			if ( get_theme_mod( 'catch_sketch_exclude_slider_post' ) ) {
				$quantity = get_theme_mod( 'catch_sketch_slider_number', 4 );

				$post_list	= array();	// list of valid post ids

				for( $i = 1; $i <= $quantity; $i++ ){
					if ( get_theme_mod( 'catch_sketch_slider_post_' . $i ) && get_theme_mod( 'catch_sketch_slider_post_' . $i ) > 0 ) {
						$post_list = array_merge( $post_list, array( get_theme_mod( 'catch_sketch_slider_post_' . $i ) ) );
					}
				}

				if ( ! empty( $post_list ) ) {
					$query->query_vars['post__not_in'] = $post_list;
				}
			}
		}
	}
endif;
add_action( 'pre_get_posts', 'catch_sketch_alter_home' );

if ( ! function_exists( 'catch_sketch_scrollup' ) ) :
	/**
	 * Function to add Scroll Up icon
	 */
	function catch_sketch_scrollup() {
		$disable_scrollup = get_theme_mod( 'catch_sketch_display_scrollup', 1 );

		if ( ! $disable_scrollup ) {
			return;
		}

		echo '
			<div class="scrollup">
				<a href="#masthead" id="scrollup" class="fa fa-sort-asc" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'catch-sketch-pro' ) . '</span></a>
			</div>' ;
	}
endif;
add_action( 'wp_footer', 'catch_sketch_scrollup', 1 );

if ( ! function_exists( 'catch_sketch_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * * @since 1.0
	 */
	function catch_sketch_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'catch_sketch_pagination_type', 'default' );

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll' === $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		if ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'catch-sketch-pro' ),
				'next_text'          => esc_html__( 'Next', 'catch-sketch-pro' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'catch-sketch-pro' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // catch_sketch_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function catch_sketch_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = absint( $wp_query->get_queried_object_id() );

	// Front page displays in Reading Settings
	$page_for_posts = absint( get_option( 'page_for_posts' ) );

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * * @since 1.0
 */

function catch_sketch_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $postID ) , $matches );

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="' . $first_img . '">';
	}

	return false;
}

function catch_sketch_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/no-sidebar.php' ) ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/left-sidebar.php' ) ) {
		$layout = 'left-sidebar';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'catch_sketch_default_layout', 'right-sidebar' );

		if ( is_front_page() ) {
			$layout = get_theme_mod( 'catch_sketch_homepage_layout', 'right-sidebar' );
		} elseif ( is_home() || is_archive() || is_search() ) {
			$layout = get_theme_mod( 'catch_sketch_archive_layout', 'right-sidebar' );
		}

		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() ) ) {
			$layout = get_theme_mod( 'catch_sketch_woocommerce_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function catch_sketch_get_posts_columns() {
	$columns = get_theme_mod( 'catch_sketch_archive_columns', 'layout-one' );

	if ( is_front_page() ) {
		$columns = get_theme_mod( 'catch_sketch_homepage_columns', 'layout-one' );
	}

	return $columns;
}

function catch_sketch_get_sidebar_id() {
	$sidebar = '';

	$layout = catch_sketch_get_theme_layout();

	$sidebaroptions = '';

	if ( 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	// WooCommerce Shop Page excluding Cart and checkout.
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		$shop_id        = get_option( 'woocommerce_shop_page_id' );
		$sidebaroptions = get_post_meta( $shop_id, 'catch-sketch-sidebar-options', true );
	} else {
		global $post, $wp_query;

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop.
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings.
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
			$sidebaroptions = get_post_meta( $page_id, 'catch-sketch-sidebar-option', true );
		} elseif ( is_singular() ) {
			if ( is_attachment() ) {
				$parent 		= $post->post_parent;
				$sidebaroptions = get_post_meta( $parent, 'catch-sketch-sidebar-option', true );

			} else {
				$sidebaroptions = get_post_meta( $post->ID, 'catch-sketch-sidebar-option', true );
			}
		}
	}

	if ( is_active_sidebar( 'woocommerce-sidebar' ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
		$sidebar = 'woocommerce-sidebar'; // WooCommerce Sidebar.
	} elseif ( is_active_sidebar( 'sidebar-optional-one' ) && 'optional-sidebar-one' === $sidebaroptions ) {
		$sidebar = 'sidebar-optional-one';
	} elseif ( is_active_sidebar( 'sidebar-optional-two' ) && 'optional-sidebar-two' === $sidebaroptions ) {
		$sidebar = 'sidebar-optional-two';
	} elseif ( is_active_sidebar( 'sidebar-optional-three' ) && 'optional-sidebar-three' === $sidebaroptions ) {
		$sidebar = 'sidebar-optional-three';
	} elseif ( is_active_sidebar( 'sidebar-optional-homepage' ) && ( is_front_page() || ( is_home() && $page_id != $page_for_posts ) ) ) {
		$sidebar = 'sidebar-optional-homepage';
	} elseif ( is_active_sidebar( 'sidebar-optional-archive' ) && ( is_archive() || ( is_home() && $page_id != $page_for_posts ) ) ) {
		$sidebar = 'sidebar-optional-archive';
	} elseif ( is_page() && is_active_sidebar( 'sidebar-optional-page' ) ) {
		$sidebar = 'sidebar-optional-page';
	} elseif ( is_single() && is_active_sidebar( 'sidebar-optional-post' ) ) {
		$sidebar = 'sidebar-optional-post';
	} elseif ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

if ( ! function_exists( 'catch_sketch_get_no_thumb_image' ) ) :
	/**
	 * $image_size post thumbnail size
	 * $type image, src
	 */
	function catch_sketch_get_no_thumb_image( $image_size = 'post-thumbnail', $type = 'image' ) {
		$image = $image_url = '';

		global $_wp_additional_image_sizes;

		$size = $_wp_additional_image_sizes['post-thumbnail'];

		if ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {
			$size = $_wp_additional_image_sizes[ $image_size ];
		}

		$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb.jpg';

		if ( 'post-thumbnail' !== $image_size ) {
			$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-' . $size['width'] . 'x' . $size['height'] . '.jpg';
		}

		if ( 'src' === $type ) {
			return $image_url;
		}

		return '<img class="no-thumb ' . esc_attr( $image_size ) . '" src="' . esc_url( $image_url ) . '" />';
	}
endif;

/**
 * Featured content posts
 */
function catch_sketch_get_featured_posts() {
	$type = get_theme_mod( 'catch_sketch_featured_content_type', 'category' );

	$number = get_theme_mod( 'catch_sketch_featured_content_number', 3 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || 'featured-content' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_featured_content_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_featured_content_page_' . $i );
			} elseif ( 'featured-content' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_featured_content_cpt_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'catch_sketch_featured_content_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$featured_posts = get_posts( $args );

	return $featured_posts;
}

/**
 * Discography posts
 */
function catch_sketch_get_discography_posts() {
	$type = get_theme_mod( 'catch_sketch_discography_type', 'category' );

	$number = get_theme_mod( 'catch_sketch_discography_number', 6 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || 'featured-content' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_discography_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_discography_page_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'catch_sketch_discography_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$featured_posts = get_posts( $args );

	return $featured_posts;
}

/**
 * Services content posts
 */
function catch_sketch_get_services_posts() {
	$type = get_theme_mod( 'catch_sketch_service_type', 'category' );

	$number = get_theme_mod( 'catch_sketch_service_number', 6 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || 'ect-service' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_service_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_service_page_' . $i );
			} elseif ( 'ect-service' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_service_cpt_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'catch_sketch_service_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$services_posts = get_posts( $args );

	return $services_posts;
}

/**
 * Team posts
 */
function catch_sketch_get_team_posts() {
	$type = get_theme_mod( 'catch_sketch_team_type', 'category' );

	$number = get_theme_mod( 'catch_sketch_team_number', 4 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_team_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_team_page_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'catch_sketch_team_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$team_posts = get_posts( $args );

	return $team_posts;
}

/**
 * Stats posts
 */
function catch_sketch_get_stats_posts() {
	$type = get_theme_mod( 'catch_sketch_stats_type', 'category' );

	$number = get_theme_mod( 'catch_sketch_stats_number', 4 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_stats_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_sketch_stats_page_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type && $cat = get_theme_mod( 'catch_sketch_stats_select_category' ) ) {
		$args['category__in'] = $cat;
	}

	$stats_posts = get_posts( $args );

	return $stats_posts;
}

if ( ! function_exists( 'catch_sketch_enable_homepage_posts' ) ) :
	/**
	 * Determine Homepage Content disabled or not
	 * @return boolean
	 */
	function catch_sketch_enable_homepage_posts() {
		if ( ! is_front_page() ) {
			return true;
		}

		if ( get_theme_mod( 'catch_sketch_display_homepage_posts', 1 ) ) {
			return true;
		}

		return false;
	}
endif; // catch_sketch_enable_homepage_posts.

if ( ! function_exists( 'catch_sketch_sections' ) ) :
	/**
	 * Display Sections on header and footer with respect to the section option set in catch_sketch_sections_sort
	 */
	function catch_sketch_sections( $selector = 'header' ) {
		$sections = get_theme_mod( 'catch_sketch_sections_sort', catch_sketch_get_default_sections_value() );

		$separated_sections = explode( 'main-content,', $sections );

		$sections = $separated_sections[0];

		if ( 'footer' === $selector ) {
			$sections = $separated_sections[1];
		}

		$sections =  ! empty( $sections ) ? explode( ',', $sections ) : array();

		foreach ( $sections as $section ) {
			if ( 'slider' === $section ) {
				get_template_part( 'template-parts/slider/content', 'display' );
			} elseif ( 'header-media' === $section ) {
				get_template_part( 'template-parts/header/header', 'media' );
			} if ( 'featured-content' === $section ) {
				get_template_part( 'template-parts/featured-content/display', 'featured' );
			} if ( 'hero-content' === $section ) {
				get_template_part( 'template-parts/hero-content/content','hero' );
			} elseif ( 'services' === $section ) {
				get_template_part( 'template-parts/services/display', 'services' );
			} elseif ( 'stats' === $section ) {
				get_template_part( 'template-parts/stats/display','stats' );
			} elseif ( 'gallery' === $section ) {
				get_template_part( 'template-parts/gallery/content', 'gallery' );
			} elseif ( 'testimonial' === $section ) {
				get_template_part( 'template-parts/testimonials/display', 'testimonial' );
			} elseif ( 'promotion-headline' === $section  ) {
				get_template_part( 'template-parts/promotion-headline/content', 'promotion-headline' );
			} elseif ( 'woo-products' === $section  ) {
				get_template_part( 'template-parts/woo-products-showcase/display', 'products' );
			} elseif ( 'portfolio' === $section  ) {
				get_template_part( 'template-parts/portfolio/display', 'portfolio' );
			} elseif ( 'team' === $section  ) {
				get_template_part( 'template-parts/team/display', 'team' );
			} elseif ( 'recent-posts' === $section ) {
				if ( 'page' == get_option('show_on_front') && is_front_page() && get_theme_mod( 'catch_sketch_enable_static_page_posts' ) )  {
					get_template_part( 'template-parts/recent-posts/front-recent', 'posts' );
				}
			} elseif ( 'newsletter' === $section ) {
				get_template_part( 'template-parts/footer/footer', 'newsletter' );
			} elseif ( 'logo-slider' === $section ) {
				get_template_part( 'template-parts/logo-slider/display', 'logo-slider' );
			} elseif ( 'contact-form' === $section ) {
				get_template_part( 'template-parts/contact-form/display', 'contact-form' );
			} elseif ( 'contact-info' === $section ) {
				get_template_part( 'template-parts/contact-info/display', 'contact-info' );
			} elseif ( 'instagram' === $section ) {
				get_template_part( 'template-parts/footer/footer', 'instagram' );
			} elseif ( 'discography' === $section ) {
				get_template_part( 'template-parts/discography/display-discography' );
			} elseif ( 'events' === $section ) {
				get_template_part( 'template-parts/events/content-event' );
			} elseif ( 'featured-video' === $section ) {
				get_template_part( 'template-parts/featured-video/display-featured' );
			} elseif ( 'playlist' === $section ) {
				get_template_part( 'template-parts/playlist/content-playlist' );
			} elseif ( 'app-section' === $section ) {
				get_template_part( 'template-parts/app-section/display-app' );
			}
		}
	}
endif;

if ( ! function_exists( 'catch_sketch_get_sortable_sections' ) ) :
	/**
	 * Returns list of sortable sections
	 */
	function catch_sketch_get_sortable_sections() {
		$sortable_sections = array(
			'header-media'       => array(
				'label'   => esc_html__( 'Header Media', 'catch-sketch-pro' ),
				'section' => 'header_image',
			),
			'slider'             => array(
				'label'   => esc_html__( 'Slider', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_featured_slider',
			),
			'hero-content'       => array(
				'label'   => esc_html__( 'Hero Content', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_hero_content_options',
			),
			'promotion-headline' => array(
				'label'   => esc_html__( 'Promotion Headline', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_promotion_headline',
			),
			'services'           => array(
				'label'   => esc_html__( 'Services', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_service',
			),
			'stats'       => array(
				'label'   => esc_html__( 'Stats', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_stats',
			),
			'portfolio' => array(
				'label'   => esc_html__( 'Portfolio', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_portfolio',
			),
			'testimonial'        => array(
				'label'   => esc_html__( 'Testimonial', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_testimonials',
			),
			'gallery'     => array(
				'label'   => esc_html__( 'Gallery', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_gallery_options',
			),
			'team' => array(
				'label'   => esc_html__( 'Team', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_team',
			),
			'featured-content'   => array(
				'label'   => esc_html__( 'Featured Content', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_featured_content',
			),
			'woo-products' => array(
				'label'   => esc_html__( 'Woo Products', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_woo_products',
			),
			'main-content'       => array(
				'label' => esc_html__( 'Main Content', 'catch-sketch-pro' ),
			),
			'recent-posts'       => array(
				'label'   => esc_html__( 'Recent Posts ( Only on homepage )', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_homepage_options',
			),
			'newsletter'       => array(
				'label'   => esc_html__( 'Newsletter', 'catch-sketch-pro' ),
				'section' => 'sidebar-widgets-sidebar-newsletter',
			),
			'contact-info'       => array(
				'label'   => esc_html__( 'Contact Info', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_contact',
			),
			'contact-form'       => array(
				'label'   => esc_html__( 'Contact Form', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_contact_form',
			),
			'logo-slider'       => array(
				'label'   => esc_html__( 'Logo Slider', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_logo_slider',
			),
			'discography'       => array(
				'label'   => esc_html__( 'Discography', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_discography',
			),
			'events'       => array(
				'label'   => esc_html__( 'Events', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_events',
			),
			'playlist'       => array(
				'label'   => esc_html__( 'Playlist', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_playlist',
			),
			'featured-video'       => array(
				'label'   => esc_html__( 'Featured Video', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_featured_video',
			),
			'app-section'           => array(
				'label'   => esc_html__( 'App Section', 'catch-sketch-pro' ),
				'section' => 'catch_sketch_app_section',
				
			),
		);

		if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
			$sortable_sections = $sortable_sections + array(
				'instagram' => array(
					'label'   => esc_html__( 'Instagram', 'catch-sketch-pro' ),
					'section' => 'sidebar-widgets-sidebar-instagram'
				)
			);
		}

		return $sortable_sections;
	}
endif;

if ( ! function_exists( 'catch_sketch_team_social_links' ) ) :
	/**
	 * Displays team social links html
	 */
	function catch_sketch_team_social_links( $counter ) {
		?>
		<div class="team-social-profile">
			<nav class="social-navigation" role="navigation" aria-label="Social Menu">
				<div class="menu-social-container">
					<ul id="menu-social-menu" class="social-links-menu">
						<?php
						$social_link_one = get_theme_mod( 'catch_sketch_team_social_link_one_' . $counter );

						if ( $social_link_one ): ?>
							<li class="menu-item-one">
								<a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_one ); ?>"> <span class="screen-reader-text"><?php echo esc_html( $social_link_one ); ?></span></a>
							</li>
						<?php endif;  ?>

						<?php
						$social_link_two = get_theme_mod( 'catch_sketch_team_social_link_two_' . $counter );
						if ( $social_link_two ): ?>
							<li class="menu-item-two">
								<a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_two ); ?>"> <span class="screen-reader-text"><?php echo esc_html( $social_link_two ); ?></span></a>
							</li>
						<?php endif;  ?>

						<?php
						$social_link_three = get_theme_mod( 'catch_sketch_team_social_link_three_' . $counter );
						if ( $social_link_three ): ?>
							<li class="menu-item-three">
								<a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_three ); ?>"> <span class="screen-reader-text"><?php echo esc_html( $social_link_three ); ?></span></a>
							</li>
						<?php endif;  ?>

						<?php
						$social_link_four = get_theme_mod( 'catch_sketch_team_social_link_four_' . $counter );
						if ( $social_link_four ): ?>
							<li class="menu-item-four">
								<a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_four ); ?>"> <span class="screen-reader-text"><?php echo esc_html( $social_link_four ); ?></span></a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</nav>
		</div><!-- .artist-social-profile -->
		<?php
	}
endif;

function catch_sketch_team_social( $link ) {
	// Get supported social icons.
	$social_icons = catch_mag_social_links_icons();

	foreach ( $social_icons as $attr => $value ) {
		if ( false !== strpos( $link, $attr ) ) {
			return catch_mag_get_svg( array( 'icon' => esc_attr( $value ) ) );
		}
	}
}
