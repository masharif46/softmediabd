<?php
/**
 * The template for displaying blog with large design
 *
 * @author 		masbaf
 * @package 	Personal
 * @version     1.0
 */

$post_format = get_post_format();
$entry_content = get_the_excerpt();
$class_exp = $entry_content ? '' : ' no_content';

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item large-style'.$class_exp); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">

	

	<?php if( $post_format == "video" && get_post_meta($post->ID, '_format_video_embed', true) ): ?>
	
	<div class="entry-media bottom-20">
		<div class="entry-image">
			<div class="entry-mark"></div>
			<div class="entry-action">
				<span><a class="popup-vimeo" href="<?php echo erika_get_video_link(get_post_meta($post->ID, '_format_video_embed', true),'link');?>"><?php echo er_post_format_icon();?></a></span>
			</div>
			<?php echo erika_get_video_link(get_post_meta($post->ID, '_format_video_embed', true));?>
		</div>
	</div>
	
	<?php elseif($post_format == "audio" && get_post_meta($post->ID, '_format_audio_embed', true)): ?>
	
	<div class="entry-media bottom-20">
		<div class="entry-audio">
			<?php echo get_post_meta($post->ID, '_format_audio_embed', true); ?>
		</div><!-- // .post-audio -->
	</div>

	<?php elseif($post_format == "gallery" ): ?>

	<?php if ( $images = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image' ))){ ?>
	<div class="entry-media bottom-20">
		<div class="entry-gallery">
			<div class="row onepixel">
				
				<?php 
					$count = 0; foreach( $images as $image ) : $count++;
					if ($count == 1):
				?>

				<div class="col-md-6">
					<div class="entry-image">
						<div class="entry-mark"></div>
						<div class="entry-action">
							<span><a href="<?php the_permalink();?>"><i class="fa fa-eye"></i></a></span>
						</div>
						<img class="img-responsive" src="<?php echo erika_resize(wp_get_attachment_url( $image->ID ),770,550);?>" alt="">
					</div><!-- // .entry-image -->
				</div><!-- // end column -->

				<?php 
					endif;
					endforeach; 
				?>
				
				<div class="col-md-6">
					<div class="row onepixel">
					
					<?php 
						$count = 0; foreach( $images as $image ) : $count++;
						if ($count > 1 && $count < 6):
					?>
						<div class="col-md-6 bottom-1">
							<div class="entry-image">
								<div class="entry-mark"></div>
								<div class="entry-action">
									<span><a href="<?php the_permalink();?>"><i class="fa fa-eye"></i></a></span>
								</div>
								<img class="img-responsive" src="<?php echo erika_resize(wp_get_attachment_url( $image->ID ),770,550);?>" alt="">
							</div><!-- // .entry-image -->
						</div><!-- // end column -->
					<?php 
						endif;
						endforeach; 
					?>

					</div><!-- // .row -->
				</div><!-- // end column -->
			</div><!-- // .row -->
		</div><!-- // .entry-gallery -->
	</div>
	
	<?php } ?>

	<?php elseif(has_post_thumbnail()) :  ?>
	<div class="entry-media bottom-20">
		<div class="entry-image">
			<div class="entry-mark"></div>
			<div class="entry-action">
				<span><a href="<?php the_permalink();?>"><?php echo er_post_format_icon();?></a></span>
			</div>
			<?php the_post_thumbnail( 'post' ); ?>
		</div>
	</div>

	<?php endif; ?>
		

	<div class="clearfix entry-wrap">
		<div class="blog-left-side hidden-xs hidden-sm">
			<div class="blog-short-info">
				<div class="author-avatar" itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author">
					<a rel="author" itemprop="url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" data-toggle="tooltip" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'erika' ), get_the_author() ) );?>">
						<?php echo get_avatar( get_the_author_meta('ID'),$size='100'); ?>
						<span class="hidden" itemprop="name"><?php echo get_the_author();?></span>
					</a>
				</div>
				<div class="blog-icon">
					<?php echo er_post_format_icon();?>
				</div>
			</div><!-- // .blog-short-info -->
		</div><!-- // .blog-left-side -->

		<div class="blog-right-side">
			<header>
				<h2 class="entry-title top-10 bottom-10" itemprop="headline"><a rel="bookmark" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
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

			</div><!-- // .entry-content -->
		</div><!-- // .blog-right-side -->
	</div><!-- // .entry-wrap -->

	<div class="divider"></div>
</div><!-- // .blog-item -->