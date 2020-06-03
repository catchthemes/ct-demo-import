<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Catch_Sketch
 */
?>

<?php
$show_content = get_theme_mod( 'catch_sketch_discography_show', 'hide-content' );
$show_meta    = get_theme_mod( 'catch_sketch_discography_meta_show', 'show-meta' );
$catch_sketch_type         = get_theme_mod( 'catch_sketch_discography_type', 'category' );
$layout       = get_theme_mod( 'catch_sketch_discography_layout', 'layout-three' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'catch-sketch-app' );
				}
				else {
					$image = '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-640x640.jpg"/>';

					// Get the first image in page, returns false if there is no image.
					$first_image = catch_sketch_get_first_image( $post->ID, 'catch-sketch-app', '' );

					// Set value of image as first image if there is an image present in the page.
					if ( $first_image ) {
						$image = $first_image;
					}

					echo $image;
				}
				?>
			</a>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

				<?php if ( 'show-meta' === $show_meta  && ( 'post' === $catch_sketch_type || 'category' === $catch_sketch_type ) ) {
				echo '<div class="entry-meta">';
					catch_sketch_entry_category();
					catch_sketch_posted_on();
				echo '</div><!-- .entry-meta -->';
				} ?>

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
</article>
