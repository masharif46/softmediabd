<?php

/**
 * Fixed Header Navigation
 *
 * @since Personal 1.0
 */
function erika_header_fixed_header() { 
	if (erika_option_data('switch_fixed_header')):
	?>

<div class="header-fixed">
	<div class="logo-header">
		<div class="container">
			
			<div class="logo-container pull-left clearfix">
				<div class="logo">
					<?php do_action( 'erika_header_logo' ); ?>
				</div><!-- // .logo -->
			</div><!-- // .logo-container -->

			<div class="menu-container sm pull-right">
				<div class="site-menu">
					<div class="site-menu-inner clearfix">
						<div class="site-menu-container pull-left">
							<nav class="hidden-xs hidden-sm" itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
								<?php
									do_action( 'erika_header_main_menu' );
								?>
							</nav><!-- // nav -->
						</div><!-- // .site-menu-container -->

						<?php do_action( 'erika_header_search' ); ?>

					</div><!-- // .site-menu-inner -->
				</div><!-- // .site-menu -->
			</div><!-- // .menu-container -->

		</div><!-- // .container -->
	</div><!-- // .logo-header -->
</div><!-- // .header-fixed -->
	
<?php endif; }
add_action( 'erika_before_header','erika_header_fixed_header' );

/**
 * Header social link
 *
 * @since Personal 1.0
 */
