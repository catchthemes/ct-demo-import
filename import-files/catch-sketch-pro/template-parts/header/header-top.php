<?php
/**
 * Display Header Top
 *
 * @package Catch_Sketch
 */

if ( ! get_theme_mod( 'catch_sketch_header_top' ) ) {
	// Bail if header top is disabled.
	return;
}

$phone = get_theme_mod( 'catch_sketch_phone', '+123-456-6780' );
$email = get_theme_mod( 'catch_sketch_email', 'info@example.com' );
$hours = get_theme_mod( 'catch_sketch_hours', esc_html__( '10:00 AM - 6:00 PM (Mon-Fri)', 'catch-sketch-pro' ) );

$address        = get_theme_mod( 'catch_sketch_address', esc_html__( 'Baltimore, USA', 'catch-sketch-pro' ) );
$address_link   = get_theme_mod( 'catch_sketch_address_link', '#' );
$address_target = get_theme_mod( 'catch_sketch_address_target' ) ? '_blank' : '_self';


$quote        = get_theme_mod( 'catch_sketch_quote', esc_html__( 'Request a Quote', 'catch-sketch-pro' ) );
$quote_link   = get_theme_mod( 'catch_sketch_quote_link', '#' );
$quote_target = get_theme_mod( 'catch_sketch_quote_target' ) ? '_blank' : '_self';

$email_label = get_theme_mod( 'catch_sketch_email_label' );
$phone_label = get_theme_mod( 'catch_sketch_phone_label' );
$hours_label = get_theme_mod( 'catch_sketch_hours_label' );
$address_label = get_theme_mod( 'catch_sketch_address_label' );

if ( ( ! has_nav_menu( 'social-top' ) && ! $phone && ! $email && ! $address && ! $address_link && ! $hours && ! $quote && ! $quote_link ) ) {
	// Bail if all elements in header top is disabled.
	return;
}



if ( has_nav_menu(  'social-top' ) && ( $phone || $email || $address || $address_link || $hours || $quote || $quote_link ) ) {
	$class = 'layout-two';
}

?>

<div id="header-top" class="header-top-bar">
	<div class="wrapper">
		<div class="header-top-content <?php echo $class; // WPCS: XSS OK. ?>">
			<?php if ( $phone || $email || $address || $address_link || $hours || $quote || $quote_link ) : ?>
			<div class="header-top-left-content">
				<div class="top-contact-information">
					<ul>
						<?php if ( $phone ) : ?>
						<li>
							<span class="phone">
								<a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $phone ) ); ?>">
									<i class="fa fa-phone" aria-hidden="true"></i>
									<?php if ( $phone_label) : ?>
										<?php echo esc_html( $phone_label ); ?>
									<?php endif; ?>	
									<span><?php echo esc_attr( $phone ); ?></span></a>
							</span>
						</li>
						<?php endif; ?>

						<?php if ( $email ) : ?>
						<li>
							<span class="envelope">
								<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>">
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
									<?php if ( $email_label) : ?>
										<?php echo esc_html( $email_label ); ?>
									<?php endif; ?>	
									<span><?php echo esc_attr( antispambot( $email ) ); ?></span></a>
							</span>
						</li>
						<?php endif; ?>

						<?php if ( $hours ) : ?>
						<li>
							<span class="hours">
								<i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php if ( $hours_label) : ?>
									<?php echo esc_html( $hours_label ); ?>
								<?php endif; ?>	
								<span><?php echo esc_attr( $hours ); ?></span>
								<span class="mobile-hours"><?php echo esc_attr( $hours ); ?></span>
							</span>
						</li>
						<?php endif; ?>

						<?php if ( $address ) : ?>
						<li>
							<span class="address">
								<a href="<?php echo esc_url( $address_link );?>" target="<?php echo $address_target; // WPCS: ok. ?>"><i class="fa fa-map-marker" aria-hidden="true"></i>
								<?php if ( $address_label) : ?>
									<?php echo esc_html( $address_label ); ?>
								<?php endif; ?>	
								<span><?php echo esc_attr( $address ); ?></span></a>
							</span>
						</li>
						<?php endif; ?>

						<?php if ( $quote ) : ?>
						<li>
							<span class="request-quote">
								<a href="<?php echo esc_url( $quote_link );?>" target="<?php echo $quote_target; // WPCS: ok. ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span><?php echo esc_attr( $quote ); ?></span></a>
							</span>
						</li>
						<?php endif; ?>
					</ul>
				</div>
			</div> <!-- .header-top-left-content -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social-top' ) ) : ?>
				<div class="header-top-right-content">
					<div class="social-navigation-wrapper">
						<div class="site-social">
							<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'catch-sketch-pro' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location'  => 'social-top',
									'container'       => 'div',
									'container_class' => 'menu-social-container',
									'depth'           => 1,
									'link_before'     => '<span class="screen-reader-text">',
									'link_after'      => '</span>'
								) );
							?>
							</nav><!-- .social-navigation -->
						</div> <!-- site-social -->
					</div> <!-- .social-navigation-wraper -->
				</div> <!-- .header-top-left-content -->
			<?php endif; ?>
		</div> <!-- .header-top-conten -->
	</div> <!-- .wrapper -->
</div><!-- .header-top-bar -->
