<?php
/**
 * 
 * Description: Displays a full-width front page. The front page template provides an optional
 * featured section that allows for highlighting a key message. It can contain up to 2 widget areas,
 * in one or two columns. These widget areas are dynamic so if only one widget is used, it will be
 * displayed in one column. If two are used, then they will be displayed over 2 columns.
 * There are also four front page only widgets displayed just beneath the two featrued widgets. Like the
 * featured widgets, they will be displayed in anywhere from one to four columns, depending on
 * how many widgets are active.
 * 
 * The front page template also displays EDD featured products and featured posts 
 * depending on the settings from Theme Customizer 
 *
 * @package Tress
 * @since Tress 1.0
 */
get_header();
?>


<div class="slider-wrapper">
    <div class="flexslider"  id="main-slider">
        <ul class="slides">
            <?php 
            // check if the slider is blank.
            // if there are no slides by user then load default slides. 
            
            if ( get_theme_mod('slider_one') =='' ) {  ?>
                <li>
                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/slider1.jpg" alt=""/>
                <div class="flex-caption">
                    <div class="slider-text-container">
                     <h2 class="slider-title"><a href="#"><?php esc_html_e('Showcase Your Restaurant Services', 'tress') ?></a></h2>
                          <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                          <a class="slider-button" href="#">
                            <?php esc_html_e('Start Building Your Website Now', 'tress') ?>
                        </a>
                    </div>
                </div>
                </li>
                
                <li>
                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/slider2.jpg" alt=""/>
                <div class="flex-caption">
                    <div class="slider-text-container">
                     <h2 class="slider-title"><a href="#"><?php esc_html_e('Showcase Your Restaurant Services', 'tress') ?></a></h2>
                          <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                          <a class="slider-button" href="#">
                            <?php esc_html_e('Start Building Your Website Now', 'tress') ?>
                        </a>
                    </div>
                 </div>
                </li>
                
                <li>
                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/slider2.jpg" alt=""/>
                <div class="flex-caption">
                    <div class="slider-text-container">
                     <h2 class="slider-title"><a href="#"><?php esc_html_e('Showcase Your Restaurant Services', 'tress') ?></a></h2>
                          <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                          <a class="slider-button" href="#">
                              <?php esc_html_e('Start Building Your Website Now', 'tress') ?>
                        </a>
                    </div>
                 </div>
                </li>
            <?php } ?>
                
          <?php 
          // if user adds a cusotm slide then display the slides 
          // load first slide
          if ( get_theme_mod('slider_one') !='' ) {  ?>
                    <li id="slider1" class="home-slider"> 
                        <img href="<?php if ( get_theme_mod('slider_one_url') !='' ) { echo esc_url(get_theme_mod('slider_one_url')); } ?>" src="<?php echo get_theme_mod('slider_one'); ?>" alt=""/>
                        <?php if ( get_theme_mod('slider_title_one') !='' || get_theme_mod('slider_one_url') !='' || get_theme_mod('slider_one_description') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="slider-text-container">
                                   <h2 class="slider-title"><a href="<?php if ( get_theme_mod('slider_one_url') !='' ) { echo esc_url(get_theme_mod('slider_one_url')); } ?>"><?php echo esc_html(get_theme_mod('slider_title_one')); ?></a></h2>
                                        
                                            <p><?php echo esc_html(get_theme_mod('slider_one_description')); ?></p>
                                          
                                 <?php if ( get_theme_mod('slider_one_link_url') !='' && get_theme_mod('slider_one_link_text') !=''  ) {  ?>
                                  <a class="slider-button" href="<?php echo esc_url(get_theme_mod('slider_one_link_url')); ?>">
                                    <?php  echo esc_html(get_theme_mod('slider_one_link_text')); ?>
                                    <?php } ?> 
                                  </a>
                            </div>
                         </div>
                        <?php } ?>
                    </li>
                    
                     <?php 
                     // load second slide
                     if ( get_theme_mod('slider_two') !='' ) {  ?>
                    <li id="slider2" class="home-slider"> 
                        <img href="<?php if ( get_theme_mod('slider_two_url') !='' ) { echo esc_url(get_theme_mod('slider_two_url')); } ?>" src="<?php echo get_theme_mod('slider_two'); ?>" alt=""/>
                        <?php } ?>
                        <?php if ( get_theme_mod('slider_title_two') !='' || get_theme_mod('slider_two_url') !='' || get_theme_mod('slider_two_description') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="slider-text-container">
                                   
                                   <h2 class="slider-title"><a href="<?php if ( get_theme_mod('slider_two_url') !='' ) { echo esc_url(get_theme_mod('slider_two_url')); } ?>"><?php echo esc_html(get_theme_mod('slider_title_two')); ?></a></h2>
                                   
                                       <p><?php echo esc_html(get_theme_mod('slider_two_description')); ?></p>
                                       <?php if ( get_theme_mod('slider_two_link_url') !='' && get_theme_mod('slider_two_link_text') !=''  ) {  ?>
                                   <a class="slider-button" href="<?php echo esc_url(get_theme_mod('slider_two_link_url')); ?>">
                                     <?php echo esc_html(get_theme_mod('slider_two_link_text')); ?>
                                       <?php } ?>
                                   </a>
                            </div>
                         </div>
                        <?php } ?>
                    </li>
                  
                    
                    <?php
                    // load third slide
                    if ( get_theme_mod('slider_three') !='' ) {  ?>
                    <li id="slider3" class="home-slider">  
                        <img href="<?php if ( get_theme_mod('slider_three_url') !='' ) { echo esc_url(get_theme_mod('slider_three_url')); } ?>" src="<?php echo get_theme_mod('slider_three'); ?>" alt=""/>
                        <?php } ?>
                        <?php if ( get_theme_mod('slider_title_three') !='' || get_theme_mod('slider_three_url') !='' || get_theme_mod('slider_three_description') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="slider-text-container">
                         
                            <h2 class="slider-title"><a href="<?php if ( get_theme_mod('slider_three_url') !='' ) { echo esc_url(get_theme_mod('slider_three_url')); } ?>"><?php echo esc_html(get_theme_mod('slider_title_three')); ?></a></h2>
                                
                                <p><?php echo esc_html(get_theme_mod('slider_three_description')); ?></p>
                                
                                <?php if ( get_theme_mod('slider_three_link_url') !='' && get_theme_mod('slider_three_link_text') !=''  ) {  ?>
                               <a class="slider-button" href="<?php echo esc_url(get_theme_mod('slider_three_link_url')); ?>">
                                 <?php  echo esc_html(get_theme_mod('slider_three_link_text')); ?>
                                 <?php } ?> 
                                </a>
                            </div>
                         </div>
                        <?php } ?>
                    </li>
                   
                    
                    <?php 
                    // load fourth slide
                    if ( get_theme_mod('slider_four') !='' ) {  ?>
                    <li id="slider4" class="home-slider"> 
                        <img href="<?php if ( get_theme_mod('slider_four_url') !='' ) { echo esc_url(get_theme_mod('slider_four_url')); } ?>" src="<?php echo get_theme_mod('slider_four'); ?>" alt=""/>
                        <?php } ?>
                        <?php if ( get_theme_mod('slider_title_four') !='' || get_theme_mod('slider_four_url') !='' || get_theme_mod('slider_four_description') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="slider-text-container">
                          
                            <h2 class="slider-title"><a href="<?php if ( get_theme_mod('slider_four_url') !='' ) { echo esc_url(get_theme_mod('slider_four_url')); } ?>"><?php echo esc_html(get_theme_mod('slider_title_four')); ?></a></h2>
                                
                                     <p><?php echo esc_html(get_theme_mod('slider_four_description')); ?></p>
                                     
                                     <?php if ( get_theme_mod('slider_four_link_url') !='' && get_theme_mod('slider_four_link_text') !=''  ) {  ?>
                                  <a class="slider-button" href="<?php echo esc_url(get_theme_mod('slider_four_link_url')); ?>">
                                    <?php  echo esc_html(get_theme_mod('slider_four_link_text')); ?>
                                    <?php } ?> 
                                   </a>
                                  </a>
                            </div>
                        </div>
                        <?php } ?>
                    </li>
                  
                         
                    <?php
                    // load fifth slide
                    if ( get_theme_mod('slider_five') !='' ) {  ?>
                    <li id="slider5" class="home-slider">  
                                <img href="<?php if ( get_theme_mod('slider_five_url') !='' ) { echo esc_url(get_theme_mod('slider_five_url')); } ?>" src="<?php echo get_theme_mod('slider_five'); ?>" alt=""/>
                          <?php } ?>
                      <?php if ( get_theme_mod('slider_title_five') !='' || get_theme_mod('slider_five_url') !='' || get_theme_mod('slider_five_description') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="slider-text-container">
                           
                            <h2 class="slider-title"><a href="<?php if ( get_theme_mod('slider_five_url') !='' ) { echo esc_url(get_theme_mod('slider_five_url')); } ?>"><?php echo esc_html(get_theme_mod('slider_title_five')); ?></a></h2>
                                
                                     <p><?php echo esc_html(get_theme_mod('slider_five_description')); ?></p>
                                     
                                     <?php if ( get_theme_mod('slider_five_link_url') !='' && get_theme_mod('slider_five_link_text') !=''  ) {  ?>
                                  <a class="slider-button" href="<?php echo esc_url(get_theme_mod('slider_five_link_url')); ?>">
                                    <?php  echo esc_html(get_theme_mod('slider_five_link_text')); ?>
                                    <?php } ?> 
                                  </a>
                            </div>
                         </div>
                       <?php } ?> 
                    </li>
                
           <?php } ?>
        </ul>
    </div>
