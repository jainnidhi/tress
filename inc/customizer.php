<?php
/**
 * Tress Theme Customizer support
 *
 * @package WordPress
 * @subpackage Tress
 * @since Tress 1.0
 */


/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Tress 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tress_customize_register($wp_customize) {
    
     $wp_customize->get_section( 'header_image'  )->priority     = 33;

    /** ===============
     * Extends CONTROLS class to add textarea
     */
    class tress_customize_textarea_control extends WP_Customize_Control {

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
                        'show_option_none' => '&mdash; ' . __('Select', 'tress') . ' &mdash;',
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
    $wp_customize->add_section('tress_notification_bar_settings', array(
        'title' => __('Notification Bar', 'tress'),
        'priority' => 29,
    ));
    
    // enable notification bar on front page?
    $wp_customize->add_setting('tress_notification_bar_check', array(
        'default' => 0, 
        'sanitize_callback' => 'tress_sanitize_checkbox',
    ));
    $wp_customize->add_control('tress_notification_bar_check', array(
        'label' => __('Show Notification Bar on Front Page', 'tress'),
        'section' => 'tress_notification_bar_settings',
        'priority' => 1,
        'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('notification_text', array('default' => '',
            'sanitize_js_callback' => 'tress_sanitize_escaping', 
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'notification_text', array(
            'label' => __('Text/HTML', 'tress'),
            'section' => 'tress_notification_bar_settings',
            'settings' => 'notification_text',
            'priority' => 2,
        )));
        
         // link text
        $wp_customize->add_setting('notification_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('notification_link_text', array(
            'label' => __('Link Text', 'tress'),
            'section' => 'tress_notification_bar_settings',
            'settings' => 'notification_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('notification_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('notification_link_url', array(
            'label' => __('Link URL', 'tress'),
            'section' => 'tress_notification_bar_settings',
            'settings' => 'notification_link_url',
            'priority' => 5,
            
        ));
    
    // Add new section for theme layout and color schemes
    $wp_customize->add_section('tress_theme_layout_settings', array(
        'title' => __('Color Scheme', 'tress'),
        'priority' => 30,
    ));

   
    // Add color scheme options
   
    $wp_customize->add_setting('tress_color_scheme', array(
        'default' => 'blue',
        'sanitize_callback' => 'tress_sanitize_color_scheme_option',
    ));

    $wp_customize->add_control('tress_color_scheme', array(
        'label' => 'Color Schemes',
        'section' => 'tress_theme_layout_settings',
        'default' => 'red',
        'type' => 'radio',
        'choices' => array(
            'blue' => __('Blue', 'tress'),
            'red' => __('Red', 'tress'),
            'green' => __('Green', 'tress'),
            'yellow' => __('Yellow', 'tress'),
            'purple' => __('Purple', 'tress'),
            'orange' => __('Orange', 'tress'),
            'brown' => __('Brown', 'tress'),
            'pink' => __('Pink', 'tress'),
        ),
    ));
    
    
    
      // Add new section for custom favicon settings
    $wp_customize->add_section('tress_custom_favicon_setting', array(
        'title' => __('Custom Favicon', 'tress'),
        'priority' => 31,
    ));
    
    
    $wp_customize->add_setting('custom_favicon');

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'custom_favicon', array(
        'label' => 'Custom Favicon',
        'section' => 'tress_custom_favicon_setting',
        'settings' => 'custom_favicon',
                 'priority' => 1,
            )
            )
    );
    
     // Add new section for custom favicon settings
    $wp_customize->add_section('tress_tracking_code_setting', array(
        'title' => __('Tracking Code', 'tress'),
        'priority' => 32,
    ));
    
    $wp_customize->add_setting('tracking_code', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'sanitize_js_callback' => 'tress_sanitize_escaping', 
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tracking_code', array(
            'label' => __('Tracking Code', 'tress'),
            'section' => 'tress_tracking_code_setting',
            'settings' => 'tracking_code',
            'priority' => 2,
        )));
    
         // Add new section for Header Contact settings
    $wp_customize->add_section('header_contact_setting', array(
        'title' => __('Header Contact', 'tress'),
        'priority' => 34,
    ));
    
    $wp_customize->add_setting('header_contact', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'header_contact', array(
            'label' => __('Contact Detail', 'tress'),
            'section' => 'header_contact_setting',
            'settings' => 'header_contact',
            'priority' => 2,
        )));
        
        
        
           // Add new section for Social Icons
    $wp_customize->add_section('social_icon_setting', array(
        'title' => __('Social Icons', 'tress'),
        'priority' => 35,
    ));
    
    // link url
        $wp_customize->add_setting('facebook_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('facebook_link_url', array(
            'label' => __('Facebook URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'facebook_link_url',
            'priority' => 1,
            
        ));
        
        // link url
        $wp_customize->add_setting('twitter_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('twitter_link_url', array(
            'label' => __('Twitter URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'twitter_link_url',
            'priority' => 2,
            
        ));
        
        // link url
        $wp_customize->add_setting('googleplus_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('googleplus_link_url', array(
            'label' => __('Google Plus URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'googleplus_link_url',
            'priority' => 3,
            
        ));
        
        // link url
        $wp_customize->add_setting('pinterest_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('pinterest_link_url', array(
            'label' => __('Pinterest URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'pinterest_link_url',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('github_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('github_link_url', array(
            'label' => __('Github URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'github_link_url',
            'priority' => 5,
            
        ));
        
        // link url
        $wp_customize->add_setting('youtube_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('youtube_link_url', array(
            'label' => __('Youtube URL', 'tress'),
            'section' => 'social_icon_setting',
            'settings' => 'youtube_link_url',
            'priority' => 6,
            
        ));
        
    // Add new section for slider settings
    $wp_customize->add_section('home_slider_setting', array(
        'title' => __('Home Slider', 'tress'),
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
            'label' => __('Slider One Title', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_one',
             'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('slider_one_url', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_one_url', array(
            'label' => __('Slider One URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_one_url',
             'priority' => 3,
           
        ));
        
        $wp_customize->add_setting('slider_one_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'slider_one_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_one_description',
            'priority' => 4,
        )));
        
        // link text
    $wp_customize->add_setting('slider_one_link_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_one_link_text', array(
        'label' => __('Slider One Link Text', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_one_link_text',
        'priority' => 5,
    ));

    // link url
    $wp_customize->add_setting('slider_one_link_url', array('default' => __('', 'tress'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_one_link_url', array(
        'label' => __('Slider One Link URL', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_one_link_url',
        'priority' => 6,
    ));
        

   $wp_customize->add_setting('slider_two', array(
       'transport'=> 'postMessage',
   ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_two', array(
        'label' => 'Slider 2',
        'section' => 'home_slider_setting',
        'settings' => 'slider_two',
                 'priority' => 7,
            )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_two', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_two', array(
            'label' => __('Slider Two Title', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_two',
             'priority' => 8,
            
        ));
        
        $wp_customize->add_setting('slider_two_url', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_two_url', array(
            'label' => __('Slider Two URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_two_url',
             'priority' => 9,
           
        ));
        
        $wp_customize->add_setting('slider_two_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'slider_two_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_two_description',
            'priority' => 10,
        )));
        
        // link text
    $wp_customize->add_setting('slider_two_link_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_two_link_text', array(
        'label' => __('Slider Two Link Text', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_two_link_text',
        'priority' => 11,
    ));

    // link url
    $wp_customize->add_setting('slider_two_link_url', array('default' => __('', 'tress'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_two_link_url', array(
        'label' => __('Slider Two Link URL', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_two_link_url',
        'priority' => 12,
    ));

    $wp_customize->add_setting('slider_three', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_three', array(
        'label' => 'Slider 3',
        'section' => 'home_slider_setting',
        'settings' => 'slider_three',
                 'priority' => 13,
            )
            )
    );
    
    
     // slider Title
        $wp_customize->add_setting('slider_title_three', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_three', array(
            'label' => __('Slider Three Title', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_three',
             'priority' => 14,
            
        ));
        
         $wp_customize->add_setting('slider_three_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_three_url', array(
            'label' => __('Slider Three URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_three_url',
             'priority' => 15,
           
        ));
        
       $wp_customize->add_setting('slider_three_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
           'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'slider_three_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_three_description',
            'priority' => 16,
        )));
        
        // link text
    $wp_customize->add_setting('slider_three_link_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_three_link_text', array(
        'label' => __('Slider Three Link Text', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_three_link_text',
        'priority' => 17,
    ));

    // link url
    $wp_customize->add_setting('slider_three_link_url', array('default' => __('', 'tress'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('slider_three_link_url', array(
        'label' => __('Slider Three Link URL', 'tress'),
        'section' => 'home_slider_setting',
        'settings' => 'slider_three_link_url',
        'priority' => 18,
    ));
    
    $wp_customize->add_setting('slider_four', array(
        'transport'=> 'postMessage',
    ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'slider_four', array(
        'label' => 'Slider 4',
        'section' => 'home_slider_setting',
        'settings' => 'slider_four',
                 'priority' => 19,
            )
            )
    );
    
    // slider Title
        $wp_customize->add_setting('slider_title_four', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_four', array(
            'label' => __('Slider Four Title', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_four',
             'priority' => 20,
            
        ));
        
         $wp_customize->add_setting('slider_four_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_four_url', array(
            'label' => __('Slider Four URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_url',
             'priority' => 21,
           
        ));
        
        $wp_customize->add_setting('slider_four_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'slider_four_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_description',
            'priority' => 22,
        )));
        
        
        // link text
        $wp_customize->add_setting('slider_four_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control('slider_four_link_text', array(
            'label' => __('Slider Four Link Text', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_link_text',
            'priority' => 23,
        ));

        // link url
        $wp_customize->add_setting('slider_four_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control('slider_four_link_url', array(
            'label' => __('Slider Four Link URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_four_link_url',
            'priority' => 24,
        ));

        $wp_customize->add_setting('slider_five', array(
            'transport'=> 'postMessage',
        ));

        $wp_customize->add_control(
                new WP_Customize_Image_Control(
                $wp_customize, 'slider_five', array(
            'label' => 'Slider 5',
            'section' => 'home_slider_setting',
            'settings' => 'slider_five',
                     'priority' => 25,
                )
                )
        );
    
        // slider Title
        $wp_customize->add_setting('slider_title_five', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_title_five', array(
            'label' => __('Slider Five Title', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_title_five',
             'priority' => 26,
            
        ));
        
         $wp_customize->add_setting('slider_five_url', array(
            'sanitize_callback' => 'sanitize_text_field',
             'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('slider_five_url', array(
            'label' => __('Slider Five URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_url',
             'priority' => 27,
           
        ));
        
        $wp_customize->add_setting('slider_five_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'slider_five_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_description',
            'priority' => 28,
        )));
        
        // link text
        $wp_customize->add_setting('slider_five_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control('slider_five_link_text', array(
            'label' => __('Slider Five Link Text', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_link_text',
            'priority' => 29,
        ));

        // link url
        $wp_customize->add_setting('slider_five_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control('slider_five_link_url', array(
            'label' => __('Slider Five Link URL', 'tress'),
            'section' => 'home_slider_setting',
            'settings' => 'slider_five_link_url',
            'priority' => 30,
        ));
        
           // Add new section for Home Tagline settings
    $wp_customize->add_section('tagline_setting', array(
        'title' => __('Home Tagline', 'tress'),
        'priority' => 37,
    ));
    
    
    // Tagline Title
        $wp_customize->add_setting('tagline_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('tagline_title', array(
            'label' => __('Tagline', 'tress'),
            'section' => 'tagline_setting',
            'settings' => 'tagline_title',
           
        ));
        
        $wp_customize->add_setting('tagline_description', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tagline_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'tagline_setting',
            'settings' => 'tagline_description',
            'priority' => 20,
        )));
        
            
     // Add new section for Home Featured Title settings
    $wp_customize->add_section('home_featured_title_setting', array(
        'title' => __('Home Featured Title', 'tress'),
        'priority' => 38,
    ));
    
    // home Title
        $wp_customize->add_setting('home_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_title', array(
            'label' => __('Section Title', 'tress'),
            'section' => 'home_featured_title_setting',
            'settings' => 'home_title',
            'priority' => 1,
           
        ));
       
        
     // Add new section for Home Featured One settings
    $wp_customize->add_section('home_featured_one_setting', array(
        'title' => __('Home Featured #1', 'tress'),
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
            'label' => __('Title', 'tress'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_title_one',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_one', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'home_description_one', array(
            'label' => __('Description', 'tress'),
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
            'label' => __('Link Text', 'tress'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_one_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_one_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_one_link_url', array(
            'label' => __('Link URL', 'tress'),
            'section' => 'home_featured_one_setting',
            'settings' => 'home_one_link_url',
            'priority' => 5,
            
        ));
        
       // Add new section for Home Featured Two settings
    $wp_customize->add_section('home_featured_two_setting', array(
        'title' => __('Home Featured #2', 'tress'),
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
            'label' => __('Title', 'tress'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_title_two',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_two', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'home_description_two', array(
            'label' => __('Description', 'tress'),
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
            'label' => __('Link Text', 'tress'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_two_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_two_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_two_link_url', array(
            'label' => __('Link URL', 'tress'),
            'section' => 'home_featured_two_setting',
            'settings' => 'home_two_link_url',
            'priority' => 5,
            
        ));
        
        
        
        // Add new section for Home Featured Three settings
    $wp_customize->add_section('home_featured_three_setting', array(
        'title' => __('Home Featured #3', 'tress'),
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
            'label' => __('Title', 'tress'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_title_three',
            'priority' => 2,
           
        ));
        
        $wp_customize->add_setting('home_description_three', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'home_description_three', array(
            'label' => __('Description', 'tress'),
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
            'label' => __('Link Text', 'tress'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_three_link_text',
            'priority' => 4,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_three_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_three_link_url', array(
            'label' => __('Link URL', 'tress'),
            'section' => 'home_featured_three_setting',
            'settings' => 'home_three_link_url',
            'priority' => 5,
            
        ));
        
        
        
            // Add new section for displaying Featured Portfolio on Front Page
    $wp_customize->add_section('tress_front_page_portfolio_options', array(
        'title' => __('Portfolio Settings', 'tress'),
        'description' => __('Settings for displaying featured portfolio on Front Page', 'tress'),
        'priority' => 52,
    ));
    // post Title
        $wp_customize->add_setting('tress_portfolio_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('tress_portfolio_title', array(
            'label' => __('Section Title', 'tress'),
            'section' => 'tress_front_page_portfolio_options',
            'settings' => 'tress_portfolio_title',
            'priority' => 1,
           
        ));
       
    // enable featured portfolio on front page?
    $wp_customize->add_setting('tress_front_featured_portfolio_check', array(
        'default' => 0, 
        'sanitize_callback' => 'tress_sanitize_checkbox',
    ));
    $wp_customize->add_control('tress_front_featured_portfolio_check', array(
        'label' => __('Show featured portfolio on Front Page', 'tress'),
        'section' => 'tress_front_page_portfolio_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('tress_front_featured_portfolio_count', array(
        'default' => 3,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'=> 'postMessage',
    ));
    $wp_customize->add_control('tress_front_featured_portfolio_count', array(
        'label' => __('Number of portfolio to display', 'tress'),
        'section' => 'tress_front_page_portfolio_options',
        'settings' => 'tress_front_featured_portfolio_count',
        'priority' => 20,
    ));
     
    
    $wp_customize->add_setting('tress_portfolio_front_count', array(
            'default' => 9,
            'sanitize_callback' => 'tress_sanitize_integer',
        ));
        $wp_customize->add_control('tress_portfolio_front_count', array(
            'label' => __('Portfolio Item Count', 'tress'),
            'section' => 'tress_front_page_portfolio_options',
            'settings' => 'tress_portfolio_front_count',
            'priority' => 40,
        ));
    
    
        
        // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('tress_front_page_post_options', array(
        'title' => __('Featured Posts', 'tress'),
        'description' => __('Settings for displaying featured posts on Front Page', 'tress'),
        'priority' => 55,
    ));
    // post Title
        $wp_customize->add_setting('tress_post_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('tress_post_title', array(
            'label' => __('Section Title', 'tress'),
            'section' => 'tress_front_page_post_options',
            'settings' => 'tress_post_title',
            'priority' => 1,
           
        ));
        
       
        // enable featured posts on front page?
        $wp_customize->add_setting('tress_front_featured_posts_check', array(
            'default' => 1, 
            'sanitize_callback' => 'tress_sanitize_checkbox',
        ));
        $wp_customize->add_control('tress_front_featured_posts_check', array(
            'label' => __('Show featured posts on Front Page', 'tress'),
            'section' => 'tress_front_page_post_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));

        // select number of posts for featured posts on front page
        $wp_customize->add_setting('tress_front_featured_posts_count', array(
            'default' => 3,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
        ));
        $wp_customize->add_control('tress_front_featured_posts_count', array(
            'label' => __('Number of posts to display', 'tress'),
            'section' => 'tress_front_page_post_options',
            'settings' => 'tress_front_featured_posts_count',
            'priority' => 20,
        ));
           // select category for featured posts 
        $wp_customize->add_setting('tress_front_featured_posts_cat', array('default' => 0,));
        $wp_customize->add_control(new WP_Customize_Dropdown_Categories_Control($wp_customize, 'tress_front_featured_posts_cat', array(
            'label' => __('Post Category', 'tress'),
            'section' => 'tress_front_page_post_options',
            'type' => 'dropdown-categories',
            'settings' => 'tress_front_featured_posts_cat',
            'priority' => 30,
        )));


                // Add new section for Home CTA settings
        $wp_customize->add_section('home_cta_setting', array(
            'title' => __('Home CTA', 'tress'),
            'priority' => 60,
        ));

        $wp_customize->add_setting('cta_title', array(
                'sanitize_callback' => 'sanitize_text_field',
                'transport'=> 'postMessage',
                ));
        
        $wp_customize->add_control('cta_title', array(
            'label' => __('Title', 'tress'),
            'section' => 'home_cta_setting',
            'settings' => 'cta_title',
            'priority' => 1,
           
        ));
    
         $wp_customize->add_setting('cta_text', array('default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'cta_text', array(
            'label' => __('CTA Text', 'tress'),
            'section' => 'home_cta_setting',
            'settings' => 'cta_text',
            'priority' => 2,
        )));
        
        
         // link text
        $wp_customize->add_setting('home_cta_link_text', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_cta_link_text', array(
            'label' => __('Link Text', 'tress'),
            'section' => 'home_cta_setting',
            'settings' => 'home_cta_link_text',
            'priority' => 3,
            
        ));
        
        // link url
        $wp_customize->add_setting('home_cta_link_url', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('home_cta_link_url', array(
            'label' => __('Link URL', 'tress'),
            'section' => 'home_cta_setting',
            'settings' => 'home_cta_link_url',
            'priority' => 4,
            
        ));
        
            // Add new section for Home Feedback Title settings
    $wp_customize->add_section('feedback_title_setting', array(
        'title' => __('Testimonial Title', 'tress'),
        'priority' => 62,
    ));
    
    // home Title
        $wp_customize->add_setting('feedback_title', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('feedback_title', array(
            'label' => __('Section Title', 'tress'),
            'section' => 'feedback_title_setting',
            'settings' => 'feedback_title',
            'priority' => 1,
           
        ));
        
        
        // Add new section for Testimonial slider settings
    $wp_customize->add_section('testimonial_slider_setting', array(
        'title' => __('Testimonial Slider', 'tress'),
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
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tslider_one_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_one_description',
            'priority' => 2,
        )));
        
        $wp_customize->add_setting('client_name_one', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_one', array(
            'label' => __('Client Name', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_one',
            'priority' => 3,
           
        ));
        
        $wp_customize->add_setting('client_name_url_one', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_url_one', array(
            'label' => __('Name URL', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_url_one',
            'priority' => 4,
            
        ));
        
        $wp_customize->add_setting('tslider_two', array(
            'transport'=> 'postMessage',
        ));

    $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_two', array(
        'label' => 'Slider 2',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_two',
                 'priority' => 5,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_two_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tslider_two_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_two_description',
            'priority' => 6,
        )));
        
        $wp_customize->add_setting('client_name_two', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_two', array(
            'label' => __('Client Name', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_two',
            'priority' => 7,
           
        ));
        
        $wp_customize->add_setting('client_name_url_two', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_url_two', array(
            'label' => __('Name URL', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_url_two',
            'priority' => 8,
            
        ));
        
         $wp_customize->add_setting('tslider_three', array(
             'transport'=> 'postMessage',
         ));
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_three', array(
        'label' => 'Slider 3',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_three',
                 'priority' => 9,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_three_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tslider_three_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_three_description',
            'priority' => 10,
        )));
        
        $wp_customize->add_setting('client_name_three', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_three', array(
            'label' => __('Client Name', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_three',
            'priority' => 11,
           
        ));
        
        $wp_customize->add_setting('client_name_url_three', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_url_three', array(
            'label' => __('Name URL', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_url_three',
            'priority' => 12,
            
        ));
        
        $wp_customize->add_setting('tslider_four', array(
             'transport'=> 'postMessage',
         ));
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_four', array(
        'label' => 'Slider 4',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_four',
                 'priority' => 13,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_four_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tslider_four_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_four_description',
            'priority' => 14,
        )));
        
        $wp_customize->add_setting('client_name_four', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_four', array(
            'label' => __('Client Name', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_four',
            'priority' => 15,
           
        ));
        
        $wp_customize->add_setting('client_name_url_four', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_url_four', array(
            'label' => __('Name URL', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_url_four',
            'priority' => 16,
            
        ));
      
        
        $wp_customize->add_setting('tslider_five', array(
             'transport'=> 'postMessage',
         ));
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
            $wp_customize, 'tslider_five', array(
        'label' => 'Slider 5',
        'section' => 'testimonial_slider_setting',
        'settings' => 'tslider_five',
                 'priority' => 17,
     
                )
            )
    );
    
        $wp_customize->add_setting('tslider_five_description', array('default' => '',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tslider_five_description', array(
            'label' => __('Description', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'tslider_five_description',
            'priority' => 18,
        )));
        
        $wp_customize->add_setting('client_name_five', array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_five', array(
            'label' => __('Client Name', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_five',
            'priority' => 19,
           
        ));
        
        $wp_customize->add_setting('client_name_url_five', array('default' => __('', 'tress'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'=> 'postMessage',
            ));
        
        $wp_customize->add_control('client_name_url_five', array(
            'label' => __('Name URL', 'tress'),
            'section' => 'testimonial_slider_setting',
            'settings' => 'client_name_url_five',
            'priority' => 20,
            
        ));
    
     // Add footer text section
    $wp_customize->add_section('tress_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 75,
    ));

    $wp_customize->add_setting('tress_footer_footer_text', array(
        'default' => null,
        'sanitize_js_callback' => 'tress_sanitize_escaping',
        'transport'=> 'postMessage',
        
    ));
    $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tress_footer_footer_text', array(
        'section' => 'tress_footer', // id of section to which the setting belongs
        'settings' => 'tress_footer_footer_text',
    )));

    
    // Add custom CSS section
    $wp_customize->add_section('tress_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));
    
    $wp_customize->add_setting('tress_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'tress_sanitize_custom_css',
        'sanitize_js_callback' => 'tress_sanitize_escaping',
        'transport'=> 'postMessage',
    ));
    
    $wp_customize->add_control(new tress_customize_textarea_control($wp_customize, 'tress_custom_css', array(
        'section' => 'tress_custom_css', // id of section to which the setting belongs
        'settings' => 'tress_custom_css', 
    )));
    
   
    // Disable one page navigation on front page.
    $wp_customize->add_setting('tress_one_page_nav_check', array(
        'default' => 0, 
        'sanitize_callback' => 'tress_sanitize_checkbox',
    ));
    $wp_customize->add_control('tress_one_page_nav_check', array(
        'label' => __('Disable one page navigation', 'tress'),
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

add_action('customize_register', 'tress_customize_register');



/*
 * Sanitize numeric values 
 * 
 * @since Tress 1.0
 */
function tress_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
    return intval( $input );
    }
}

