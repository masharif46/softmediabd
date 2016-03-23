<?php
/**
 * The template for displaying blog with small design
 *
 * @author 		masbaf
 * @package 	Personal
 * @version     1.0
 */

$post_format = get_post_format();
$entry_content = get_the_excerpt();
$class_exp = $entry_content ? '' : ' no_content';

?>
<div class="msbox col-md-4 bottom-30">
	<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item small'.$class_exp); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
		<div class="blog-image">
			
			<?php if( $post_format == "quote" ): ?>

			<div class="blog-quotes">
				<?php the_excerpt();?>
			</div>

			<?php elseif( $post_format == "video" && get_post_meta($post->ID, '_format_video_embed', true) ): ?>

			<div class="entry-image">
				<div class="entry-mark"></div>
				<div class="entry-action">
					<span><a class="popup-vimeo" href="<?php echo erika_get_video_link(get_post_meta($post->ID, '_format_video_embed', true),'link');?>"><?php echo er_post_format_icon();?></a></span>
				</div>
				<?php echo erika_get_video_link(get_post_meta($post->ID, '_format_video_embed', true));?>
			</div>
			
			<?php elseif($post_format == "audio" && get_post_meta($post->ID, '_format_audio_embed', true)): ?>
			
			<div class="entry-audio">
				<?php echo get_post_meta($post->ID, '_format_audio_embed', true); ?>
			</div><!-- // .post-audio -->

			<?php elseif($post_format == "gallery" ): ?>

			<?php if ( $images = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image' ))){ ?>
			
			<div class="entry-image">
				<div class="entry-mark"></div>
				<div class="entry-action">
					<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
				</div>
				<img class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/placeholder/770x550.gif" alt="<?php the_title();?>">
			</div>

			<?php } else { ?>

			<div class="entry-image">
				<div class="entry-mark"></div>
				<div class="entry-action">
					<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
				</div>
				<img class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/placeholder/770x550.gif" alt="<?php the_title();?>">
			</div>
			
			<?php } ?>

			<?php elseif(has_post_thumbnail()) :  ?>

			<div class="entry-image">
				<div class="entry-mark"></div>
				<div class="entry-action">
					<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
				</div>
				<?php the_post_thumbnail( 'post-masonry' ); ?>
			</div>
			
			<?php else : ?>

			<div class="entry-image">
				<div class="entry-mark"></div>
				<div class="entry-action">
					<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
				</div>
				<img class="img-responsive" src="<?php echo get_template_directory_uri();?>/mas/images/placeholder/770x550.gif" alt="<?php the_title();?>">
			</div>

			<?php endif; ?>
		</div><!-- // .blog-image -->
		<div class="blog-info">
			<div class="blog-info-inner">
				<div class="blog-info-meta">
					<span><i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.__('ago','erika'); ?> </span>
					<span><i class="fa fa-pencil"></i> <?php the_author_link();?></span>
					<?php if ( have_comments() ) : ?>
					<span><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="blog-title">
					<h4><a rel="bookmark" itemprop="headline" href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				</div>
			</div>
		</div><!-- // .blog-info -->
	</div><!-- // .blog-item -->
</div><!-- // end colunn -->