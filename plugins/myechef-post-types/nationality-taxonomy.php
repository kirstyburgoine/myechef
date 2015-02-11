<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Nationality Taxonomy
 * Description: Options ofr Nationality taxonomy so it can be applied to multiple post types and have customf fields
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */






function kb_register_nationality_taxonomy() {

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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);

}

add_action( 'init', 'kb_register_nationality_taxonomy' );



if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_nationality-flag',
		'title' => 'Nationality Flag',
		'fields' => array (
			array (
				'key' => 'field_531d16853b1e0',
				'label' => 'Flag',
				'name' => 'flag',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'nationality_category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


?>