/*
 * Escaping for input values
 * 
 * @since Tress 1.0
 */
function tress_sanitize_escaping( $input) {
    $input = esc_attr( $input);
    return $input;
}


/* 
 * Sanitize Custom CSS 
 * 
 * @since Tress 1.0
 */

function tress_sanitize_custom_css( $input) {
    $input = wp_kses_stripslashes( $input);
    return $input;
}	

/*
 * Sanitize Checkbox input values
 * 
 * @since Tress 1.0
 */
function tress_sanitize_checkbox( $input ) {
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
 * @since Tress 1.0
 */
function tress_sanitize_color_scheme_option($colorscheme_option){
    if ( ! in_array( $colorscheme_option, array( 'blue','red','green','yellow','purple','orange','brown','pink' ) ) ) {
		$colorscheme_option = 'blue';
	}

	return $colorscheme_option;
}


/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Tress 1.0
 */
function tress_customize_preview_js() {
    wp_enqueue_script('tress_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20131205', true);
}

add_action('customize_preview_init', 'tress_customize_preview_js');


function tress_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php echo esc_attr(get_theme_mod('tress_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'tress_header_output');

function tress_footer_tracking_code() {
    echo esc_attr(get_theme_mod('tracking_code'));
}
add_action('wp_footer','tress_footer_tracking_code'); 