<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Chefs Menus Post Type
 * Description: Creates the chefs_menus post type so that it can be network activated / deactivated
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_chefs_menus_post_type() {

	$labels = array(
		'name'               => _x( 'Chef\'s Menus', 'post type general name' ),
		'singular_name'      => _x( 'Chef\'s Menu', 'post type singular name' ),
		'menu_name'          => _x( 'Chef\'s Menus', 'admin Chefs menu' ),
		'name_admin_bar'     => _x( 'Chef\'s Menu', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Chefs Menu' ),
		'add_new_item'       => __( 'Add New Chef\'s Menu' ),
		'new_item'           => __( 'New Chef\'s Menu' ),
		'edit_item'          => __( 'Edit Chef\'s Menu' ),
		'view_item'          => __( 'View Chef\'s Menu' ),
		'all_items'          => __( 'All Chef\'s Menus' ),
		'search_items'       => __( 'Search Chef\'s Menus' ),
		'parent_item_colon'  => __( 'Parent Chef\'s Menus:' ),
		'not_found'          => __( 'No Chef\'s Menus found.' ),
		'not_found_in_trash' => __( 'No Chef\'s Menus found in Trash.' )
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'menus', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE
	);

	register_post_type( 'chefs_menu', $args );

}

add_action( 'init', 'kb_register_chefs_menus_post_type' );



function kb_register_chefs_menus_taxonomies() {



	register_taxonomy(
		'event_type',
		'chefs_menu',
		array(
			'labels' => array(
				'name' => 'Event Type',
				'add_new_item' => 'Add Event Type',
				'new_item_name' => "New Event Type"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);



	register_taxonomy(
		'chefs_menu_type',
		'chefs_menu',
		array(
			'labels' => array(
				'name' => 'Menu Type',
				'add_new_item' => 'Add Menu Type',
				'new_item_name' => "New Menu Type"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);

}

add_action( 'init', 'kb_register_chefs_menus_taxonomies' );


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_chefs-menu',
		'title' => 'Chef\'s Menu',
		'fields' => array (
			array (
				'key' => 'field_53de7df358d1e',
				'label' => 'Small Description',
				'name' => 'small_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'formatting' => 'br',
			),
			/*
			array (
				'key' => 'field_5331f087976cf',
				'label' => 'Portion Quantity',
				'name' => 'portion_quantity',
				'type' => 'text',
				'instructions' => 'How many portions will the recipe make',
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53554f62fe909',
				'label' => 'Portion Quantity Text',
				'name' => 'portion_quantity_text',
				'type' => 'text',
				'instructions' => 'Enter the text for the quantity type that you would like to display after "This recipe makes X ......". Please keep this to lower case and singular so that it can also be used in the calculator totals table in other variations as well',
				'default_value' => 'portion',
				'placeholder' => 'portion',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			*/
			array (
				'key' => 'field_5413f9f54b227',
				'label' => 'Suggested Cost Label',
				'name' => 'serving',
				'type' => 'select',
				'instructions' => 'Affects the column title for the suggested cost on all tables on the page',
				'choices' => array (
					'Selling Price' => 'Selling Price',
					'Cost Price' => 'Cost Price',
				),
				'default_value' => 'Selling Price per Serving',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53de4a17890f6',
				'label' => 'Courses',
				'name' => 'fc_courses',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => 'Add Course',
						'name' => 'add_course',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_53de4bae51ca7',
								'label' => 'Course Name',
								'name' => 'course_name',
								'type' => 'text',
								'column_width' => 100,
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_53de4a68890f7',
								'label' => 'Recipes per Course',
								'name' => 'recipes_per_course',
								'type' => 'repeater',
								'column_width' => 100,
								'sub_fields' => array (
									array (
										'key' => 'field_53de4a85890f8',
										'label' => 'Recipe',
										'name' => 'recipe',
										'type' => 'relationship',
										'column_width' => 60,
										'return_format' => 'object',
										'post_type' => array (
											0 => 'recipe',
										),
										'taxonomy' => array (
											0 => 'all',
										),
										'filters' => array (
											0 => 'search',
										),
										'result_elements' => array (
											0 => 'post_type',
											1 => 'post_title',
										),
										'max' => '',
									),
									array (
										'key' => 'field_53de4ac9890f10',
										'label' => 'Suggested Cost',
										'name' => 'suggested_cost',
										'type' => 'number',
										'instructions' => 'selling / cost price per serving',
										'column_width' => 20,
										'default_value' => '0.00',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
									array (
										'key' => 'field_53de4ac9890f11',
										'label' => 'Gross Profit',
										'name' => 'gross_profit',
										'type' => 'number',
										'instructions' => '% per serving',
										'column_width' => 20,
										'default_value' => '65',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
								),
								'row_min' => '',
								'row_limit' => '8',
								'layout' => 'table',
								'button_label' => 'Add Recipe',
							),
						),
					),
					array (
						'label' => 'Add Text Area',
						'name' => 'add_text_area',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_53e37a80241ae',
								'label' => 'Text Area Title',
								'name' => 'text_area_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_53e37a99241af',
								'label' => 'Text Area',
								'name' => 'text_area',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
						),
					),
				),
				'button_label' => 'Add Content Type',
				'min' => '',
				'max' => '8',
			),
			array (
				'key' => 'field_53e37bdda87f0',
				'label' => 'Message',
				'name' => '',
				'type' => 'message',
				'message' => 'All content to display on the page after the suggested menus should be created using the standard WordPress content area below.',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'chefs_menu',
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
				1 => 'discussion',
				2 => 'comments',
				3 => 'revisions',
				4 => 'author',
				5 => 'format',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}



?>