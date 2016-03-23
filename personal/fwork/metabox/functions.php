<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Erika
 * @package  Metaboxes
 * @license  http://softmediabd.com GPL v2.0 (or later)
 * @link     https://softmediabd.com
 */

add_filter( 'cmb_meta_boxes', 'erika_metaboxes_config' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function erika_metaboxes_config( array $meta_boxes ) {


	$prefix = '_erika_';
	
	// get theme settings
	$blog_layout = erika_option_data('select_blog_sidebar') ? erika_option_data('select_blog_sidebar') : 'content-sidebar' ;

	$sidebar_item = $sidebar_item_alt = array();
	$sidebar_item['default-sidebar'] 		 = 'Default Sidebar';
	$sidebar_item_alt['default-sidebar-alt'] = 'Default Sidebar';
	$sidebar_setting = erika_option_data('multi_sidebar');
	if ($sidebar_setting) {

		foreach ($sidebar_setting as $sidebar => $name) {
			
			if($name) {
				$sidebar_item[strtolower($name)] 		= $name;
				$sidebar_item_alt[strtolower($name)] 	= $name;
			}
		
		}

	}

	$menu_item = array();
	$menu_nav = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
	$menu_item['default'] = __('Default','erika');
	foreach ($menu_nav as $menu_nav_item) {
		$menu_item[$menu_nav_item->slug] = $menu_nav_item->name;
	}

	$meta_boxes['erika_page_header'] = array(
		'id'         => 'erika_page_header_settings',
		'title'      => __( 'Header Settings', 'erika' ),
		'pages'      => array( 'page','post','portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			array(
				'name' => __( 'Heading Background Image', 'erika' ),
				'desc' => __( 'Upload an image or enter a URL. Leave blank for default.', 'erika' ),
				'id'   => $prefix . 'url_header_image',
				'type' => 'file',
			),

			array(
				'name'    => __( 'Heading Background Repeat', 'erika' ),
				'id'      => $prefix . 'select_header_image_repeat',
				'type'    => 'select',
				'options' => array(
					'repeat' 	=> __( 'Repeat', 'erika' ),
					'repeat-x' 	=> __( 'Repeat X', 'erika' ),
					'repeat-y'  => __( 'Repeat Y', 'erika' ),
					'fullwidth' => __( 'Full Width', 'erika' ),
					'cover'     => __( 'Cover', 'erika' ),
				),
			),

			array(
				'name' 	  => __( 'Custom Header Menu', 'erika' ),
				'desc' 	  => __( 'Replace default theme main menu by your menu', 'erika' ),
				'id'   	  => $prefix . 'custom_header_menu',
				'type' 	  => 'select',
				'options' => $menu_item,
			),

			array(
				'name' => __( 'Bellow Header Content', 'erika' ),
				'desc' => __( 'Insert custom HTML or content show after header. Example: Slider', 'erika' ),
				'id'   => $prefix . 'custom_header_content',
				'type' => 'textarea_small',
			),

		),
	);

	$meta_boxes['erika_page_heading'] = array(
		'id'         => 'erika_page_heading_settings',
		'title'      => __( 'Heading Content Settings', 'erika' ),
		'pages'      => array( 'page','post','portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			array(
				'name' => __( 'Hidden Page Heading', 'erika' ),
				'id'   => $prefix . 'check_page_heading',
				'type' => 'checkbox',
			),

			array(
				'name' => __( 'Hidden Page Breadcrumbs', 'erika' ),
				'id'   => $prefix . 'check_page_breadcrumbs',
				'type' => 'checkbox',
			),

			array(
				'name' => __( 'Heading Background Image', 'erika' ),
				'desc' => __( 'Upload an image or enter a URL. Leave blank for default.', 'erika' ),
				'id'   => $prefix . 'url_heading_image',
				'type' => 'file',
			),

			array(
				'name'    => __( 'Heading Background Repeat', 'erika' ),
				'id'      => $prefix . 'select_heading_image_repeat',
				'type'    => 'select',
				'options' => array(
					'repeat' 	=> __( 'Repeat', 'erika' ),
					'repeat-x' 	=> __( 'Repeat X', 'erika' ),
					'repeat-y'  => __( 'Repeat Y', 'erika' ),
					'fullwidth' => __( 'Full Width', 'erika' ),
					'cover'     => __( 'Cover', 'erika' ),
				),
			),

			array(
				'name' => __( 'Custom Heading Content', 'erika' ),
				'desc' => __( 'Replace default page heading by your content. Leave blank for default.', 'erika' ),
				'id'   => $prefix . 'custom_heading_content',
				'type' => 'textarea_small',
			),

		),
	);

	$meta_boxes['erika_sidebar_heading'] = array(
		'id'         => 'erika_sidebar_heading_settings',
		'title'      => __( 'Sidebar Settings', 'erika' ),
		'pages'      => array( 'page','post' ),
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(

			array(
				'name'    => __( 'Choose Widgets Sidebar', 'erika' ),
				'id'      => $prefix . 'radio_widget_sidebar',
				'type'    => 'radio_inline',
				'options' => $sidebar_item,
				'std' => 'default-sidebar'
			),

			array(
				'name'    => __( 'Choose Widgets Sidebar for Alt Sidebar', 'erika' ),
				'id'      => $prefix . 'radio_widget_sidebar_alt',
				'type'    => 'radio_inline',
				'options' => $sidebar_item_alt,
				'std' => 'default-sidebar-alt'
			),

			array(
				'name'    => __( 'Choose Sidebar Layout', 'erika' ),
				'id'      => $prefix . 'radio_sidebar_layout',
				'type'    => 'radio_inline',
				'options' => array(
					'content-sidebar' => __( 'Right Sidebar', 'erika' ),
					'sidebar-content'   => __( 'Left Sidebar', 'erika' ),
					'fullwidth'   => __( 'Full Width Page', 'erika' ),
					'sidebar-content-sidebar'     => __( 'Both Sidebar', 'erika' ),
					'content-sidebar-sidebar'   => __( 'Both Sidebar on the right', 'erika' ),
					'sidebar-sidebar-content'   => __( 'Both Sidebar on the left', 'erika' ),
				),
				'std'		=> $blog_layout
			),

			array(
				'name'    => __( 'Force fullwidth Page', 'erika' ),
				'id'      => $prefix . 'radio_force_full_width',
				'type'    => 'checkbox',
				'desc' => __( 'Force page with 100% width. Except post', 'erika' ),
			),

			array(
				'name' => __( 'Disable Footer Contact', 'erika' ),
				'id'   => $prefix . 'check_page_footer_contact',
				'type' => 'checkbox',
			),

			array(
				'name'    => __( 'Custom Archive Layout', 'erika' ),
				'id'      => $prefix . 'custom_archive_layout',
				'type'    => 'radio_inline',
				'options'   => array(
                            'large'     => 'Large', 
                            'medium'    => 'Medium',
                            'masonry'   => 'Masonry',
                            'timeline'  => 'Timeline',
                        ), 
				'std'		=> 'large'
			),

		),
	);

	$meta_boxes['erika_review_post'] = array(
		'id'         => 'erika_post_reviews',
		'title'      => __( 'Post Reviews', 'erika' ),
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(

			array(
				'name'    => __( 'Star Rating', 'erika' ),
				'id'      => $prefix . 'select_review_rating',
				'type'    => 'select',
				'options' => array(
					'1' 	=> __( '1 Star', 'erika' ),
					'2' 	=> __( '2 Stars', 'erika' ),
					'3'  	=> __( '3 Stars', 'erika' ),
					'4' 	=> __( '4 Stars', 'erika' ),
					'5'     => __( '5 Stars', 'erika' ),
				),
			),

			array(
				'name'    => __( 'Review Description', 'erika' ),
				'id'      => $prefix . 'text_review_desc',
				'type'    => 'text',
			),

			array(
				'id'          => $prefix . 'post_review_item',
				'type'        => 'group',
				'options'     => array(
					'group_title'   => __( 'Review {#}', 'erika' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Review', 'erika' ),
					'remove_button' => __( 'Remove Review', 'erika' ),
					'sortable'      => true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'Title',
						'id'   => 'post_review_title',
						'type' => 'text',
					),
					array(
						'name' => 'Percent',
						'id'   => 'post_review_percent',
						'type' => 'text',
					),
				),
			),

		),
	);

	$meta_boxes['erika_portfolio'] = array(
		'id'         => 'erika_portfolio_info',
		'title'      => __( 'Portfolio Informations', 'erika' ),
		'pages'      => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(

			array(
				'name' => __( 'Project URL', 'erika' ),
				'id'   => $prefix . 'project_url',
				'type' => 'text_url',
				'protocols' => array('http', 'https'),
			),

			array(
				'name'         => __( 'Project Images Slide', 'erika' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'erika' ),
				'id'           => $prefix . 'project_images_slide',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ),
			),

			array(
				'name' => __( 'Project Video Embed Code', 'erika' ),
				'id'   => $prefix . 'project_video_code',
				'type' => 'textarea_small',
			),

			array(
				'id'          => $prefix . 'project_custom_field',
				'type'        => 'group',
				'description' => __( 'Add more portfolio information field', 'erika' ),
				'options'     => array(
					'group_title'   => __( 'Field {#}', 'erika' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Field', 'erika' ),
					'remove_button' => __( 'Remove Field', 'erika' ),
					'sortable'      => true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'Field Title',
						'id'   => 'portfolio_field_title',
						'type' => 'text',
					),
					array(
						'name' => 'Field Content',
						'id'   => 'portfolio_field_content',
						'type' => 'textarea_small',
					),
				),
			),

		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}