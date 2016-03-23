<?php
/**
 * Recent Projects
 *
 * @since 1.0
 */
class Erika_Recent_Projects_Widget extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'recent_portfolio_widget latest-posts recent-portfolio', 
			'description' => __('Shows recent portfolio images in sidebar.','erika')
		);
    	parent::__construct('erika_recent_projects_widget', __('Erika - Recent Projects','erika'), $widget_ops);
	}
	function widget($args, $instance) {
           
			extract( $args );
			$cats = '';

			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Projects' : $instance['title'], $instance, $this->id_base);	
			if ( ! $number = absint( $instance['number'] ) ) $number = 5;
			if( ! $cats = $instance["cats"] )  $cats='';

			$my_args=array(
				'posts_per_page' => $number,
				'orderby' => 'date',
				'order' => 'DESC',
				'post_type' => 'portfolio',
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'id',
						'terms' => $cats,
					)
				)
			);
			
			
			
			$adv_recent_posts = null;
			$adv_recent_posts = new WP_Query($my_args);

			echo $before_widget;
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			echo '<ul class="list-unstyled row onepixel">'."\n";
			$post_count = 0;
			while ( $adv_recent_posts->have_posts() ) : $adv_recent_posts->the_post();
				
			?>
				
				<li <?php post_class('col-md-4 col-xs-4 col-sm-4 bottom-1'); ?>>
					<a href="<?php the_permalink();?>">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('post-medium'); ?>
							<?php else: ?>
							<img src="<?php echo get_template_directory_uri();?>/mas/images/placeholder/160x160.gif" alt="<?php the_title();?>">
						<?php endif;?>
					</a>
				</li><!-- // .clearfix -->
				
		<?php 		 
			endwhile;
			echo '</ul>'."\n";
			wp_reset_query();
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['cats'] = $new_instance['cats'];
			$instance['number'] = absint($new_instance['number']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Projects';
			$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of projects to show:','erika'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
                
        <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories:','erika');?> 
                <?php
                     $categories =  get_terms('portfolio_category',array( 'parent' => 0 , 'hide_empty'    => false,));
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (isset($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
                            $option .= $cat->name;
                            $option .= '<br />';
                            echo $option;
                         }
                    ?>
            </label>
        </p>
		
		<?php }
}


/**
 * Recent Post
 *
 * @since 1.0
 */
class Erika_Recent_Posts_Widget extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'recent_posts_widget recent-post widget-posts', 
			'description' => __('Shows recent posts in sidebar.','erika')
		);
    	parent::__construct('erika_recent_posts_widget', __('Erika - Recent Posts','erika'), $widget_ops);
	}
	function widget($args, $instance) {
           
			extract( $args );
						
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);	
			if ( ! $number = absint( $instance['number'] ) ) $number = 5;
			if( ! $cats = $instance["cats"] )  $cats='';

			if($cats){
				$cat_query = implode(',', $cats);
			} else {
				$cat_query = '';
			}

			$my_args=array(
				'posts_per_page' => $number,
				'orderby' => 'date',
				'order' => 'DESC',
				'cat'	=>  $cat_query,
				'ignore_sticky_posts' => 1
			);
			
			
			
			$adv_recent_posts = null;
			$adv_recent_posts = new WP_Query($my_args);

			echo $before_widget;
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			echo '<ul class="list-unstyled bottom-0">'."\n";
			$post_count = 0;
			while ( $adv_recent_posts->have_posts() ) : $adv_recent_posts->the_post();
				
			?>

				<li <?php post_class('clearfix'); ?>>
					
					<div class="post-image">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('recent-post'); ?>
							<?php else: ?>
							<img src="<?php echo get_template_directory_uri();?>/mas/images/placeholder/160x160.gif" alt="<?php the_title();?>">
						<?php endif;?>
					</div><!-- // .post-image -->

					<div class="post-info">
						<h4 class="entry-title bottom-0">
							<a rel="bookmark" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a>
						</h4>
						<div class="post-meta">
							<span class="author"><i class="fa fa-pencil"></i><a rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="url fn n" data-toggle="tooltip" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'erika' ), get_the_author() ) );?>"><?php echo get_the_author();?></a></span>
							<span class="time updated"><i class="fa fa-clock-o"></i><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </span>
						</div>
					</div><!-- // .post-content -->

				</li><!-- // .clearfix -->
		<?php 		 
			endwhile;
			echo '</ul>'."\n";
			wp_reset_query();
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['cats'] = $new_instance['cats'];
			$instance['number'] = absint($new_instance['number']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
			$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:','erika'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
                
        <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories:','erika');?> 
                <?php
                	 $cats = '';
                     $categories =  get_terms('category',array( 'parent' => 0 , 'hide_empty'    => false,));
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (isset($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
                            $option .= $cat->name;
                            $option .= '<br />';
                            echo $option;
                         }
                    ?>
            </label>
        </p>
		
		<?php }
}

