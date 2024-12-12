<?php 

//theme Support

add_theme_support( 'post-thumbnails' );

// menu
function broxy_register_menues(){
	register_nav_menus(array('main-menu'=>'Main Menu'));
}
add_action('init','broxy_register_menues');


//stylesheet
function broxy_bookcenter_enqueue_stylesheets(){

	// Enqueue Bootstrap CSS (using CDN)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), null);
    // Enqueue Bootstrap JS (using CDN)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);

    wp_enqueue_style('broxy-bookcenter-stylesheet',get_stylesheet_uri());
    wp_style_add_data('broxy-bookcenter-stylesheet','rtl','replace');
}
add_action('wp_enqueue_scripts','broxy_bookcenter_enqueue_stylesheets');




//register custom taxonomies
function  broxy_book_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$booktype_labels = array(
		'name'              => _x( 'Book Types', 'taxonomy general name', 'broxy-bookcenter' ),
		'singular_name'     => _x( 'Book Type', 'taxonomy singular name', 'broxy-bookcenter' ),
		'search_items'      => __( 'Search Book Types', 'broxy-bookcenter' ),
		'all_items'         => __( 'All Book Types', 'broxy-bookcenter' ),
		'parent_item'       => __( 'Parent Book Type', 'broxy-bookcenter' ),
		'parent_item_colon' => __( 'Parent Book Type:', 'broxy-bookcenter' ),
		'edit_item'         => __( 'Edit Book Type', 'broxy-bookcenter' ),
		'update_item'       => __( 'Update Book Type', 'broxy-bookcenter' ),
		'add_new_item'      => __( 'Add New Book Type', 'broxy-bookcenter' ),
		'new_item_name'     => __( 'New  Book Type Name', 'broxy-bookcenter' ),
		'menu_name'         => __( 'Book Type', 'broxy-bookcenter' ),
	);

	$booktype_args = array(
		'hierarchical'      => true,
		'labels'            => $booktype_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'book-type' ),
	);

	register_taxonomy( 'book_type', array( 'book' ), $booktype_args );

	unset( $args );
	unset( $labels );

	// Add new taxonomy, NOT hierarchical (like tags)
	$writer_labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name', 'broxy-bookcenter' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'broxy-bookcenter' ),
		'search_items'               => __( 'Search Writers', 'broxy-bookcenter' ),
		'popular_items'              => __( 'Popular Writers', 'broxy-bookcenter' ),
		'all_items'                  => __( 'All Writers', 'broxy-bookcenter' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer', 'broxy-bookcenter' ),
		'update_item'                => __( 'Update Writer', 'broxy-bookcenter' ),
		'add_new_item'               => __( 'Add New Writer', 'broxy-bookcenter' ),
		'new_item_name'              => __( 'New Writer Name', 'broxy-bookcenter' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'broxy-bookcenter' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'broxy-bookcenter' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'broxy-bookcenter' ),
		'not_found'                  => __( 'No writers found.', 'broxy-bookcenter' ),
		'menu_name'                  => __( 'Writers', 'broxy-bookcenter' ),
	);

	$writer_args = array(
		'hierarchical'          => false,
		'labels'                => $writer_labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);

	register_taxonomy( 'writer', 'book', $writer_args );

//register publisher
    $publisher_labels = array(
		'name'                       => _x( 'Publishers', 'taxonomy general name', 'broxy-bookcenter' ),
		'singular_name'              => _x( 'Publisher', 'taxonomy singular name', 'broxy-bookcenter' ),
		'search_items'               => __( 'Search Publishers', 'broxy-bookcenter' ),
		'popular_items'              => __( 'Popular Publishers', 'broxy-bookcenter' ),
		'all_items'                  => __( 'All Publishers', 'broxy-bookcenter' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Publisher', 'broxy-bookcenter' ),
		'update_item'                => __( 'Update Publisher', 'broxy-bookcenter' ),
		'add_new_item'               => __( 'Add New Publisher', 'broxy-bookcenter' ),
		'new_item_name'              => __( 'New Publisher Name', 'broxy-bookcenter' ),
		'separate_items_with_commas' => __( 'Separate publishers with commas', 'broxy-bookcenter' ),
		'add_or_remove_items'        => __( 'Add or remove publishers', 'broxy-bookcenter' ),
		'choose_from_most_used'      => __( 'Choose from the most used publishers', 'broxy-bookcenter' ),
		'not_found'                  => __( 'No publishers found.', 'broxy-bookcenter' ),
		'menu_name'                  => __( 'Publishers', 'broxy-bookcenter' ),
	);

	$publisher_args = array(
		'hierarchical'          => false,
		'labels'                => $publisher_labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'publisher' ),
	);

	register_taxonomy( 'publisher', 'book', $publisher_args);
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'broxy_book_taxonomies', 0 );



/**
 * Register a custom post type called "book"
 */
function broxy_bookcenter_register_book_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Books', 'broxy-bookcenter' ),
		'singular_name'         => _x( 'Book', 'broxy-bookcenter' ),
		'menu_name'             => _x( 'Books', 'broxy-bookcenter' ),
		'name_admin_bar'        => _x( 'Book', 'broxy-bookcenter' ),
		'add_new'               => __( 'Add New', 'broxy-bookcenter' ),
		'add_new_item'          => __( 'Add New Book', 'broxy-bookcenter'),
		'new_item'              => __( 'New Book', 'broxy-bookcenter' ),
		'edit_item'             => __( 'Edit Book', 'broxy-bookcenter' ),
		'view_item'             => __( 'View Book', 'broxy-bookcenter' ),
		'all_items'             => __( 'All Books', 'broxy-bookcenter' ),
		'search_items'          => __( 'Search Books', 'broxy-bookcenter' ),
		'parent_item_colon'     => __( 'Parent Books:', 'broxy-bookcenter' ),
		'not_found'             => __( 'No books found.', 'broxy-bookcenter' ),
		'not_found_in_trash'    => __( 'No books found in Trash.', 'broxy-bookcenter' ),
		'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'broxy-bookcenter' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'broxy-bookcenter' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'broxy-bookcenter' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'broxy-bookcenter' ),
		'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'broxy-bookcenter' ),
		'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'broxy-bookcenter' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'broxy-bookcenter' ),
		'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'broxy-bookcenter' ),
		'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'broxy-bookcenter' ),
		'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'broxy-bookcenter' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
	);

	register_post_type( 'book', $args );
}

add_action( 'init', 'broxy_bookcenter_register_book_custom_post_type' );