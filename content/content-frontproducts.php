<?php
/**
 * The template for displaying Woocommerce featured products on Front Page 
 *
 * @package Tress
 * @since Tress 1.0
 */
?>

<?php
// check if woocommerce is active

if (class_exists('woocommerce')) {

    // check if user has enabled featured products for front page
    if (get_theme_mod('tress_woo_front_featured_products')) {
        ?>

        <div id="home-product-container">
            <div class="section-title">
                        <?php if (get_theme_mod('tress_woo_front_featured_title')) : ?>
                        <h3 class="featured-edd-title">
                        <?php echo (get_theme_mod('tress_woo_front_featured_title')); ?>
                        </h3>  
                    </div>
            <div class="home-products clearfix" role="main">

                <div class="col grid_12_of_12">
                    
                    <?php endif; ?>

                    <?php
                    $per_page = intval(get_theme_mod('tress_woo_store_front_count'));
                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $per_page,
                    );
                    $products = new WP_Query($product_args);
                    ?>
                    <?php if ($products->have_posts()) : $i = 1; ?>
            <?php while ($products->have_posts()) : $products->the_post(); ?>
                            <div class="col grid_4_of_12 home-product">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="home-product-title"><?php the_title(); ?></h3>
                                </a>
                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('product-image-thumb'); ?>
                                    </a>
                                    <div class="home-product-info">
                                          
                                            <div class="product-buttons">
                                                
                                                <a href="<?php the_permalink(); ?>" class="product-details-link"><?php esc_html_e('View Details', 'tress'); ?></a>
                                            </div><!--end .product-buttons-->
              
                                    </div> <!--end .home-product-info -->
                                </div> <!--end .product-image -->
                            </div><!--end .product-->
                            <?php $i+=1; ?>
                        <?php endwhile; ?>
        <?php else : ?>

                        <h2 class="center"><?php esc_html_e('Not Found', 'tress'); ?></h2>
                        <p class="center"><?php esc_html_e('Sorry, but you are looking for something that is not here', 'tress'); ?></p>
                        <?php get_search_form(); ?>

        <?php endif; ?>

                </div> <!-- /.col.grid_12_of_12 -->

                <p class="tress-store-button"><a class="cta-button" href="<?php echo esc_url(get_theme_mod('tress_woo_store_link_url')); ?>"><?php echo esc_html(get_theme_mod('tress_woo_store_link_text')); ?></a></p>

            </div><!-- /#primary.site-content.row -->

        </div><!-- /#maincontentcontainer -->

    <?php } // end featured products on front page check  ?>

<?php } // end woocommerce Check   ?> 