/**
 * Recent Post Thumbnail
 *
 * @since 1.0
 */
class Erika_Carousel_Posts_Widget extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'latest-posts', 
			'description' => __('Shows recent posts in sidebar.','erika')
		);
    	parent::__construct('erika_carousel_posts_widget', __('Erika - Thumbnail Recent Posts','erika'), $widget_ops);
	}
	function widget($args, $instance) {
           
			extract( $args );
						
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);	
			if ( ! $number = absint( $instance['number'] ) ) $number = 5;
			if( ! $cats = $instance["cats"] )  $cats='';

			if($cats){
				$cat_query = implode(',', $cats);
			} else {
				$cat_query = '';
			}

			$my_args=array(
				'posts_per_page' => $number,
				'orderby' => 'date',
				'order' => 'DESC',
				'cat'	=>  $cat_query,
				'ignore_sticky_posts' => 1
			);
			
			
			
			$adv_recent_posts = null;
			$adv_recent_posts = new WP_Query($my_args);

			echo $before_widget;
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			echo '<ul class="row onepixel">'."\n";
			$post_count = 0;
			while ( $adv_recent_posts->have_posts() ) : $adv_recent_posts->the_post();
				
			?>

				<li <?php post_class('col-md-4 col-xs-4 col-sm-4 bottom-1'); ?>>
					<a href="<?php the_permalink();?>">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('post-medium'); ?>
							<?php else: ?>
							<img src="<?php echo get_template_directory_uri();?>/mas/images/placeholder/160x160.gif" alt="<?php the_title();?>">
						<?php endif;?>
					</a>
				</li><!-- // .clearfix -->
		<?php 		 
			endwhile;
			echo '</ul>'."\n";
			wp_reset_query();
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['cats'] = $new_instance['cats'];
			$instance['number'] = absint($new_instance['number']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
			$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:','erika'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
                
        <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories:','erika');?> 
                <?php
                	 $cats = '';
                     $categories =  get_terms('category',array( 'parent' => 0 , 'hide_empty'    => false,));
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (isset($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
                            $option .= $cat->name;
                            $option .= '<br />';
                            echo $option;
                         }
                    ?>
            </label>
        </p>
		
		<?php }
}

/**
 * Category Listing Widget
 *
 * @since 1.0
 */
class Erika_Category_Widget extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'menu erika_taxonomy_widget widget-category', 
			'description' => __('Shows category listing in sidebar.','erika')
		);
    	parent::__construct('recent-posts-widget', __('Erika - Category List','erika'), $widget_ops);
	}
	function widget($args, $instance) {
           
			extract( $args );
		
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Category' : $instance['title'], $instance, $this->id_base);	
			
			echo $before_widget;
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			echo '<ul class="list-unstyled">'."\n";
			$args = array(
  				'orderby' => 'name',
  				'order' => 'ASC'
  			);
			$categories = get_categories($args);
			foreach($categories as $category) { 
				echo '<li>';
    			echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s",'erika' ), $category->name ) . '" ' . '>' . $category->name.'</a>';
    			echo '</li>';
			}
			?>
				
		<?php 		 
			echo '</ul>'."\n";
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Category';
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		
		<?php }
}
/**
 * Contact Widget.
 *
 * @since 1.0
 */
