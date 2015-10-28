<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Wastage Reports Post Type
 * Description: Creates the wastage reposrts post type so that it can be network activated / deactivated
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_wastage_post_type() {

	$labels = array(
		'name'               => _x( 'Wastage', 'post type general name' ),
		'singular_name'      => _x( 'Wastage', 'post type singular name' ),
		'menu_name'          => _x( 'Wastage', 'admin Wastage' ),
		'name_admin_bar'     => _x( 'Wastage', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Wastage' ),
		'add_new_item'       => __( 'Add New Wastage' ),
		'new_item'           => __( 'New Wastage' ),
		'edit_item'          => __( 'Edit Wastage' ),
		'view_item'          => __( 'View Wastage' ),
		'all_items'          => __( 'All Wastage' ),
		'search_items'       => __( 'Search Wastage' ),
		'parent_item_colon'  => __( 'Parent Wastage:' ),
		'not_found'          => __( 'No Wastage found.' ),
		'not_found_in_trash' => __( 'No Wastage found in Trash.' )
	);

	$args = array(

		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'wastage', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE

	);

	register_post_type('wastage', $args );

}

add_action( 'init', 'kb_register_wastage_post_type' );


function kb_register_wastage_taxonomies() {

	register_taxonomy(
		'cost_type',
		'wastage',
		array(
			'labels' => array(
				'name' => 'Type of Cost',
				'add_new_item' => 'Add Type of Cost',
				'new_item_name' => "New Type of Cost"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);

}

add_action( 'init', 'kb_register_wastage_taxonomies' );





if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_wastage',
		'title' => 'Wastage',
		'fields' => array (
			/*
			array (
				'key' => 'field_530dbb8b601ad',
				'label' => 'Small Description',
				'name' => 'small_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'formatting' => 'br',
			),
			*/
			array (
				'key' => 'field_5627984bcc25f',
				'label' => 'Report Start Date',
				'name' => 'report_start',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),

			array (
				'key' => 'field_5627984bcc27f',
				'label' => 'Report End Date',
				'name' => 'report_end',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
/*
			array (
				'key' => 'field_5331f087928cf',
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
				'key' => 'field_53554f62fe889',
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
			array (
				'key' => 'field_5360b9da57d3b',
				'label' => 'Recipe Quantity',
				'name' => 'recipe_quantity',
				'type' => 'text',
				'instructions' => 'How much will this recipe make?
	This is required to allow a base unit of one that can be used to calculate the correct cost of a sub recipe depending on the quantity needed to make up the main recipe. For example, the main recipe for custard could make 3 litres but only 500ml would be needed for apple pie and custard.',
				'default_value' => 0,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			), 
			array (
				'key' => 'field_5360bbe357d3c',
				'label' => 'Recipe Quantity Unit',
				'name' => 'recipe_quantity_unit',
				'type' => 'select',
				'instructions' => 'What unit will the recipe make',
				'choices' => array (
					'g' => 'g (grammes)',
					'ml' => 'ml (millilitres)',
					'na' => 'No unit',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			), */

			array (
				'key' => 'field_530dbdb45a5b7',
				'label' => 'Ingredients',
				'name' => 'ingredients',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_530dbdc35a5b8',
						'label' => 'Ingredients',
						'name' => 'ingredients',
						'type' => 'relationship',
						'column_width' => '',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'ingredient',
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
						'key' => 'field_530dbdf05a5b9',
						'label' => 'Quantity',
						'name' => 'quantity',
						'type' => 'number',
						'instructions' => 'In base units',
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
						'key' => 'field_530dbbaa691ae',
						'label' => 'Reason for Wastage',
						'name' => 'reason_for_wastage',
						'type' => 'select',
						'choices' => array (
							'Out of date' => 'Out of date',
							'Returned by customer' => 'Returned by customer',
							'Leftover from service' => 'Leftover from service',
							'Dropped on floor' => 'Dropped on floor',
						),
						'instructions' => '',
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
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Ingredient',
			), /*
			array (
				'key' => 'field_530dbc6e601b2',
				'label' => 'Seasoning',
				'name' => 'seasoning',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			), */
			array (
				'key' => 'field_535fc12fd5002',
				'label' => 'Sub Recipes',
				'name' => 'sub_recipes',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_535fc152d5003',
						'label' => 'Sub Recipe',
						'name' => 'sub_recipe',
						'type' => 'relationship',
						'column_width' => '',
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
						'key' => 'field_535fc187d5004',
						'label' => 'Quantity',
						'name' => 'quantity',
						'type' => 'number',
						'instructions' => 'In base units',
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
						'key' => 'field_540dbbaa791ae',
						'label' => 'Reason for Wastage',
						'name' => 'sub_reason_for_wastage',
						'type' => 'select',
						'choices' => array (
							'Out of date' => 'Out of date',
							'Returned by customer' => 'Returned by customer',
							'Leftover from service' => 'Leftover from service',
							'Dropped on floor' => 'Dropped on floor',
						),
						'instructions' => '',
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
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Recipe',
			),
	
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wastage',
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
				3 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

};

?>