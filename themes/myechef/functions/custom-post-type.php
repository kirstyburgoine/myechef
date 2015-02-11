<?php // functions/custom-post-types.php


 //*******
// LABELS

function post_type_labels($singular, $plural = NULL) {

	$plural = $plural === NULL ? $singular . 's' : $plural;

	return array(
		'name'					=> $plural,
		'singular_name'			=> $singular,
		'add_new'				=> 'Add ' . $singular,
		'add_new_item'			=> 'Add New ' . $singular,
		'edit_item'				=> 'Edit ' . $singular,
		'new_item'				=> 'New ' . $singular,
		'view_item'				=> 'View ' . $singular,
		'search_items'			=> 'Search ' . $plural,
		'not_found'				=> 'No ' . strtolower($plural) . ' found',
		'not_found_in_trash'	=> 'No ' . strtolower($plural) . ' found in Trash',
		'parent_item_colon'		=> ''
	);

}


 //*****************
// CUSTOM POST TYPE

/*
register_post_type('ingredient', array(
	'labels'				=> post_type_labels('Ingredient'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'ingredients', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes', 'page-formats', 'comments'),
	'has_archive'			=> TRUE
));


register_post_type('recipe', array(
	'labels'				=> post_type_labels('Recipe'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'recipes', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes', 'page-formats', 'comments'),
	'has_archive'			=> TRUE
));


register_post_type('supplier', array(
	'labels'				=> post_type_labels('Supplier'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'suppliers', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes', 'page-formats', 'comments'),
	'has_archive'			=> TRUE
));


register_post_type('chefepedia', array(
	'labels'				=> post_type_labels('Chef-E-Pedia'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'chefepedia', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes', 'page-formats', 'comments'),
	'has_archive'			=> TRUE
));

*/

///Course, Food Group and Nationality

/*
add_action('init', function() {

	register_taxonomy(
		'course_category',
		'recipe',
		array(
			'labels' => array(
				'name' => 'Course',
				'add_new_item' => 'Add New Course',
				'new_item_name' => "New Course"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'food_group_category',
		'recipe',
		array(
			'labels' => array(
				'name' => 'Food Group',
				'add_new_item' => 'Add New Food Group',
				'new_item_name' => "New Food Group"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'nationality_category',
		array('recipe', 'chefs_menu'),
		array(
			'labels' => array(
				'name' => 'Nationality',
				'add_new_item' => 'Add New Nationality',
				'new_item_name' => "New Nationality"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'ingredient_category',
		'ingredient',
		array(
			'labels' => array(
				'name' => 'Ingredient Category',
				'add_new_item' => 'Add New Ingredient Category',
				'new_item_name' => "New Ingredient Category"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);



	register_taxonomy(
		'supplier_type',
		'supplier',
		array(
			'labels' => array(
				'name' => 'Supplier Type',
				'add_new_item' => 'Add New Type',
				'new_item_name' => "New Type"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'location',
		'supplier',
		array(
			'labels' => array(
				'name' => 'Location',
				'add_new_item' => 'Add New Location',
				'new_item_name' => "New Food Location"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'delivery',
		'supplier',
		array(
			'labels' => array(
				'name' => 'Delivery Options',
				'add_new_item' => 'Add New Delivery Option',
				'new_item_name' => "New Delivery Option"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);


	register_taxonomy(
		'alphabet',
		'chefepedia',
		array(
			'labels' => array(
				'name' => 'Alphabet',
				'add_new_item' => 'Add New Letter',
				'new_item_name' => "New Letter"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);



});
*/