<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Sketch
 */

$classes[] = 'hero-section';
$classes[] = 'section';
$classes[] = get_theme_mod( 'catch_sketch_hero_content_position', 'content-aligned-right' );
$classes[] = get_theme_mod( 'catch_sketch_hero_text_align', 'text-aligned-left' );
$classes[] = get_theme_mod( 'catch_sketch_hero_content_layout', 'default' );
?>
<div id="hero-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="section-content-wrap">
			<article id="post-0" class="hentry hero-image-content">
				<?php
				$meta     = get_theme_mod( 'catch_sketch_hero_content_meta' );
				$catch_sketch_title    = get_theme_mod( 'catch_sketch_hero_content_title' );
				$subtitle = get_theme_mod( 'catch_sketch_hero_content_subtitle' );
				$image    = get_theme_mod( 'catch_sketch_hero_content_image' );
				if ( $image ) :
					$catch_sketch_catlink = get_theme_mod( 'catch_sketch_hero_content_link' );
					$target = get_theme_mod( 'catch_sketch_hero_content_target' ) ? '_blank' : '_self';
					?>
					<div class="featured-content-image" style="background-image: url( <?php echo $image; ?> );">
						<?php if( $catch_sketch_catlink ) : ?>
						<a class="cover-link" href="<?php echo esc_url( $catch_sketch_catlink ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
						<?php endif; ?>
					</div>
					
					<div class="entry-container">
				<?php
				else: 
					// If meta is available, display it.
					if ( $meta ) {
						?>
						<span class="cat-links"><?php echo esc_html( $meta ); ?></span>
						<?php
					}

					if ( $catch_sketch_title || $subtitle ) : ?>
						<div class="section-heading-wrapper">
							<div class="section-title-wrapper">
								<?php if ( $subtitle ) : ?>
									<span class="subtitle"><?php echo esc_html( $subtitle ); ?></span>
								<?php endif; ?>

								<?php if ( $catch_sketch_title ) : ?>
									<h2 class="section-title"><?php echo esc_html( $catch_sketch_title ); ?></h2>
								<?php endif; ?>
							</div><!-- .section-title-wrapper -->
						</div><!-- .section-heading-wrapper -->
				<?php endif; ?>
				
					<div class="entry-container full-width">
				<?php endif; ?>

				<?php if ( $image && ( $catch_sketch_title || $subtitle ) ) : 
					// If meta is available, display it.
					if ( $meta ) {
						?>
						<span class="cat-links"><?php echo esc_html( $meta ); ?></span>
						<?php
					}
					?>

					<header class="entry-header">
						<header class="entry-header">
							<?php if ( $catch_sketch_title ) : ?>
							<h2 class="entry-title ">
								<?php echo esc_html( $catch_sketch_title ); ?>
							</h2>
							<?php endif; ?>

							<?php if ( $subtitle ) : ?>
								<span><?php echo esc_html( $subtitle ); ?></span>
							<?php endif; ?>
						</header><!-- .entry-header -->
					</header><!-- .entry-header -->
				<?php endif; ?>

				<?php if ( $content = get_theme_mod( 'catch_sketch_hero_content_content' ) ) : ?>
					<div class="entry-content">
						<?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>

						<?php
						$more_text   = get_theme_mod( 'catch_sketch_hero_content_more_text' );
						$more_link   = get_theme_mod( 'catch_sketch_hero_content_more_link', '#' );
						$more_target = get_theme_mod( 'catch_sketch_hero_content_more_target' ) ? '_blank' : '_self' ;


						if ( $more_text ) : ?>
						<span class="more-button">
							<a class="more-link" href="<?php echo esc_url( $more_link ); ?>" target="<?php echo esc_attr( $more_target ); ?>"> <?php echo esc_html( $more_text ); ?> </a>
						</span>
						<?php endif; ?>
					</div><!-- .entry-content -->
				<?php endif; ?>

				<?php
					$author_image = get_theme_mod( 'catch_sketch_hero_content_author_image' );
					$author_name  = get_theme_mod( 'catch_sketch_hero_content_author_name' );
					$author_desc  = get_theme_mod( 'catch_sketch_hero_content_author_desc' );

					if ( $author_image || $author_name || $author_desc ) : ?>
					<div class="author-info">
						<?php if ( $author_image ) : ?>
						<div class="author-avatar">
							<img alt="" src="<?php echo esc_url( $author_image ); ?>" class="avatar avatar-70 photo" width="70" height="70">
						</div><!-- .author-avatar -->
						<?php endif; ?>

						<?php if ( $author_name || $author_desc ) : ?>
						<div class="author-description">
							<?php if ( $author_name ) : ?>
							<h2 class="author-title"><?php echo esc_html( $author_name ); ?></h2>
							<?php endif; ?>

							<?php if ( $author_desc ) : ?>
							<p class="author-bio">
								<?php echo esc_html( $author_desc ); ?>
							</p><!-- .author-bio -->
							<?php endif; ?>
						</div><!-- .author-description -->
						<?php endif; ?>
					</div><!-- .author-info -->
				<?php endif; ?>
				</div><!-- .entry-container -->
			</article><!-- #post-## -->
		</div><!-- .section-content-wrap -->
	</div> <!-- Wrapper -->
</div> <!-- hero-content-wrapper -->