class Erika_Contact extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'erika_contact_info contact_widget', 
			'description' => __('Display contact infomations','erika')
		);
    	parent::__construct('erika_contact_info', __('Erika - Contact Info','erika'), $widget_ops);
	}
	function widget($args, $instance) {
			extract( $args );
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Contact Infomations' : $instance['title'], $instance, $this->id_base);	
			
			echo $before_widget.$before_title.$instance["title"].$after_title;
			echo '<ul class="contact-info-wrap list-unstyled">'."\n";
			if ($instance["address"])
			echo '<li class="contact-field"><i class="fa fa-map-marker"></i>'.$instance["address"].'</li>'."\n";
			if ($instance["phone"])
			echo '<li class="contact-field"><i class="fa fa-phone"></i><span>Phone:</span>'.$instance["phone"].'</li>'."\n";
			if ($instance["fax"])
			echo '<li class="contact-field"><i class="fa fa-reply"></i><span>Fax:</span>'.$instance["fax"].'</li>'."\n";
			if ($instance["email"])
			echo '<li class="contact-field"><i class="fa fa-envelope"></i><span>Email:</span>'.$instance["email"].'</li>'."\n";
			if ($instance["website"])
			echo '<li class="contact-field"><i class="fa fa-globe"></i><span>Website:</span>'.$instance["website"].'</li>'."\n";
			echo '</ul>'."\n";
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['address'] = strip_tags($new_instance['address']);
			$instance['phone'] = strip_tags($new_instance['phone']);
			$instance['fax'] = strip_tags($new_instance['fax']);
			$instance['email'] = strip_tags($new_instance['email']);
			$instance['website'] = strip_tags($new_instance['website']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Contact Infomations';
			$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
			$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
			$fax = isset($instance['fax']) ? esc_attr($instance['fax']) : '';
			$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
			$website = isset($instance['website']) ? esc_attr($instance['website']) : '';
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" size="3" /></p>
        
		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('website'); ?>"><?php _e('Website:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php echo $this->get_field_name('website'); ?>" type="text" value="<?php echo $website; ?>" size="3" /></p>

		<?php }
}
/**
 * Video Embed Widget.
 *
 * @since 1.0
 */
class Erika_Embed_Code extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'erika_video_embed', 
			'description' => __('Display video in Widget','erika')
		);
    	parent::__construct('erika_embed_code', __('Erika - Video Embed','erika'), $widget_ops);
	}
	function widget($args, $instance) {
			extract( $args );
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Contact Infomations' : $instance['title'], $instance, $this->id_base);	
			
			echo $before_widget.$before_title.$instance["title"].$after_title;
			echo '<div class="embed_content">'."\n";
			echo $instance['embed_code'];
			echo '</div>'."\n";
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['embed_code'] = strip_tags($new_instance['embed_code']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Contact Infomations';
			$embed_code = isset($instance['embed_code']) ? esc_attr($instance['embed_code']) : '';
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('embed_code'); ?>"><?php _e('Video Embed Code:','erika'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('embed_code'); ?>" name="<?php echo $this->get_field_name('embed_code'); ?>"><?php echo $embed_code; ?></textarea></p>
        
		<?php }
}
/**
 * Flickr Images.
 *
 * @since 1.0
 */
