<?php
global $edd_options;

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package Prism
 * @since Prism 1.0
 */
?>
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <!DOCTYPE html>
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>>
    <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9" <?php language_attributes(); ?>>
    <![endif]-->
    <!--[if !(IE 7) | !(IE 8)  ]><!-->
    <html <?php language_attributes(); ?>>
        <!--<![endif]-->
        <head>
            <meta charset="<?php bloginfo('charset'); ?>" />
            <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

            <title><?php wp_title('|', true, 'right'); ?></title>
            <meta http-equiv="cleartype" content="on">

            <!-- Responsive and mobile friendly stuff -->
            <meta name="HandheldFriendly" content="True">
            <meta name="MobileOptimized" content="320">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="profile" href="http://gmpg.org/xfn/11" />
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


            <?php wp_head(); ?>
        </head>

        <body <?php body_class(); ?>>
            
             <div class="notification-bar">
                    <div class="notification-wrap clearfix">
                        <div class="col grid_6_of_12 notification-text">
                                <?php if ( get_theme_mod('home_description_two') !='' ) {  ?>
                                <p><?php echo esc_html(get_theme_mod('home_description_two')); ?></p>
                               <?php } else { ?>
                              <p><?php esc_html_e('This is the notification text block.', 'prism') ?> </p>
                                 <?php } ?>
                        </div>
                        <div class="col grid_6_of_12 notification-link last">
                            <a class="read-more" href="<?php if ( get_theme_mod('notification_link_url') !='' ) { echo esc_url(get_theme_mod('notification_link_url')); } ?>">
                           <?php if ( get_theme_mod('notification_link_text') !='' ) {  ?><?php echo esc_html(get_theme_mod('notification_link_text')); ?>
                             <?php } else {  ?> <?php esc_html_e('Read More', 'prism') ?>
                           <?php } ?></a>
                        </div>
                    </div>
                </div>
            
            <div id="wrapper" class="hfeed site">

                <div class="visuallyhidden skip-link"><a href="#primary" title="<?php esc_attr_e('Skip to main content', 'prism'); ?>"><?php esc_html_e('Skip to main content', 'prism'); ?></a></div>
         
                <div class="social-wrapper">
                    <div class="header-contact clearfix">
                        <div class="col grid_6_of_12">
                            <?php if (get_theme_mod('header_contact') != '') { ?>
                                <p><i class="fa fa-phone"></i><?php echo esc_html(get_theme_mod('header_contact')); ?></p>
                            <?php } else { ?>
                                <p><i class="fa fa-phone"></i><?php esc_html_e('Call us on  24x7: 800-555-0101', 'prism') ?> </p>
                            <?php } ?>
                        </div>
                        <div class="col grid_6_of_12 social-icons-container last"> 
                            <div class="social-links clearfix">
                                <ul id="header-social-links" class="clearfix">
                                    <?php if (get_theme_mod('facebook_link_url')) { ?>
                                        <li class="prism-fb"><a href="<?php echo esc_url(get_theme_mod('facebook_link_url')); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('twitter_link_url')) { ?>
                                        <li class="prism-twitter"><a href="<?php echo esc_url(get_theme_mod('twitter_link_url')); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('googleplus_link_url')) { ?>
                                        <li class="prism-gplus"><a href="<?php echo esc_url(get_theme_mod('googleplus_link_url')); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('pinterest_link_url')) { ?>
                                        <li class="prism-pinterest"><a href="<?php echo esc_url(get_theme_mod('pinterest_link_url')); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('github_link_url')) { ?>
                                        <li class="prism-github"><a href="<?php echo esc_url(get_theme_mod('github_link_url')); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('youtube_link_url')) { ?>
                                        <li class="prism-youtube"><a href="<?php echo esc_url(get_theme_mod('youtube_link_url')); ?>"></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div><!-- /.header-extras -->
                    </div>
                </div>
                <div id="headercontainer" class="fxd">

                    <header id="masthead" class="site-header row" role="banner">
                        <div class="col grid_4_of_12 header-title">
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">
                                    <?php echo get_bloginfo('name'); ?>	
                                </a>
                            </h1>
                            <p class="site-description"> 
                                <?php echo get_bloginfo('description'); ?>
                            </p>

                            <?php if (get_header_image()) : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                            <?php endif; ?>
                        </div> <!-- /.col.grid_6_of_12 -->

                        <div class="col grid_8_of_12 header-extras last"> 
                            
                        </div><!-- /.header-extras -->
                    </header> <!-- /#masthead.site-header.row -->
                    <div class="nav-container">
                        <nav id="site-navigation" class="main-navigation clearfix" role="navigation">
                                 <?php if(!is_front_page() || get_theme_mod('prism_one_page_nav_check')) {
                                  wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'primary-menu', 'container_class' => 'menu')); 
                                 }
                                 else { ?>
                                <div id="home-top-nav" class="home-menu">
                                        <ul class="home-navigation">
                                            <li id="m1" class="page_item"><a class="scrollSmint" href="#main-slider" id="social-wrapper">Home</a></li>
                                            <li id="m2" class="page_item"><a class="scrollSmint" href="#featured-title" id="home-featured-title-area"><?php if ( get_theme_mod('home_menu_title') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_menu_title')); ?>
                                                                <?php } else {  ?> <?php esc_html_e('Theme Features', 'prism') ?>
                                                                                                    <?php } ?></a></li>
                                            <li id="m3" class="page_item"><a class="scrollSmint" href="#post-title" id="home-post-title-area"><?php if ( get_theme_mod('prism_post_menu_title') !='' ) {  ?><?php echo esc_html(get_theme_mod('prism_post_menu_title')); ?>
                                                                <?php } else {  ?> <?php esc_html_e('Recent Blogs', 'prism') ?>
                                                                                                    <?php } ?></a></li>
                                            <li id="m4" class="page_item"><a class="scrollSmint" href="#feedback-title" id="client-feedback-area"><?php if ( get_theme_mod('feedback_menu_title') !='' ) {  ?><?php echo esc_html(get_theme_mod('feedback_menu_title')); ?>
                                                                <?php } else {  ?> <?php esc_html_e('Client Feedbacks', 'prism') ?>
                                                                                                    <?php } ?></a></li>

                                            <li id="m5" class="page_item"><a class="scrollSmint" href="#contact-title" id="home-contact-area"><?php if ( get_theme_mod('home_menu_contact_title') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_menu_contact_title')); ?>
                                                                <?php } else {  ?> <?php esc_html_e('Contact', 'prism') ?>
                                                                                                    <?php } ?></a></li>
                                        </ul>
                                    </div>
                                <?php } ?>
                                
                                <div id="mobile-menu"></div>
                            </nav> <!-- /.site-navigation.main-navigation -->
                    </div>

                </div> <!-- /#headercontainer -->
