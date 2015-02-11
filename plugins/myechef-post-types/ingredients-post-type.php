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
				'key' => 'field_5457973baf836',
				'label' => 'Stock Levels',
				'name' => 'stock_levels',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_54579750af837',
						'label' => 'Member / Business Unit',
						'name' => 'business_unit',
						'type' => 'user',
						'required' => 1,
						'column_width' => '',
						'role' => array (
							1 => 'editor',
						),
						'field_type' => 'select',
						'allow_null' => 0,
					),
					array (
						'key' => 'field_54579766af838',
						'label' => 'Package Size',
						'name' => 'package_size',
						'type' => 'number',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array (
						'key' => 'field_54579778af839',
						'label' => 'Stock',
						'name' => 'stock',
						'type' => 'number',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
				),
				'row_min' => '0',
				'row_limit' => '10',
				'layout' => 'table',
				'button_label' => 'Add Stock Level',
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