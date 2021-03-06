<?php

// get page header settings
$class1 = $class2 = '';

if( is_page() || is_single() || is_singular()):

	if(erika_meta_data('_erika_url_header_image')):

		$out = '';
		$header_images = erika_meta_data( '_erika_url_header_image', 'type=file' );
	    foreach ( $header_images as $img => $img_url) {
	    	$out =  $img_url;
	    };

	    $class1 = 'section '.erika_meta_data('_erika_select_header_image_repeat');
	    $class2 = 'data-bg="'.$out.'"';

	endif;

endif;

?>
<header id="header" class="<?php echo $class1;?>" <?php echo $class2; ?> itemtype="http://schema.org/WPHeader" itemscope="itemscope" role="banner">
	
	<?php do_action('erika_before_header'); ?>

	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="callus">
						<span><?php echo erika_option_data( 'textarea_callus' );?></span>
					</div>
				</div>

				<div class="col-md-6 hidden-xs hidden-sm">
					<?php do_action('erika_header_social'); ?>
				</div>

			</div><!-- // .row -->
		</div><!-- // .container -->
	</div><!-- // .top-header -->

	<div class="logo-header">
		<div class="container">
			<div class="logo-container text-center clearfix">
				<div class="logo">
					<?php do_action( 'erika_header_logo' ); ?>
				</div><!-- // .logo -->
			</div><!-- // .logo-container -->
		</div><!-- // .container -->
	</div><!-- // .logo-header -->

	<div class="site-menu hidden-xs hidden-sm">
		<div class="container">
			<div class="site-menu-inner clearfix">
				<div class="site-menu-container pull-left">
					<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
						<?php do_action( 'erika_header_main_menu' ); ?>
					</nav><!-- // nav -->
				</div><!-- // .site-menu-container -->

				<?php do_action( 'erika_header_search' ); ?>

			</div><!-- // .site-menu-inner -->
		</div><!-- // .container -->
	</div><!-- // .site-menu -->

	<?php do_action('erika_after_header'); ?>

</header><!-- // #header -->