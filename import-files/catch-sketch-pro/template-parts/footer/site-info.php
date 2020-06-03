<div id="site-generator">
	<div class="wrapper">

		<?php get_template_part( 'template-parts/footer/social', 'footer' ); ?>

		<div class="site-info">
			<?php
		        $theme_data = wp_get_theme();

		        $def_footer_text = sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'catch-sketch-pro' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'catch-sketch-pro' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';

		        $footer_text = get_theme_mod( 'catch_sketch_footer_content', $def_footer_text );

		        $search_items = array( '[the-year]', '[site-link]', '[privacy-policy-link]' );

		        // @remove Remove this check when WP 5.5 is released
		        if ( function_exists( 'wp_date' ) ) {
		        	$date = wp_date( __( 'Y', 'catch-sketch-pro' ) );
		        } else {
		        	$date = date_i18n( __( 'Y', 'catch-sketch-pro' ) );
		        }

		        $replace = array( esc_attr( $date ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() );

		        $footer_text =  str_replace( $search_items, $replace, $footer_text );

		        echo wp_kses_post( $footer_text );
		    ?>
		</div> <!-- .site-info -->
	</div> <!-- .wrapper -->
</div><!-- .site-info -->
