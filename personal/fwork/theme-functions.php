<?php
/**
 * Add custom contact methods
 *
 * @since masbaf 1.0
 */
add_filter('user_contactmethods', 'er_user_contactmethods');            
function er_user_contactmethods($user_contactmethods){  
    $user_contactmethods['twitter'] = 'Twitter';  
    $user_contactmethods['facebook'] = 'Facebook'; 
    $user_contactmethods['linkedin'] = 'LikedIn'; 
    $user_contactmethods['pinterest'] = 'Pinterest';
    $user_contactmethods['googleplus'] = 'Google Plus';
    return $user_contactmethods;  
}  

/**
 * Breadcrumb
 * Custom fixed for email request
 *
 * @since Erange 1.x
 */
function erika_breadcrumb() {
 
    /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
 
    $show_current   = 0; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ''; // delimiter between crumbs
    $before         = '<li class="current"><span>'; // tag before the current crumb
    $after          = '</span></li>'; // tag after the current crumb
    /* === END OF OPTIONS === */
 
    global $post;
    $home_link    = home_url('/');
    $link_before  = '<li>';
    $link_after   = '</li>';
    $link_attr    = '';
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    if(!is_404())
    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');
 
    if (is_home() || is_front_page()) {
 
        if ($show_on_home == 1) echo '<div class="breadcrumbs"><ul class="clearfix"><li>' . $text['home'] . '</li></ul></div>';
 
    } else {
 
        echo '<div class="breadcrumbs"><ul class="clearfix">';
        if ($show_home_link == 1) {
            echo '<li><a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a></li>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }
 
        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 
        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
 
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
 
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
 
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
 
        } elseif ( is_attachment() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
 
        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;
 
        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }
 
        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page','erika') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
        echo '</ul></div><!-- .breadcrumbs -->';
 
    }
}

/**
 * Formatting Allowed Tags
 *
 * @since Personal 1.0
 */
function erika_formatting_allowedtags() {

	return apply_filters(
		'erika_formatting_allowedtags',
		array(
			'a'          => array( 'href' => array(), 'title' => array(), ),
			'b'          => array(),
			'blockquote' => array(),
			'br'         => array(),
			'div'        => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'em'         => array(),
			'i'          => array(),
			'p'          => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'span'       => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'strong'     => array(),
		)
	);

}
/**
 * Page Navigation
 *
 * @since Personal 1.0
 */
function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}
 
/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
   Function is largely based on Version 2.4 of the WP-PageNavi plugin */  
function erika_pagenavi($before = '', $after = '', $class = '') { 
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('First Page');
    $pagenavi_options['last_text'] = ('Last Page');
    $pagenavi_options['next_text'] = '&#8594;';
    $pagenavi_options['prev_text'] = '&#8592;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 4; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 4;
     
    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        //intval — Get the integer value of a variable
        /*http://php.net/manual/en/function.intval.php*/
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
         
        //empty — Determine whether a variable is empty
        /*http://php.net/manual/en/function.empty.php*/
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
         
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
         
        if($start_page <= 0) {
            $start_page = 1;
        }
         
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
         
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
         
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }  
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi '.$class.'">'."\n".'<ul class="list-unstyled bottom-0 clearfix">'."\n";
             
            if(!empty($pages_text)) {
                echo '<li><span class="pages">'.$pages_text.'</span></li>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            
            echo '<li>'.get_previous_posts_link($pagenavi_options['prev_text']).'</li>';
             
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
                }
            }
             
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }
             
            for($i = $start_page; $i  <= $end_page; $i++) {                     
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<li><span class="current">'.$current_page_text.'</span></li>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }
             
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
            }
            
            echo '<li>'.get_next_posts_link($pagenavi_options['next_text'], $max_page).'</li>';
             
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }
            echo '</ul></div>'.$after."\n";
        }
    }
}

/**
 * Get custom post type terms links
 *
 * @since Personal 1.0
 */
function erika_custom_taxonomies_terms_links($taxonomy) {
    global $post, $post_id;
    // get post by post id &get_post
    $post = get_post($post->ID);
    // get post type by post
    $post_type = $post->post_type;
    // get post type taxonomies
    $terms = get_the_terms( $post->ID, $taxonomy );
    if ( !empty( $terms ) ) {
        $out = array();
        foreach ( $terms as $term )
            $out[] = '<a title="'.$term->name.'" href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
        $return = join( ', ', $out );
    } else {
        $return = '';
    }
    return $return;
}

/**
 * Get custom post type terms slig
 *
 * @since Personal 1.0
 */
function erika_custom_taxonomies_terms_slug($taxonomy) {
    global $post, $post_id;
    // get post by post id
    $post = get_post($post->ID);
    // get post type by post
    $post_type = $post->post_type;
    // get post type taxonomies
    $terms = get_the_terms( $post->ID, $taxonomy );
    if ( !empty( $terms ) ) {
        $out = array();
        foreach ( $terms as $term )
            $out[] = $term->slug;
        $return = join( ' ', $out );
    }
    return $return;
}

