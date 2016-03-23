<?php

/**
 * Custom Expcerpt Length
 *
 * @since Personal 1.0
 */
function erika_excerpt_length( $length ) {
	erika_option_data('text_excerptlength') ? $lg = erika_option_data('text_excerptlength') : $lg = 30;
	return $lg;
}
add_filter( 'excerpt_length', 'erika_excerpt_length', 999 );
function erika_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'erika_excerpt_more');

function erika_custom_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}


/**
 * Get post tags
 *
 * @since Personal 1.0
 */
function er_post_tags(){ 
	if(has_tag()) :
?>
	<span class="tags-group">
		<?php the_tags('',' '); ?>
	</span>
<?php endif ; }

/**
 * Author Box
 *
 * @since Personal 1.0
 */
function er_author_box(){ ?>

	<div class="entry-author clearfix top-30">
		<div class="avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
		</div><!-- // .avatar -->
		<div class="author-info">
			<h4><?php the_author_meta( 'user_nicename' ); ?></h4>
			<p><?php the_author_meta( 'user_description' ); ?></p>
		</div><!-- // .author-info -->
	</div><!-- // .entry-author -->

<?php }

/**
 * Relate Posts
 *
 * @since Personal 1.0
 */
function er_relates_post(){ 
	global $post, $post_id;
	$relates_posts = array(   
    	'post__not_in' => array($post->ID),
    	'showposts'=> 3,
    	'ignore_sticky_posts' => 1
    );
    $relates_query = new WP_Query( $relates_posts );
    if( $relates_query->have_posts() && count($relates_query) >=3 ) :
?>


<?php endif; }

/**
*
* Erange Post Rating
*
* @since Personal 1.0
*/
function erika_post_rating(){
	global $post, $post_id;
	$total_score = 0;
	$total_item = 0;
	$out  = '';
	$rating = rwmb_meta('erika_review_item');
	$stars = rwmb_meta('erika_rating_star');

	$rating ? $errors = array_filter($rating) : $errors = null;

	if( !empty($errors)){
		foreach ($rating as $rating_item => $value) {
			$score = explode('|',$value);
			$total_score += $score[1];
			$total_item++;
		}
		$out .= '<div class="entry-review bottom-30"><div class="review-details"><div class="row onepixel"><div class="col-md-9 review-area">';

		foreach ($rating as $rating_item => $value) {
			$score = explode('|',$value);
			$out .= '<div class="review-score bottom-5"><span class="title">'.$score[0].'</span><div class="progress bottom-5"><div data-bgcolor="3498db" data-percentage="'.$score[1].'" class="progress-bar"><span class="progress-content">'.$score[1].'</span></div></div></div>';
		}
		$out .= '</div><div class="col-md-3 review-area">
					<div class="review-total">
						<span class="score">'.number_format((float)$total_score/$total_item, 1, '.', '').'</span>
						<span class="des">'.rwmb_meta('erika_review_desc').'</span>
						<span class="star-rating star-rating-'.$stars.'"></span>
					</div></div></div></div></div>';
		return $out;
	}
}

/**
*
* Erange Post Rating Score
*
* @since Personal 1.0
*/
function erika_post_rating_score($before,$after){
	global $post, $post_id;
	$total_score = 0;
	$total_item = 0;
	$out  = '';
	$rating = rwmb_meta('erika_review_item');
	if( $rating ){
		foreach ($rating as $rating_item => $value) {
			$score = explode('|',$value);
			$total_score += $score[1];
			$total_item++;
		}
		$out = $before.number_format((float)$total_score/$total_item, 0, '.', '').$after;
	}
	return $out;
}

/**
*
* Get next & previous post
*
* @since Personal 1.0
*/
function er_nexpre_post(){
	global $post, $post_id;
	$prev_post = get_adjacent_post(false, '', true);
	if(!empty($prev_post)) {
		$prev_post_out = '<h4 class="bottom-0"><a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">' . $prev_post->post_title . '</a></h4>'; 
	} else {
		$prev_post_out = '<span class="notice">'.__('No previous post', 'ereven').'</span>';
	}

	$next_post = get_adjacent_post(false, '', false);
	if(!empty($next_post)) {
		$next_post_out = '<h4 class="bottom-0"><a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . $next_post->post_title . '</a></h4>'; 
	} else {
		$next_post_out = '<span class="notice">'.__('No next post', 'ereven').'</span>';
	} ?>

	<div class="relate-posts top-30">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<div class="relate-post-item previous">
					<span><?php _e('Previous Post','erika');?></span>
					<?php echo $prev_post_out; ?>
				</div><!-- // .relate-post-item -->
			</div><!-- // end column -->
			<div class="col-md-6 col-sm-6 col-xs-6">
				<div class="relate-post-item next">
					<span class="title"><?php _e('Next Post','erika');?></span>
					<?php echo $next_post_out; ?>
				</div><!-- // .relate-post-item -->
			</div><!-- // end column -->
		</div><!-- // .row -->
	</div><!-- // .realte-posts -->

<?php }

/**
*
* Icon for post format
*
* @since Personal 1.0
*/

function er_post_format_icon(){ 
	global $post, $post_id;
	$post_format = get_post_format();
	if( has_post_thumbnail() && $post_format == '' ): 
		$out = '<i class="fa fa-camera"></i>';
	elseif( $post_format == "video" ): 
		$out = '<i class="fa fa-video-camera"></i>';
	elseif($post_format == "audio"): 
		$out = '<i class="fa fa-music"></i>';
	elseif($post_format == "gallery" ): 
		$out = '<i class="fa fa-camera"></i>';
	elseif($post_format == "quote"): 
		$out = '<i class="fa fa-quote-left"></i>';
	else: 
		$out = '<i class="fa fa-file-text"></i>';
	endif; 
	return $out;
}

/**
*
* Post Comments
*/
function erika_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="comment-body clearfix" id="comment-<?php comment_ID() ?>">
		<div class="avatar">
			<?php echo get_avatar( $comment,$size='70'); ?>
		</div><!-- // .avatar -->

		<div class="comment-text">
			<div class="author">
				<h5 class="bottom-0"><?php printf( __( '%s', 'erika'), get_comment_author_link() ) ?></h5>
				<time class="comment-date" datetime="<?php echo get_comment_date('c');?>"><?php printf(__('%1$s at %2$s', 'erika'), get_comment_date(),  get_comment_time() ) ?></time>
				<span class="edit-link">
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					<?php edit_comment_link( __( '(Edit)', 'erika'),'  ','' ) ?>
				</span>
			</div><!-- // .author -->

			<div class="text">
				<?php comment_text() ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
		        	<em><?php _e( 'Your comment is awaiting moderation.', 'erika' ) ?></em>
		      	<?php endif; ?>
			</div><!-- // .text -->

		</div><!-- // .comment-text -->
	</div><!-- // .commentbody -->
      
<?php
}

/**
*
* Post Shorten
*
*/
function erika_post_short($custom_class){ 
	global $post, $post_id;
?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item bb '.$custom_class); ?>>
      	
      	<?php do_action( 'er_before_post') ;?>

		<div class="blog-item-content">
			<h4 class="entry-title">
				<a rel="bookmark" title="<?php the_title(__('Permalink to: ','erika')); ?>" href="<?php the_permalink();?>"><?php the_title();?></a>
			</h4>

			<?php er_post_info('entry-meta separate');?>

		</div>
	</div>
<?php }

/**
*
* Remove Images Width & Height Tag 
*
*/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}