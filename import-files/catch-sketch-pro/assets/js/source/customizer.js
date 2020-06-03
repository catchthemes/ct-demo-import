	/**
	 * File customizer.js.
	 *
	 * Theme Customizer enhancements for a better user experience.
	 *
	 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
	 */

	( function( $ ) {
		var style = $( '#catch-sketch-color-scheme-css' ),
			api = wp.customize;

		if ( ! style.length ) {
			style = $( 'head' ).append( '<style type="text/css" id="catch-sketch-color-scheme-css" />' )
								.find( '#catch-sketch-color-scheme-css' );
		}

		// Site title and description.
		wp.customize( 'blogname', function( value ) {
			value.bind( function( to ) {
				$( '.site-title a' ).text( to );
			} );
		} );
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( to ) {
				$( '.site-description' ).text( to );
			} );
		} );

		// Header text color.
		wp.customize( 'header_textcolor', function( value ) {
			value.bind( function( to ) {
				if ( 'blank' === to ) {
					$( '.site-identity' ).css( {
						'clip': 'rect(1px, 1px, 1px, 1px)',
						'position': 'absolute'
					} );
				} else {
					$( '.site-identity' ).css( {
						'clip': 'auto',
						'position': 'relative'
					} );
					$( '.site-title a' ).css( {
						'color': to
					} );

					var c;

					if( /^#([A-Fa-f0-9]{3}){1,2}$/.test( to ) ){
						c= to.substring(1).split('');
						if(c.length== 3){
							c= [c[0], c[0], c[1], c[1], c[2], c[2]];
						}
						c= '0x'+c.join('');
						to_rgb = 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',.8)';
					}

					$( '.site-description' ).css( {
						'color': to_rgb
					} );

				}
			} );
		} );

		// Color Scheme CSS.
		api.bind( 'preview-ready', function() {
			api.preview.bind( 'update-color-scheme-css', function( css ) {
				style.html( css );
			} );
		} );

		// Header text color.
		api( 'color_scheme', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).removeClass( 'color-scheme-default color-scheme-dark color-scheme-gray color-scheme-red color-scheme-yellow' );
				$( 'body' ).addClass( 'color-scheme-' + to );
			});
		});
	} )( jQuery );
