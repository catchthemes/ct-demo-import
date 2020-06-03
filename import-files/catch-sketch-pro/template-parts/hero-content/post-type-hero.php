<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Sketch
 */
$catch_sketch_type   = get_theme_mod( 'catch_sketch_hero_content_type', 'page' );

if ( 'page' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_hero_content' ) ) {
	$args['page_id'] = absint( $catch_sketch_id );
} elseif ( 'post' === $catch_sketch_type && $catch_sketch_id = get_theme_mod( 'catch_sketch_hero_content_post' ) ) {
	$args['p'] = absint( $catch_sketch_id );
} elseif ( 'category' === $catch_sketch_type && $catch_sketch_cat = get_theme_mod( 'catch_sketch_hero_content_category' ) ) {
	$args['cat']            = absint( $catch_sketch_cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		
		$classes[] = 'hero-section';
		$classes[] = 'section';
		$classes[] = get_theme_mod( 'catch_sketch_hero_content_position', 'content-aligned-right' );
		$classes[] = get_theme_mod( 'catch_sketch_hero_text_align', 'text-aligned-left' );
		$classes[] = get_theme_mod( 'catch_sketch_hero_content_layout', 'default' );
		$catch_sketch_title = '';

		if ( get_theme_mod( 'catch_sketch_display_hero_content_title', 1 ) ) {
			$catch_sketch_title = get_the_title();
		}

		$subtitle = get_theme_mod( 'catch_sketch_hero_content_subtitle' );						
		?>
		<div id="hero-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="wrapper">
				<div class="section-content-wrap">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="featured-content-image" style="background-image: url( <?php the_post_thumbnail_url( 'catch-sketch-hero-content' ); ?> );">
								<a class="cover-link" href="<?php the_permalink(); ?>"></a>
							</div>
							<div class="entry-container">
						<?php else :
								if ( $catch_sketch_title || $subtitle || get_theme_mod( 'catch_sketch_display_hero_content_meta' ) ) : ?>
								<div class="section-heading-wrapper">
									<div class="section-title-wrapper">
										<?php if ( $subtitle ) : ?>
											<span class="subtitle"><?php echo esc_html( $subtitle ); ?></span>
										<?php endif; ?>

										<?php if ( $catch_sketch_title ) : ?>
											<h2 class="section-title"><?php echo esc_html( $catch_sketch_title ); ?></h2>
										<?php endif; ?>
									</div><!-- .section-title-wrapper -->
									
									<?php
									// If meta is enabled, display cats.
									if ( get_theme_mod( 'catch_sketch_display_hero_content_meta' ) ) {
										catch_sketch_entry_category();
									}
									?>
								</div><!-- .section-heading-wrapper -->
							<?php endif; ?>

							<div class="entry-container full-width">
						<?php endif; 
							if ( has_post_thumbnail() && ( $catch_sketch_title || $subtitle ) ) : 
								// If meta is enabled, display cats.
								if ( get_theme_mod( 'catch_sketch_display_hero_content_meta' ) ) {
									catch_sketch_entry_category();
								}
								?>
								<header class="entry-header">
									<?php if ( $catch_sketch_title ) : ?>
									<h2 class="entry-title ">
										<?php echo esc_html( $catch_sketch_title ); ?>
									</h2>
									<?php endif; ?>

									<?php if ( $subtitle ) : ?>
										<span class="subtitle"><?php echo esc_html( $subtitle ); ?></span>
									<?php endif; ?>
								</header><!-- .entry-header -->
							<?php endif; ?>

							<div class="entry-content">
								<?php
									$show_content = get_theme_mod( 'catch_sketch_hero_content_show', 'full-content' );

									if ( 'full-content' === $show_content ) {
										the_content();
									} elseif ( 'excerpt' === $show_content ) {
										echo '<p>' . get_the_excerpt() . '</p>';
									}

									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'catch-sketch-pro' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'catch-sketch-pro' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>

								<?php
							// If author is enabled, display it.
							if ( get_theme_mod( 'catch_sketch_display_hero_content_author' ) ) {
								?>
								<div class="author-info">
									<div class="author-avatar">
										<?php
										/**
										 * Filter the Foodie World author bio avatar size.
										 *
										 * * @since 1.0
										 *
										 * @param int $size The avatar height and width size in pixels.
										 */
										$author_bio_avatar_size = apply_filters( 'catch_sketch_author_bio_avatar_size', 150 );

										echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
										?>
									</div><!-- .author-avatar -->

									<div class="author-description">
										<h2 class="author-title"><span class="author-heading screen-reader-text"><?php esc_html_e( 'Author:', 'catch-sketch-pro' ); ?></span> <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h2>

										<p class="author-bio">
											<?php the_author_meta( 'description' ); ?>
										</p><!-- .author-bio -->
									</div><!-- .author-description -->
								</div><!-- .author-info -->

								<?php
							}
							?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<?php
										edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'catch-sketch-pro' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<span class="edit-link">',
											'</span>'
										);
									?>
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .entry-container -->
					</article><!-- #post-## -->
				</div><!-- .section-content-wrap -->
			</div> <!-- Wrapper -->
		</div> <!-- hero-content-wrapper -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
