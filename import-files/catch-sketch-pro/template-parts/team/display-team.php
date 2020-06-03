<?php
/**
 * The template for displaying team content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_sketch_team_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if team content is disabled.
	return;
}

$catch_sketch_type = get_theme_mod( 'catch_sketch_team_type', 'category' );

if ( 'custom' !== $catch_sketch_type ) {
	$team_posts = catch_sketch_get_team_posts();

	if ( empty( $team_posts ) ) {
		return;
	}
}

$catch_sketch_title     = get_theme_mod( 'catch_sketch_team_title', esc_html__( 'Our Team', 'catch-sketch-pro' ) );
$sub_title = get_theme_mod( 'catch_sketch_team_sub_title' );

$layout = get_theme_mod( 'catch_sketch_team_layout', 'layout-four' );

$text_align  = get_theme_mod( 'catch_sketch_team_text_align', 'text-aligned-center' );

$classes[] = 'team-section';
$classes[] = 'section';
$classes[] = $text_align;

?>

<div id="team-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $catch_sketch_title || '' !== $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( $catch_sketch_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
						<?php
						$subtitle = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="team-content-wrapper section-content-wrapper <?php echo esc_attr( $layout ); ?>">

			<?php
			if ( 'custom' === $catch_sketch_type ) {
				get_template_part( 'template-parts/team/content', 'custom' );
			} else {
				$i = 1;
				foreach ( $team_posts as $post ) { 
					setup_postdata( $post );

					$show_content = get_theme_mod( 'catch_sketch_team_show', 'excerpt' );
					$show_meta    = get_theme_mod( 'catch_sketch_team_meta_show', 'hide-meta' );
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php
							if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'catch-sketch-team' ); ?></a>
							</div>
							<?php endif; ?>
							<div class="entry-container">
								<header class="entry-header">
									<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

									<?php if ( 'show-meta' === $show_meta  && 'custom' !== $catch_sketch_type ) : ?>
									<div class="entry-meta">
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
								} 

								catch_sketch_team_social_links( $i );
								?>
							</div><!-- .entry-container -->
						</div> <!-- .hentry-inner -->
					</article> <!-- .article -->
				<?php
					$i++;
				}

				wp_reset_postdata();
			}
			?>

			<?php
				$target = get_theme_mod( 'catch_sketch_team_target' ) ? '_blank': '_self';
				$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_team_link', '#' );
				$text   = get_theme_mod( 'catch_sketch_team_text', esc_html__( 'View All', 'catch-sketch-pro' ) );

				if ( $text ) :
			?>

			<p class="view-all-button">
				<span class="more-button">
					<a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a>
				</span>
			</p>
			<?php endif; ?>

		</div><!-- .team-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #team-section -->
