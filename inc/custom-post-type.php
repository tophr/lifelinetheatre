<?php
/**
 * Custom post type
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'lt_flush_rewrite_rules' );

// Flush your rewrite rules
function lt_flush_rewrite_rules() {
	flush_rewrite_rules();
}
flush_rewrite_rules();
// let's create the function for the custom type
function custom_post_production() { 
	// creating (registering) the custom type 
	register_post_type( 'production', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
				'name' 				=> __( 'Productions', 'understrap' ), /* This is the Title of the Group */
				'singular_name' 	=> __( 'Production', 'understrap' ), /* This is the individual type */
				'add_new' 			=> __( 'Add New', 'understrap' ), /* The add new menu item */					
				'add_new_item' 		=> __( 'Add New Production', 'understrap' ), /* Add New Display Title */
				'edit_item' 		=> __( 'Edit Production', 'understrap' ), /* Edit Display Title */
				'new_item' 			=> __( 'New Production', 'understrap' ), /* New Display Title */
				'view_item'			=> __( 'View Production', 'understrap' ), /* View Display Title */
				'view_items'		=> __( 'View Productions', 'understrap' ), /* View Display Title */
				'search_items' 		=> __( 'Search Production', 'understrap' ), /* Search Custom Type Title */
				'not_found' 		=> __( 'Nothing found in the Database.', 'understrap' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'understrap' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
				'all_items'			=> __( 'All Productions', 'understrap' ), /* the all items menu item */
				'archives'			=> __( 'Productions Archives', 'understrap' ),
				'attributes'		=> __( 'Production Attributes', 'understrap' ),
				'insert_into_item'	=> __( 'Insert into Productions', 'understrap' ),
			), /* end of arrays */
			'description' 			=> __( 'This is the production post type', 'understrap' ), /* Custom Type Description */
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'exclude_from_search'	=> false,
			'show_ui' 				=> true,
			'query_var' 			=> true,
			'menu_position' 		=> 21, /* this is what order you want it to appear in on the left hand side menu */ 
			//'menu_icon' 		=> get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			//'rewrite'			=> array( 'slug' => 'production', 'with_front' => false ), /* you can specify its url slug */
			'rewrite'			=> array( 'slug' => 'performances/%season%', 'with_front' => false ),  
			'has_archive' 		=> 'performances', /* you can rename the slug here */
			'capability_type'	=> 'page',
			'hierarchical' 		=> false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports'			=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky'),
			'show_in_rest'		=> true,
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'production' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'production' );
	
	register_taxonomy_for_object_type( 'season', 'production' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_production');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	// register_taxonomy( 'custom_cat', 
	//	array('production'), /* if you change the name of register_post_type( 'production', then you have to change this */
	//	array('hierarchical' => true,     /* if this is true, it acts like categories */
	//		'labels' => array(
	//			'name' => __( 'Custom Categories', 'understrap' ), /* name of the custom taxonomy */
	//			'singular_name' => __( 'Custom Category', 'understrap' ), /* single taxonomy name */
	//			'search_items' =>  __( 'Search Custom Categories', 'understrap' ), /* search title for taxomony */
	//			'all_items' => __( 'All Custom Categories', 'understrap' ), /* all title for taxonomies */
	//			'parent_item' => __( 'Parent Custom Category', 'understrap' ), /* parent title for taxonomy */
	//			'parent_item_colon' => __( 'Parent Custom Category:', 'understrap' ), /* parent taxonomy title */
	//			'edit_item' => __( 'Edit Custom Category', 'understrap' ), /* edit custom taxonomy title */
	//			'update_item' => __( 'Update Custom Category', 'understrap' ), /* update title for taxonomy */
	//			'add_new_item' => __( 'Add New Custom Category', 'understrap' ), /* add new title for taxonomy */
	//			'new_item_name' => __( 'New Custom Category Name', 'understrap' ) /* name title for taxonomy */
	//		),
	//		'show_admin_column' => true, 
	//		'show_ui' => true,
	//		'query_var' => true,
	//		'rewrite' => array( 'slug' => 'custom-slug' ),
	//	)
	//);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'season', 
		array('production'), /* if you change the name of register_post_type( 'production', then you have to change this */
		array('hierarchical' => true,    /* if this is false, it acts like tags */
			'labels' => array(
				'name'                       => _x( 'Season', 'taxonomy general name', 'understrap' ),
				'singular_name'              => _x( 'Season', 'taxonomy singular name', 'understrap' ),
				'search_items'               => __( 'Search Seasons', 'understrap' ),
				'popular_items'              => __( 'Popular Seasons', 'understrap' ),
				'all_items'                  => __( 'All Seasons', 'understrap' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Season', 'understrap' ),
				'view_item'                  => __( 'View Season', 'understrap' ),
				'update_item'                => __( 'Update Season', 'understrap' ),
				'add_new_item'               => __( 'Add New Season', 'understrap' ),
				'new_item_name'              => __( 'New Season Name', 'understrap' ),
				'separate_items_with_commas' => __( 'Separate Seasons with commas', 'understrap' ),
				'add_or_remove_items'        => __( 'Add or remove Seasons', 'understrap' ),
				'choose_from_most_used'      => __( 'Choose from the most used Seasons', 'understrap' ),
				'not_found'                  => __( 'No Seasons found.', 'understrap' ),
				'menu_name'                  => __( 'Seasons', 'understrap' ),
				'back_to_items'              => __( 'Back to Seasons', 'understrap' ),
			),			
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_rest' 			=> true,
			'update_count_callback' => '_update_post_term_count',
			//'rewrite'				=> array( 'slug' => 'performances', 'with_front' => false),
		)
	);
		
// https://wordpress.stackexchange.com/questions/108642/permalinks-custom-post-type-custom-taxonomy-post
function lt_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'production' ){
        $terms = wp_get_object_terms( $post->ID, 'season' );
        if( $terms ){
            return str_replace( '%season%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'lt_show_permalinks', 1, 2 );

?>