class Erika_Flickr_Images extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'erika_flickr_images widget-flickr', 
			'description' => __('Display Flickr images','erika')
		);
    	parent::__construct('erika_flickr_images', __('Erika - Flickr Images','erika'), $widget_ops);
	}
	function widget($args, $instance) {
			extract( $args );
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Flickr' : $instance['title'], $instance, $this->id_base);	
			
			echo $before_widget.$before_title.$instance["title"].$after_title;
			echo '<div class="flickr-widget">'."\n";
			echo '<div class="clearfix"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$instance['number_img'].'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$instance['flickr_id'].'"></script></div>';
			echo '</div>'."\n";
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
			$instance['number_img'] = strip_tags($new_instance['number_img']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Flickr';
			$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
			$number_img = isset($instance['number_img']) ? esc_attr($instance['number_img']) : '9';
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>"></p>

        <p><label for="<?php echo $this->get_field_id('number_img'); ?>"><?php _e('Number:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number_img'); ?>" name="<?php echo $this->get_field_name('number_img'); ?>" type="text" value="<?php echo $number_img; ?>"></p>
        
		<?php }
}
/**
 * Twitter
 *
 * @since 1.0
 */
class Erika_Twitter extends WP_Widget {
		/** constructor */	
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'latest-tweet widget-twitter', 
			'description' => __('Display Lastest Tweet','erika')
		);
    	parent::__construct('erika_twitter', __('Erika - New Tweets','erika'), $widget_ops);
	}
	function widget($args, $instance) {
			extract( $args );
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Tweets' : $instance['title'], $instance, $this->id_base);	
			
			$twitter_widget_id = erika_rand_string(8);

			echo $before_widget.$before_title.$instance["title"].$after_title;
			echo '<div class="widget-content">';
			echo '<div id="tweet-'.$twitter_widget_id.'">'."\n";
			echo '</div>'."\n";
			echo '</div>'."\n";
			echo '<script type="text/javascript">jQuery(document).ready(function($){jQuery("#tweet-'.$twitter_widget_id.'").tweecool({username : "'.$instance['twitter_id'].'", limit : '.$instance['number_tweet'].',profile_image : false });});</script>';
			echo $after_widget;
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
			$instance['number_tweet'] = strip_tags($new_instance['number_tweet']);
			return $instance;
		}
		
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Twitter';
			$twitter_id = isset($instance['twitter_id']) ? esc_attr($instance['twitter_id']) : '';
			$number_tweet = isset($instance['number_tweet']) ? esc_attr($instance['number_tweet']) : '3';
		?>
		
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>"></p>

        <p><label for="<?php echo $this->get_field_id('number_tweet'); ?>"><?php _e('Number:','erika'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number_tweet'); ?>" name="<?php echo $this->get_field_name('number_tweet'); ?>" type="text" value="<?php echo $number_tweet; ?>"></p>
        
		<?php }
}
/**
 * Tags Widget.
 *
 * @since 1.0
 */
function tcr_tag_cloud_filter($args = array()) {
    $args['smallest'] = 12;
    $args['largest'] = 12;
    $args['unit'] = 'px';
    return $args;
}
add_filter('widget_tag_cloud_args', 'tcr_tag_cloud_filter', 90);

/**
 * Register Widgets.
 *
 * @since 1.0
 */
function erika_register_widgets() {
	register_widget( 'Erika_Recent_Projects_Widget' );
	register_widget( 'Erika_Recent_Posts_Widget' );
	register_widget( 'Erika_Category_Widget' );
	register_widget( 'Erika_Embed_Code' );
	register_widget( 'Erika_Contact' );
	register_widget( 'Erika_Flickr_Images' );
	register_widget( 'Erika_Twitter' );
	register_widget( 'Erika_Carousel_Posts_Widget' );
}

add_action( 'widgets_init', 'erika_register_widgets' );

/**
 * Format Widget Title
 *
 * @since 1.0
 */
//add_filter ( 'widget_title', 'erika_add_span_widgets' );
function erika_add_span_widgets( $old_title ) {
 
	$title = explode( " ", $old_title, 2 );
	if ( isset( $title[0] ) && isset( $title[1] ) ) {
		$titleNew = "<span>$title[0]</span> $title[1]";
	} else{
		return;
	}
	return $titleNew;
}