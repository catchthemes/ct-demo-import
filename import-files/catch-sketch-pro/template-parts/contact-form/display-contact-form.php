<?php
/**
 * The template for displaying Contact Info
 *
 * @package Catch_Sketch
 */
?>

<?php 
	$enable_form   = get_theme_mod( 'catch_sketch_contact_form_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_form ) ) {
	// Bail if featured content is disabled.
	return;
}

$layout = 'layout-one';

$section_title     = get_theme_mod( 'catch_sketch_contact_form_archive_title', 'Contact Form' );
$section_sub_title = get_theme_mod( 'catch_sketch_contact_form_sub_title' );

?> 	
	<div id="contact-form-section" class="contact-form section">
		<div class="wrapper">
			<?php if ( '' !== $section_title || $section_sub_title ) : ?>
				<div class="section-heading-wrapper featured-section-headline">
					<?php if ( '' !== $section_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo wp_kses_post( $section_title ); ?></h2>
						</div>
					<?php endif; ?>

					<?php if ( '' !== $section_sub_title ) : ?>
						<div class="section-description-wrapper section-subtitle">
							<?php echo wp_kses_post( $section_sub_title ); ?>
						</div><!-- .section-description-wrapper -->
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="section-content-wrapper contact-content-wrapper <?php echo esc_attr( $layout ); ?>">
			<?php
				$catch_sketch_type     = get_theme_mod( 'catch_sketch_contact_form_type', 'page' ); 
				$catch_sketch_title    = get_theme_mod( 'catch_sketch_contact_form_title' ); ?>
				<article class="hentry contact-us-form">
					<div class="entry-container">
					<?php if ( $catch_sketch_title ) : ?>
						<header class="entry-header">
							<h2 class="entry-title "><?php echo esc_html( $catch_sketch_title ); ?></h2>
						</header>
					<?php endif; ?>
					<?php
					$inner_content = '';

					if ('post' === $catch_sketch_type && 'publish' === get_post_status( get_theme_mod( 'catch_sketch_contact_form_post' ) ) ) {
						$post_object = get_post( get_theme_mod( 'catch_sketch_contact_form_post' ) );

						$inner_content = apply_filters( 'the_content', $post_object->post_content );
					} elseif ( 'page' === $catch_sketch_type  && 'publish' === get_post_status( get_theme_mod( 'catch_sketch_contact_form_page' ) ) ) {
						$post_object = get_post( get_theme_mod( 'catch_sketch_contact_form_page' ) );

						$inner_content = apply_filters( 'the_content', $post_object->post_content );
					} elseif ( 'custom' === $catch_sketch_type ) {

						$inner_content = get_theme_mod( 'catch_sketch_contact_form_custom' );
					}
					?>

						<div class="entry-content">
							<?php echo do_shortcode( $inner_content );?> 
						</div>
					</div>
				</article><!-- .hentry -->	
			</div>
		</div><!-- .wrapper -->
	</div><!-- .section -->
