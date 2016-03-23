<?php

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'erika'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'erika'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */

            $erika_columns = array('Disable',1,2,3,4,5,6,7,8,9,10,11,12);

            // Background Patterns Reader
            $sample_patterns_path   = get_template_directory() . '/mas/images/bg';
            $sample_patterns_url    = get_template_directory_uri() . '/mas/images/bg/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'erika'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'erika'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'erika'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'erika') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://softmediabd.com', 'erika'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General Settings', 'erika'),
                'fields'    => array(
                    
                    array(
                        'id'        => 'textarea_trackingcode',
                        'type'      => 'textarea',
                        'title'     => __('Tracking Code', 'erika'),
                        'subtitle'  => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'erika'),
                    ),

                    array(
                        'id'        => 'media_favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Favicon Upload (16x16)', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your Favicon (16x16px ico/png - use <a href='http://www.favicon.cc/' target='_blank'>favicon.cc</a> to make sure it's fully compatible",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'media_favicon_iphone',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Apple iPhone Icon Upload (57x57)', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your Apple Touch Icon (57x57px png)",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'media_favicon_iphone_retina',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Apple iPhone Retina Icon Upload (114x114)', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your Apple Touch Retina Icon (114x114px png)",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'media_favicon_ipad',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Apple iPad Icon Upload (72x72)', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your Apple Touch Retina Icon (144x144px png)",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'media_favicon_ipad_retina',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Apple iPad Retina Icon Upload (144x144px)', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your Apple Touch Retina Icon (144x144px png)",
                        'default'   => array(),
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-glasses',
                'title'     => __('Layout', 'erika'),
                'fields'    => array(

                    array(
                        'id'        => 'select_main_layout',
                        'type'      => 'radio',
                        'title'     => __('Theme Layout', 'erika'),
                        'subtitle'  => __('Select your themes layout.', 'erika'),
                        'options'   => array('fullwidth' => 'Full Width', 'boxed' => 'Boxed', 'boxed margin' => 'Boxed with Margin'),
                        'default'   => 'fullwidth',
                    ),

                    array(
                        'id'        => 'select_theme_grid',
                        'type'      => 'radio',
                        'title'     => __('Theme Width', 'erika'),
                        'subtitle'  => __('Select your themes width.', 'erika'),
                        'options'   => array('normal-grid' => '1170px', 'old-grid' => '960px'),
                        'default'   => 'normal-grid',
                    ),

                    array(
                        'id'        => 'image_background',
                        'type'      => 'image_select',
                        'tiles'     => true,
                        'required'  => array(array('select_main_layout', '=', array('boxed','boxed margin'))),
                        'title'     => __('Background Images', 'erika'),
                        'subtitle'  => __('Select a background images', 'erika'),
                        'default'   => 0,
                        'options'   => $sample_patterns,
                        'output'        => array('body.boxed'),
                    ),

                    array(
                        'id'        => 'image_background_repeat',
                        'type'      => 'select',
                        'required'  => array(array('select_main_layout', '=', array('boxed','boxed margin'))),
                        'title'     => __('Background Repeat', 'erika'),
                        'subtitle'  => __('Select your background image repeat.', 'erika'),
                        'options'   => array('cover' => 'Cover', 'repeat' => 'Repeat', 'no-repeat' => 'No Repeat', 'repeat-x' => 'Repeat X', 'repeat-y' => 'Repeat Y'),
                        'default'   => 'cover',
                    ),

                    array(
                        'id'        => 'images_custom_background',
                        'required'  => array(array('select_main_layout', '=', array('boxed','boxed margin'))),
                        'type'      => 'background',
                        'url'       => true,
                        'title'     => __('Custom Background Images', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your custom background images or paste image url",
                        'default'   => array(),
                        'output'        => array('body.boxed'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-puzzle',
                'title'     => __('Header', 'erika'),
                'fields'    => array(

                    array(
                        'id'        => 'switch_fixed_header',
                        'type'      => 'switch',
                        'title'     => __('Fixed Header', 'erika'),
                        'on'        => 'Enabled',
                        'off'       => 'Disabled',
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'textarea_callus',
                        'type'      => 'textarea',
                        'title'     => __('Call us content', 'erika'),
                        'subtitle'  => __('Enter your content of call us area', 'erika'),
                        'validate'  => 'html',
                    ),

                    array(
                        'id'        => 'select_header_menu_style',
                        'type'      => 'radio',
                        'title'     => __('Menu Style', 'erika'),
                        'options'   => array('default' => 'Default', 'center' => 'Logo Center', 'right' => 'Right Menu', 'right-alt' => 'Right 2 Menu'),
                        'default'   => 'default',
                    ),

                    array(
                        'id'        => 'select_display_logo',
                        'type'      => 'radio',
                        'title'     => __('Display logo as', 'erika'),
                        'options'   => array('logo' => 'Logo', 'text' => 'Text'),
                        'default'   => 'logo',
                    ),

                    array(
                        'id'        => 'images_custom_logo',
                        'required'  => array(array('select_display_logo', '=', 'logo')),
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Logo Image', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your custom logo images or paste image url",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'images_retina_logo',
                        'required'  => array(array('select_display_logo', '=', 'logo')),
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Logo Image for Retina Devices', 'erika'),
                        'compiler'  => 'true',
                        'desc'      => "Upload your custom logo images or paste image url",
                        'default'   => array(),
                    ),

                    array(
                        'id'        => 'logo_spacing',
                        'output'        => array('.site-title'),
                        'required'  => array(array('select_display_logo', '=', 'logo')),
                        'type'      => 'spacing',
                        'mode'      => 'margin',
                        'title'     => __('Logo Spacing', 'erika'),
                        'units'         => 'px',
                        'right' => false, 
                        'left' => false,
                        'default' => array(
                            'margin-top' => '0px',
                            'margin-bottom' => '0px',
                        )
                    ),

            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-photo',
                'title'     => __('Footer', 'erika'),
                'fields'    => array(

                    // Footer contact settings

                    array(
                        'id'        => 'footer_check_contact',
                        'type'      => 'checkbox',
                        'title'     => __('Enable Footer Contact', 'erika'),
                        'subtitle'  => __('Display contact map above Footer Widget', 'erika'),
                    ),

                    array(
                        'id'        => 'footer_map_url',
                        'required'  => array(array('footer_check_contact', '=', 1)),
                        'type'      => 'text',
                        'title'     => __('Google Map Address', 'erika'),
                        'subtitle'  => __('Enter your your Google Map Address', 'erika'),
                    ),

                    array(
                        'id'        => 'footer_map_zoom',
                        'required'  => array(array('footer_check_contact', '=', 1)),
                        'type'      => 'text',
                        'title'     => __('Google Map Zoom', 'erika'),
                        'subtitle'  => __('Enter your your Google Map Zoom', 'erika'),
                        'default'     => 14,
                    ),

                    array(
                        'id'        => 'footer_contact_id',
                        'required'  => array(array('footer_check_contact', '=', 1)),
                        'type'      => 'text',
                        'title'     => __('Gravity form ID', 'erika'),
                        'subtitle'  => __('Enter your Gravity form ID', 'erika'),
                    ),

                    array(
                        'id'        => 'footer_contact_heading_title',
                        'required'  => array(array('footer_check_contact', '=', 1)),
                        'type'      => 'text',
                        'title'     => __('Heading Title', 'erika'),
                    ),

                    array(
                        'id'        => 'footer_contact_subheading_title',
                        'required'  => array(array('footer_check_contact', '=', 1)),
                        'type'      => 'text',
                        'title'     => __('Sub Heading Title', 'erika'),
                    ),



                    // Footer Widget Row 1

                    array(
                        'id'        => 'select_footer_widget_1_1_width',
                        'type'      => 'select',
                        'title'     => __('Footer Widget 1 Width', 'erika'),
                        'subtitle'  => __('Select your footer widget 1 width.', 'erika'),
                        'options'   => $erika_columns,
                        'default'   => '3',
                    ),
                    array(
                        'id'        => 'select_footer_widget_1_2_width',
                        'type'      => 'select',
                        'title'     => __('Footer Widget 2 Width', 'erika'),
                        'subtitle'  => __('Select your footer widget 2 width.', 'erika'),
                        'options'   => $erika_columns,
                        'default'   => '3',
                    ),
                    array(
                        'id'        => 'select_footer_widget_1_3_width',
                        'type'      => 'select',
                        'title'     => __('Footer Widget 3 Width', 'erika'),
                        'subtitle'  => __('Select your footer widget 3 width.', 'erika'),
                        'options'   => $erika_columns,
                        'default'   => '3',
                    ),
                    array(
                        'id'        => 'select_footer_widget_1_4_width',
                        'type'      => 'select',
                        'title'     => __('Footer Widget 4 Width', 'erika'),
                        'subtitle'  => __('Select your footer widget 4 width.', 'erika'),
                        'options'   => $erika_columns,
                        'default'   => '3',
                    ),

                    array(
                        'id'        => 'footer_copyright',
                        'type'      => 'editor',
                        'title'     => __('Footer Copyright Text', 'erika'),
                        'subtitle'  => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'erika'),
                        'default'   => 'Design by softmediabd',
                    ),

            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-adjust',
                'title'     => __('Theme Color', 'erika'),
                'fields'    => array(


                    array(
                        'id' => 'opt-general-color',
                        'type' => 'info',
                        'desc' => __('General Color', 'erika')
                    ),

                    array(
                        'id' => 'general_background',
                        'type' => 'color',
                        'title' => __('General Background Color', 'erika'),
                        'subtitle' => __('Pick a background color for the main site.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background',
                        'output' => array('.blog-item .blog-info .blog-title','.contactblock','.contact-modal .contact-modeal-heading','.stepbox .step','.probox .probox-heading','.jobbox .jobbox-footer a','.header-icon-search','.woocommerce #content div.product p.price', '.woocommerce #content div.product span.price', '.woocommerce div.product p.price', '.woocommerce div.product span.price','.woocommerce-page #content div.product p.price','.woocommerce-page #content div.product span.price', '.woocommerce-page div.product p.price', '.woocommerce-page div.product span.price',),
                    ),

                    array(
                        'id' => 'general_border',
                        'type' => 'color',
                        'title' => __('General Border Color', 'erika'),
                        'subtitle' => __('Pick a border color for the main site.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('.button.stroke','.button.stroke .icon','.field input.error','.accordion.faq.toggle .accordion-item.active','.callout.action','.iconbox.top .iconbox-content h4','.blog-item.small.sticky','.contactblock input',),
                    ),

                    array(
                        'id' => 'general_color',
                        'type' => 'color',
                        'title' => __('General Color', 'erika'),
                        'subtitle' => __('Pick a color for the main site.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.button.stroke','.testimonail-detail .testimonial-info span.name','.counter-box .counter-icon','.service-box .service-icon','.accordion .accordion-heading .accordion-title a','.accordion .accordion-heading .accordion-title a:after','.tabs.main .tabNavigation li.active a','.tabs.center .tabNavigation li.active a','.pricing-table .pricing-content ul li i','.iconbox .iconbox-icon','.carouselbox .nav a:hover','.icon-list i',),
                    ),

                    array(
                        'id' => 'opt-info-link',
                        'type' => 'info',
                        'desc' => __('Link & Form Color', 'erika')
                    ),

                    array(
                        'id' => 'link-color',
                        'type' => 'link_color',
                        'title' => __('Links Color', 'erika'),
                        'output'    => array('a','h1 a','h2 a','h3 a','h4 a','h5 a','h6 a'),
                        'default' => array(
                            'regular' => '#272727',
                            'hover' => '#EF4A43',
                            'active' => '#EF4A43',
                        )
                    ),

                    array(
                        'id' => 'button_color',
                        'type' => 'color',
                        'title' => __('Button Color', 'erika'),
                        'subtitle' => __('Pick a background color for the button.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background',
                        'output' => array('.button','button','input[type="submit"]','input[type="button"]','input[type="reset"]'),
                    ),

                    array(
                        'id' => 'button_color_hover',
                        'type' => 'color',
                        'title' => __('Button Hover Color', 'erika'),
                        'subtitle' => __('Pick a background hover color for the button.', 'erika'),
                        'default' => '#272727',
                        'validate' => 'color',
                        'mode'      => 'background',
                        'output' => array('.button:hover','.button:focus','button:hover','button:focus','input[type="submit"]:hover','input[type="button"]:hover','input[type="reset"]:hover','input[type="submit"]:focus','input[type="button"]:focus','input[type="reset"]:focus',),
                    ),

                    // main header background

                    array(
                        'id' => 'opt-info-header',
                        'type' => 'info',
                        'desc' => __('Header Menu Background', 'erika')
                    ),


                    // top header info

                    array(
                        'id' => 'top_header_background',
                        'type' => 'color',
                        'title' => __('Top Header Background', 'erika'),
                        'subtitle' => __('Pick a background for top header.', 'erika'),
                        'default' => '#fbfbfb',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#header .top-header',),
                    ),

                    array(
                        'id' => 'header_main_menu_background',
                        'type' => 'color',
                        'title' => __('Main Header Menu Background', 'erika'),
                        'subtitle' => __('Pick a background for main menu.', 'erika'),
                        'default' => '#919191',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#header .site-menu .site-menu-inner',),
                    ),
                    array(
                        'id' => 'header_main_menu_border',
                        'type' => 'color',
                        'title' => __('Main Header Menu Border', 'erika'),
                        'subtitle' => __('Pick a border color for main menu.', 'erika'),
                        'default' => '#a3a3a3',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('#header .site-menu .site-menu-inner ul li a',),
                    ),


                    // header menu color

                    array(
                        'id' => 'header_menu_background',
                        'type' => 'color',
                        'title' => __('Header Menu Background', 'erika'),
                        'subtitle' => __('Pick a background for menu.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#header .site-menu .site-menu-inner ul > li.sfHover > a','#header .site-menu .site-menu-inner ul li a:hover','#header .site-menu .site-menu-inner ul li.current-menu-item > a','#header .site-menu .site-menu-inner ul ul','#header .site-menu .site-menu-inner .sf-mega-content','#header .menu-container.sm .site-menu .site-menu-inner ul li a:hover','#header .menu-container.sm .site-menu .site-menu-inner ul > li.sfHover > a','#header .menu-container.sm .site-menu .site-menu-inner ul li.current-menu-item > a','#header .menu-container.sma .site-menu .site-menu-inner ul li a:hover','#header .menu-container.sma .site-menu .site-menu-inner ul > li.sfHover > a','#header .menu-container.sma .site-menu .site-menu-inner ul li.current-menu-item > a',),
                    ),

                    array(
                        'id' => 'header_menu_border_background',
                        'type' => 'color',
                        'title' => __('Header Menu Border', 'erika'),
                        'subtitle' => __('Pick a color for border menu.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('#header .site-menu .site-menu-inner ul > li.sfHover > a','#header .site-menu .site-menu-inner ul li a:hover','#header .site-menu .site-menu-inner ul li.current-menu-item > a','#header .site-menu .site-menu-inner ul ul','#header .site-menu .site-menu-inner .sf-mega-content','#header .menu-container.sm .site-menu .site-menu-inner ul li a:hover','#header .menu-container.sm .site-menu .site-menu-inner ul > li.sfHover > a','#header .menu-container.sm .site-menu .site-menu-inner ul li.current-menu-item > a','#header .menu-container.sma .site-menu .site-menu-inner ul li a:hover','#header .menu-container.sma .site-menu .site-menu-inner ul > li.sfHover > a','#header .menu-container.sma .site-menu .site-menu-inner ul li.current-menu-item > a','#header .site-menu .site-menu-inner ul ul li',),
                    ),

                    array(
                        'id' => 'header_menu_submenu_background',
                        'type' => 'color',
                        'title' => __('Header Sub Menu Background', 'erika'),
                        'subtitle' => __('Pick a color for sub menu background color.', 'erika'),
                        'default' => '#F35C4C',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#header .menu-container.sma .site-menu .site-menu-inner ul ul a:hover','#header .menu-container.sma .site-menu .site-menu-inner ul ul li.sfHover > a','#header .menu-container.sma .site-menu .site-menu-inner ul ul li.current-menu-item > a','#header .menu-container.sm .site-menu .site-menu-inner ul ul a:hover','#header .menu-container.sm .site-menu .site-menu-inner ul ul li.sfHover > a','#header .menu-container.sm .site-menu .site-menu-inner ul ul li.current-menu-item > a','#header .site-menu .site-menu-inner ul ul a:hover','#header .site-menu .site-menu-inner ul ul li.sfHover > a','#header .site-menu .site-menu-inner ul ul li.current-menu-item > a',),
                    ),

                    // heading
                    
                    array(
                        'id' => 'opt-info-heading-nav',
                        'type' => 'info',
                        'desc' => __('Heading Navigation', 'erika')
                    ),

                    array(
                        'id' => 'head_nav_border',
                        'type' => 'color',
                        'title' => __('Heading Nav Border Color', 'erika'),
                        'subtitle' => __('Pick a color for heading navigation', 'erika'),
                        'default' => '#f0f0f0',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('.heading-nav','.heading-nav ul li a',),
                    ),

                    array(
                        'id' => 'head_nav_hover_border',
                        'type' => 'color',
                        'title' => __('Heading Nav Border Color Hover', 'erika'),
                        'subtitle' => __('Pick a color hover for heading navigation', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('.heading-nav ul li a:hover','.heading-nav ul li.active a',),
                    ),


                    // footer background color
                    array(
                        'id' => 'opt-info-footer-style',
                        'type' => 'info',
                        'desc' => __('Footer Style', 'erika')
                    ),

                    array(
                        'id' => 'footer_widget_background',
                        'type' => 'color',
                        'title' => __('Footer Widget Background', 'erika'),
                        'subtitle' => __('Pick a background for footer background color.', 'erika'),
                        'default' => '#3f3f3f',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#footer .footer-widget',),
                    ),

                    array(
                        'id' => 'footer_widget_title_color',
                        'type' => 'color',
                        'title' => __('Footer Widget Title Color', 'erika'),
                        'subtitle' => __('Pick a color for footer widget title.', 'erika'),
                        'default' => '#fff',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('#footer .footer-widget .widget-title',),
                    ),

                    array(
                        'id' => 'footer_widget_title_span_color',
                        'type' => 'color',
                        'title' => __('Footer Widget Title Span Color', 'erika'),
                        'subtitle' => __('Pick a color for footer widget title span.', 'erika'),
                        'default' => '#e74c3c',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('#footer .footer-widget .widget-title span',),
                    ),

                    array(
                        'id' => 'footer_widget_title_input_color',
                        'type' => 'color',
                        'title' => __('Footer Widget Input Border Color', 'erika'),
                        'subtitle' => __('Pick a color for footer input.', 'erika'),
                        'default' => '#4a4a4a',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('#footer input','#footer textarea','#footer select','#footer button','#footer .footer-widget .widget','#footer .footer-widget .widget ul','#footer .footer-widget .widget ul li','#footer .footer-widget .widget ul li a','#footer .table > thead > tr > th,','#footer .table > tbody > tr > th,','#footer .table > tfoot > tr > th,','#footer .table > thead > tr > td,','#footer .table > tbody > tr > td,','#footer .table > tfoot > tr > td',),
                    ),

                    array(
                        'id' => 'footer_widget_title_border_color',
                        'type' => 'color',
                        'title' => __('Footer Widget Title Border Color', 'erika'),
                        'subtitle' => __('Pick a color for footer widget border.', 'erika'),
                        'default' => '#4a4a4a',
                        'validate' => 'color',
                        'mode'      => 'border-bottom-color',
                        'output' => array('#footer .footer-widget .widget-title',),
                    ),

                    array(
                        'id' => 'footer_credit_background',
                        'type' => 'color',
                        'title' => __('Footer Credit Background', 'erika'),
                        'subtitle' => __('Pick a background for footer credit background color.', 'erika'),
                        'default' => '#3f3f3f',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('#footer .footer-credits',),
                    ),

                    array(
                        'id' => 'footer_credit_boder',
                        'type' => 'color',
                        'title' => __('Footer Credit Border Top Color', 'erika'),
                        'subtitle' => __('Pick a border top color for Footer Credits.', 'erika'),
                        'default' => '#4a4a4a',
                        'validate' => 'color',
                        'mode'      => 'boder-top-color',
                        'output' => array('#footer .footer-credits .footer-credits-inner',),
                    ),

                    array(
                        'id' => 'footer_credit_link',
                        'type' => 'link_color',
                        'title' => __('Footer Credit Links Color', 'erika'),
                        'output'    => array('#footer .footer-credits a'),
                        'default' => array(
                            'regular' => '#eee',
                            'hover' => '#EF4A43',
                            'active' => '#EF4A43',
                        )
                    ),

                    // sidebar
                    array(
                        'id' => 'opt-info-sidebar',
                        'type' => 'info',
                        'desc' => __('Sidebar Widget', 'erika')
                    ),

                    array(
                        'id' => 'sidebar_widget_title_color',
                        'type' => 'color',
                        'title' => __('Widget Title Color', 'erika'),
                        'subtitle' => __('Pick a color widget title.', 'erika'),
                        'default' => '#272727',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.widget-title h4'),
                    ),

                    array(
                        'id' => 'sidebar_widget_title_span_color',
                        'type' => 'color',
                        'title' => __('Widget Title Span Color', 'erika'),
                        'subtitle' => __('Pick a color widget span title.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.widget .widget-title span','.widget.tags a:hover'),
                    ),

                    array(
                        'id' => 'sidebar_widget_list_icon_color',
                        'type' => 'color',
                        'title' => __('Widget List Icon Color', 'erika'),
                        'subtitle' => __('Pick a color for list icon color.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.widget ul li a:before','.widget.contact_widget ul li i','.widget.recent-post ul li .post-meta span i','.widget.contact_widget ul li i'),
                    ),

                    array(
                        'id' => 'sidebar_border_color',
                        'type' => 'color',
                        'title' => __('Widget Border Color', 'erika'),
                        'subtitle' => __('Pick a color for border.', 'erika'),
                        'default' => '#f0f0f0',
                        'validate' => 'color',
                        'mode'      => 'boder-color',
                        'output' => array('.widget ul li','.widget ul li a','.widget'),
                    ),

                    // blog
                    array(
                        'id' => 'opt-info-blog',
                        'type' => 'info',
                        'desc' => __('Blog', 'erika')
                    ),

                    array(
                        'id' => 'blog_icon_background',
                        'type' => 'color',
                        'title' => __('Blog Icon Background', 'erika'),
                        'subtitle' => __('Pick a color for blog icon.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.blog-item .blog-icon'),
                    ),

                    array(
                        'id' => 'blog_meta_icon_color',
                        'type' => 'color',
                        'title' => __('Blog Meta Icon Background', 'erika'),
                        'subtitle' => __('Pick a color for meta icon.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.blog-item .entry-meta span i','.blog-item .entry-info span i'),
                    ),

                    array(
                        'id' => 'blog_entry_action_hover',
                        'type' => 'color',
                        'title' => __('Blog Action Background', 'erika'),
                        'subtitle' => __('Pick a background color blog action .', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.entry-image .entry-action span'),
                    ),

                    array(
                        'id' => 'blog_small_quote_border',
                        'type' => 'color',
                        'title' => __('Blog Small Quote Border Color', 'erika'),
                        'subtitle' => __('Pick a border color for small quote .', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'borer-left-color',
                        'output' => array('.small-quote'),
                    ),

                    array(
                        'id' => 'blog_review_background',
                        'type' => 'color',
                        'title' => __('Blog Review Background Color', 'erika'),
                        'subtitle' => __('Pick a background color for review area.', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.review-box .review-score','.review-box .review-area .progress .progress-bar',),
                    ),

                    // page navi
                    array(
                        'id' => 'opt-info-page-navi',
                        'type' => 'info',
                        'desc' => __('Page Navigation', 'erika')
                    ),

                    array(
                        'id' => 'page_navi_bg',
                        'type' => 'color',
                        'title' => __('Page Navigation Background', 'erika'),
                        'subtitle' => __('Pick a background color for pagenavi.', 'erika'),
                        'default' => '#f0f0f0',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.pagenavi li'),
                    ),

                    array(
                        'id' => 'page_navi_current_bg',
                        'type' => 'color',
                        'title' => __('Page Navigation Current Background', 'erika'),
                        'subtitle' => __('Pick a background color pagenavi current item', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.pagenavi li span'),
                    ),

                    array(
                        'id' => 'page_navi_current_border',
                        'type' => 'color',
                        'title' => __('Page Navigation Current Border', 'erika'),
                        'subtitle' => __('Pick a border color pagenavi current item', 'erika'),
                        'default' => '#343030',
                        'validate' => 'color',
                        'mode'      => 'border-color',
                        'output' => array('.pagenavi li span'),
                    ),

                    // heading area
                    array(
                        'id' => 'opt-info-heading-title',
                        'type' => 'info',
                        'desc' => __('Heading Title', 'erika')
                    ),

                    array(
                        'id' => 'heading_title_border_color',
                        'type' => 'color',
                        'title' => __('Heading Title Border Color', 'erika'),
                        'subtitle' => __('Pick a color for heading title', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'border-left-color',
                        'output' => array('.heading-area'),
                    ),

                    array(
                        'id' => 'heading_title_span_color',
                        'type' => 'color',
                        'title' => __('Heading Title Strong Color', 'erika'),
                        'subtitle' => __('Pick a color for strong tag of heading title', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'color',
                        'output' => array('.heading-area .heading span','.heading-area .heading strong'),
                    ),

                    // portfolio
                    array(
                        'id' => 'opt-info-portfolio',
                        'type' => 'info',
                        'desc' => __('Portfolio', 'erika')
                    ),

                    array(
                        'id' => 'portfolio_inner_bg',
                        'type' => 'color',
                        'title' => __('Portfolio Inner Background', 'erika'),
                        'subtitle' => __('Pick a color portfolio inner background', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.portfolio-item .portfolio-info .portfolio-info-inner'),
                    ),

                    // product
                    array(
                        'id' => 'opt-info-product',
                        'type' => 'info',
                        'desc' => __('Product', 'erika')
                    ),

                    array(
                        'id' => 'product_title_bg',
                        'type' => 'color',
                        'title' => __('Product Title Background', 'erika'),
                        'subtitle' => __('Pick a color for product title', 'erika'),
                        'default' => '#EF4A43',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'output' => array('.product-item.hover .product-title-area','#product-detail .product-amount .field.a span'),
                    ),

                    
            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-font',
                'title'     => __('Typography', 'erika'),
                'fields'    => array(
                    array(
                        'id'        => 'typography-body',
                        'type'      => 'typography',
                        'title'     => __('Body Font', 'erika'),
                        'subtitle'  => __('Specify the body font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('body'),
                        'default'   => array(
                            'color'         => '#999',
                            'font-size'     => '13.8px',
                            'line-height'   => '23px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '300',
                        ),
                    ),
                    
                    array(
                        'id'        => 'typography-h1',
                        'type'      => 'typography',
                        'title'     => __('Heading 1', 'erika'),
                        'subtitle'  => __('Specify the H1 font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h1'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '22px',
                            'line-height'   => '28px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h2',
                        'type'      => 'typography',
                        'title'     => __('Heading 2', 'erika'),
                        'subtitle'  => __('Specify the H2 font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h2'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '20px',
                            'line-height'   => '26px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h3',
                        'type'      => 'typography',
                        'title'     => __('Heading 3', 'erika'),
                        'subtitle'  => __('Specify the H3 font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h3'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '18px',
                            'line-height'   => '24px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h4',
                        'type'      => 'typography',
                        'title'     => __('Heading 4', 'erika'),
                        'subtitle'  => __('Specify the H4 font properties.', 'erika'),
                        'google'    => true,
                        'output'        => array('h4'),
                        'text-align' => false,
                        'all_styles'    => true,
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '16px',
                            'line-height'   => '22px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h5',
                        'type'      => 'typography',
                        'title'     => __('Heading 5', 'erika'),
                        'subtitle'  => __('Specify the H5 font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h5'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '14px',
                            'line-height'   => '20px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h6',
                        'type'      => 'typography',
                        'title'     => __('Heading 6', 'erika'),
                        'subtitle'  => __('Specify the H6 font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h6'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '12px',
                            'line-height'   => '18px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '400',
                        ),
                    ),

                    array(
                        'id'    => 'opt-divide',
                        'type'  => 'divide'
                    ),

                    // Heading Large

                    array(
                        'id'        => 'typography-h1-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 1 Large', 'erika'),
                        'subtitle'  => __('Specify the H1 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'subsets'  => true,
                        'all_styles'    => true,
                        'output'        => array('h1.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '33px',
                            'line-height'   => '44px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h2-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 2 Large', 'erika'),
                        'subtitle'  => __('Specify the H2 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h2.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '30px',
                            'line-height'   => '39px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h3-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 3 Large', 'erika'),
                        'subtitle'  => __('Specify the H3 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h3.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '27px',
                            'line-height'   => '36px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h4-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 4 Large', 'erika'),
                        'subtitle'  => __('Specify the H4 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'output'        => array('h4.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '24px',
                            'line-height'   => '33px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h5-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 5 Large', 'erika'),
                        'subtitle'  => __('Specify the H5 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h5.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '22px',
                            'line-height'   => '40px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),
                    array(
                        'id'        => 'typography-h6-large',
                        'type'      => 'typography',
                        'title'     => __('Heading 6 Large', 'erika'),
                        'subtitle'  => __('Specify the H6 Large font properties.', 'erika'),
                        'google'    => true,
                        'text-align' => false,
                        'all_styles'    => true,
                        'output'        => array('h6.large'),
                        'default'   => array(
                            'color'         => '#272727',
                            'font-size'     => '18px',
                            'line-height'   => '21px',
                            'font-family'   => 'Open Sans',
                            'font-weight'   => '800',
                        ),
                    ),

            ));

             $this->sections[] = array(
                'icon'      => ' el-icon-briefcase',
                'title'     => __('Portfolio', 'erika'),
                'fields'    => array(

                    array(
                        'id'        => 'text_portfolioslug',
                        'type'      => 'text',
                        'title'     => __('Portfolio Slug', 'erika'),
                        'desc'      => __('Enter the URL Slug for your Portfolio (Default: portfolio-item) <br /><strong>Go save your permalinks after changing this.</strong>', 'erika'),
                        'default'   => 'portfolio-item',
                    ),

                    array(
                        'id'        => 'text_portfolio_category_slug',
                        'type'      => 'text',
                        'title'     => __('Custom Category Slug', 'erika'),
                        'desc'      => __('Enter the Category Taxonomy Slug for your Portfolio (Default: portfolio_category) <br /><strong>Go save your permalinks after changing this.</strong>', 'erika'),
                        'default'   => 'portfolio_category',
                    ),

                    array(
                        'id'        => 'text_portfolio_tag_slug',
                        'type'      => 'text',
                        'title'     => __('Custom Tag Slug', 'erika'),
                        'desc'      => __('Enter the Tag Taxonomy Slug for your Portfolio (Default: portfolio_tag) <br /><strong>Go save your permalinks after changing this.</strong>', 'erika'),
                        'default'   => 'portfolio_tag',
                    ),

                    array(
                        'id'        => 'select_portfolio_archive',
                        'type'      => 'select',
                        'title'     => __('Portfolio Archive Columns', 'erika'),
                        'desc'      => __('Choose number columns of Potfolio archive', 'erika'),
                        'options'   => array(
                            '4' => '3 Columns',
                            '3' => '4 Columns',
                        ), 
                        'default'   => '3',
                    ),

                    array(
                        'id'        => 'select_portfolio_filter_number',
                        'type'      => 'text',
                        'title'     => __('Portfolio Filter Item Per Page', 'erika'),
                        'desc'      => __('Choose number item of Potfolio filter page', 'erika'),
                        'default'   => '12',
                        'validate'  => 'numeric',
                    ),
            ));
            
            $this->sections[] = array(
                'icon'      => 'el-icon-file',
                'title'     => __('Post and Page', 'erika'),
                'fields'    => array(

                    array(
                        'id'        => 'select_post_archive',
                        'type'      => 'radio',
                        'title'     => __('Main Post Layout', 'erika'),
                        'subtitle'      => __('Choose your Default Blog Layout', 'erika'),
                        'options'   => array(
                            'large'     => 'Large', 
                            'medium'    => 'Medium',
                            'masonry'   => 'Masonry',
                            'timeline'  => 'Timeline',
                        ), 
                        'default'   => 'large',
                    ),

                    array(
                        'id'        => 'select_blog_sidebar',
                        'required'  => array(array('select_post_archive', '=', array('large','medium'))),
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Blog Sidebar', 'erika'),
                        'subtitle'  => __('Select main blog sidebar', 'erika'),
                        'options'   => array(
                            'fullwidth' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            'sidebar-content' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'content-sidebar' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            'sidebar-content-sidebar' => array('alt' => '3 Column Middle','img' => ReduxFramework::$_url . 'assets/img/3cm.png'),
                            'sidebar-sidebar-content' => array('alt' => '3 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/3cl.png'),
                            'content-sidebar-sidebar' => array('alt' => '3 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/3cr.png')
                        ),
                        'default'   => 'content-sidebar'
                    ),

                    array(
                        'id'        => 'text_excerptlength',
                        'type'      => 'text',
                        'title'     => __('Blog Excerpt Length', 'erika'),
                        'subtitle'  => __('Default: 30', 'erika'),
                        'desc'      => __('Used for blog page, archives & search results.', 'erika'),
                        'validate'  => 'numeric',
                        'default'   => '30',
                    ),

                    array(
                        'id'        => 'check_disable_page_comment',
                        'type'      => 'checkbox',
                        'title'     => __('Permanently Disable Page Comments', 'erika'),
                        'subtitle'  => __('Check to disable page comments', 'erika'),
                        'default'   => '0'
                    ),

                    array(
                        'id'        => 'check_disable_post_comment',
                        'type'      => 'checkbox',
                        'title'     => __('Permanently Disable Post Comments', 'erika'),
                        'subtitle'  => __('Check to disable post comments', 'erika'),
                        'default'   => '0'
                    ),
            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-lines',
                'title'     => __('Sidebar', 'erika'),
                'fields'    => array(
                    array(
                        'id'        => 'multi_sidebar',
                        'type'      => 'multi_text',
                        'title'     => __('Sidebar Generator', 'erika'),
                        'subtitle'  => __('Enter the name of the sidebar you want to create', 'erika')
                    ),
            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-shopping-cart',
                'title'     => __('WooCommerce', 'erika'),
                'fields'    => array(

                array(
                        'id'        => 'select_product_sidebar',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Shop Sidebar', 'erika'),
                        'subtitle'  => __('Select main shop sidebar', 'erika'),
                        'options'   => array(
                            'fullwidth' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            'sidebar-content' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'content-sidebar' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            'sidebar-content-sidebar' => array('alt' => '3 Column Middle','img' => ReduxFramework::$_url . 'assets/img/3cm.png'),
                            'sidebar-sidebar-content' => array('alt' => '3 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/3cl.png'),
                            'content-sidebar-sidebar' => array('alt' => '3 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/3cr.png')
                        ),
                        'default'   => 'content-sidebar'
                    ),

                array(
                    'id'        => 'check_shop_menu',
                    'type'      => 'checkbox',
                    'title'     => __('Show cart menu', 'erika'),
                    'subtitle'  => __('Check to display cart in the menu', 'erika'),
                    'default'   => '1'
                ),
            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-css',
                'title'     => __('Custom CSS', 'erika'),
                'fields'    => array(

                array(
                    'id'       => 'er_custom_css',
                    'type'     => 'ace_editor',
                    'title'    => __( 'CSS Code', 'er' ),
                    'subtitle' => __( 'Paste your CSS code here.', 'erika' ),
                    'mode'     => 'css',
                    'theme'    => 'chrome',
                    'default'  => "#yourid{\nmargin: 0 auto;\n}"
                ),
            ));

            $this->sections[] = array(
                'icon'      => 'el-icon-link',
                'title'     => __('Social', 'erika'),
                'fields'    => array(

                    array(
                        'id'        => 'text-phone',
                        'type'      => 'text',
                        'title'     => __('Contact Phone', 'erika'),
                        'subtitle'  => __('Enter your phone number', 'erika'),
                    ),

                    array(
                        'id'        => 'email-url',
                        'type'      => 'text',
                        'title'     => __('Contact Email', 'erika'),
                        'subtitle'  => __('Enter your email contact', 'erika'),
                    ),

                    array(
                        'id'        => 'facebook-id',
                        'type'      => 'text',
                        'title'     => __('Facebook ID', 'erika'),
                        'subtitle'  => __('Enter your facebook page username', 'erika'),
                    ),

                    array(
                        'id'        => 'twitter-id',
                        'type'      => 'text',
                        'title'     => __('Tweeter ID', 'erika'),
                        'subtitle'  => __('Enter your Twitter ID', 'erika'),
                    ),

                    array(
                        'id'        => 'linkedin-url',
                        'type'      => 'text',
                        'title'     => __('LinkedIn URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'googleplus-url',
                        'type'      => 'text',
                        'title'     => __('Google Plus URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'youtube-url',
                        'type'      => 'text',
                        'title'     => __('Youtube URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'flickr-url',
                        'type'      => 'text',
                        'title'     => __('Flickr URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'vimeo-url',
                        'type'      => 'text',
                        'title'     => __('Vimeo URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'dribbble-url',
                        'type'      => 'text',
                        'title'     => __('Dribbble URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'pinterest-url',
                        'type'      => 'text',
                        'title'     => __('Pinterest URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'instagram-url',
                        'type'      => 'text',
                        'title'     => __('Instagram URL', 'erika'),
                        'subtitle'  => __('This must be a URL.', 'erika'),
                        'validate'  => 'url',
                    ),

                    array(
                        'id'        => 'check-rss',
                        'type'      => 'checkbox',
                        'title'     => __('Show RSS Link', 'erika'),
                        'default'   => '1',
                    ),
            ));

            


            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'erika'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://softmediabd.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'erika',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'erika'),
                'page_title'        => __('Theme Options', 'erika'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBu4c6pGY_auWMszOX2agP4ja2VlEWsfeE', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => 'erika_data',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'erika_option_page',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/everislabs',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/everislabs',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://dribbble.com/everislabs',
                'title' => 'Follow us on Dribble',
                'icon'  => 'el-icon-dribbble'
            );

            // Panel Intro text -> before the form
            $this->args['intro_text'] = __('<p>Thank you for your purchased our theme. If you need support, please send your request to <a href="mailto:admin@softmediabd.com">admin@softmediabd.com</a></p>', 'erika');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
function erika_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );   
    }
}
add_action('init', 'erika_removeDemoModeLink');