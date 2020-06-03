<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Sketch
 */
?>

<?php
$enable = get_theme_mod( 'catch_sketch_contact_option', 'disabled' );
$contact_layout = get_theme_mod( 'catch_sketch_contact_layout', 'default' );

if ( ! catch_sketch_check_section( $enable ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_sketch_type          = get_theme_mod( 'catch_sketch_contact_type', 'category' );
$social_title  = get_theme_mod( 'catch_sketch_contact_social_title', esc_html__( 'Follow Us', 'catch-sketch-pro' ) );
$catch_sketch_title = get_theme_mod( 'catch_sketch_contact_title', esc_html__( 'Say Hello', 'catch-sketch-pro' ) );
$description   = get_theme_mod( 'catch_sketch_contact_description' );
$phone_label   = get_theme_mod( 'catch_sketch_contact_phone_label' );
$phone         = get_theme_mod( 'catch_sketch_contact_phone', '123-456-7890' );
$email_label   = get_theme_mod( 'catch_sketch_contact_email_label' );
$email         = get_theme_mod( 'catch_sketch_contact_email', 'someone@somewhere.com' );
$address_label = get_theme_mod( 'catch_sketch_contact_address_label' );
$address       = get_theme_mod( 'catch_sketch_contact_address', 'Boston, MA, USA' );
$catch_sketch_map           = get_theme_mod( 'catch_sketch_contact_map', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/contact-map.jpg' );

$contact_show = false;
$items        = 0;

if ( $phone || $email || $address ) {
	$contact_show = true;
}

if ( $contact_show ) {
	if ( $phone ) {
		$items++;
	}

	if ( $email ) {
		$items++;
	}

	if ( $address ) {
		$items++;
	}

	if ( 1 === $items ) {
		$layout = 'one-column';
	} elseif ( 2 === $items ) {
		$layout = 'two-columns';
	} elseif ( 3 === $items ) {
		$layout = 'three-columns';
	}
}

$class = '';
if( 'full-width' == $contact_layout ) {
	$class = 'full-width-layout';
}

$custom_code = get_theme_mod( 'catch_sketch_footer_contact_custom_code' );
$catch_sketch_map_type 	= get_theme_mod( 'catch_sketch_contact_map_type', 'image' );
$catch_sketch_map_link   = get_theme_mod( 'catch_sketch_contact_map_link' );
$catch_sketch_map_target = get_theme_mod( 'catch_sketch_contact_map_target' ) ? '_blank' : '_self';
?>

<div id="contact-section" class="contact-section section<?php echo ! $catch_sketch_map ? ' no-image' : ''; ?> <?php echo esc_attr( $class ); ?>">
	<div class="wrapper">
		<div class="section-content-wrap">
			<article class="hentry">
				<div class="hentry-inner">
					<div class="entry-container">
						<?php if ( $catch_sketch_title || $description ) : ?>
							<header class="entry-header">
								<h2 class="entry-title">
									<?php if ( $catch_sketch_title ) : ?>
										<?php echo wp_kses_post( $catch_sketch_title ); ?>
									<?php endif; ?>

								<?php if ( $description ) : ?>
									<span>
										<?php echo esc_html( $description ); ?>
									</span><!-- .section-description -->
								<?php endif; ?>

								</h2>
							</header><!-- .entry-header -->
						<?php endif; ?>

						<div class="entry-content">
							<?php if ( $contact_show ) : ?>
								<div class="contact-info-details contact-information">
									<ul class="contact-details <?php echo esc_attr( $layout ? ' ' . $layout : '' ); ?>">

										<?php if ( $email || $email_label ) : ?>
											<li>
											<?php if ( $email ) : ?>
												<span class="envelop">

													<i class="contact-icon fa fa-envelope"></i>

													<span class="contact-wrap">
														<?php if ( $email_label ) : ?>
															<span class="contact-label"><?php echo esc_html( $email_label ); ?></span>
														<?php endif; ?>
														<a target="_blank" title="<?php echo esc_attr( antispambot( $email ) ); ?>" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>">
															<span><?php echo esc_html( antispambot( $email ) ); ?></span>
														</a>
													</span> <!-- .contact-wrap -->
												</span>
											<?php endif; ?>
											</li><!-- #contact-item -->
										<?php endif; ?>

										<?php if ( $phone || $phone_label ) : ?>
										<li>
											<?php if ( $phone ) : ?>
												<span class="contact">
														<i class="fa fa-phone"></i>

														<span class="contact-wrap">
															<?php if ( $phone_label ) : ?>
																<span class="contact-label"><?php echo esc_html( $phone_label ); ?></span>
															<?php endif; ?>
															<a target="_blank" title="<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>">
																<span><?php echo esc_html( $phone ); ?></span>
															</a>
														</span> <!-- .contact-wrap -->
												</span>
											<?php endif; ?>
										</li><!-- #contact-item -->
										<?php endif; ?>

										<?php if ( $address || $address_label ) : ?>
										<li>
											<?php if ( $address ) : ?>
												<span class="address">

														<i class="fa fa-map-marker" aria-label="Icon Address"></i>

														<span class="contact-wrap">
															<?php if ( $address_label ) : ?>
																<span class="contact-label"><?php echo esc_html( $address_label ); ?></span>
															<?php endif; ?>

															<?php
													$address_link = get_theme_mod( 'catch_sketch_contact_address_link' );

													if ( $address_link ) :
														$address_target = get_theme_mod( 'catch_sketch_contact_address_target' ) ? '_blank' : '_self';
													?>
													<a target="<?php echo $address_target; // WPCS ok. ?>" href="<?php echo esc_url( $address_link ); ?>">
													<?php endif; ?>

															<span><?php echo esc_html( $address ); ?></span>
													<?php if ( $address_link ) : ?>
													</a>
														</span> <!-- .contact-wrap -->
													<?php endif; ?>
												</span>
											<?php endif; ?>
										</li><!-- #contact-item -->
										<?php endif; ?>
									</ul>
								</div><!-- .contact-info-details -->
							<?php endif; ?>

	
							
							<?php if ( has_nav_menu( 'social-contact' ) ) : ?>
								<div class="contact-info-details stay-connected">
								<?php if ( $social_title ) : ?>
									<p><?php echo wp_kses_post( $social_title ); ?></p>
								<?php endif; ?>
									<nav class="social-navigation" role="navigation" aria-label="Contact Info Details Stay Connected">
										<?php
											wp_nav_menu( array(
												'theme_location' => 'social-contact',
												'menu_class'     => 'social-links-menu',
												'depth'          => 1,
												'link_before'    => '<span class="screen-reader-text">',
												'link_after'     => '</span>',
											) );
										?>
									</nav><!-- .social-navigation -->
								</div><!-- .contact-info-details -->
							<?php endif; ?>
						</div><!-- .entry-content -->
					</div><!-- .entry-container -->

					<?php if ( 'image' == $catch_sketch_map_type ) :  ?>
					<div class="post-thumbnail contact-map" style="background-image: url( <?php echo ($catch_sketch_map); ?> )">	
						<a class="cover-link" href="<?php echo esc_url( $catch_sketch_map_link ); ?>" target="<?php echo  $catch_sketch_map_target; ?>">
						</a>	
					</div><!-- .contact-map -->
			
					<?php elseif( 'custom-code' == $catch_sketch_map_type ) : ?>
						<div class="post-thumbnail contact-map">
							<figure class="google-maps">
							<?php	// Removed escaping as wp_kses_post() removes all iframes and shortcodes, add when better escaping function is found.
								 echo $custom_code; ?>
							</figure>
						</div><!-- .contact-map -->
					<?php endif; ?>
				</div>
			</article> <!-- article -->

		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div> <!-- #contact-section -->
