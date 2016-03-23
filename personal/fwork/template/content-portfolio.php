<div class="portfolio-item">
							
	<div class="portfolio-image">
		<a href="<?php the_permalink();?>" title="<?php the_title();?>">
			<?php the_post_thumbnail('portfolio');?>
		</a>
	</div><!-- // .portfolio-image -->

	<div class="portfolio-info">
		<div class="portfolio-info-inner clearfix">
			<div class="portfolio-title">
				<h4 class="bottom-0"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
			</div>
			<div class="portfolio-star white">
				<i class="fa fa-heart-o"></i> <?php echo erika_meta_data('_post_like_count'); ?>
			</div>
			<?php erika_portfolio_action();?>
		</div>
	</div><!-- // .portfolio-info -->
	
</div><!-- // .portfolio-item -->