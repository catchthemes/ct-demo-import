<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch_Sketch
 */
?>

<?php
$grid_style = get_theme_mod( 'catch_sketch_blog_style', 0 );

if ( $grid_style ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif; ?>
		<div class="hentry-inner">
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php 
					$columns = catch_sketch_get_posts_columns();
					$thumbnail = 'post-thumbnail';

					if ( 'layout-one' === $columns ) {
						$thumbnail = 'catch-sketch-blog';
						$layout  = catch_sketch_get_theme_layout();
					
						if ( 'no-sidebar-full-width' === $layout ) {
							$thumbnail = 'catch-sketch-slider';
						}
					}

					the_post_thumbnail( $thumbnail ); 
					?>
				</a>
			</div>
			<?php endif; ?>

			<?php $show_meta    = get_theme_mod( 'catch_sketch_archive_meta_show', 'show-meta' );
			?>

			<div class="entry-container">
				<?php if ( is_sticky() ) : ?>
				<span class="sticky-label"><?php esc_html_e( 'Featured', 'catch-sketch-pro' ); ?></span>
				<?php endif; ?>

				<header class="entry-header">
					<?php
					$show_content = get_theme_mod( 'catch_sketch_archive_content_show', 'excerpt' );
					if ( 'post' === get_post_type() ) :
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
					endif; ?>
					<?php
					if ( 'show-meta' === $show_meta ) : ?>
						<div class="entry-meta">
							<?php catch_sketch_blog_entry_meta_left(); ?>
							<?php catch_sketch_blog_entry_meta_right(); ?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
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
		</div> <!-- .hentry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
