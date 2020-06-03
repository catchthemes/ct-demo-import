<?php
/**
 * The template used for displaying promotion_headline content
 *
 * @package Catch_Sketch
 */
?>

<?php
$catch_sketch_title = get_theme_mod( 'catch_sketch_promotion_headline_title' );


$classes[] = 'promotion-headline-section section'; 

$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_align', 'content-aligned-right' );
$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_text_align', 'text-aligned-left' );
$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_box_design', 'style-one' );
$classes[] = get_theme_mod( 'catch_sketch_promotion_headline_layout', 'default' );

$image = get_theme_mod( 'catch_sketch_promotion_headline_image' );
// Bg image added from function catch_sketch_promo_headline_bg_css()
if ( ! $image ) {
	$classes[] = 'no-background';
}

$catch_sketch_catlink = get_theme_mod( 'catch_sketch_promotion_headline_link', '#');
$target = get_theme_mod( 'catch_sketch_promotion_headline_target' );

?>

<div id="promotion-headline-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="section-content-wrap">
			<article id="post-0" class="hentry">
			<?php if ( $image ) : ?>
				<div class="post-thumbnail">
					<a href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>">
						<img src="<?php echo esc_url( $image ); ?>" class="wp-post-image" alt="<?php echo esc_attr( $catch_sketch_title ); ?>" title="<?php echo esc_attr( $catch_sketch_title ); ?>">
					</a>
				</div>
			<?php endif; ?>
				<?php
				$catch_sketch_title = get_theme_mod( 'catch_sketch_promotion_headline_title' );
				$subtitle = get_theme_mod( 'catch_sketch_promotion_headline_subtitle' );
				?>
				<div class="entry-container">
					<div class="inner-container">
						<?php if ( $catch_sketch_title || $subtitle ) : ?>
							<header class="entry-header">
								<?php if ( $catch_sketch_title ) : ?>
								<h2 class="section-title">
									<?php echo wp_kses_post( $catch_sketch_title ); ?>
								</h2>
								<?php endif; ?>

								<?php if ( $subtitle ) : ?>
								<div class="section-description">
									<?php
									$subtitle = apply_filters( 'the_content', $subtitle );
									echo str_replace( ']]>', ']]&gt;', $subtitle );
									?>
								</div><!-- .section-description -->
								<?php endif; ?>
							</header><!-- .entry-header -->
						<?php endif; ?>

						<?php if ( $content = get_theme_mod( 'catch_sketch_promotion_headline' ) ) : ?>
							<div class="entry-content">
								<?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>

								<?php
								$more_text   = get_theme_mod( 'catch_sketch_promotion_headline_more_text' );
								$more_link   = get_theme_mod( 'catch_sketch_promotion_headline_more_link', '#' );
								$more_target = get_theme_mod( 'catch_sketch_promotion_headline_more_target' ) ? '_blank' : '_self' ;

								if ( $more_text ) : ?>
								<span class="more-button">
									<a class="more-link" href="<?php echo esc_url( $more_link ); ?>" target="<?php echo esc_attr( $more_target ); ?>"> <?php echo esc_html( $more_text ); ?> </a>
								</span>
								<?php endif; ?>
							</div><!-- .entry-content -->
						<?php endif; ?>
					</div><!-- .inner-container -->
				</div><!-- .entry-container -->
			</article><!-- #post-## -->
		</div><!-- .section-content-wrap -->
	</div> <!-- Wrapper -->
</div> <!-- promotion_headline-wrapper -->

