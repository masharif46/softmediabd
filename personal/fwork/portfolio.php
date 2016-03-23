<?php

/**
* Register Portfolio Custom Post Type
*/

function erika_portfolio() {
  
  $portfolio_slug = erika_option_data('text_portfolioslug') ? erika_option_data('text_portfolioslug') : 'portfolio';

  $labels = array(
    'name'               => __('Portfolio','erika'),
    'singular_name'      => __('Portfolio','erika'),
    'add_new'            => __('Add New','erika'),
    'add_new_item'       => __('Add New Project','erika'),
    'edit_item'          => __('Edit Project','erika'),
    'new_item'           => __('New Project','erika'),
    'all_items'          => __('All Projects','erika'),
    'view_item'          => __('View Project','erika'),
    'search_items'       => __('Search Project','erika'),
    'not_found'          => __('No projects found','erika'),
    'not_found_in_trash' => __('No projects found in Trash','erika'),
    'parent_item_colon'  => __('','erika'),
    'menu_name'          => __('Portfolio','erika')
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => $portfolio_slug ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'			 => 'dashicons-portfolio',
    'supports'           => array( 'title', 'editor', 'thumbnail' )
  );

  register_post_type( 'portfolio', $args );
}
add_action( 'init', 'erika_portfolio' );

/**
* Register Portfolio Taxonomies
*/

function erika_portfolio_taxonomies() {

  	$portfolio_cat_slug = erika_option_data('text_portfolio_category_slug') ? erika_option_data('text_portfolio_category_slug') : 'portfolio_categoy';
  	$portfolio_tag_slug = erika_option_data('text_portfolio_tag_slug') ? erika_option_data('text_portfolio_tag_slug') : 'portfolio_tag';

	// Portfolio categories taxonomy
	$labels = array(
		'name'              => __( 'Categories', 'erika' ),
		'singular_name'     => __( 'Category', 'erika' ),
		'search_items'      => __( 'Search Categories', 'erika' ),
		'all_items'         => __( 'All Categories', 'erika' ),
		'parent_item'       => __( 'Parent Category', 'erika' ),
		'parent_item_colon' => __( 'Parent Category:', 'erika' ),
		'edit_item'         => __( 'Edit Category', 'erika' ),
		'update_item'       => __( 'Update Category' , 'erika'),
		'add_new_item'      => __( 'Add New Category', 'erika' ),
		'new_item_name'     => __( 'New Category Name', 'erika' ),
		'menu_name'         => __( 'Category', 'erika' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $portfolio_cat_slug ),
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

	// Portfolio tags taxonomy
	$labels = array(
		'name'              => __( 'Tags', 'erika' ),
		'singular_name'     => __( 'Tag', 'erika' ),
		'search_items'      => __( 'Search Tags', 'erika' ),
		'all_items'         => __( 'All Tags', 'erika' ),
		'parent_item'       => __( 'Parent Tag', 'erika' ),
		'parent_item_colon' => __( 'Parent Tag:', 'erika' ),
		'edit_item'         => __( 'Edit Tag', 'erika' ),
		'update_item'       => __( 'Update Tag' , 'erika'),
		'add_new_item'      => __( 'Add New Tag', 'erika' ),
		'new_item_name'     => __( 'New Tag Name', 'erika' ),
		'menu_name'         => __( 'Tag', 'erika' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $portfolio_tag_slug ),
	);

	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $args );
}

add_action( 'init', 'erika_portfolio_taxonomies', 0 );