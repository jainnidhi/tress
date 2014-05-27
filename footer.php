<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package Tress
 * @since Tress 1.0
 */
?>

<div id="footercontainer">

    <?php
    // Count how many footer sidebars are active so we can work out how many containers we need
    $footerSidebars = 0;
    for ($x = 1; $x <= 4; $x++) {
        if (is_active_sidebar('sidebar-footer' . $x)) {
            $footerSidebars++;
        }
    }

    // If there's one or more one active sidebars, create a row and add them
    if ($footerSidebars > 0) {
        ?>
        <footer class="site-footer row" role="contentinfo">
            <?php
            // Work out the container class name based on the number of active footer sidebars
            $containerClass = "grid_" . 12 / $footerSidebars . "_of_12";

            // Display the active footer sidebars
            for ($x = 1; $x <= 4; $x++) {
                if (is_active_sidebar('sidebar-footer' . $x)) {
                    ?>
                    <div id="<?php echo 'footer-widget' . $x; ?>" class="col <?php echo $containerClass ?>">
                        <div class="widget-area" role="complementary">
                    <?php dynamic_sidebar('sidebar-footer' . $x); ?>
                        </div>
                    </div> <!-- /.col.<?php echo $containerClass ?> -->
            <?php }
        }
        ?>
        </footer> <!-- /.site-footer.row -->
<?php } ?>

    <div class="footer-wrap clearfix">
        <div class="footer-wrap-container">
        <?php if (get_theme_mod('tress_footer_footer_text') == '') { ?>
            <div class="smallprint">
                <p>
                    <a href="<?php $my_theme = wp_get_theme(); echo $my_theme->get( 'ThemeURI' ); ?>">
                        <?php _e('Tress WordPress theme by IdeaBox', 'tress'); ?>
                    </a>
                </p>
            </div>
        <?php } else { ?>   
                    <div class="smallprint"><?php echo wpautop(esc_html(get_theme_mod('tress_footer_footer_text'))); ?></div>
        <?php } ?> 
                    <div class="footer-extras">
                         <div class="social-links">
                                <ul>
                                    <?php if (get_theme_mod('facebook_link_url')) { ?>
                                        <li class="tress-fb"><a href="<?php echo get_theme_mod('facebook_link_url'); ?>"></a></li>
                                    <?php } ?>
                                    <?php if(get_theme_mod('twitter_link_url')) { ?>
                                        <li class="tress-twitter"><a href="<?php echo  get_theme_mod('twitter_link_url'); ?>"></a></li>
                                    <?php } ?>
                                    <?php if(get_theme_mod('googleplus_link_url')) { ?>
                                        <li class="tress-gplus"><a href="<?php echo get_theme_mod('googleplus_link_url'); ?>"></a></li>
                                    <?php } ?>
                                    <?php if( get_theme_mod('pinterest_link_url')) { ?>
                                        <li class="tress-pinterest"><a href="<?php echo get_theme_mod('pinterest_link_url'); ?>"></a></li>
                                    <?php } ?>
                                    <?php if (get_theme_mod('github_link_url')) { ?>
                                        <li class="tress-github"><a href="<?php echo get_theme_mod('github_link_url'); ?>"></a></li>
                                    <?php } ?>
                                    <?php if(get_theme_mod('youtube_link_url')) { ?>
                                        <li class="tress-youtube"><a href="<?php echo get_theme_mod('youtube_link_url'); ?>"></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                    </div> 
        </div>
    </div> <!-- /.footer-wrap -->
</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
</body>

</html>
