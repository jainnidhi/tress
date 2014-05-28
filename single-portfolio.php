<?php get_header(); ?>

<div id="maincontentcontainer">
    <div class="site-content row">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
               
                    <div class="col grid_8_of_12">
                        <div class="content">							

                            <div id="post-<?php the_ID(); ?>" <?php post_class('entry portfolio-content'); ?>>
                                 <h1 class="entry-title"><?php the_title(); ?></h1>

                                <?php the_post_thumbnail('post_feature_thumb'); ?>

                            </div><!--end .product-content.entry-->
                            <div class="content-des">
                                <?php the_content(__('Read the rest of this entry &raquo;','tress')); ?>
                            </div>


                        </div><!--end .content-->

                    </div><!--end .col grid_12_of_12-->



                <?php endwhile; ?>

            <?php else : ?>

                <div class="entry portfolio-content not-found">

                    <h2 class="title"><?php _e('Not Found','tress'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','tress'); ?></p>
                    <?php get_search_form(); ?>

                </div><!--end .product-content.entry-->


            <?php endif; ?>
            <?php if (is_active_sidebar('sidebar-main')) { ?>
                <div class="col grid_4_of_12 last right-sidebar">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar-main'); ?>
                    </div>
                </div><!--end .col grid_4_of_12-->
            <?php } ?>
        </div><!--end .row-->

    </div><!--end #main-content.container-->
</div><!-- end #main-content-container -->
    <?php get_footer(); ?>