/**
 * Creat random string
 *
 * @since Personal 1.0
 */
function erika_rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    $str = '';
    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[ rand( 0, $size - 1 ) ];
    }

    return $str;
}

function erika_hex2rgba($hex,$a=1) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   
   $rgb = array($r, $g, $b);

   return 'rgba('.$r.','.$g.','.$b.','.$a.')';
}

/**
 * Add Responsive Images Class
 *
 * @since Personal 1.0
 */
add_filter('post_thumbnail_html','erika_add_class_to_thumbnail');
function erika_add_class_to_thumbnail($thumb) {
    $thumb = str_replace('attachment-', 'img-responsive attachment-', $thumb);
    return $thumb;
}

/**
 * Count total post in special term
 *
 * @since Personal 1.0
 */
function erika_term_post_count($type,$term){
    $args = array(
        'post_type' => $type,
        'post_status' => 'published',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => $term
            )
        )
    );
    return count( get_posts( $args ) );
    wp_reset_query();
}

/**
 * Get custom product category content
 *
 * @since Personal 1.0
 */
function erika_custom_tax_content($id,$term_id,$field_id){
    $meta = get_option($id);
    if (empty($meta)) $meta = array();
    if (!is_array($meta)) $meta = (array) $meta;
    $meta = isset($meta[$term_id]) ? $meta[$term_id] : array();
    isset($meta[$field_id]) ? $value = $meta[$field_id] : $value = '';
    return $value;
}

/**
 * Get second product images
 *
 * @since Personal 1.0
 */
function erika_second_product_image(){
    global $post, $product, $woocommerce;
    $attachment_ids = $product->get_gallery_attachment_ids();
    if ( $attachment_ids ) {
        $loop = 1;
        foreach ( $attachment_ids as $attachment_id ) {
            if($loop == 1)
            $img       = wp_get_attachment_image_src( $attachment_id, 'shop_catalog');
            $image = $img[0];
            $loop++;
        }
    } else {
        $image = '';
    }

    return $image;
}

/**
 * Return icon class from icon name
 *
 * @since Erange 1.0
 */
function erika_icon_format($icon){
    if(substr($icon, 0, 3) == 'pe-'){
        $out = $icon;
    } else {
        $out = 'fa fa-'.$icon;
    }
    return $out;
}

/**
 * Get vimeo thumbnail
 *
 * @since Erange 1.0
 */
function erika_get_vimeo_thumbnail($id){
    $vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
    return $vimeo[0]['thumbnail_large'];
}

/**
 * Get vimeo and youtube video link and images
 *
 * @since Erange 1.0
 */
function erika_get_video_link($link,$output='img'){

    if (strpos($link,'youtu') !== false) {
       
        $pattern = '%(?:https?://)?(?:www\.)?(?:youtu\.be/| youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})[a-zA-Z0-9\< \>\"]%x';
        $result = preg_match($pattern, $link, $matches);
        $img = '<img class="img-responsive" src="http://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg" alt=""/>';
        $link = 'http://www.youtube.com/watch?v='.$matches[1];
    } else {
        preg_match('/player\.vimeo\.com\/video\/([0-9]*)/', $link, $matches);
        $img = '<img class="img-vimeo" src="'.erika_get_vimeo_thumbnail($matches[1]).'" alt=""/>';
        $link = 'http://vimeo.com/'.$matches[1];
    }

    if($output == 'img'){
        $out = $img;
    } else {
        $out = $link;
    }
    return $out;
}

/**
 * Get Video URL
 *
 * @since Personal 1.0
 */
function erika_get_video_url($link){

    if (strpos($link,'youtu') !== false) {
       
        $pattern = '%(?:https?://)?(?:www\.)?(?:youtu\.be/| youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})[a-zA-Z0-9\< \>\"]%x';
        $result = preg_match($pattern, $link, $matches);
        $img = 'http://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg';
    } else {
        preg_match('/player\.vimeo\.com\/video\/([0-9]*)/', $link, $matches);
        $img = erika_get_vimeo_thumbnail($matches[1]);
    }

    return $img;
}

/**
 * Save video thumbnail as featured image
 *
 * @since Personal 1.0
 */