function erika_header_social_link(){ ?>
	
	<div class="social-info pull-right hidden-xs hidden-sm">
		<ul class="social textcolor list-unstyled">
			
			<?php if(erika_option_data('text-phone')):?>
			<li class="phone">
				<a href="tel:<?php echo erika_option_data('text-phone');?>"><i class="fa fa-phone"></i><span><?php echo erika_option_data('text-phone');?></span></a>
			</li>
			<?php endif; ?>
			
			<?php if(erika_option_data('email-url')):?>
			<li class="mail active">
				<a href="mailto:<?php echo erika_option_data('email-url');?>">
					<i class="fa fa-envelope"></i><span><?php echo erika_option_data('email-url');?></span>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if(erika_option_data('facebook-id')):?>
			<li class="facebook">
				<a href="http://facebook.com/<?php echo erika_option_data('facebook-id');?>">
					<i class="fa fa-facebook"></i><span><?php _e('follow on facebook','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('twitter-id')):?>
			<li class="twitter">
				<a href="http://twitter.com/<?php echo erika_option_data('twitter-id');?>">
					<i class="fa fa-twitter"></i><span><?php _e('follow on twitter','erika');?></span>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if(erika_option_data('pinterest-url')):?>
			<li class="pinterest">
				<a href="<?php echo erika_option_data('pinterest-url');?>">
					<i class="fa fa-pinterest"></i><span><?php _e('get pin on pinterest','erika');?></span>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if(erika_option_data('googleplus-url')):?>
			<li class="googleplus">
				<a href="<?php echo erika_option_data('googleplus-url');?>">
					<i class="fa fa-google-plus"></i><span><?php _e('follow on google plus','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('linkedin-url')):?>
			<li class="linkedin">
				<a href="<?php echo erika_option_data('linkedin-url');?>">
					<i class="fa fa-linkedin"></i><span><?php _e('follow on linkedin','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('youtube-url')):?>
			<li class="youtube">
				<a href="<?php echo erika_option_data('youtube-url');?>">
					<i class="fa fa-youtube"></i><span><?php _e('youtube channel','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('flickr-url')):?>
			<li class="flickr">
				<a href="<?php echo erika_option_data('flickr-url');?>">
					<i class="fa fa-flickr"></i><span><?php _e('our flickr images','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('vimeo-url')):?>
			<li class="vimeo">
				<a href="<?php echo erika_option_data('vimeo-url');?>">
					<i class="fa fa-vimeo-square"></i><span><?php _e('follow us on vimeo','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('dribbble-url')):?>
			<li class="dribbble">
				<a href="<?php echo erika_option_data('dribbble-url');?>">
					<i class="fa fa-dribbble"></i><span><?php _e('follow us on dribbble','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if(erika_option_data('instagram-url')):?>
			<li class="vimeo">
				<a href="<?php echo erika_option_data('instagram-url');?>">
					<i class="fa fa-instagram"></i><span><?php _e('follow us on instagram','erika');?></span>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if(erika_option_data('check-rss')):?>
			<li class="rss">
				<a href="<?php bloginfo('rss2_url');?>">
					<i class="fa fa-rss"></i><span><?php _e('rss subscribe','erika');?></span>
				</a>
			</li>
			<?php endif; ?>

		</ul>
	</div>

<?php }
add_action( 'erika_header_social','erika_header_social_link' );

/**
 * Header search form
 *
 * @since Personal 1.0
 */
function erika_header_search_form(){ ?>
	
	<div class="header-search-form pull-right hidden-xs hidden-sm">
		<div class="header-search">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' )); ?>">
				<div class="header-search-input-wrap"><input class="header-search-input" placeholder="<?php _e('Type to search...','erika');?>" type="text" value="" name="s"/></div>
				<input class="header-search-submit" type="submit" value=""><span class="header-icon-search"><i class="fa fa-search"></i></span>
			</form>
		</div>
	</div>

<?php }
add_action( 'erika_header_search','erika_header_search_form',9 );

/**
 * Main menu
 *
 * @since Personal 1.0
 */
function erika_header_main_menu_item(){		
	if(is_page() && erika_meta_data('_erika_custom_header_menu') != 'default'){
		wp_nav_menu( array(
			'menu'            => erika_meta_data('_erika_custom_header_menu'),
			'container'       => 'ul', 
			'menu_class' => 'sf-menu nav nav-tabs list-unstyled clearfix',
			'walker' => new erika_menu_icon_walker()
		) );
	} elseif (has_nav_menu('header')){
		wp_nav_menu( array(
			'theme_location'  => 'header',
			'container'       => 'ul', 
			'menu_class' => 'sf-menu nav nav-tabs list-unstyled clearfix',
			'walker' => new erika_menu_icon_walker()
		) );
	} else {
		echo '<p class="menu-notice">'.__('Let go by adding your menu by click <a href="'.get_admin_url( '', 'nav-menus.php' ).'">here</a>','erika').'</p>';
	};					
}
add_action( 'erika_header_main_menu','erika_header_main_menu_item' );

/**
 * Logo insider content
 *
 * @since Personal 1.0
 */
function erika_header_logo_inside() {
	
	is_home() ? $logo_wrap = 'h1' : $logo_wrap = 'p';

	$logo_img = erika_option_data('images_custom_logo');
	$retina_img = erika_option_data('images_retina_logo');

	if ($retina_img['id'])
		$logo_size = getimagesize(get_attached_file($retina_img['id']));
	?>
	
	<<?php echo $logo_wrap;?> class="site-title" itemprop="headline">
		<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if(erika_option_data('select_display_logo' ) == "logo"): ?>
				<?php if ($retina_img['id']) : ?>
					<img class="logo_retina" src="<?php echo $retina_img['url']; ?>" width="<?php echo $logo_size[0]/2; ?>" height="<?php echo $logo_size[1]/2; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				<?php else: ?>
				<img class="logo_standard" src="<?php echo $logo_img['url'] ? $logo_img['url'] : get_template_directory_uri().'/assets/images/logo.png'; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				<?php endif; ?>
			<?php else: ?>
			<span class="site-title">
				<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
			</span>
			<?php endif; ?>
		</a>
	</<?php echo $logo_wrap;?>>
	<span class="site-desc"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>

<?php }
add_action( 'erika_header_logo','erika_header_logo_inside' );

/**
 * Heading Content
 *
 * @since Personal 1.0
 */
function erika_heading_content() { 

	$class1 = $class2 = '';

	if( is_page() || is_single() || is_singular()):

		if(erika_meta_data('_erika_url_heading_image')):

			$out = '';
			$heading_images = erika_meta_data( '_erika_url_heading_image','type=file' );
		    foreach ( $heading_images as $img => $img_url) {
		    	$out =  $img_url;
		    };

		    $class1 = ' section '.erika_meta_data('_erika_select_heading_image_repeat');
		    $class2 = ' data-bg="'.$out.'"';

		endif;

	endif;

	?>
	
	<div class="page-heading<?php echo $class1;?>"<?php echo $class2;?>>
		<div class="container">
			<div class="row">
				
				<div class="col-md-6">
					<div class="page-title-area">
						<h2 class="bottom-0 page-title">
							<?php
								if ( erika_meta_data('_erika_custom_heading_content') ):
									echo erika_meta_data('_erika_custom_heading_content');
								elseif( is_home() ) :
									printf( __( 'Homepage', 'erika' ));
								elseif ( is_404() ):
									printf( __( 'Content not found', 'erika' ) );
								elseif ( is_day() ) :
									printf( __( 'Daily Archives: %s', 'erika' ), get_the_date() );
								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: %s', 'erika' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'erika' ) ) );
								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: %s', 'erika' ), get_the_date( _x( 'Y', 'yearly archives date format', 'erika' ) ) );
								elseif ( is_singular() ) :
									echo the_title('', '', $echo = false );
								elseif ( is_category() ) :
									printf( __( 'Category Archives: %s', 'erika' ), single_cat_title( '', false ) );
								elseif ( is_tag() ) :
									printf( __( 'Tag Archives: %s', 'erika' ), single_tag_title( '', false ) );
								elseif ( is_search() ) :
									printf( __( 'Search Results for: %s', 'erika' ), get_search_query() );
								elseif ( is_tax() ) :
									printf( __( '%s', 'erika' ), single_cat_title( '', false ) );
								else :
									_e( 'Archives', 'erika' );
								endif;
							?>
						</h2>
					</div>	
				</div><!-- // end column -->
				
				<div class="col-md-6 text-right">
					<?php
						if(!is_404()) {
							if(erika_meta_data('_erika_check_page_breadcrumbs') == '') 
							erika_breadcrumb(); 
						}
						
					?>
				</div><!-- // end column -->

			</div><!-- // .row -->
		</div><!-- // .container -->
	</div><!-- // .page-heading -->
<?php }
add_action( 'erika_heading', 'erika_heading_content' );

/**
 * Footer Custom Contact
 *
 * @since Personal 1.0
 */

function erika_custom_contact(){ 

	if (erika_option_data('footer_check_contact') == 1):

	?>

	<div id="contact-area">
		<div id="contactmap" class="section">
			<div id="map-canvas" class="map"></div>
		</div><!-- // #contactmap -->

		<div id="contactinfo" class="section contact-section" data-bgcolor="#3C3C3C">
			<div class="container">
				<div class="contactblock">
					
					<div class="row">
						<div class="col-md-3 bottom-sm-10">
							<input type="text" id="pre-name" placeholder="<?php _e('Enter your name','erika');?>">
						</div><!-- // end column -->

						<div class="col-md-3 bottom-sm-10">
							<input type="email" id="pre-mail" placeholder="<?php _e('Enter your email','erika');?>">
						</div><!-- // end column -->

						<div class="col-md-3 bottom-sm-10">
							<input type="text" id="pre-title" placeholder="<?php _e('Enter message title','erika');?>">
						</div><!-- // end column -->

						<div class="col-md-3">
							<button type="submit" class="pre-button" data-toggle="modal" data-target="#contact-modal"><?php _e('Send our request','erika');?><i class="icon-right fa fa-envelope"></i></button>
						</div><!-- // end column -->

					</div><!-- // .row -->
				</div><!-- // .contactblock -->

				<div class="heading-area text-center top-30 bottom-30">
					<h4 class="heading large white"><?php echo erika_option_data( 'footer_contact_heading_title' );?></h4>
					<span class="sub-heading white"><?php echo erika_option_data( 'footer_contact_subheading_title' );?></span>
				</div><!-- // .heading-area -->
			</div>

			<!-- Modal -->
			<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="contact-modal">

							<div id="contact">
								
								<div class="bottom-20 text-center contact-modeal-heading">
									<h3 class="white heading bottom-0"><?php _e('Contact to us','erika');?></h3>
									<span class="white"><?php _e('Enter all infomation bellow to contact','erika');?></span>
								</div><!-- // .contact-modeal-heading -->

								<?php echo do_shortcode( erika_option_data( 'footer_contact_id' ) ); ?>

							</div><!-- // #contact -->
						</div><!-- // #contact-modal -->
					</div><!-- // .modal-content -->
				</div><!-- // .modal-dialog -->
			</div><!-- // .modal -->
		</div><!-- // #contactinfo -->

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
		<script type="text/javascript">
		var latlng = new google.maps.LatLng(0, 0);
		var myOptions = {
			zoom: <?php echo erika_option_data('footer_map_zoom');?>,
			center: latlng,
			scrollwheel: false,
			scaleControl: false,
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map2 = new google.maps.Map(document.getElementById("map-canvas"),
			myOptions);
		
		var geocoder_map2 = new google.maps.Geocoder();
		var address = '<?php echo erika_option_data('footer_map_url');?>';
		geocoder_map2.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map2.setCenter(results[0].geometry.location);
				
				var marker = new google.maps.Marker({
					map: map2, 
					
					position: map2.getCenter()
				});
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
		</script>

	</div><!-- // #contact -->

<?php 

	endif;

}

add_action('end_content_wrap','erika_custom_contact');

/**
 * WooCommerce Cart
 *
 * @since Personal 1.0
 */
function erika_header_woo_cart(){
	if (erika_option_data('check_shop_menu') == 1):
	global $woo_options;
	global $woocommerce;
	?>
	<ul class="sf-menu cart-menu pull-right">
		<li class="cart-total-menu">
			<a class="cart-title" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
				<i class="main-icon fa fa-shopping-cart"></i>
				<span class="sub-total"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
			</a>
			<div class="sf-mega">
				<div class="sf-mega-content">
					<div class="sf-mega-cart">
						<?php if ($woocommerce->cart->cart_contents_count == 0) {
							echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>';
							?> 
						<?php } ?>
					</div>
				</div>
			</div>
		</li>
	</ul>
<?php endif; }
if ( class_exists( 'woocommerce' ) )
add_action('erika_header_search','erika_header_woo_cart');

/**
 * WooCommerce Share
 *
 * @since Personal 1.0
 */
function erika_woo_share(){ ?>
<div class="product-social text-center">
	<ul class="list-unstyled bottom-0 social bg clearfix">
		<li class="facebook"><a data-toggle="tooltip" title="<?php _e('Share on Facebook','erika');?>" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-facebook"></i></a></li>
		<li class="twitter"><a data-toggle="tooltip" title="<?php _e('Tweet on Twitter','erika');?>" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?><?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
		<li class="googleplus"><a data-toggle="tooltip" title="<?php _e('Post on your wall','erika');?>" href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>"><i class="fa fa-google-plus"></i></a></li>
		<li class="linkedin"><a data-toggle="tooltip" title="<?php _e('Share on your LinkedIn profile','erika');?>" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-linkedin"></i></a></li>
		<li><?php echo getPostLikeLink(get_the_ID()); ?></li>
	</ul>
</div>
<?php }
add_action('woocommerce_single_product_summary','erika_woo_share',99);
add_action('erika_after_portfolio_detail','erika_woo_share',99 );
/**
 * Favicon
 *
 * @since Personal 1.0
 */
function erika_header_fav(){ 
	$fav_1 = erika_option_data('media_favicon');
	$fav_2 = erika_option_data('media_favicon_iphone');
	$fav_3 = erika_option_data('media_favicon_iphone_retina');
	$fav_4 = erika_option_data('media_favicon_ipad');
	$fav_5 = erika_option_data('media_favicon_ipad_retina');
	?>

<?php if($fav_1['url']):?>
<link rel="shortcut icon" href="<?php echo $fav_1['url']; ?>">
<?php endif ;?>
<?php if($fav_2['url']):?>
<link rel="apple-touch-icon" href="<?php echo $fav_2['url']; ?>">
<?php endif ;?>
<?php if($fav_3['url']):?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $fav_3['url']; ?>">
<?php endif ;?>
<?php if($fav_4['url']):?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $fav_4['url']; ?>">
<?php endif ;?>
<?php if($fav_5['url']):?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $fav_5['url']; ?>">
<?php endif ;?>
<?php }
add_action('erika_media_include','erika_header_fav');

/**
 * After header content
 *
 * @since Personal 1.0
 */
function erika_after_header_content(){
	if (!is_404() && erika_meta_data('_erika_custom_header_content') != '')
	echo '<div class="container">'.do_shortcode( erika_meta_data('_erika_custom_header_content') ).'</div>';
}
add_action('erika_after_header','erika_after_header_content');

// Custom Theme CSS
function erika_custom_css_out(){
	$css = erika_option_data('er_custom_css');
	if ($css)
		echo '<style id="er_option_css" type="text/css">'.str_replace(array("\r", "\n"), '', $css).'</style>'."\n";
}
add_action('wp_head','erika_custom_css_out');

function erika_footer_code(){
	$code = erika_option_data('textarea_trackingcode');
	echo $code;
}
add_action('wp_footer','erika_footer_code');