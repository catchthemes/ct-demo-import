<?php
/**
 * The template for displaying stats posts on the front page
 *
 * @package Catch_Sketch
 */
?>

<?php
$show_content = get_theme_mod( 'catch_sketch_stats_show', 'excerpt' );
$catch_sketch_type         = get_theme_mod( 'catch_sketch_stats_type', 'category' );
$layout       = get_theme_mod( 'catch_sketch_stats_layout', 'layout-four' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'catch-sketch-stats' ); ?></a>
		</div>
		<?php endif; ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
			</header>

			<?php
			if ( 'excerpt' === $show_content ) {
				$excerpt = get_the_excerpt();

				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			} elseif ( 'full-content' === $show_content ) {
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				echo '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
			} ?>
		</div><!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article> <!-- .article -->