function erika_autoset_featured() {
    global $post;

    $format = get_post_format();
    
    if ($format == 'video' && get_post_meta($post->ID, '_format_video_embed', true)) {
        $thumb = erika_get_video_url(get_post_meta($post->ID, '_format_video_embed', true));
        media_sideload_image($thumb, $post->ID, get_the_title());

        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
  
}
add_action('save_post', 'erika_autoset_featured');

/**
 * Get save option data
 *
 * @since Personal 1.0
 */
function erika_option_data($data){
    global $erika_data;
    if (isset($erika_data[$data]))
    return $erika_data[$data];
}
/**
 * Get save meta data
 *
 * @since Personal 1.0
 */
if ( ! class_exists( 'EVR_Metadata' ) )
{
    /**
     * Wrapper class for helper functions
     */
    class EVR_Metadata
    {
        /**
         * Do actions when class is loaded
         *
         * @return void
         */
        static function on_load()
        {
            add_shortcode( 'erika_meta_data', array( __CLASS__, 'shortcode' ) );
        }

        /**
         * Shortcode to display meta value
         *
         * @param $atts Array of shortcode attributes, same as meta() function, but has more "meta_key" parameter
         * @see meta() function below
         *
         * @return string
         */
        static function shortcode( $atts )
        {
            $atts = wp_parse_args( $atts, array(
                'type'    => 'text',
                'post_id' => get_the_ID(),
            ) );
            if ( empty( $atts['meta_key'] ) )
                return '';

            $meta = self::meta( $atts['meta_key'], $atts, $atts['post_id'] );

            $content = $meta;

            return apply_filters( __FUNCTION__, $content );
        }

        /**
         * Get post meta
         *
         * @param string   $key     Meta key. Required.
         * @param int|null $post_id Post ID. null for current post. Optional
         * @param array    $args    Array of arguments. Optional.
         *
         * @return mixed
         */
        static function meta( $key, $args = array(), $post_id = null )
        {
            $post_id = empty( $post_id ) ? get_the_ID() : $post_id;

            $args = wp_parse_args( $args, array(
                'type' => 'text',
            ) );

            // Set 'multiple' for fields based on 'type'
            if ( !isset( $args['multiple'] ) )
                $args['multiple'] = in_array( $args['type'], array( 'checkbox_list', 'file', 'file_advanced', 'image', 'image_advanced', 'plupload_image', 'thickbox_image' ) );

            $meta = get_post_meta( $post_id, $key, !$args['multiple'] );

            return apply_filters( __FUNCTION__, $meta, $key, $args, $post_id );
        }
        
    }

    EVR_Metadata::on_load();
}

/**
 * Get post meta
 *
 * @param string   $key     Meta key. Required.
 * @param int|null $post_id Post ID. null for current post. Optional
 * @param array    $args    Array of arguments. Optional.
 *
 * @return mixed
 */
function erika_meta_data( $key, $args = array(), $post_id = null )
{
    return EVR_Metadata::meta( $key, $args, $post_id );
}

/**
* Add icon to Menu
*
* @since Personal 1.0
*/
class erika_menu_icon_walker extends Walker_Nav_Menu {  
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {  
        global $wp_query;  
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';  
  
        $class_names = $value = '';  
        $icon = get_post_meta( $item->ID, '_menu_item_custom', true );
  
        $classes = empty( $item->classes ) ? array() : (array) $item->classes; 
        $menu_icon_class  = ! empty( $icon ) ? ' has-icon' : '';   
  
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );  
        $class_names = ' class="'. esc_attr( $class_names ) . $menu_icon_class . '"';  
  
        $output .= $indent . '<li ' . $value . $class_names .'>';  
  
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';  
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';  
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';  
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';  
        $description  = ! empty( $icon ) ? '<span class="icon"><i class="'.erika_icon_format( $icon ).'"></i></span>' : '';  
  
  
        $item_output = $args->before;  
        $item_output .= '<a'. $attributes .'>';  
        $item_output .= $description.$args->link_before;
        $item_output .= $args->link_after .apply_filters( 'the_title', $item->title, $item->ID );    
        $item_output .= '</a>';  
        $item_output .= $args->after;  
  
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );  
    }  
}

add_filter('nav_menu_item_id', 'erika_css_attributes_filter', 100, 1);
function erika_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}

function erika_get_template_part($path, $name, $before=null, $after=null) {        
    ob_start();  
    get_template_part($path, $name);  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $before.$ret.$after;    
}

add_filter('body_class','erika_custom_class');
function erika_custom_class($classes) {

    $classes[] = erika_option_data( 'select_main_layout' ) ? erika_option_data('select_main_layout') : '';
    $classes[] = erika_option_data( 'select_theme_grid' ) ? erika_option_data( 'select_theme_grid' ) : '';
    $classes[] = erika_option_data( 'image_background_repeat' ) ? erika_option_data( 'image_background_repeat' ) : '';
    
    return $classes;
}

function erika_setting_class(){
    if ( erika_option_data( 'select_main_layout' ) == 'boxed' || erika_option_data( 'select_main_layout' ) == 'boxed margin' ) :
        $class = 'container';
    else:
        $class = '';
    endif;
    if ( $class ):
        $out = 'class="'.$class.'"';
    else:
        $out = '';
    endif;

    return $out;
}

function erika_remove_hentry( $classes ) {
    $classes = array_diff( $classes, array( 'hentry' ) );
    return $classes;
}
add_filter( 'post_class','erika_remove_hentry' );

function erika_portfolio_action(){
    global $post;
    $img = '';
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $img = $thumb['0'];
    if ($img)
    echo '<div class="portfolio-link"><a class="image-link" href="'.$img.'"><i class="fa fa-arrows"></i></a></div>';
}