<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Catch_Sketch
 */

// For registration of custom-header, check customizer/color-scheme.php


if ( ! function_exists( 'catch_sketch_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see catch_sketch_custom_header_setup().
	 */
	function catch_sketch_header_style() {
		$header_textcolor = get_header_textcolor();

		$header_image = catch_sketch_featured_overall_image();

		if ( $header_image ) : ?>
			<style type="text/css" rel="header-image">
				.custom-header:before {
					background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
				}
			</style>
		<?php
		endif;

		// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		$header_text_color = get_header_textcolor();
		$color_scheme      = catch_sketch_get_color_scheme();
		$default_color     = trim( $color_scheme[1] , '#' );

		$header_eighty_textcolor = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.8)', catch_sketch_hex2rgb( $header_textcolor ) );

		if ( $default_color !== $header_text_color ) :
		?>
		<style type="text/css" id="catch-sketch-header-css">
		.site-title a {
			color: #<?php echo esc_attr( $header_textcolor ); ?>;
		}

		.site-description {
		 	color: <?php echo esc_attr( $header_eighty_textcolor ); ?>;
		}
		</style>
		<?php
			endif;
		} else {
			?>
			<style type="text/css" id="catch-sketch-header-css">
			.site-branding {
				margin: 0 auto 0 0;
			}

			.site-identity {
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
			</style>
		<?php
		}
	}
endif;

if ( ! function_exists( 'catch_sketch_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own catch_sketch_featured_image(), and that function will be used instead.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_featured_image() {
		$thumbnail = is_front_page() ? 'catch-sketch-slider' : 'catch-sketch-header-inner';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image[0];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) ) {
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image[0];
			} else {
				return get_header_image();
			}
		} elseif ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // catch_sketch_featured_image
endif;

if ( ! function_exists( 'catch_sketch_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own catch_sketch_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_featured_page_post_image() {
		$thumbnail = 'catch-sketch-header-inner';
		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			if ( ! has_post_thumbnail( absint( get_option( 'woocommerce_shop_page_id' ) ) ) ) {
				return catch_sketch_featured_image();
			}
		} elseif ( is_home() && $blog_id = get_option('page_for_posts') ) {
			if ( has_post_thumbnail( $blog_id  ) ) {
		    	return get_the_post_thumbnail_url( $blog_id, $thumbnail );
			} else {
				return catch_sketch_featured_image();
			}
		} elseif ( ! has_post_thumbnail() || ( class_exists( 'WooCommerce' ) && is_product() ) ) {
			return catch_sketch_featured_image();
		}

		$thumbnail = is_front_page() ? 'catch-sketch-slider' : 'catch-sketch-header-inner';

		if ( is_home() && $blog_id = get_option( 'page_for_posts' ) ) {
			return get_the_post_thumbnail_url( $blog_id, $thumbnail );
		} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
			return get_the_post_thumbnail_url( absint( get_option( 'woocommerce_shop_page_id' ) ), $thumbnail );
		} else {
			return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
		}
	} // catch_sketch_featured_page_post_image
endif;

if ( ! function_exists( 'catch_sketch_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own catch_sketch_featured_pagepost_image(), and that function will be used instead.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_featured_overall_image() {
		global $post;
		$enable = get_theme_mod( 'catch_sketch_header_media_option', 'disabled' );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) ) {
			$catch_sketch_id = $post->ID;

			if ( class_exists( 'WooCommerce' ) && is_shop() ) {
				$catch_sketch_id = absint( get_option( 'woocommerce_shop_page_id' ) );
			}
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $catch_sketch_id, 'catch-sketch-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return;
			} elseif ( 'enable' == $individual_featured_image ) {
				return catch_sketch_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() || ( is_home() && is_front_page() ) ) {
				return catch_sketch_featured_image();
			}
		} elseif ( 'exclude-home' === $enable ) {
			// Check Excluding Homepage
			if ( is_front_page() || ( is_home() && is_front_page() ) ) {
				return false;
			} else {
				return catch_sketch_featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enable ) {
			if ( is_front_page() || ( is_home() && is_front_page() ) ) {
				return false;
			} if ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) || ( is_home() && ! is_front_page() ) ) {
				return catch_sketch_featured_page_post_image();
			} else {
				return catch_sketch_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return catch_sketch_featured_image();
		} elseif ( 'entire-site-page-post' === $enable ) {
			// Check Entire Site (Post/Page)
			if ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) || ( is_home() && ! is_front_page() ) ) {
				return catch_sketch_featured_page_post_image();
			} else {
				return catch_sketch_featured_image();
			}
		} elseif ( 'pages-posts' === $enable ) {
			// Check Page/Post
			if ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) ) {
				return catch_sketch_featured_page_post_image();
			}
		}

		return false;
	} // catch_sketch_featured_overall_image
endif;

if ( ! function_exists( 'catch_sketch_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * * @since 1.0
	 */
	function catch_sketch_header_media_text() {
		if ( ! catch_sketch_has_header_media_text() ) {
			// Bail early if header media text is disabled
			return false;
		}

		$content_align = get_theme_mod( 'catch_sketch_header_media_content_align', 'content-aligned-center' );
		$text_align    = get_theme_mod( 'catch_sketch_header_media_text_align', 'text-aligned-center' );

		$classes[] = 'custom-header-content';
		$classes[] = $content_align;
		$classes[] = $text_align;

		?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="entry-container">
				<div class="entry-container-wrap">
					<?php 
					if ( is_front_page() && $header_media_tagline = get_theme_mod( 'catch_sketch_header_media_tagline' ) ) {
						echo '<span class="header-media-title">' . wp_kses_post( $header_media_tagline ) . '</span>';
					} 
					?>

					<header class="entry-header">
						<h2 class="entry-title">
							<?php catch_sketch_header_title(); ?>
						</h2>
					</header>
					<?php catch_sketch_header_text(); ?>
				</div> <!-- .entry-container-wrap -->
			</div>
		</div> <!-- entry-container -->
		<?php
	} // catch_sketch_header_media_text.
endif;

if ( ! function_exists( 'catch_sketch_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * * @since 1.0
	 */
	function catch_sketch_has_header_media_text() {
		
		$header_media_tagline  = get_theme_mod( 'catch_sketch_header_media_tagline' );
		$header_media_title    = get_theme_mod( 'catch_sketch_header_media_title' );
		$header_media_subtitle = get_theme_mod( 'catch_sketch_header_media_subtitle' );
		$header_media_text     = get_theme_mod( 'catch_sketch_header_media_text' );
		$header_media_url      = get_theme_mod( 'catch_sketch_header_media_url', '' );
		$header_media_url_text = get_theme_mod( 'catch_sketch_header_media_url_text' );

		$header_image = catch_sketch_featured_overall_image();

		if ( ( is_front_page() && ! ( is_front_page() && $header_media_tagline ) && ! $header_media_title && ! $header_media_subtitle && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) || ( ( is_singular() || is_archive() || is_search() || is_404() ) && ! $header_image ) ) {
			// Header Media text Disabled
			return false;
		}

		return true;
	} // catch_sketch_has_header_media_text.
endif;
