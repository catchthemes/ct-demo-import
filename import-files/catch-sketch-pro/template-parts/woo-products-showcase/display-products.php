<?php
/**
 * The template for displaying Woo Products Showcase
 *
 * @package My Music Band
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

$enable_content = get_theme_mod( 'catch_sketch_woo_products_showcase_option', 'disabled' );

if ( ! catch_sketch_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$number         = get_theme_mod( 'catch_sketch_woo_products_showcase_number', 8 );
$columns        = get_theme_mod( 'catch_sketch_woo_products_showcase_columns', 4 );
$paginate       = get_theme_mod( 'catch_sketch_woo_products_showcase_paginate' );
$orderby        = isset( $_GET['orderby'] ) ? $_GET['orderby'] : get_theme_mod( 'catch_sketch_woo_products_showcase_orderby' );
$product_filter = get_theme_mod( 'catch_sketch_woo_products_showcase_products_filter' );
$featured       = get_theme_mod( 'catch_sketch_woo_products_showcase_featured' );
$order          = get_theme_mod( 'catch_sketch_woo_products_showcase_order' );
$skus           = get_theme_mod( 'catch_sketch_woo_products_showcase_skus' );
$category       = get_theme_mod( 'catch_sketch_woo_products_showcase_category' );

$shortcode = '[products';

if ( $number ) {
	$shortcode .= ' limit="' . esc_attr( $number ) . '"';
}

if ( $columns ) {
	$shortcode .= ' columns="' . absint( $columns ) . '"';
}

if ( $paginate ) {
	$shortcode .= ' paginate="' . esc_attr( $paginate ) . '"';
}

if ( $orderby ) {
	$shortcode .= ' orderby="' . esc_attr( $orderby ) . '"';
}

if ( $order ) {
	$shortcode .= ' order="' . esc_attr( $order ) . '"';
}

if ( $product_filter && 'none' !== $product_filter ) {
	$shortcode .= ' ' . esc_attr( $product_filter ) . '="true"';
}

if ( $skus ) {
	$shortcode .= ' skus="' . esc_attr( $skus ) . '"';
}

if ( $category ) {
	$shortcode .= ' category="' . esc_attr( $category ) . '"';
}

if ( $featured ) {
	$shortcode .= ' visibility="featured"';
}

$shortcode .= ']';

$catch_sketch_title     = get_theme_mod( 'catch_sketch_woo_products_showcase_headline', esc_html__( 'Our Store', 'catch-sketch-pro' ) );
$sub_title = get_theme_mod( 'catch_sketch_woo_products_showcase_subheadline', esc_html__( 'Order Online', 'catch-sketch-pro' ) );

$classes[] = 'product-section section';

$round_product_image = get_theme_mod( 'catch_sketch_woo_products_round_thumbnail' );

if ( $round_product_image ) {
   $classes[] = 'round-product-image';
}

$round_product_image = get_theme_mod( 'catch_sketch_woo_products_border' );

if ( $round_product_image ) {
   $classes[] = 'product-border';
}

?>

<div id="product-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $catch_sketch_title || $sub_title ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
				<?php if ( '' != $catch_sketch_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_sketch_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
					<?php
						$description = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
					?>
					</div><!-- .section-description -->
				<?php endif; ?>


			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper product-content-wrapper">
			<?php echo do_shortcode( $shortcode ); ?>
			<?php
				$target = get_theme_mod( 'catch_sketch_woo_products_showcase_target' ) ? '_blank': '_self';
				$catch_sketch_catlink   = get_theme_mod( 'catch_sketch_woo_products_showcase_link', get_permalink( wc_get_page_id( 'shop' ) ) );
				$text   = get_theme_mod( 'catch_sketch_woo_products_showcase_text', esc_html__( 'Go to Shop Page', 'catch-sketch-pro' ) );

				if ( $text ) :
			?>
				<p class="view-all-button">
					<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_sketch_catlink ); ?>"><?php echo esc_html( $text ); ?></a></span>
				</p>
			<?php endif; ?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .sectionr -->
