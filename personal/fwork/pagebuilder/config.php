<?php
// Visual Composer Settings
if(function_exists('vc_set_as_theme')) 
    vc_set_as_theme(true);
if(function_exists('vc_remove_element')):
    vc_remove_element("vc_button");
    vc_remove_element("vc_button2");
    vc_remove_element("vc_carousel");
    vc_remove_element("vc_tour");
    vc_remove_element("vc_cta_button");
    vc_remove_element("vc_cta_button2");
    vc_remove_element("vc_facebook");
    vc_remove_element("vc_flickr");
    vc_remove_element("vc_gallery");
    vc_remove_element("vc_googleplus");
    vc_remove_element("vc_images_carousel");
    vc_remove_element("vc_item");
    vc_remove_element("vc_items");
    vc_remove_element("vc_message");
    vc_remove_element("vc_pie");
    vc_remove_element("vc_pinterest");
    vc_remove_element("vc_posts_grid");
    vc_remove_element("vc_posts_slider");
    vc_remove_element("vc_progress_bar");
    vc_remove_element("vc_separator");
    vc_remove_element("vc_teaser_grid");
    vc_remove_element("vc_text_separator");
    vc_remove_element("vc_toggle");
    vc_remove_element("vc_tweetmeme");
    vc_remove_element("vc_twitter");
    vc_remove_element("vc_widget_sidebar");
    vc_remove_element("vc_wp_archives");
    vc_remove_element("vc_wp_calendar");
    vc_remove_element("vc_wp_categories");
    vc_remove_element("vc_wp_custommenu");
    vc_remove_element("vc_wp_links");
    vc_remove_element("vc_wp_meta");
    vc_remove_element("vc_wp_pages");
    vc_remove_element("vc_wp_posts");
    vc_remove_element("vc_wp_recentcomments");
    vc_remove_element("vc_wp_rss");
    vc_remove_element("vc_wp_search");
    vc_remove_element("vc_wp_tagcloud");
    vc_remove_element("vc_wp_text");
    vc_remove_element("vc_gmaps");
endif;

if ( is_admin() ) {
	if ( ! function_exists('erika_remove_vc_custom_teaser') ) {
		function erika_remove_vc_custom_teaser(){
			$post_types = get_post_types( '', 'names' ); 
			foreach ( $post_types as $post_type ) {
				remove_meta_box('vc_teaser',  $post_type, 'side');
			}
		} 
	} 
add_action('do_meta_boxes', 'erika_remove_vc_custom_teaser');
}

function get_user_fontello_icons_array() {

    $icons_config_path_1 = get_template_directory().'/mas/js/admin/font-awesome.json';
    $icons_config_path_2 = get_template_directory().'/mas/js/admin/iconmoon.json';

    ob_start();
    include( $icons_config_path_1 );
    $json = ob_get_contents();
    ob_end_clean();
    $json = json_decode($json);

    ob_start();
    include( $icons_config_path_2 );
    $iconmoon = ob_get_contents();
    ob_end_clean();
    $iconmoon = json_decode($iconmoon);

    $output = array();

    if ( ! empty( $json ) ){
        foreach ( $json->icons as $key => $val ){
            $icon_class = $val->id;
            $output[ $icon_class ] = $icon_class;
        }
    }

    if ( !empty( $iconmoon ) ){
        foreach ($iconmoon->icons as $key => $val ) {
            $icon_class = 'pe-7s-'.$val->properties->name;
            $output[ $icon_class ] = $icon_class;
        }
    }

    return $output;
}

function erika_iconfont_params_callback( $settings, $value ) {

    $param = $settings;
    $param_value = $value;
    $param_line = '';

    $dependency = vc_generate_dependencies_attributes($settings);
    $value = $param_value;

    $param_line .= '<div class="'.$param['type'].'_container erika_font_container">';
    $param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.esc_attr( $value ).'" ' . $dependency . '/>';

    $ish_user_icons = get_user_fontello_icons_array();

    if ( ! empty( $ish_user_icons ) ){
        $subline = '<ul class="'.$param['type'].'_list erika_fas_ic">';

        foreach ( $ish_user_icons as $key => $val ) {

            $class = $val;

            if ( $value == $val){
                $subline .= '<li class="active">';
            }
            else{
                $subline .= '<li>';
            }
            $subline .= '<a class="'.$param['type'].'_item erika_font_item ' . erika_icon_format($class) . '" fas-ic-value="' . $val . '" href="#" title="' . $key . '"></a></li>';
        }

        $subline .= '</ul>';
        $param_line .= $subline;
    }
    $param_line .= '</div>';

    // Do not forget to echo the variable
    return $param_line;
}
add_shortcode_param('erika_font_awesome' , 'erika_iconfont_params_callback', get_template_directory_uri(). '/mas/js/admin/icon-field.js');

function action_admin_scripts_init(){
    wp_enqueue_style( 'erika-fonts', get_template_directory_uri().'/mas/css/fonts.css', array(), '1.0' );
    wp_enqueue_style( 'erika-admin', get_template_directory_uri().'/mas/css/admin.css', array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'action_admin_scripts_init' );