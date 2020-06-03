<?php
/**
 * Primary Menu Template
 *
 * @package Catch_Sketch
 */
$enable_search = get_theme_mod( 'catch_sketch_display_primary_search', 1 );

?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">

		<div class="header-overlay"></div>

		<div class="menu-toggle-wrapper">
			<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<div class="menu-bars">
					<div class="bars bar1"></div>
	  				<div class="bars bar2"></div>
	  				<div class="bars bar3"></div>
  				</div>
				<span class="menu-label"><?php echo esc_html_e( 'Menu', 'catch-sketch-pro' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<?php
				if( function_exists( 'catch_sketch_header_cart' ) ) {
					catch_sketch_header_cart();
				}
				?>

				<?php get_template_part( 'template-parts/header/header', 'navigation' ); ?>

				<?php if ( has_nav_menu( 'social' ) || get_theme_mod( 'catch_sketch_display_primary_search', 1 ) ) : ?>
					<div class="mobile-social-search">
						<?php if ( get_theme_mod( 'catch_sketch_display_primary_search', 1 ) ) : ?>
						<div class="search-container">
							<?php get_search_form(); ?>
						</div>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'catch-sketch-pro' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'container'       => 'div',
										'container_class' => 'menu-social-container',
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
										'depth'          => 1,
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>

					</div><!-- .mobile-social-search -->
				<?php endif; ?>
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->

	<?php 
	$primary_menu_position = get_theme_mod( 'catch_sketch_menu_alignment', 'right' );

	if ( 'center' == $primary_menu_position ) : ?>
		<div class="search-social-cart-wrapper"> 
	<?php endif; ?>		

	<?php if ( get_theme_mod( 'catch_sketch_display_primary_search', 1 ) ) : ?>
		<div class="search-social-container">
			<div id="primary-search-wrapper" class="menu-wrapper">
				<div class="menu-toggle-wrapper">
					<button id="social-search-toggle" class="menu-toggle">
						<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'catch-sketch-pro' ); ?></span>
					</button>
				</div><!-- .menu-toggle-wrapper -->

				<div class="menu-inside-wrapper">
					<div class="search-container">
						<?php get_Search_form(); ?>
					</div>
				</div><!-- .menu-inside-wrapper -->
			</div><!-- #social-search-wrapper.menu-wrapper -->
		</div> <!-- .search-social-container -->
		<?php endif; ?>

		<?php get_template_part( 'template-parts/header/social', 'header' ); ?>

		<?php if ( get_theme_mod( 'catch_sketch_display_primary_cart' ) ) :

			if( function_exists( 'catch_sketch_header_cart' ) ) {
				catch_sketch_header_cart();
			}
		endif;
	if ( 'center' == $primary_menu_position ) : ?>
		</div> <!-- .search-social-cart-wrapper -->
	<?php endif; ?>	
</div><!-- .site-header-menu -->


