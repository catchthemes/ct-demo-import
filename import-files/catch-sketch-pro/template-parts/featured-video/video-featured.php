<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Catch_Sketch
 */
?>
<?php
$quantity = get_theme_mod( 'catch_sketch_featured_video_number', 4);

$flag = false;

for ( $i = 1; $i <= $quantity; $i++ ) { 
	$class = array();
	
	if ( 1 == $i ) {
		$class[] = 'featured';
	} else {
		$class[] = 'excerpt-video-left';
	}

	if ( 2 === $i ) : ?>
	<div class="side-posts-wrap" data-simplebar>
	<?php 
		$flag = true;
	endif; 

	$video_title = get_theme_mod( 'catch_sketch_featured_video_title_' . $i ); 
	$video_sub_title = get_theme_mod( 'catch_sketch_featured_video_sub_title_' . $i );

	if ( empty( $video_title || $video_sub_title) ) {
		$class[] = 'no-caption-video';
	}
			
?>	
	<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
		<div class="hentry-inner">
			<?php
				$catch_sketch_link = get_theme_mod( 'catch_sketch_featured_video_link_' . $i ) ? get_theme_mod( 'catch_sketch_featured_video_link_' . $i ) : '#';

				$lightbox = get_theme_mod( 'catch_sketch_featured_video_show_lightbox', 'enabled' );

				$embed_code = wp_oembed_get( esc_url( $catch_sketch_link ) );

				if ( 'enabled' === $lightbox ){
					echo '<div class="video-thumbnail post-thumbnail lightbox-enabled">
							<a class="mixed" data-flashy-type="video" href="' . esc_url( $catch_sketch_link ) . '">' . $embed_code . '</a>
						</div><!-- .video-thumbnail -->';
				} else {
					echo '<div class="video-thumbnail post-thumbnail">
							' . $embed_code . '
						</div><!-- .video-thumbnail -->';
				}
			?>

			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<span>
							<?php $video_title = get_theme_mod( 'catch_sketch_featured_video_title_' . $i ) ? get_theme_mod( 'catch_sketch_featured_video_title_' . $i ) : '';
							 echo esc_html( $video_title ); ?>	
						</span>
					</h2>
					
					<div class="entry-meta">
						<?php $video_sub_title = get_theme_mod( 'catch_sketch_featured_video_sub_title_' . $i ) ? get_theme_mod( 'catch_sketch_featured_video_sub_title_' . $i ) : '';
							 echo esc_html( $video_sub_title ); ?>
					</div><!-- .entry-meta -->
				</header>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php } // End for().
if ( $flag ) : ?>
</div>
<?php endif;
