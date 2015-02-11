<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Information Centre Post Type
 * Description: Creates the Information Centre post type so that it can be activated / deactivated in sub sites
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_information_centre_post_type() {

	$labels = array(
		'name'               => _x( 'Information Centre', 'post type general name' ),
		'singular_name'      => _x( 'Information Centre', 'post type singular name' ),
		'menu_name'          => _x( 'Information Centre', 'admin Information Centre' ),
		'name_admin_bar'     => _x( 'Information Centre', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Article' ),
		'add_new_item'       => __( 'Add New Article' ),
		'new_item'           => __( 'New Article' ),
		'edit_item'          => __( 'Edit Article' ),
		'view_item'          => __( 'View Article' ),
		'all_items'          => __( 'All Articles' ),
		'search_items'       => __( 'Search Articles' ),
		'parent_item_colon'  => __( 'Parent Articles:' ),
		'not_found'          => __( 'No Articles found.' ),
		'not_found_in_trash' => __( 'No Articles found in Trash.' )
	);

	$args = array(

		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'information-centre', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE

	);

	register_post_type('information_centre', $args );

}

add_action( 'init', 'kb_register_information_centre_post_type' );



function kb_register_information_centre_taxonomies() {

		register_taxonomy(
		'alphabet',
		'information_centre',
		array(
			'labels' => array(
				'name' => 'Alphabet',
				'add_new_item' => 'Add New Letter',
				'new_item_name' => "New Letter"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_in_nav_menus'	=> false

		)
	);

}

add_action( 'init', 'kb_register_information_centre_taxonomies' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_information_centre',
		'title' => 'Information Centre',
		'fields' => array (
			array (
				'key' => 'field_53a95cdc441c8',
				'label' => 'Small Description',
				'name' => 'small_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'information_centre',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'featured_image',
				10 => 'categories',
				11 => 'tags',
				12 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

?>