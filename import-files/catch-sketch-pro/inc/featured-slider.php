<?php
/**
 * The template for displaying the Slider
 *
 * @package Catch_Sketch
 */

if ( ! function_exists( 'catch_sketch_featured_slider' ) ) :
	/**
	 * Add slider.
	 *
	 * @uses action hook catch_sketch_before_content.
	 *
	 * * @since 1.0
	 */
	function catch_sketch_featured_slider() {
		if ( catch_sketch_is_slider_displayed() ) {
			$type              = get_theme_mod( 'catch_sketch_slider_type', 'category' );
			$transition_effect = get_theme_mod( 'catch_sketch_slider_transition_effect', 'fade' );
			$transition_length = get_theme_mod( 'catch_sketch_slider_transition_length', 1 );
			$transition_delay  = get_theme_mod( 'catch_sketch_slider_transition_delay', 4 );
			
			$classes[]   = get_theme_mod( 'catch_sketch_content_align', 'content-aligned-left');
			$classes[]   = get_theme_mod( 'catch_sketch_slider_text_align', 'text-aligned-left');
			$classes[]   = get_theme_mod( 'catch_sketch_slider_style', 'style-one');
			
			$output = '
				<div class="slider-content-wrapper section ' . esc_attr( implode( ' ', $classes ) ) . '">
					<div class="wrapper">
						<div class="section-content-wrap">
							<div class="cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
							    data-cycle-fx="'. esc_attr( $transition_effect ) .'"
								data-cycle-speed="'. esc_attr( $transition_length * 1000 ) .'"
								data-cycle-timeout="'. esc_attr( $transition_delay * 1000 ) .'"
								data-cycle-pager="#featured-slider-pager"
								data-cycle-prev="#featured-slider-prev"
        						data-cycle-next="#featured-slider-next"
								data-cycle-slides="> .post-slide"
								>';

			if ( get_theme_mod( 'catch_sketch_slider_pager', 1 ) ) {
				$output .= '
								<div class="controllers">
									<!-- prev/next links -->
									<div id="featured-slider-prev" class="cycle-prev fa fa-angle-left" aria-label="Previous" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Previous Slide', 'catch-sketch-pro' ) . '</span></div>

									<!-- empty element for pager links -->
									<div id="featured-slider-pager" class="cycle-pager"></div>

									<div id="featured-slider-next" class="cycle-next fa fa-angle-right" aria-label="Next" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Next Slide', 'catch-sketch-pro' ) . '</span></div>

								</div><!-- .controllers -->';
			}
							// Select Slider
			if ( 'post' === $type || 'page' === $type || 'category' === $type ) {
				$output .= catch_sketch_post_page_category_slider();
			} elseif ( 'custom' === $type ) {
				$output .= catch_sketch_image_slider();
			}

			$output .= '
							</div><!-- .cycle-slideshow -->
						</div><!-- .section-content-wrap -->
					</div><!-- .wrapper -->';
			$output .= '
				</div><!-- .slider-content-wrapper -->';

			echo $output;
		} // End if().
	}
	endif;
add_action( 'catch_sketch_slider', 'catch_sketch_featured_slider', 10 );

