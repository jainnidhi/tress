<?php
/**
 * Prism Theme Customizer support
 *
 * @package WordPress
 * @subpackage Prism
 * @since Prism 1.0
 */


/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Prism 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prism_customize_register($wp_customize) {
    
     $wp_customize->get_section( 'header_image'  )->priority     = 33;

    /** ===============
     * Extends CONTROLS class to add textarea
     */
    class prism_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Displays a list of categories in dropdown
    class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {

        public $type = 'dropdown-categories';

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                    array(
                        'name' => '_customize-dropdown-categories-' . $this->id,
                        'echo' => 0,
                        'hide_empty' => false,
                        'show_option_none' => '&mdash; ' . __('Select', 'prism') . ' &mdash;',
                        'hide_if_empty' => false,
                        'selected' => $this->value(),
                    )
            );

            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown);

            printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>', $this->label, $dropdown
            );
        }

    }
    // Add new section for theme layout and color schemes
    $wp_customize->add_section('prism_notification_bar_settings', array(
        'title' => __('Notification Bar', 'prism'),
        'priority' => 29,
    ));
    
    $wp_customize->add_setting('notification_text', array('default' => '',
            'sanitize_js_callback' => 'prism_sanitize_escaping', 
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'notification_text', array(
            'label' => __('Text/HTML', 'prism'),
            'section' => 'prism_notification_bar_settings',
            'settings' => 'notification_text',
            'priority' => 2,
        )));
        
         // link text
        $wp_customize->add_setting('notification_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('notification_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'prism_notification_bar_settings',
            'settings' => 'notification_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('notification_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('notification_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'prism_notification_bar_settings',
            'settings' => 'notification_link_url',
            'priority' => 5,
            
        ));
    
    // Add new section for theme layout and color schemes
    $wp_customize->add_section('prism_theme_layout_settings', array(
        'title' => __('Color Scheme', 'prism'),
        'priority' => 30,
    ));

    // Add color scheme options
   
    $wp_customize->add_setting('prism_bg_color_scheme', array(
        'default' => 'light',
        'sanitize_callback' => 'prism_sanitize_bg_color_scheme_option',
    ));

    $wp_customize->add_control('prism_bg_color_scheme', array(
        'label' => 'Background Color Schemes',
        'section' => 'prism_theme_layout_settings',
        'default' => 'light',
        'type' => 'radio',
        'choices' => array(
            'light' => __('Light', 'prism'),
            'dark' => __('Dark', 'prism'),
           
           
        ),
    ));
    
    // Add color scheme options
   
    $wp_customize->add_setting('prism_color_scheme', array(
        'default' => 'blue',
        'sanitize_callback' => 'prism_sanitize_color_scheme_option',
    ));

    $wp_customize->add_control('prism_color_scheme', array(
        'label' => 'Color Schemes',
        'section' => 'prism_theme_layout_settings',
        'default' => 'red',
        'type' => 'radio',
        'choices' => array(
            'blue' => __('Blue', 'prism'),
            'red' => __('Red', 'prism'),
            'green' => __('Green', 'prism'),
            'gray' => __('Gray', 'prism'),
            'purple' => __('Purple', 'prism'),
            'orange' => __('Orange', 'prism'),
            'brown' => __('Brown', 'prism'),
            'pink' => __('Pink', 'prism'),
        ),
    ));
    
    
    
      // Add new section for custom favicon settings
    $wp_customize->add_section('prism_custom_favicon_setting', array(
        'title' => __('Custom Favicon', 'prism'),
        'priority' => 31,
    ));
    
    
    $wp_customize->add_setting('custom_favicon');

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'custom_favicon', array(
        'label' => 'Custom Favicon',
        'section' => 'prism_custom_favicon_setting',
        'settings' => 'custom_favicon',
                 'priority' => 1,
            )
            )
    );
    
     // Add new section for custom favicon settings
    $wp_customize->add_section('prism_tracking_code_setting', array(
        'title' => __('Tracking Code', 'prism'),
        'priority' => 32,
    ));
    
    $wp_customize->add_setting('tracking_code', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'sanitize_js_callback' => 'prism_sanitize_escaping', 
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'tracking_code', array(
            'label' => __('Tracking Code', 'prism'),
            'section' => 'prism_tracking_code_setting',
            'settings' => 'tracking_code',
            'priority' => 2,
        )));
    
         // Add new section for Header Contact settings
    $wp_customize->add_section('header_contact_setting', array(
        'title' => __('Header Contact', 'prism'),
        'priority' => 34,
    ));
    
    $wp_customize->add_setting('header_contact', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'header_contact', array(
            'label' => __('Contact Detail', 'prism'),
            'section' => 'header_contact_setting',
            'settings' => 'header_contact',
            'priority' => 2,
        )));
        
        
        
           // Add new section for Social Icons
    $wp_customize->add_section('social_icon_setting', array(
        'title' => __('Social Icons', 'prism'),
        'priority' => 35,
    ));
    
    // link url
        $wp_customize->add_setting('facebook_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('facebook_link_url', array(
            'label' => __('Facebook URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'facebook_link_url',
            'priority' => 1,
            
        ));
        
        // link url
        $wp_customize->add_setting('twitter_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('twitter_link_url', array(
            'label' => __('Twitter URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'twitter_link_url',
            'priority' => 2,
            
        ));
        
        // link url
        $wp_customize->add_setting('googleplus_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('googleplus_link_url', array(
            'label' => __('Google Plus URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'googleplus_link_url',
            'priority' => 3,
            
        ));
        
        // link url
        $wp_customize->add_setting('pinterest_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('pinterest_link_url', array(
            'label' => __('Pinterest URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'pinterest_link_url',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('github_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('github_link_url', array(
            'label' => __('Github URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'github_link_url',
            'priority' => 5,
            
        ));
        
        // link url
        $wp_customize->add_setting('youtube_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('youtube_link_url', array(
            'label' => __('Youtube URL', 'prism'),
            'section' => 'social_icon_setting',
            'settings' => 'youtube_link_url',
            'priority' => 6,
            
        ));
        
    // Add new section for slider settings
    $wp_customize->add_section('home_slider_setting', array(
        'title' => __('Home Slider', 'prism'),
        'priority' => 36,
    ));

    $wp_customize->add_setting('slider_one', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_one', array(
        'label' => 'Slider 1',
        'section' => 'home_slider_setting',
        'settings' => 'slider_one',
                 'priority' => 1,
     
                )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_one', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_one', array(
            'label' => __('Slider One Title', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_one',
             'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('slider_one_url', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_one_url', array(
            'label' => __('Slider One URL', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_one_url',
             'priority' => 3,
           
        ));
        
        $wp_customize->add_setting('slider_one_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'slider_one_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_one_description',
            'priority' => 4,
        )));
        

   $wp_customize->add_setting('slider_two', array(
       'transport'=> 'postMessage',
   ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_two', array(
        'label' => 'Slider 2',
        'section' => 'home_slider_setting',
        'settings' => 'slider_two',
                 'priority' => 5,
            )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_two', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_two', array(
            'label' => __('Slider Two Title', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_two',
             'priority' => 6,
            
        ));
        
        $wp_customize->add_setting('slider_two_url', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_two_url', array(
            'label' => __('Slider Two URL', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_two_url',
             'priority' => 7,
           
        ));
        
        $wp_customize->add_setting('slider_two_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'slider_two_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_two_description',
            'priority' => 8,
        )));


    $wp_customize->add_setting('slider_three', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_three', array(
        'label' => 'Slider 3',
        'section' => 'home_slider_setting',
        'settings' => 'slider_three',
                 'priority' => 9,
            )
            )
    );
    
    
     // slider Title
        $wp_customize->add_setting('slider_title_three', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_three', array(
            'label' => __('Slider Three Title', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_three',
             'priority' => 10,
            
        ));
        
         $wp_customize->add_setting('slider_three_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_three_url', array(
            'label' => __('Slider Three URL', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_three_url',
             'priority' => 11,
           
        ));
        
       $wp_customize->add_setting('slider_three_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
           'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'slider_three_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_three_description',
            'priority' => 12,
        )));
    
    $wp_customize->add_setting('slider_four', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_four', array(
        'label' => 'Slider 4',
        'section' => 'home_slider_setting',
        'settings' => 'slider_four',
                 'priority' => 13,
            )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_four', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_four', array(
            'label' => __('Slider Four Title', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_four',
             'priority' => 14,
            
        ));
        
         $wp_customize->add_setting('slider_four_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_four_url', array(
            'label' => __('Slider Four URL', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_url',
             'priority' => 15,
           
        ));
        
        $wp_customize->add_setting('slider_four_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'slider_four_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_description',
            'priority' => 16,
        )));
        
    $wp_customize->add_setting('slider_five', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_five', array(
        'label' => 'Slider 5',
        'section' => 'home_slider_setting',
        'settings' => 'slider_five',
                 'priority' => 17,
            )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_five', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_five', array(
            'label' => __('Slider Five Title', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_five',
             'priority' => 18,
            
        ));
        
         $wp_customize->add_setting('slider_five_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_five_url', array(
            'label' => __('Slider Five URL', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_url',
             'priority' => 19,
           
        ));
        
        $wp_customize->add_setting('slider_five_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'slider_five_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_description',
            'priority' => 20,
        )));
        
        
           // Add new section for Home Tagline settings
    $wp_customize->add_section('tagline_setting', array(
        'title' => __('Home Tagline', 'prism'),
        'priority' => 37,
    ));
    
    
    // Tagline Title
        $wp_customize->add_setting('tagline_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('tagline_title', array(
            'label' => __('Tagline', 'prism'),
            'section' => 'tagline_setting',
            'settings' => 'tagline_title',
           
        ));
        
        $wp_customize->add_setting('tagline_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'tagline_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'tagline_setting',
            'settings' => 'tagline_description',
            'priority' => 20,
        )));
        
            
     // Add new section for Home Featured Title settings
    $wp_customize->add_section('home_featured_title_setting', array(
        'title' => __('Home Featured Title', 'prism'),
        'priority' => 38,
    ));
    
    // home Title
        $wp_customize->add_setting('home_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title', array(
            'label' => __('Section Title', 'prism'),
            'section' => 'home_featured_title_setting',
            'settings' => 'home_title',
            'priority' => 1,
           
        ));
        
        // home Title
        $wp_customize->add_setting('home_menu_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_menu_title', array(
            'label' => __('Menu Title', 'prism'),
            'section' => 'home_featured_title_setting',
            'settings' => 'home_menu_title',
            'priority' => 2,
           
        ));
        
     // Add new section for Home Featured One settings
    $wp_customize->add_section('home_featured_one_setting', array(
        'title' => __('Home Featured #1', 'prism'),
        'priority' => 40,
    ));
    
    
    $wp_customize->add_setting('home_featured_one', array(
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'home_featured_one', array(
        'label' => 'Featured Image',
        'section' => 'home_featured_one_setting',
        'settings' => 'home_featured_one',
                'priority' => 1,
            )
            )
    );
    
    // home Title
        $wp_customize->add_setting('home_title_one', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title_one', array(
            'label' => __('Title', 'prism'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_title_one',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_one', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'home_description_one', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_description_one',
            'priority' => 3,
        )));
        
         // link text
        $wp_customize->add_setting('home_one_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_one_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_one_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_one_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_one_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_one_link_url',
            'priority' => 5,
            
        ));
        
       // Add new section for Home Featured Two settings
    $wp_customize->add_section('home_featured_two_setting', array(
        'title' => __('Home Featured #2', 'prism'),
        'priority' => 45,
    ));
    
    
    $wp_customize->add_setting('home_featured_two', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'home_featured_two', array(
        'label' => 'Featured Image',
        'section' => 'home_featured_two_setting',
        'settings' => 'home_featured_two',
                'priority' => 1,
            )
            )
    );
    
    // home Title
        $wp_customize->add_setting('home_title_two', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title_two', array(
            'label' => __('Title', 'prism'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_title_two',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_two', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'home_description_two', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_description_two',
            'priority' => 3,
        )));
        
         // link text
        $wp_customize->add_setting('home_two_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_two_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_two_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_two_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_two_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_two_link_url',
            'priority' => 5,
            
        ));
        
        
        
        // Add new section for Home Featured Three settings
    $wp_customize->add_section('home_featured_three_setting', array(
        'title' => __('Home Featured #3', 'prism'),
        'priority' => 50,
    ));
    
    
    $wp_customize->add_setting('home_featured_three', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'home_featured_three', array(
        'label' => 'Featured Image',
        'section' => 'home_featured_three_setting',
        'settings' => 'home_featured_three',
                'priority' => 1,
            )
            )
    );
    
    // home Title
        $wp_customize->add_setting('home_title_three', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title_three', array(
            'label' => __('Title', 'prism'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_title_three',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_three', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'home_description_three', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_description_three',
            'priority' => 3,
        )));
        
         // link text
        $wp_customize->add_setting('home_three_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_three_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_three_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_three_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_three_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_three_link_url',
            'priority' => 5,
            
        ));
        
        
         // Add new section for Home Featured One settings
    $wp_customize->add_section('home_featured_four_setting', array(
        'title' => __('Home Featured #4', 'prism'),
        'priority' => 51,
    ));
    
    
    $wp_customize->add_setting('home_featured_four', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'home_featured_four', array(
        'label' => 'Featured Image',
        'section' => 'home_featured_four_setting',
        'settings' => 'home_featured_four',
                'priority' => 1,
            )
            )
    );
    
    // home Title
        $wp_customize->add_setting('home_title_four', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title_four', array(
            'label' => __('Title', 'prism'),
            'section' => 'home_featured_four_setting',
            'settings' => 'home_title_four',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_four', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'home_description_four', array(
            'label' => __('Description', 'prism'),
            'section' => 'home_featured_four_setting',
            'settings' => 'home_description_four',
            'priority' => 3,
        )));
        
         // link text
        $wp_customize->add_setting('home_four_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_four_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'home_featured_four_setting',
            'settings' => 'home_four_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_four_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_four_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'home_featured_four_setting',
            'settings' => 'home_four_link_url',
            'priority' => 5,
            
        ));
        
    
    
        
        // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('prism_front_page_post_options', array(
        'title' => __('Featured Posts', 'prism'),
        'description' => __('Settings for displaying featured posts on Front Page', 'prism'),
        'priority' => 55,
    ));
    // post Title
        $wp_customize->add_setting('prism_post_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('prism_post_title', array(
            'label' => __('Section Title', 'prism'),
            'section' => 'prism_front_page_post_options',
            'settings' => 'prism_post_title',
            'priority' => 1,
           
        ));
        
        // post Title
        $wp_customize->add_setting('prism_post_menu_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('prism_post_menu_title', array(
            'label' => __('Menu Title', 'prism'),
            'section' => 'prism_front_page_post_options',
            'settings' => 'prism_post_menu_title',
            'priority' => 2,
           
        ));
    // enable featured posts on front page?
    $wp_customize->add_setting('prism_front_featured_posts_check', array(
        'default' => 1, 
        'sanitize_callback' => 'prism_sanitize_checkbox',
    ));
    $wp_customize->add_control('prism_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'prism'),
        'section' => 'prism_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('prism_front_featured_posts_count', array(
        'default' => 3,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'=> 'postMessage',
    ));
    $wp_customize->add_control('prism_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'prism'),
        'section' => 'prism_front_page_post_options',
        'settings' => 'prism_front_featured_posts_count',
        'priority' => 20,
    ));
       // select category for featured posts 
    $wp_customize->add_setting('prism_front_featured_posts_cat', array('default' => 0,));
    $wp_customize->add_control(new WP_Customize_Dropdown_Categories_Control($wp_customize, 'prism_front_featured_posts_cat', array(
        'label' => __('Post Category', 'prism'),
        'section' => 'prism_front_page_post_options',
        'type' => 'dropdown-categories',
        'settings' => 'prism_front_featured_posts_cat',
        'priority' => 30,
    )));
           
        
            // Add new section for Home CTA settings
    $wp_customize->add_section('home_cta_setting', array(
        'title' => __('Home CTA', 'prism'),
        'priority' => 60,
    ));
    
    $wp_customize->add_setting('cta_text', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'cta_text', array(
            'label' => __('CTA Text', 'prism'),
            'section' => 'home_cta_setting',
            'settings' => 'cta_text',
            'priority' => 1,
        )));
        
        
         // link text
        $wp_customize->add_setting('home_cta_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_cta_link_text', array(
            'label' => __('Link Text', 'prism'),
            'section' => 'home_cta_setting',
            'settings' => 'home_cta_link_text',
            'priority' => 2,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_cta_link_url', array('default' => __('', 'prism'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_cta_link_url', array(
            'label' => __('Link URL', 'prism'),
            'section' => 'home_cta_setting',
            'settings' => 'home_cta_link_url',
            'priority' => 3,
            
        ));
        
            // Add new section for Home Contact Title settings
    $wp_customize->add_section('feedback_title_setting', array(
        'title' => __('Testimonial Title', 'prism'),
        'priority' => 62,
    ));
    
    // home Title
        $wp_customize->add_setting('feedback_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('feedback_title', array(
            'label' => __('Section Title', 'prism'),
            'section' => 'feedback_title_setting',
            'settings' => 'feedback_title',
            'priority' => 1,
           
        ));
        
        // home Title
        $wp_customize->add_setting('feedback_menu_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('feedback_menu_title', array(
            'label' => __('Menu Title', 'prism'),
            'section' => 'feedback_title_setting',
            'settings' => 'feedback_menu_title',
            'priority' => 2,
           
        ));
        
        
        // Add new section for Testimonial slider settings
    $wp_customize->add_section('testimonial_slider_setting', array(
        'title' => __('Testimonial Slider', 'prism'),
        'priority' => 63,
    ));

    $wp_customize->add_setting('tslider_one', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_one', array(
        'label' => 'Slider 1',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_one',
                 'priority' => 1,
     
                )
            )
    );
    
        
        $wp_customize->add_setting('tslider_one_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'tslider_one_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_one_description',
            'priority' => 2,
        )));
        
        
        $wp_customize->add_setting('tslider_two', array(
            'transport'=> 'postMessage',
        ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_two', array(
        'label' => 'Slider 2',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_two',
                 'priority' => 3,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_two_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'tslider_two_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_two_description',
            'priority' => 4,
        )));
        
         $wp_customize->add_setting('tslider_three', array(
             'transport'=> 'postMessage',
         ));
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_three', array(
        'label' => 'Slider 3',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_three',
                 'priority' => 5,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_three_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'tslider_three_description', array(
            'label' => __('Description', 'prism'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_three_description',
            'priority' => 6,
        )));
        
        
        
            // Add new section for Contact settings
    $wp_customize->add_section('contact_setting', array(
        'title' => __('Contact Details', 'prism'),
        'priority' => 64,
    ));
    
    
     // contact Title
        $wp_customize->add_setting('contact_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('contact_title', array(
            'label' => __('Title', 'prism'),
            'section' => 'contact_setting',
            'settings' => 'contact_title',
            'priority' => 1,
           
        ));
        
         $wp_customize->add_setting('contact_email', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('contact_email', array(
            'label' => __('Email', 'prism'),
            'section' => 'contact_setting',
            'settings' => 'contact_email',
            'priority' => 2,
            
        ));
        
        $wp_customize->add_setting('contact_phone', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('contact_phone', array(
            'label' => __('Phone', 'prism'),
            'section' => 'contact_setting',
            'settings' => 'contact_phone',
            'priority' => 3,
            
        ));
        
    $wp_customize->add_setting('address_detail', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
    $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'address_detail', array(
            'label' => __('Address', 'prism'),
            'section' => 'contact_setting',
            'settings' => 'address_detail',
            'priority' => 4,
        )));
        
        // Add new section for Home Contact Title settings
    $wp_customize->add_section('home_contact_title_setting', array(
        'title' => __('Home Contact Title', 'prism'),
        'priority' => 63,
    ));
    
    // section Title
        $wp_customize->add_setting('home_contact_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_contact_title', array(
            'label' => __('Section Title', 'prism'),
            'section' => 'home_contact_title_setting',
            'settings' => 'home_contact_title',
            'priority' => 1,
           
        ));
        
        // menu Title
        $wp_customize->add_setting('home_menu_contact_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_menu_contact_title', array(
            'label' => __('Menu Title', 'prism'),
            'section' => 'home_contact_title_setting',
            'settings' => 'home_menu_contact_title',
            'priority' => 2,
           
        ));
        
        
          // Add new section for Home Tagline settings
    $wp_customize->add_section('prism_contact_form_setting', array(
        'title' => __('Contact Form', 'prism'),
        'priority' => 64,
    ));    
       
    $wp_customize->add_setting('contact_form_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('contact_form_title', array(
            'label' => __('Title', 'prism'),
            'section' => 'prism_contact_form_setting',
            'settings' => 'contact_form_title',
            'priority' => 1,
           
        ));
        
    $wp_customize->add_setting('prism_contact_form', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('prism_contact_form', array(
            'label' => __('Contact Form Short Code', 'prism'),
            'section' => 'prism_contact_form_setting',
            'settings' => 'prism_contact_form',
            'priority' => 2,
           
        ));
    
        // Add new section for Home Tagline settings
    $wp_customize->add_section('video_setting', array(
        'title' => __('Home Map', 'prism'),
        'priority' => 65,
    ));    
       
        
        $wp_customize->add_setting('contact_map', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'contact_map', array(
            'label' => __('Map Code', 'prism'),
            'section' => 'video_setting',
            'settings' => 'contact_map',
            'priority' => 1,
        )));  
    
     // Add footer text section
    $wp_customize->add_section('prism_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 75,
    ));

    $wp_customize->add_setting('prism_footer_footer_text', array(
        'default' => null,
        'sanitize_js_callback' => 'prism_sanitize_escaping',
        'transport'=> 'postMessage',
        
    ));
    $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'prism_footer_footer_text', array(
        'section' => 'prism_footer', // id of section to which the setting belongs
        'settings' => 'prism_footer_footer_text',
    )));

    
    // Add custom CSS section
    $wp_customize->add_section('prism_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));
    
    $wp_customize->add_setting('prism_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'prism_sanitize_custom_css',
        'sanitize_js_callback' => 'prism_sanitize_escaping',
        'transport'=> 'postMessage',
    ));
    
    $wp_customize->add_control(new prism_customize_textarea_control($wp_customize, 'prism_custom_css', array(
        'section' => 'prism_custom_css', // id of section to which the setting belongs
        'settings' => 'prism_custom_css', 
    )));
    
   
    // Disable one page navigation on front page.
    $wp_customize->add_setting('prism_one_page_nav_check', array(
        'default' => 0, 
        'sanitize_callback' => 'prism_sanitize_checkbox',
    ));
    $wp_customize->add_control('prism_one_page_nav_check', array(
        'label' => __('Disable one page navigation', 'prism'),
        'section' => 'nav',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    //remove default customizer sections
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('colors');
    
    // add post message for various customizer settings 
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
}

add_action('customize_register', 'prism_customize_register');



/*
 * Sanitize numeric values 
 * 
 * @since Prism 1.0
 */
function prism_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
    return intval( $input );
    }
}

