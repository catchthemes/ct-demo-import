<?php
/**
 * The template for displaying portfolio items
 *
 * @package Catch_Sketch
 */
?>

<?php

$number = get_theme_mod( 'catch_sketch_portfolio_number', 6 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$slider_select = get_theme_mod( 'catch_sketch_portfolio_slider', 1 );

for ( $i = 1; $i <= $number; $i++ ) {
	$content  = get_theme_mod( 'catch_sketch_portfolio_content_' . $i );
	$target   = get_theme_mod( 'catch_sketch_portfolio_target_' . $i ) ? '_blank': '_self';
	$catch_sketch_catlink     = get_theme_mod( 'catch_sketch_portfolio_link_' . $i, '#' );
	$catch_sketch_title    = get_theme_mod( 'catch_sketch_portfolio_title_' . $i );
	$image    = get_theme_mod( 'catch_sketch_portfolio_image_' . $i ) ? get_theme_mod( 'catch_sketch_portfolio_image_' . $i ) : trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-640x640.jpg';

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$catch_sketch_catlink = qtrans_convertURL( $catch_sketch_catlink );
	}

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
		<div class="hentry-inner">
			<div class="portfolio-thumbnail post-thumbnail">
				<?php if ( $catch_sketch_catlink ) : ?>
				<a class="post-thumbnail" href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php endif; ?>
					<img src="<?php echo esc_url( $image ); ?>" class="wp-post-image" alt="<?php echo esc_attr( $catch_sketch_title ); ?>" title="<?php echo esc_attr( $catch_sketch_title ); ?>">
				<?php if ( $catch_sketch_catlink ) : ?>
				</a>
				<?php endif; ?>
			</div>

			<div class="entry-container">
				<div class="inner-wrap">
					<?php
					if ( $catch_sketch_title ) : ?>
						<header class="entry-header">
							<h2 class="entry-title">
								<?php if ( $catch_sketch_catlink ) : ?>
								<a class="post-thumbnail" href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>">
								<?php endif; ?>
									<?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
								<?php if ( $catch_sketch_catlink ) : ?>
								</a>
								<?php endif; ?>
						</header>
					<?php endif; ?>
				</div>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
}
