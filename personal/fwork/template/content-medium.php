<?php
/**
 * The template for displaying blog with medium design
 *
 * @author 		masbaf
 * @package 	Personal
 * @version     1.0
 */

$post_format = get_post_format();
$entry_content = get_the_excerpt();
$class_exp = $entry_content ? '' : ' no_content';

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item medium clearfix'.$class_exp); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
	<div class="row ft">
		<div class="col-md-5 bottom-xs-20 bottom-sm-20">
			<div class="entry-media">
				
				<?php if( $post_format == "video" && get_post_meta($post->ID, '_format_video_embed', true) ): ?>

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

				<?php elseif(has_post_thumbnail()) :  ?>

				<div class="entry-image">
					<div class="entry-mark"></div>
					<div class="entry-action">
						<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
					</div>
					<?php the_post_thumbnail( 'post-medium' ); ?>
				</div>
				
				<?php else : ?>

				<div class="entry-image">
					<div class="entry-mark"></div>
					<div class="entry-action">
						<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
					</div>
					<img class="img-responsive" src="<?php echo get_template_directory_uri();?>/mas/images/placeholder/290x290.gif" alt="<?php the_title();?>">
				</div>

				<?php endif; ?>

			</div><!-- // .entry-media -->
		</div><!-- // .col-md-5 -->
		<div class="col-md-7">
			<div class="clearfix entry-wrap">
				<div class="blog-left-side hidden-xs hidden-sm">
					<div class="blog-short-info">
						<div class="author-avatar">
							<a rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="url fn n" data-toggle="tooltip" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'erika' ), get_the_author() ) );?>">
								<?php echo get_avatar( get_the_author_meta('ID'),$size='100'); ?>
							</a>
						</div><!-- // .author-avatar -->
						<div class="blog-icon">
							<?php echo er_post_format_icon();?>
						</div><!-- // .blog-icon -->
					</div><!-- // .blog-short-info -->
				</div><!-- // .blog-left-side -->

				<div class="blog-right-side">
					<header>
						<h2 class="entry-title bottom-10" itemprop="headline"><a rel="bookmark" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
						<div class="entry-info">
							<span itemprop="datePublished"><i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.__('ago','erika'); ?> </span>
							<span><i class="fa fa-pencil"></i> <?php the_author_link();?></span>
							<?php if ( have_comments() ) : ?>
							<span><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?></span>
							<?php endif; ?>
						</div>
					</header><!-- // header -->

					<div class="entry-summary top-20" itemprop="text">
						<?php if( $post_format == 'quote'): ?>
						<div class="small-quote">
						<?php endif; ?>

						<?php the_excerpt();?>

						<?php if( $post_format == 'quote'): ?>
						</div>
						<?php endif; ?>
					</div><!-- // .entry-summary -->
					
				</div><!-- // .blog-right-side -->
			</div><!-- // .entry-wrap -->
		</div><!-- // .col-md-7 -->
	</div><!-- // .row -->
	<div class="divider"></div>
</div><!-- // .blog-item -->