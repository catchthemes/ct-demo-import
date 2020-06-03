<?php
if ( ! get_theme_mod( 'catch_sketch_display_primary_search', 1 ) ) {
	// Disable Search on header top.
	return false;
}
?>
<div class="search-content-wrapper-top menu-wrapper">
	<div id="search-toggle" class="menu-toggle">
		<a href="#" class="fa fa-search"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'catch-sketch-pro' ); ?></span></a>
		<a href="#" class="fa fa-times"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'catch-sketch-pro' ); ?></span></a>
	</div>

	<div id="search-container">
		<?php get_search_form(); ?>
	</div><!-- #search-container -->
</div> <!-- .search-content-wrapper -->
