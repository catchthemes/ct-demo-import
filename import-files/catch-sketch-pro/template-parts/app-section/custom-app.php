<?php
/**
 * The template used for displaying promotion headline
 *
 * @package My Music Band
 */

$class[] = 'section';
$class[] = 'app-section';
$class[] = 'promotion-section';
$class[] = get_theme_mod( 'catch_sketch_app_section_image_position', 'content-align-right' );
$class[] = get_theme_mod( 'catch_sketch_app_section_text_alignment', 'text-align-left' );

$image    = get_theme_mod( 'catch_sketch_app_section_image' );
$target   = get_theme_mod( 'catch_sketch_app_section_target' ) ? '_blank' : '_self';
$catch_sketch_title    = get_theme_mod( 'catch_sketch_app_section_title' );
$subtitle = get_theme_mod( 'catch_sketch_app_section_subtitle' );

if ( ! $image ) {
	$class[] = 'no-thumb';
}
?>
<div id="app-section" class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
	<div class="wrapper section-content-wrapper">
		<article class="hentry type-image app-image">
			<div class="hentry-inner">
				<?php if ( $image ) : ?>
					<div class="app-section-image" style="background-image: url( <?php echo $image; ?> );"></div>
				<?php endif; ?>

				<div class="content-wrapper">
					<div class="entry-container">
						<div class="entry-container-frame">
							<?php if ( $catch_sketch_title || $subtitle ) : ?>
								<header class="entry-header section-title-wrapper">
									<?php if ( $catch_sketch_title ) : ?>
									<h2 class="entry-title section-title "> <?php echo wp_kses_post( $catch_sketch_title ); ?> </h2>
									<?php endif; ?>

									<?php if ( $subtitle ) : ?>
										<span><?php echo esc_html( $subtitle ); ?></span>
									<?php endif; ?>
								</header><!-- .entry-header -->
							<?php endif; ?>

							<?php
							$image = get_theme_mod( 'catch_sketch_app_section_logo_image' );
							if ( $image ) : ?>
								<div class="post-thumbnail">
									<img src="<?php echo esc_url( $image ); ?>">
								</div><!-- .post-thumbnail-->
							<?php endif; ?>

							<?php if ( $content = get_theme_mod( 'catch_sketch_app_section_content' ) ) : ?>
								<div class="entry-content">
									<?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>

									<?php
									$more_text   = get_theme_mod( 'catch_sketch_app_section_more_text' );
									$more_link   = get_theme_mod( 'catch_sketch_app_section_more_link', '#' );
									$more_target = get_theme_mod( 'catch_sketch_app_section_more_target' ) ? '_blank' : '_self' ;


									if ( $more_text ) : ?>
										<a class="more-link" href="<?php echo esc_url( $more_link ); ?>" target="<?php echo esc_attr( $more_target ); ?>">
											<span class="readmore"><?php echo esc_html( $more_text ); ?></span>
										</a>
									<?php
									endif;
									?>
									<div class="app-image-container">

									<?php
										$first_app_image   = get_theme_mod( 'catch_sketch_app_section_first_image' );
										$first_image_link  = get_theme_mod( 'catch_sketch_app_section_first_image_link' );
										$second_app_image  = get_theme_mod( 'catch_sketch_app_section_second_image' );
										$second_image_link = get_theme_mod( 'catch_sketch_app_section_second_image_link' );
										$third_app_image   = get_theme_mod( 'catch_sketch_app_section_third_image' );
										$third_image_link  = get_theme_mod( 'catch_sketch_app_section_third_image_link' );

										if ( $first_app_image ) : ?>
											<div class="app-image first">
											<?php	echo '
												<a href="' . esc_url( $first_image_link ) . '" target="' . $target . '">
													<img src="' . esc_url( $first_app_image ) . '" class="wp-post-image">
												</a>'; ?>
											</div><!-- .post-thumbnail-background -->
										<?php endif;
										if ( $second_app_image ) : ?>
											<div class="app-image second">
											<?php	echo '
												<a href="' . esc_url( $second_image_link ) . '" target="' . $target . '">
													<img src="' . esc_url( $second_app_image ) . '" class="wp-post-image">
												</a>'; ?>
											</div><!-- .post-thumbnail-background -->
										<?php endif;
										if ( $third_app_image ) : ?>
											<div class="app-image third">
											<?php	echo '
												<a href="' . esc_url( $third_image_link ) . '" target="' . $target . '">
													<img src="' . esc_url( $third_app_image ) . '" class="wp-post-image">
												</a>'; ?>
											</div><!-- .post-thumbnail-background -->
										<?php endif;?>
									</div>
									<div class="app-button-container">	
									<?php
										// Buttons Start.
										$first_button_text  = get_theme_mod( 'catch_sketch_app_section_button_one_text' );
										$first_button_link  = get_theme_mod( 'catch_sketch_app_section_button_one_link' );
										$second_button_text = get_theme_mod( 'catch_sketch_app_section_button_two_text' );
										$second_button_link = get_theme_mod( 'catch_sketch_app_section_button_two_link' );

										if ( $first_button_link ) : ?>
											<div class="app-button">
												<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $first_button_link ); ?>"><?php echo esc_html( $first_button_text ); ?>
												</a>
											</div> <?php endif;
										if ( $second_button_link ) : ?>
											<div class="app-button">
												<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $second_button_link ); ?>"><?php echo esc_html( $second_button_text ); ?>
												</a>
											</div>
										<?php endif;?>
									</div>
								</div><!-- .entry-content -->
							<?php endif; ?>
						</div><!-- .entry-container-frame -->
					</div><!-- .entry-container -->
				</div><!-- .content-wrapper -->
			</div><!-- .hentry-inner -->
		</article><!-- #post-## -->
	</div><!-- .section-content-wrap -->
</div><!-- .section -->