</div>

     <!-- Start business-tagline area -->
        <div class="business-tagline-area">
            <div class="business-tagline">
                <?php if ( get_theme_mod('tagline_title') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('tagline_title')); ?></h3>

                  <?php } else {  ?> <h3><?php esc_html_e('Build Restaurant Website With Tress Multipurpose Theme', 'tress') ?></h3>
                           <?php } ?>

                  <?php if ( get_theme_mod('tagline_description') !='' ) {  ?>
                  <p><?php echo esc_html(get_theme_mod('tagline_description')); ?></p>
                           <?php } else { ?>
                          <p><?php esc_html_e('Creating your Restaurant & Food based website with Tress is completely easy.
                              You just need to perform few tweaks in the theme option panel and your website will be ready to use.
                              Showcase all important features of your website on homepage.', 'tress') ?> </p>
                                           <?php } ?>
            </div>
        </div><!-- end business tagline area -->
        <!-- Start home featured area -->
        
        <div class="home-featured-title-area" id="featured-title">
            <div class="home-featured-title section-title">
                 <?php if ( get_theme_mod('home_title') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('home_title')); ?></h3>
                  <?php } else {  ?> <h3><?php esc_html_e('Theme Features', 'tress') ?></h3>
                           <?php } ?>
            </div>
        </div>
        <div class="home-featured-area">
            <div class="home-featured">
                <div class="home-featured-one grid_4_of_12 col">
                    <?php if ( get_theme_mod('home_featured_one') !='' ) {  ?>
                     <div class="featured-image"><img src="<?php echo get_theme_mod('home_featured_one'); ?>" /></div>
                    <?php } else {  ?>
                     <div class="featured-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/img1.jpg" /></div>
                     <?php } ?>


                           <?php if ( get_theme_mod('home_title_one') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('home_title_one')); ?></h3>
                  <?php } else {  ?> <h3><?php esc_html_e('Our Products', 'tress') ?></h3>
                           <?php } ?>

                  <?php if ( get_theme_mod('home_description_one') !='' ) {  ?>
                  <p><?php echo esc_html(get_theme_mod('home_description_one')); ?></p>
                           <?php } else { ?>
                          <p><?php esc_html_e('Showcase your best quality products on home page to grab visitor&rsquo;s attention.', 'tress') ?> </p>
                                           <?php } ?>

                      <a class="read-more" href="<?php if ( get_theme_mod('home_one_link_url') !='' ) { echo esc_url(get_theme_mod('home_one_link_url')); } ?>">
                           <?php if ( get_theme_mod('home_one_link_text') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_one_link_text')); ?>

                  <?php } else {  ?> <?php esc_html_e('Read More', 'tress') ?>
                           <?php } ?></a>
                </div>

                <div class="home-featured-two grid_4_of_12 col">
                    <?php if ( get_theme_mod('home_featured_two') !='' ) {  ?>
                     <div class="featured-image"><img src="<?php echo get_theme_mod('home_featured_two'); ?>" /></div>
                    <?php } else {  ?>
                     <div class="featured-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/img2.jpg" /></div>
                     <?php } ?>


                           <?php if ( get_theme_mod('home_title_two') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('home_title_two')); ?></h3>
                  <?php } else {  ?> <h3><?php esc_html_e('Our Services', 'tress') ?></h3>
                           <?php } ?>

                  <?php if ( get_theme_mod('home_description_two') !='' ) {  ?>
                  <p><?php echo esc_html(get_theme_mod('home_description_two')); ?></p>
                           <?php } else { ?>
                          <p><?php esc_html_e('Show your multiple services that will explore your website among the audience.', 'tress') ?> </p>
                                           <?php } ?>

                      <a class="read-more" href="<?php if ( get_theme_mod('home_two_link_url') !='' ) { echo esc_url(get_theme_mod('home_two_link_url')); } ?>">
                           <?php if ( get_theme_mod('home_two_link_text') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_two_link_text')); ?>

                  <?php } else {  ?> <?php esc_html_e('Read More', 'tress') ?>
                           <?php } ?></a>
                </div>


                <div class="home-featured-three grid_4_of_12 col">
                    <?php if ( get_theme_mod('home_featured_three') !='' ) {  ?>
                     <div class="featured-image"><img src="<?php echo get_theme_mod('home_featured_three'); ?>" /></div>
                    <?php } else {  ?>
                     <div class="featured-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/img3.jpg" /></div>
                     <?php } ?>


                           <?php if ( get_theme_mod('home_title_three') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('home_title_three')); ?></h3>
                  <?php } else {  ?> <h3><?php esc_html_e('Our Clients', 'tress') ?></h3>
                           <?php } ?>

                  <?php if ( get_theme_mod('home_description_three') !='' ) {  ?>
                  <p><?php echo esc_html(get_theme_mod('home_description_three')); ?></p>
                           <?php } else { ?>
                          <p><?php esc_html_e('Show testimonials of your clients that will build the trust among the audience.', 'tress') ?> </p>
                                           <?php } ?>

                      <a class="read-more" href="<?php if ( get_theme_mod('home_three_link_url') !='' ) { echo esc_url(get_theme_mod('home_three_link_url')); } ?>">
                           <?php if ( get_theme_mod('home_three_link_text') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_three_link_text')); ?>

                    <?php } else {  ?> <?php esc_html_e('Read More', 'tress') ?>
                           <?php } ?></a>
                </div>
               
            </div>
        </div><!-- end home featured area -->
        
         <?php  // Display featured posts on front page
            get_template_part('content', 'frontportfolio'); ?>
        
        <div class="client-feedback-area" id="feedback-title">
            <div class="client-feedback-title section-title">
                 <?php if ( get_theme_mod('feedback_title') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('feedback_title')); ?></h3>
                  <?php } else {  ?> <h3><?php esc_html_e('Our Clients Feedback', 'tress') ?></h3>
                           <?php } ?>
            </div>
        </div>
        <!-- Home testimonial slider starts here --> 
        <div class="testimonial-slider">
            <div class="flexslider" id="reviewslider">
                <ul class="slides">
                    <?php if ( get_theme_mod('tslider_one') =='' ) {  ?>
                        <li id="tslider1">
                        <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/img1.jpg" alt=""/>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                            </div>
                            <div class="client-name">
                                 <a class="client" href="#">
                                    <?php esc_html_e('-John', 'tress') ?>
                                </a>
                            </div>
                       </div>
                    </li>
                    
                    <li id="tslider2">
                        <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/img2.jpg" alt=""/>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                               <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>                  
                            </div>
                            <div class="client-name">
                                 <a class="client" href="#">
                                    <?php esc_html_e('-John', 'tress') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                    
                     <li id="tslider3">
                        <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/img3.jpg" alt=""/>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                            </div>
                            <div class="client-name">
                                 <a class="client" href="#">
                                    <?php esc_html_e('-John', 'tress') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                    
                    <li id="tslider4">
                        <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/img4.jpg" alt=""/>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                            </div>
                            <div class="client-name">
                                 <a class="client" href="#">
                                    <?php esc_html_e('-John', 'tress') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                    
                    <li id="tslider5">
                        <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/img5.jpg" alt=""/>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <p><?php esc_html_e('Showcase your multiple services and let users understand about your business.', 'tress') ?> </p>
                            </div>
                            <div class="client-name">
                                 <a class="client" href="#">
                                    <?php esc_html_e('-John', 'tress') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    
                     <?php if ( get_theme_mod('tslider_one') !='' ) {  ?>
                    <li id="tslider1">
                        <img  src="<?php echo get_theme_mod('tslider_one'); ?>" alt=""/>
                      <?php if ( get_theme_mod('tslider_one_description') !='' || get_theme_mod('client_name_url_one') !='' || get_theme_mod('client_name_one') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <?php echo wpautop(esc_html(get_theme_mod('tslider_one_description'))); ?>
                            </div>
                            <div class="client-name">
                                 <a href="<?php echo esc_url(get_theme_mod('client_name_url_one')); ?>">
                                     <?php echo esc_html(get_theme_mod('client_name_one')); ?>
                                 </a>
                            </div>
                       </div>
                      <?php } ?>
                    </li>
                    
                    <?php if ( get_theme_mod('tslider_two') !='' ) {  ?>
                    <li id="tslider2">
                        <img  src="<?php echo get_theme_mod('tslider_two'); ?>" alt=""/>
                        <?php } ?>
                     <?php if ( get_theme_mod('tslider_two_description') !='' || get_theme_mod('client_name_url_two') !='' || get_theme_mod('client_name_two') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <?php echo wpautop(esc_html(get_theme_mod('tslider_two_description'))); ?>
                            </div>
                            <div class="client-name">
                                 <a href="<?php echo esc_url(get_theme_mod('client_name_url_two')); ?>">
                                     <?php echo esc_html(get_theme_mod('client_name_two')); ?>
                                 </a>
                            </div>
                        </div>
                     <?php } ?>
                    </li>
                    
                     <?php if ( get_theme_mod('tslider_three') !='' ) {  ?>
                     <li id="tslider3"> 
                        <img  src="<?php echo get_theme_mod('tslider_three'); ?>" alt=""/>
                        <?php } ?>
                     <?php if ( get_theme_mod('tslider_three_description') !='' || get_theme_mod('client_name_url_three') !='' || get_theme_mod('client_name_three') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <?php echo wpautop(esc_html(get_theme_mod('tslider_three_description'))); ?>
                            </div>
                            <div class="client-name">
                                 <a href="<?php echo esc_url(get_theme_mod('client_name_url_three')); ?>">
                                     <?php echo esc_html(get_theme_mod('client_name_three')); ?>
                                 </a>
                            </div>
                         </div>
                     <?php } ?>
                    </li>
                    
                     <?php if ( get_theme_mod('tslider_four') !='' ) {  ?>
                     <li id="tslider4"> 
                        <img  src="<?php echo get_theme_mod('tslider_four'); ?>" alt=""/>
                        <?php } ?>
                      <?php if ( get_theme_mod('tslider_four_description') !='' || get_theme_mod('client_name_url_four') !='' || get_theme_mod('client_name_four') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <?php echo wpautop(esc_html(get_theme_mod('tslider_four_description'))); ?>
                            </div>
                            <div class="client-name">
                                 <a href="<?php echo esc_url(get_theme_mod('client_name_url_four')); ?>">
                                     <?php echo esc_html(get_theme_mod('client_name_four')); ?>
                                 </a>
                            </div>
                       </div>
                      <?php } ?>
                    </li>
                    
                     <?php if ( get_theme_mod('tslider_five') !='' ) {  ?>
                     <li id="tslider5"> 
                        <img  src="<?php echo get_theme_mod('tslider_five'); ?>" alt=""/>
                        <?php } ?>
                        <?php if ( get_theme_mod('tslider_five_description') !='' || get_theme_mod('client_name_url_five') !='' || get_theme_mod('client_name_five') !='' ) {  ?>
                        <div class="flex-caption">
                            <div class="client-testimonial">
                                <?php echo wpautop(esc_html(get_theme_mod('tslider_five_description'))); ?>
                            </div>
                            <div class="client-name">
                                 <a href="<?php echo esc_url(get_theme_mod('client_name_url_five')); ?>">
                                     <?php echo esc_html(get_theme_mod('client_name_five')); ?>
                                 </a>
                            </div>
                         </div>
                        <?php } ?>
                    </li>
                    
                 <?php } ?>
                    
               </ul>
            </div>
        </div>
        
        
        
        <?php  // Display featured posts on front page
            get_template_part('content', 'frontposts'); ?>
        
        <div class="home-cta-area">
                <div class="home-cta">
                     <?php if ( get_theme_mod('cta_title') !='' ) {  ?><h3><?php echo esc_html(get_theme_mod('cta_title')); ?></h3>
                          <?php } else {  ?> <h3><?php esc_html_e('CTA Title', 'tress') ?></h3>
                               <?php } ?>
                    <div class="home-cta-one">
                        <?php if ( get_theme_mod('cta_text') !='' ) {  ?>
                        <p><?php echo esc_html(get_theme_mod('cta_text')); ?></p>
                           <?php } else { ?>
                          <p><?php esc_html_e('We have really amazing products that you would be amazed to see.', 'tress') ?> </p>
                                           <?php } ?>
                    </div>
                    <div class="home-cta-two">
                        <a class="cta-button" href="<?php if ( get_theme_mod('home_cta_link_url') !='' ) { echo esc_url(get_theme_mod('home_cta_link_url')); } ?>">
                           <?php if ( get_theme_mod('home_cta_link_text') !='' ) {  ?><?php echo esc_html(get_theme_mod('home_cta_link_text')); ?>

                    <?php } else {  ?> <?php esc_html_e('Read More', 'tress') ?>
                           <?php } ?></a>
                    </div>
                
                </div>
         </div>
       
         <span class="top"><a class="back-to-top"><i class="fa fa-arrow-up"></i></a></span>
            
  
<?php
get_footer();
?>