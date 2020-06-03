<?php
/**
 * The template for displaying stats image content
 *
 * @package Catch_Sketch
 */
?>

<?php
$quantity = get_theme_mod( 'catch_sketch_stats_number', 4 );

for ( $i = 1; $i <= $quantity; $i++ ) {
	$target = get_theme_mod( 'catch_sketch_stats_target_' . $i ) ? '_blank' : '_self';

	$catch_sketch_catlink = get_theme_mod( 'catch_sketch_stats_link_' . $i ) ? get_theme_mod( 'catch_sketch_stats_link_' . $i ) : '#';

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$catch_sketch_catlink = qtrans_convertURL( $catch_sketch_catlink );
	}

	echo '
	<article id="stats-post-' . esc_attr( $i ) . '" class="hentry"> <div class="hentry-inner">';

		$catch_sketch_title       = get_theme_mod( 'catch_sketch_stats_title_' . $i );
		$content     = get_theme_mod( 'catch_sketch_stats_content_' . $i );
		$more_button = get_theme_mod( 'catch_sketch_stats_more_button_text_' . $i );

		$image = get_theme_mod( 'catch_sketch_stats_image_' . $i ) ? get_theme_mod( 'catch_sketch_stats_image_' . $i ) : '';

		if ( $image ) {
			echo '
			<div class="post-thumbnail">
			<a href="' . esc_url( $catch_sketch_catlink ) . '" target="' . esc_attr( $target ) . '">
				<img src="' . esc_url( $image ) . '" class="wp-post-image" alt="' . esc_attr( $catch_sketch_title ) . '" title="' . esc_attr( $catch_sketch_title ) . '">
			</a></div>';
		}

		if ( $catch_sketch_title || $content || $more_button) {
			echo '
			<div class="entry-container">';

				if ( $catch_sketch_title ) {
					echo '
					<header class="entry-header">
					<h2 class="entry-title">
						<a href="' . esc_url( $catch_sketch_catlink ) . '" rel="bookmark" target="' . esc_attr( $target ) . '">' . wp_kses_post( $catch_sketch_title ) . '</a>
					</h2>';
					echo '</header>';
				}

				if ( $content || $more_button ) {
					if ( $more_button ) {
						$content .= '<span class="more-button">
							<a class="more-link" href="' . esc_url( $catch_sketch_catlink ) . '" rel="bookmark" target="' . esc_attr( $target ) . '">' . esc_html( $more_button ) . '</a>
						</span>';
					}

				 	echo '<div class="entry-summary">' . wp_kses_post( $content ) . '</div><!-- .entry-summary -->';
				}



				echo '
			</div><!-- .entry-container -->';
		}

		echo '
		</div>
	</article><!-- .stats-post-' . esc_attr( $i ) . ' -->';
} // End for().