/*
 * Escaping for input values
 * 
 * @since Prism 1.0
 */
function prism_sanitize_escaping( $input) {
    $input = esc_attr( $input);
    return $input;
}


/* 
 * Sanitize Custom CSS 
 * 
 * @since Prism 1.0
 */

function prism_sanitize_custom_css( $input) {
    $input = wp_kses_stripslashes( $input);
    return $input;
}	

/*
 * Sanitize Checkbox input values
 * 
 * @since Prism 1.0
 */
function prism_sanitize_checkbox( $input ) {
    if ( $input ) {
            $output = '1';
    } else {
            $output = false;
    }
    return $output;
}

/*
 * Sanitize color scheme options 
 * 
 * @since Prism 1.0
 */
function prism_sanitize_color_scheme_option($colorscheme_option){
    if ( ! in_array( $colorscheme_option, array( 'blue','red','green','gray','purple','orange','brown','pink' ) ) ) {
		$colorscheme_option = 'blue';
	}

	return $colorscheme_option;
}


/*
 * Sanitize background color scheme options 
 * 
 * @since Prism 1.0
 */
function prism_sanitize_bg_color_scheme_option($bg_colorscheme_option){
    if ( ! in_array( $bg_colorscheme_option, array( 'light','dark') ) ) {
		$bg_colorscheme_option = 'light';
	}

	return $bg_colorscheme_option;
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Prism 1.0
 */
function prism_customize_preview_js() {
    wp_enqueue_script('prism_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20131205', true);
}

add_action('customize_preview_init', 'prism_customize_preview_js');


function prism_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php echo esc_attr(get_theme_mod('prism_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'prism_header_output');

function prism_footer_tracking_code() {
    echo esc_attr(get_theme_mod('tracking_code'));
}
add_action('wp_footer','prism_footer_tracking_code'); 