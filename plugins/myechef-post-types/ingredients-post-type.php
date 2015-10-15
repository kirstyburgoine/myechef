<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Ingredients Post Type
 * Description: Creates the ingredient post type so that it can be network activated / deactivated
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_ingredients_post_type() {

	$labels = array(
		'name'               => _x( 'Ingredients', 'post type general name' ),
		'singular_name'      => _x( 'Ingredient', 'post type singular name' ),
		'menu_name'          => _x( 'Ingredients', 'admin Ingredients' ),
		'name_admin_bar'     => _x( 'Ingredient', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Ingredient' ),
		'add_new_item'       => __( 'Add New Ingredient' ),
		'new_item'           => __( 'New Ingredient' ),
		'edit_item'          => __( 'Edit Ingredient' ),
		'view_item'          => __( 'View Ingredient' ),
		'all_items'          => __( 'All Ingredients' ),
		'search_items'       => __( 'Search Ingredients' ),
		'parent_item_colon'  => __( 'Parent Ingredients:' ),
		'not_found'          => __( 'No Ingredients found.' ),
		'not_found_in_trash' => __( 'No Ingredients found in Trash.' )
	);

	$args = array(

		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'ingredients', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments', 'author'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE

	);

	register_post_type('ingredient', $args );

}

add_action( 'init', 'kb_register_ingredients_post_type' );



function kb_register_ingredients_taxonomies() {

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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);

	register_taxonomy(
		'ingredient_supplier',
		'ingredient',
		array(
			'labels' => array(
				'name' => 'Ingredient Supplier',
				'add_new_item' => 'Add New Ingredient Supplier',
				'new_item_name' => "New Ingredient Supplier"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);

}

add_action( 'init', 'kb_register_ingredients_taxonomies' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_ingredients',
		'title' => 'Ingredients',
		'fields' => array (
			array (
				'key' => 'field_530dbaac77dc0',
				'label' => 'Base Unit',
				'name' => 'base_unit',
				'type' => 'select',
				'instructions' => 'Metric measurements',
				'choices' => array (
					'g' => 'g (grammes)',
					'ml' => 'ml (millilitres)',
					'each' => 'Each',
					'null' => 'null',
				),
				'default_value' => 'g : g (grammes)',
				'allow_null' => 0,
				'multiple' => 0,
			),

			array (
				'key' => 'field_530dba4377dbf',
				'label' => 'Base Cost',
				'name' => 'base_cost',
				'type' => 'number',
				'instructions' => 'Cost (in pence) per base unit.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			), 
			
			array (
				'key' => 'field_530dba4377db3',
				'label' => 'Pack Cost',
				'name' => 'pack_cost',
				'type' => 'number',
				'instructions' => 'Cost (in pence) per pack.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),

			array (
				'key' => 'field_530dba4377db4',
				'label' => 'Pack Size',
				'name' => 'pack_size',
				'type' => 'number',
				'instructions' => 'How many in a pack?',
				'default_value' => '0',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_561ce92d423cd',
				'label' => 'VATable?',
				'name' => 'vatable',
				'type' => 'radio',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'No',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_561ce961423ce',
				'label' => 'Vat Amount',
				'name' => 'vat_amount',
				'type' => 'number',
				'instructions' => 'Enter the VAT amount as a decimal, For example 20% would be 0.2.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_561ce92d423cd',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '0.2',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),

			array (
				'key' => 'field_538f87fc10e87',
				'label' => 'Allergens',
				'name' => 'allergens',
				'type' => 'checkbox',
				'instructions' => 'Select any allergens that are present in the recipe',
				'choices' => array (
					'Celery (c)' => 'Celery (c)',
					'Cereal (g)' => 'Cereal (g)',
					'Crustacea (cr)' => 'Crustacea (cr)',
					'Eggs (e)' => 'Eggs (e)',
					'Fish (f)' => 'Fish (f)',
					'Lupin (l)' => 'Lupin (l)',
					'Milk (mi)' => 'Milk (mi)',
					'Molluscs (mo)' => 'Molluscs (mo)',
					'Mustard (mu)' => 'Mustard (mu)',
					'Nuts (n)' => 'Nuts (n)',
					'Peanuts (p)' => 'Peanuts (p)',
					'Sesame Seeds (ss)' => 'Sesame Seeds (ss)',
					'Soya (so)' => 'Soya (so)',
					'Sulphur Dioxide (sd)' => 'Sulphur Dioxide (sd)',
				),
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_530dba4377db8',
				'label' => 'Percentage Yield',
				'name' => 'percentage_yield',
				'type' => 'number',
				'instructions' => 'What percentage of the ingredient will be used?',
				'default_value' => '100',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'ingredient',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'discussion',
				3 => 'comments',
				4 => 'featured_image',
				5 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

?>