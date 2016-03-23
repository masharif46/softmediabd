<?php

// Remove default WC Breadcrumbs
add_action( 'init', 'erika_remove_wc_breadcrumbs' );
function erika_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// Remove WC General Style
add_filter( 'woocommerce_enqueue_styles', 'erika_dequeue_styles' );
function erika_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
	return $enqueue_styles;
}

// Add WC Default Images Size
add_action( 'init', 'erika_woocommerce_image_dimensions', 1 );
function erika_woocommerce_image_dimensions() {
	$catalog = array(
		'width' => '450',	// px
		'height'	=> '535',// px
		'crop'	=> 1 // true
		);

	$single = array(
		'width' => '800',	// px
		'height'	=> '580',	// px
		'crop'	=> 1 // true
		);

	$thumbnail = array(
		'width' => '275',	// px
		'height'	=> '200',	// px
		'crop'	=> 1 // false
		);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}

// Define Woocommerce Columns
add_filter('loop_shop_columns', 'erika_wc_product_columns_frontend');
function erika_wc_product_columns_frontend() {
	global $woocommerce;

	$columns = 4;

	if ( is_product_category() ) :
		$columns = 4;
	endif;

	if ( is_product() ) :
		$columns = 4;
	endif;

	if ( is_checkout() ) :
		$columns = 4;
	endif;

	return $columns;

}

// Dropdown cart
add_filter('add_to_cart_fragments', 'erika_add_to_cart_dropdown'); 
function erika_add_to_cart_dropdown( $fragments ) {
	global $woocommerce;
	ob_start();
	?>

	<li class="cart-total-menu">
		<a class="cart-title" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
			<i class="main-icon fa fa-shopping-cart"></i>
			<span class="sub-total"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
		</a>
		<div class="sf-mega">
			<div class="sf-mega-content">
				<div class="sf-mega-cart">
					<div class="cart_list">
						<ul>
						<?php                                    
				            if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
				                $_product = $cart_item['data'];                                            
				                if ($_product->exists() && $cart_item['quantity']>0) :  ?>  
			
				              	<li class="row onepixel">
				              		<div class="col-md-1">
				              			<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="fa fa-times"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key ); ?>
				              		</div>
				              		<div class="col-md-7"><?php 
				              			 $product_title = $_product->get_title();
				                         echo '<a class="cart_list_product_title" href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a>';
				                         echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).' /</div>';
				                         echo '<div class="cart_list_product_quantity">'.__('Quantity', 'woocommerce').': '.$cart_item['quantity'].'</div>';

				              		?></div>
				              		<div class="col-md-4">
				              			<?php   echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    ?>
				              		</div>
				              	</li><!-- end row -->

				        <?php                                        
				            endif;                                        
				            endforeach;
				        ?>
				        </ul>
					</div><!-- // .cart_list -->

					 <div class="minicart_total_checkout">                                        
	                    <?php _e('Cart Subtotal', 'woocommerce'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
	                </div>

	                <div class="row onepixel">
	                	<div class="col-md-6">
	                		 <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button black"><span><?php _e('View Cart', 'woocommerce'); ?></span></a>
	                	</div>
	                	<div class="col-md-6">
	                		<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button black"><span><?php _e( 'Checkout', 'woocommerce' ); ?></span></a>
	                	</div>
	                </div>
	                
	                <?php else: echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>'; endif; ?>                 

				</div>
			</div>
		</div>
	</li>

	<?php
	$fragments['.cart-total-menu'] = ob_get_clean();
	return $fragments;
}