<?php
/**
 * The template for displaying team image content
 *
 * @package Catch_Sketch
 */
?>

<?php
$quantity = get_theme_mod( 'catch_sketch_team_number', 4 );

for ( $i = 1; $i <= $quantity; $i++ ) {
	$target = get_theme_mod( 'catch_sketch_team_target_' . $i ) ? '_blank' : '_self';

	$catch_sketch_catlink = get_theme_mod( 'catch_sketch_team_link_' . $i ) ? get_theme_mod( 'catch_sketch_team_link_' . $i ) : '#';

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$catch_sketch_catlink = qtrans_convertURL( $catch_sketch_catlink );
	}

	echo '
	<article id="team-post-' . esc_attr( $i ) . '" class="hentry"> <div class="hentry-inner">';

		$catch_sketch_title       = get_theme_mod( 'catch_sketch_team_title_' . $i );
		$position    = get_theme_mod( 'catch_sketch_team_position_' . $i );
		$content     = get_theme_mod( 'catch_sketch_team_content_' . $i );
		$more_button = get_theme_mod( 'catch_sketch_team_more_button_text_' . $i );

		$image = get_theme_mod( 'catch_sketch_team_image_' . $i ) ? get_theme_mod( 'catch_sketch_team_image_' . $i ) : '';

		echo '
		<div class="post-thumbnail">
			<a href="' . esc_url( $catch_sketch_catlink ) . '" target="' . esc_attr( $target ) . '"><img src="' . esc_url( $image ) . '" /></a>
		</div>';

		if ( $catch_sketch_title || $content || $more_button) {
			echo '
			<div class="entry-container">
				<header class="entry-header">';

				if ( $catch_sketch_title ) {
					echo '
					<h2 class="entry-title">
						<a href="' . esc_url( $catch_sketch_catlink ) . '" rel="bookmark" target="' . esc_attr( $target ) . '">' . wp_kses_post( $catch_sketch_title ) . '</a>
					</h2>';
				}

				if ( $position ) {
					echo '
					<div class="entry-meta">
						<span class="entry-job">
                        	<span class="job-label">' . esc_html( $position ) . '</span>
	                    </span>
	                </div> <!-- .entry-meta -->';
	            }

				echo '</header>';

				if ( $content || $more_button ) {
					if ( $more_button ) {
						$content .= '<span class="more-button">
							<a class="more-link" href="' . esc_url( $catch_sketch_catlink ) . '" rel="bookmark" target="' . esc_attr( $target ) . '">' . esc_html( $more_button ) . '</a>
						</span>';
					}

				 	echo '<div class="entry-summary">' . wp_kses_post( $content ) . '</div><!-- .entry-summary -->';
				}

				catch_sketch_team_social_links( $i );

				echo '
			</div><!-- .entry-container -->';		}

		echo '
		</div>
	</article><!-- .team-post-' . esc_attr( $i ) . ' -->';
} // End for().
