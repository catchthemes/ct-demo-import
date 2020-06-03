<?php
/**
 * The template for displaying services posts on the front page
 *
 * @package Catch_Sketch
 */
?>

<?php
$show_content = get_theme_mod( 'catch_sketch_service_show', 'excerpt' );
$show_meta    = get_theme_mod( 'catch_sketch_service_meta_show', 'hide-meta' );
$catch_sketch_type         = get_theme_mod( 'catch_sketch_service_type', 'category' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php

				// Default value if there is no first image
				$image = '';

				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'catch-sketch-stats' );
				} else {
					echo catch_sketch_get_no_thumb_image( 'catch-sketch-stats' );
				}
				?>
			</a>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

				<?php if ( 'show-meta' === $show_meta && 'custom' !== $catch_sketch_type ) : ?>
				<div class="entry-meta">
					<?php catch_sketch_entry_category(); ?>
					<?php catch_sketch_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>

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