if ( ! function_exists( 'catch_sketch_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: catch_sketch_theme_options from customizer
	 *
	 * * @since 1.0
	 */
	function catch_sketch_post_page_category_slider() {
		$quantity     = get_theme_mod( 'catch_sketch_slider_number', 4 );
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$type         = get_theme_mod( 'catch_sketch_slider_type', 'category' );
		$show_meta    = get_theme_mod( 'catch_sketch_slider_meta_show', 'hide-meta' );
		$show_content = get_theme_mod( 'catch_sketch_slider_content_show', 'show-content' );
		$output       = '';

		$args = array(
			'post_type'           => 'any',
			'ignore_sticky_posts' => 1, // ignore sticky posts
		);

		//Get valid number of posts
		if ( 'post' === $type || 'page' === $type ) {
			for ( $i = 1; $i <= $quantity; $i++ ) {
				$post_id = '';

				if ( 'post' === $type ) {
					$post_id = get_theme_mod( 'catch_sketch_slider_post_' . $i );
				} elseif ( 'page' === $type ) {
					$post_id = get_theme_mod( 'catch_sketch_slider_page_' . $i );
				}

				if ( $post_id && '' !== $post_id ) {
					$post_list = array_merge( $post_list, array( $post_id ) );

					$no_of_post++;
				}
			}

			$args['post__in'] = $post_list;
			$args['orderby'] = 'post__in';
		} elseif ( 'category' === $type ) {
			$no_of_post = $quantity;

			$args['category__in'] = get_theme_mod( 'catch_sketch_slider_select_category' );

			$args['post_type'] = 'post';
		}

		if ( ! $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) :
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			if ( 0 === $loop->current_post ) {
				$classes = 'post post-' . get_the_ID() . ' hentry slides displayblock';

			} else {
				$classes = 'post post-' . get_the_ID() . ' hentry slides displaynone';
			}

			$counter =  $loop->current_post + 1;
			$white_text_color = get_theme_mod( 'catch_sketch_featured_text_white_' . $counter );
			$style            = get_theme_mod( 'catch_sketch_slider_style', 'style-one');

			if ( 'style-two' === $style && $white_text_color ) {
				$classes .= ' text-white';
			}

			// Default value if there is no featurd image or first image.
			$thumbnail = 'catch-sketch-slider';
			$image_url = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-1920x1080.jpg';



			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail );
			} else {
				// Get the first image in page, returns false if there is no image.
				$first_image_url = catch_sketch_get_first_image( get_the_ID(), $thumbnail, '', true );

				// Set value of image as first image if there is an image present in the page.
				if ( $first_image_url ) {
					$image_url = $first_image_url;
				}
			}

			$more_tag_text = get_theme_mod( 'catch_sketch_excerpt_more_text',  esc_html__( 'Continue reading', 'catch-sketch-pro' ) );

			$output .= '
			<div class="post-slide">
				<article class="' . esc_attr( $classes ) . '">';

					$output .= '
					<div class="slider-image" style="background-image: url(' . esc_url( $image_url ) . ')" alt="' . $title_attribute . '">
						<a class="cover-link" href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
							</a>
					</div><!-- .slider-image -->
					<div class="entry-container"><div class="entry-container-wrap">';

				$output .= the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2></header>', false );

				if ( 'show-meta' === $show_meta  && ( 'post' === $type || 'category' === $type ) ) {
					$output .= '<div class="entry-meta">' . catch_sketch_entry_category( false ) . '</div>';
				}

				$show_content = get_theme_mod( 'catch_sketch_slider_show', 'excerpt' );

				if ( 'excerpt' === $show_content ) {
					$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
				} elseif ( 'full-content' === $show_content ) {
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
				}

						$output .= '
					</div></div><!-- .entry-container -->
				</article><!-- .slides -->
			</div><!-- .post-slide -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // catch_sketch_post_page_category_slider.

if ( ! function_exists( 'catch_sketch_image_slider' ) ) :
	/**
	 * This function to display featured posts slider
	 *
	 * @get the data value from theme options
	 * @displays on the index
	 *
	 * @usage Featured Image, Title and Excerpt of Post
	 *
	 */
	function catch_sketch_image_slider() {
		$quantity = get_theme_mod( 'catch_sketch_slider_number', 4 );

		$output = '';

		for ( $i = 1; $i <= $quantity; $i++ ) {
			$image = get_theme_mod( 'catch_sketch_slider_image_' . $i );

			// Check Image Not Empty to add in the slides.
			if ( $image ) {
				$imagetitle = get_theme_mod( 'catch_sketch_featured_title_' . $i ) ? get_theme_mod( 'catch_sketch_featured_title_' . $i ) : '';

				$title     = '';
				$content   = '';
				$link      = get_theme_mod( 'catch_sketch_featured_link_' . $i );
				$target    = '_self';
				$more_link = '';

				if ( $link ) {
					// Checking Link Target.
					$target = get_theme_mod( 'catch_sketch_featured_target_' . $i ) ? '_blank' : '_self';

					$more_tag_text = get_theme_mod( 'catch_sketch_excerpt_more_text',  esc_html__( 'Continue reading', 'catch-sketch-pro' ) );

					$more_link = '<span class="more-button"><a href="' . esc_url( $link ) . '" class="more-link" target="' . $target . '">' . wp_kses_data( $more_tag_text ) . '</a></span>';
				}

				$subtitle = get_theme_mod( 'catch_sketch_featured_sub_title_' . $i ) ? '<span class="sub-title">' . wp_kses_post( get_theme_mod( 'catch_sketch_featured_sub_title_' . $i ) ) . '</span><!-- .sub-title -->' : '';

				$title = '<header class="entry-header"><h2 class="entry-title"> <a title="' . esc_attr( $imagetitle ) . '" href="' . esc_url( $link ) . '" target="' . $target . '">' . esc_html( $imagetitle ) . '</a>'. $subtitle .'</h2></header>';

				$subtitle = get_theme_mod( 'catch_sketch_featured_sub_title_' . $i ) ? '<span class="sub-title">' . wp_kses_post( get_theme_mod( 'catch_sketch_featured_sub_title_' . $i ) ) . '</span><!-- .sub-title -->' : '';

				$content = get_theme_mod( 'catch_sketch_featured_content_' . $i ) ? '<div class="entry-summary"><p>' . wp_kses_post( get_theme_mod( 'catch_sketch_featured_content_' . $i ) ) . $more_link . '</p></div><!-- .entry-summary -->' : '';

				$contentopening = '';
				$contentclosing = '';

				// Content Opening and Closing.
				if ( $title || $subtitle || $content ) {
					$contentopening = '<div class="entry-container"><div class="entry-container-wrap">';
					$contentclosing = '</div></div><!-- .entry-container -->';
				}

				// Adding in Classes for Display block and none.
				$classes = ( 1 === $i ) ? 'displayblock' : 'displaynone';

				$classes .=  ' image-slides hentry images-' . $i . ' slides';

				$white_text_color = get_theme_mod( 'catch_sketch_featured_text_white_' . intval( $i ) );
				$style            = get_theme_mod( 'catch_sketch_slider_style', 'style-one');

				if ( 'style-two' === $style && $white_text_color ) {
					$classes .= ' text-white';
				}

				$output .= '
				<div class="post-slide">
					<article class="' . esc_attr( $classes ) . '">
						<div class="slider-image" style="background-image: url(' . esc_url( $image ) . ')" alt="' . $imagetitle . '">
							<a  class="cover-link" href="' . esc_url( $link ) . '" title="' . esc_attr( $imagetitle ) . '">
								</a>
						</div><!-- .slider-image -->


						' . $contentopening .  $title .$content . $contentclosing . '
					</article><!-- .slides -->
				</div><!-- .post-slide -->';
			} // End if().
		} // End for().
		return $output;
	}
endif; // catch_sketch_image_slider.

if ( ! function_exists( 'catch_sketch_is_slider_displayed' ) ) :
	/**
	 * Return true if slider image is displayed
	 *
	 */
	function catch_sketch_is_slider_displayed() {
		$enable_slider = get_theme_mod( 'catch_sketch_slider_option', 'disabled' );

		return catch_sketch_check_section( $enable_slider );
	}
endif; // catch_sketch_is_slider_displayed.
