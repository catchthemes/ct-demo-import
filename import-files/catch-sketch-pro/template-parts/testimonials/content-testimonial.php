<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Catch_Sketch
 */
?>
<div class="testimonial-slider-wrap">
	<div class="hentry-wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-container">
				<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_post_thumbnail(); ?>
					</a>
					<?php if ( get_theme_mod( 'catch_sketch_testimonial_display_title', 1 ) || $position ) : ?>
					<header class="entry-header">
						<?php
						if ( get_theme_mod( 'catch_sketch_testimonial_display_title', 1 ) ) {
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
						}

						if ( $position ) {
						echo '<div class="entry-meta"><span class="position">' . esc_html( $position ) . '</span></div>';
						}
						?>
					</header>
				<?php endif;?>
				</div> <!-- .post-thumbnail -->
			<?php endif; ?>
			</div><!-- .entry-container -->
		</article>
	</div><!-- .hentry-wrap -->
</div><!-- .testimonial-slider-wrap -->
