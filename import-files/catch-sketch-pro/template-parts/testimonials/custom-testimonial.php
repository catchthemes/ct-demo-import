<?php
/**
 * The template for displaying testimonial items
 *
 * @package Catch_Sketch
 */
?>

<?php
$number = get_theme_mod( 'catch_sketch_testimonial_number', 4 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

?>
<div class="section-content-wrap">
	<div class="cycle-slideshow"
	    data-cycle-log="false"
	    data-cycle-pause-on-hover="true"
	    data-cycle-swipe="true"
	    data-cycle-auto-height=container
		data-cycle-speed="1000"
		data-cycle-timeout="4000"
		data-cycle-loader=false
		data-cycle-prev=".cycle-prev"
		data-cycle-next=".cycle-next"
		data-cycle-slides=".testimonial-slider-wrap"
		data-cycle-pager="#testimonial-slider-pager"
		>
		<?php for ( $i = 1; $i <= $number; $i++ ) :
			$content  = get_theme_mod( 'catch_sketch_testimonial_content_' . $i );
			$target   = get_theme_mod( 'catch_sketch_testimonial_target_' . $i ) ? '_blank': '_self';
			$catch_sketch_catlink     = get_theme_mod( 'catch_sketch_testimonial_link_' . $i, '#' );
			$catch_sketch_title    = get_theme_mod( 'catch_sketch_testimonial_title_' . $i );
			$image    = get_theme_mod( 'catch_sketch_testimonial_image_' . $i );
			$position = get_theme_mod( 'catch_sketch_testimonial_position_' . $i );

			if ( function_exists( 'qtrans_convertURL' ) ) {
				$catch_sketch_catlink = qtrans_convertURL( $catch_sketch_catlink );
			}

			?>
			<div class="testimonial-slider-wrap">
				<div class="hentry-wrap">
					<article id="post-<?php echo esc_attr( $i ) ?>" class="post hentry post-image">
						

						<div class="entry-container">
							<?php
								if ( $catch_sketch_title || $position ) : ?>
								<!-- <header class="entry-header">
								<?php if ( $catch_sketch_title ) : ?>
									<h2 class="entry-title"><a href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $catch_sketch_title ); ?></a></h2>
								<?php endif; ?>

								<?php if ( $position ) : ?>
									<div class="entry-meta"><span class="position"><?php echo esc_html( $position ); ?></span></div>
								<?php endif; ?>
								</header> -->
								<?php endif; ?>

								<?php if ( $content ) : ?>
								<div class="entry-content">
									  <?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>
								</div>
								<?php endif; ?>
						</div><!-- .entry-container -->
						<?php if ( $image ) : ?>
							<div class="post-thumbnail">
								<a href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>" >
									<img src=" <?php echo esc_url( $image ) ?>" class="wp-post-image" alt=" <?php echo esc_attr( $catch_sketch_title ) ?>" title=" <?php echo esc_attr( $catch_sketch_title ) ?>">
								</a>

								<?php
								if ( $catch_sketch_title || $position ) : ?>
								<header class="entry-header">
								<?php if ( $catch_sketch_title ) : ?>
									<h2 class="entry-title"><a href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $catch_sketch_title ); ?></a></h2>
								<?php endif; ?>

								<?php if ( $position ) : ?>
									<div class="entry-meta"><span class="position"><?php echo esc_html( $position ); ?></span></div>
								<?php endif; ?>
								</header>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</article>
				</div><!-- .hentry-wrap -->
			</div><!-- .testimonial-slider-wrap -->
		<?php endfor; ?>
	</div><!-- .cycle-slideshow -->

	<div id="testimonial-slider-pager" class="cycle-pager"></div>

	<div class="controls">
		<!-- prev/next links -->
		<div class="cycle-prev fa fa-angle-left" aria-label="<?php esc_attr_e( 'Previous', 'catch-sketch-pro' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'catch-sketch-pro' ); ?></span></div>


		<div class="cycle-next fa fa-angle-right" aria-label="<?php esc_attr_e( 'Next', 'catch-sketch-pro' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'catch-sketch-pro' ); ?></span></div>
	</div>
</div><!-- .section-content-wrap -->
