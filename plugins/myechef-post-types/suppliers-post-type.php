<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Suppliers Post Type
 * Description: Creates the supplier post type so that it can be network activated / deactivated
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_suppliers_post_type() {

	$labels = array(
		'name'               => _x( 'Suppliers', 'post type general name' ),
		'singular_name'      => _x( 'Supplier', 'post type singular name' ),
		'menu_name'          => _x( 'Suppliers', 'admin Supplier' ),
		'name_admin_bar'     => _x( 'Supplier', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Supplier' ),
		'add_new_item'       => __( 'Add New Supplier' ),
		'new_item'           => __( 'New Supplier' ),
		'edit_item'          => __( 'Edit Supplier' ),
		'view_item'          => __( 'View Supplier' ),
		'all_items'          => __( 'All Suppliers' ),
		'search_items'       => __( 'Search Suppliers' ),
		'parent_item_colon'  => __( 'Parent Suppliers:' ),
		'not_found'          => __( 'No Suppliers found.' ),
		'not_found_in_trash' => __( 'No Suppliers found in Trash.' )
	);

	$args = array(

		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'suppliers', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE

	);

	register_post_type('supplier', $args );

}

add_action( 'init', 'kb_register_suppliers_post_type' );



function kb_register_suppliers_taxonomies() {

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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false

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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);

}

add_action( 'init', 'kb_register_suppliers_taxonomies' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_supplier',
		'title' => 'Supplier',
		'fields' => array (
			array (
				'key' => 'field_53a56ed8808fc',
				'label' => 'Featured Supplier',
				'name' => 'featured_supplier',
				'type' => 'radio',
				'instructions' => 'This effects whether the supplier will appear at the top of the page and whether the featured image will display.',
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
				'key' => 'field_53a55a955cfa2',
				'label' => 'Small Description',
				'name' => 'small_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53a55b402f1cd',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'text',
				'instructions' => 'Full address including postcode. ',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a55ba2e973c',
				'label' => 'Telephone Number',
				'name' => 'telephone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a55bb7e973d',
				'label' => 'Email Address',
				'name' => 'email',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a55bc3e973e',
				'label' => 'Website Address',
				'name' => 'website_address',
				'type' => 'text',
				'instructions' => 'Please include the http://',
				'default_value' => '',
				'placeholder' => 'http://www.myechef.co.uk',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),/*
			array (
				'key' => 'field_53a55c7eb47c2',
				'label' => 'Map',
				'name' => 'map',
				'type' => 'google_map',
				'instructions' => 'This is not yet used but has been included to allow the possibility at a later date.',
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),*/
			array (
				'key' => 'field_53a938c34ee2e',
				'label' => 'Main Content Message',
				'name' => '',
				'type' => 'message',
				'message' => 'The main content area is not currently used but has been left in so that additional information can be saved for use at a later date.',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'supplier',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'slug',
				5 => 'author',
				6 => 'format',
				7 => 'categories',
				8 => 'tags',
				9 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
?>