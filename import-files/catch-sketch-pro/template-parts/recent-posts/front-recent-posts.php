<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Catch_Sketch
 */
?>

<div class="recent-blog-content-wrapper section">
	<div class="wrapper">
		<div class="recent-blog-container">
			<div class="archive-content-wrap">
			<?php
			$post_title = get_theme_mod( 'catch_sketch_recent_posts_heading', esc_html__( 'Blog', 'catch-sketch-pro' ) );
			$post_subtitle = get_theme_mod( 'catch_sketch_recent_posts_subheading' );

			if ( '' !== $post_title || '' !== $post_subtitle ) :
			?>
				<div class="section-heading-wrap">
					<?php if ( '' !== $post_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo esc_html( $post_title ); ?></h2>
						</div> <!-- .section-title-wrapper -->
					<?php endif; ?>

					<?php if ( '' !== $post_subtitle ) : ?>
						<div class="section-description">
							<?php
			                $post_subtitle = apply_filters( 'the_content', $post_subtitle );
			                echo str_replace( ']]>', ']]&gt;', $post_subtitle );
			                ?>
						</div><!-- .section-description -->
					<?php endif; ?>


				</div><!-- .section-heading-wrap -->
			<?php
			endif;
			?>
			<div class="section-content-wrapper <?php echo esc_attr( catch_sketch_get_posts_columns() ); ?>">
				<?php
				$recent_posts = new WP_Query( array(
					'ignore_sticky_posts' => true,
				) );

				/* Start the Loop */
				while ( $recent_posts->have_posts() ) :
					$recent_posts->the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php if ( is_sticky() ) { ?>
								<span class="sticky-label"><?php esc_html_e( 'Featured', 'catch-sketch-pro' ); ?></span>
							<?php } ?>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
							<?php endif; ?>

							<div class="entry-container">
								<header class="entry-header">
									<?php
									$show_content = get_theme_mod( 'catch_sketch_archive_content_show', 'excerpt' );
									$show_meta    = get_theme_mod( 'catch_sketch_archive_meta_show', 'show-meta' );

									the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		
									if ( 'show-meta' === $show_meta ) : 
										catch_sketch_blog_entry_meta_left();
										 catch_sketch_blog_entry_meta_right(); 
									endif; ?>
								</header><!-- .entry-header -->

								<?php
									if ( 'excerpt' === $show_content ) {
										echo '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
									} elseif ( 'full-content' === $show_content ) {
										$content = apply_filters( 'the_content', get_the_content() );
										$content = str_replace( ']]>', ']]&gt;', $content );
										echo '<div class="entry-content"' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
									} ?>
							</div> <!-- .entry-container -->
						</div><!-- .hentry-inner-->
					</article><!-- #post -->
					<?php
				endwhile;

				wp_reset_postdata();
				?>
			</div><!-- .section-content-wrap -->
			<p class="view-all-button"><span class="more-button more-recent-posts">
					<a class="more-link" href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>"><?php esc_html_e( 'More Posts', 'catch-sketch-pro' ); ?></a>
				<span>
			</p>
			</div> <!-- .archive-content-wrap -->
		</div> <!-- .recent-blog-container -->
	</div> <!-- .wrapper -->
</div> <!-- .recent-blog-content-wrapper -->
