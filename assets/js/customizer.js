/**
 * Twenty Fourteen Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
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
        wp.customize( 'notification_text', function( value ) {
		value.bind( function( to ) {
			$( '.notification-wrap p' ).text( to );
		} );
	} );
        wp.customize( 'notification_link_text', function( value ) {
		value.bind( function( to ) {
			$( '.notification-wrap .read-more' ).text( to );
		} );
	} );
         wp.customize( 'notification_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.notification-wrap .read-more' ).attr('href', to );
		} );
	} );
        wp.customize( 'facebook_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.tress-fb a' ).attr('href', to );
		} );
	} );
       wp.customize( 'twitter_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.social-links .tress-twitter a' ).attr('href', to );
		} );
	} );
        wp.customize( 'googleplus_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.social-links .tress-gplus a' ).attr('href', to );
		} );
	} );
        wp.customize( 'pinterest_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.social-links .tress-pinterest a' ).attr('href', to );
		} );
	} );
        wp.customize( 'github_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.social-links .tress-github a' ).attr('href', to );
		} );
	} );
        wp.customize( 'youtube_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.social-links .tress-youtube a' ).attr('href', to );
		} );
	} );
        wp.customize( 'header_contact', function( value ) {
		value.bind( function( to ) {
			$( '.header-contact p' ).text( to );
		} );
	} );
        wp.customize( 'slider_title_one', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 .flex-caption h2 a' ).text( to );
		} );
	} );
        wp.customize( 'slider_one', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 img' ).attr('src', to );
		} );
	} );
        wp.customize( 'slider_one_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 .flex-caption h2 a' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_one_description', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'slider_one_link_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 .flex-caption .slider-button' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_one_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 .flex-caption .slider-button' ).text( to );
		} );
	} );
         wp.customize( 'slider_two', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'slider_title_two', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 .flex-caption h2 a' ).text( to );
		} );
	} );
         wp.customize( 'slider_two_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 .flex-caption h2 a' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_two_description', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'slider_two_link_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 .flex-caption .slider-button' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_two_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#slider2 .flex-caption .slider-button' ).text( to );
		} );
	} );
         wp.customize( 'slider_three', function( value ) {
		value.bind( function( to ) {
			$( '#slider3 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'slider_title_three', function( value ) {
		value.bind( function( to ) {
			$( '#slider3 .flex-caption h2 a' ).text( to );
		} );
	} );
         wp.customize( 'slider_three_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider3 .flex-caption h2 a' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_three_description', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'slider_three_link_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider3 .flex-caption .slider-button' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_three_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#slider3 .flex-caption .slider-button' ).text( to );
		} );
	} );
         wp.customize( 'slider_four', function( value ) {
		value.bind( function( to ) {
			$( '#slider1 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'slider_title_four', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption h2 a' ).text( to );
		} );
	} );
         wp.customize( 'slider_four_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption h2 a' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_four_description', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption p' ).text( to );
		} );
	} );
         wp.customize( 'slider_four_link_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption .slider-button' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_four_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#slider4 .flex-caption .slider-button' ).text( to );
		} );
	} );
         wp.customize( 'slider_five', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'slider_title_five', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 .flex-caption h2 a' ).text( to );
		} );
	} );
        wp.customize( 'slider_five_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 .flex-caption h2 a' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_five_description', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'slider_five_link_url', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 .flex-caption .slider-button' ).attr('href', to );
		} );
	} );
         wp.customize( 'slider_five_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#slider5 .flex-caption .slider-button' ).text( to );
		} );
	} );
        wp.customize( 'tagline_title', function( value ) {
		value.bind( function( to ) {
			$( '.business-tagline h3' ).text( to );
		} );
	} );
        wp.customize( 'tagline_description', function( value ) {
		value.bind( function( to ) {
			$( '.business-tagline p' ).text( to );
		} );
	} );
        wp.customize( 'home_title', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-title h3' ).text( to );
		} );
	} );
       
         wp.customize( 'home_title_one', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-one h3' ).text( to );
		} );
	} );
        
         wp.customize( 'home_featured_one', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-one .featured-image img' ).attr('src', to );
		} );
	} );
        
         wp.customize( 'home_description_one', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-one p' ).text( to );
		} );
            } );
                
         wp.customize( 'home_one_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-one .read-more' ).attr('href', to );
		} );
	} );
        
        wp.customize( 'home_one_link_text', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-one .read-more' ).text( to );
		} );
	} );
        
         wp.customize( 'home_featured_two', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-two .featured-image img' ).attr('src', to );
		} );
	} );
        
        wp.customize( 'home_title_two', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-two h3' ).text( to );
		} );
	} );
        
         wp.customize( 'home_description_two', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-two p' ).text( to );
		} );
            } );
                
         wp.customize( 'home_two_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured .read-more' ).attr('href', to );
		} );
	} );
        
        wp.customize( 'home_two_link_text', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured .read-more' ).text( to );
		} );
	} );
        wp.customize( 'home_featured_three', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured-three .featured-image img' ).attr('src', to );
		} );
	} );
        
        wp.customize( 'home_title_three', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured h3 a' ).text( to );
		} );
	} );
        
         wp.customize( 'home_description_three', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured p' ).text( to );
		} );
            } );
                
         wp.customize( 'home_three_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured .read-more' ).attr('href', to );
		} );
	} );
        
        wp.customize( 'home_three_link_text', function( value ) {
		value.bind( function( to ) {
			$( '.home-featured .read-more' ).text( to );
		} );
	} );
        
         wp.customize( 'tress_post_title', function( value ) {
		value.bind( function( to ) {
			$( '.home-post-title h3' ).text( to );
		} );
	} );
       
        wp.customize( 'cta_title', function( value ) {
		value.bind( function( to ) {
			$( '.home-cta h3' ).text( to );
		} );
	} );
        wp.customize( 'cta_text', function( value ) {
		value.bind( function( to ) {
			$( '.home-cta p' ).text( to );
		} );
	} );
        
         wp.customize( 'home_cta_link_url', function( value ) {
		value.bind( function( to ) {
			$( '.home-cta .cta-button' ).attr('href', to );
		} );
            } );
                
         wp.customize( 'home_cta_link_text', function( value ) {
		value.bind( function( to ) {
			$( '.home-cta .cta-button' ).text( to );
		} );
	} );
       
        wp.customize( 'feedback_title', function( value ) {
		value.bind( function( to ) {
			$( '.client-feedback-title h3' ).text( to );
		} );
	} );
        wp.customize( 'tslider_one', function( value ) {
		value.bind( function( to ) {
			$( '#tslider1 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'tslider_one_description', function( value ) {
		value.bind( function( to ) {
			$( '#reviewslider #tslider1 .flex-caption p' ).text( to );
		} );
	} );
        
         wp.customize( 'client_name_one', function( value ) {
		value.bind( function( to ) {
			$( '#tslider1 .client-name a' ).text( to );
		} );
	} );
         wp.customize( 'client_name_url_one', function( value ) {
		value.bind( function( to ) {
			$( '#tslider1 .client-name a' ).attr('href', to );
		} );
            } );
        
         wp.customize( 'tslider_two', function( value ) {
		value.bind( function( to ) {
			$( '#tslider2 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'tslider_two_description', function( value ) {
		value.bind( function( to ) {
			$( '#reviewslider #tslider2 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'client_name_two', function( value ) {
		value.bind( function( to ) {
			$( '#tslider2 .client-name a' ).text( to );
		} );
	} );
         wp.customize( 'client_name_url_two', function( value ) {
		value.bind( function( to ) {
			$( '#tslider2 .client-name a' ).attr('href', to );
		} );
            } );
         wp.customize( 'tslider_three', function( value ) {
		value.bind( function( to ) {
			$( '#tslider3 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'tslider_three_description', function( value ) {
		value.bind( function( to ) {
			$( '#reviewslider #tslider3 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'client_name_three', function( value ) {
		value.bind( function( to ) {
			$( '#tslider3 .client-name a' ).text( to );
		} );
	} );
         wp.customize( 'client_name_url_three', function( value ) {
		value.bind( function( to ) {
			$( '#tslider3 .client-name a' ).attr('href', to );
		} );
            } );
        wp.customize( 'tslider_four', function( value ) {
		value.bind( function( to ) {
			$( '#tslider4 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'tslider_four_description', function( value ) {
		value.bind( function( to ) {
			$( '#reviewslider #tslider4 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'client_name_four', function( value ) {
		value.bind( function( to ) {
			$( '#tslider4 .client-name a' ).text( to );
		} );
	} );
         wp.customize( 'client_name_url_four', function( value ) {
		value.bind( function( to ) {
			$( '#tslider4 .client-name a' ).attr('href', to );
		} );
            } );
            
         wp.customize( 'tress_portfolio_title', function( value ) {
		value.bind( function( to ) {
			$( '.home-portfolio-title h3' ).text( to );
		} );
	} );
        wp.customize( 'tslider_five', function( value ) {
		value.bind( function( to ) {
			$( '#tslider5 img' ).attr('src', to );
		} );
	} );
         wp.customize( 'tslider_five_description', function( value ) {
		value.bind( function( to ) {
			$( '#reviewslider #tslider5 .flex-caption p' ).text( to );
		} );
	} );
        wp.customize( 'client_name_five', function( value ) {
		value.bind( function( to ) {
			$( '#tslider5 .client-name a' ).text( to );
		} );
	} );
         wp.customize( 'client_name_url_five', function( value ) {
		value.bind( function( to ) {
			$( '#tslider5 .client-name a' ).attr('href', to );
		} );
            } );
         wp.customize( 'tress_footer_footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.smallprint p' ).text( to );
		} );
	} );
       
} )( jQuery );