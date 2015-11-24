<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Recipes Post Type
 * Description: Creates the recipes post type so that it can be network activated / deactivated
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


function kb_register_recipes_post_type() {

	$labels = array(
		'name'               => _x( 'Recipes', 'post type general name' ),
		'singular_name'      => _x( 'Recipe', 'post type singular name' ),
		'menu_name'          => _x( 'Recipes', 'admin Recipes' ),
		'name_admin_bar'     => _x( 'recipe', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Recipe' ),
		'add_new_item'       => __( 'Add New Recipe' ),
		'new_item'           => __( 'New Recipe' ),
		'edit_item'          => __( 'Edit Recipe' ),
		'view_item'          => __( 'View Recipe' ),
		'all_items'          => __( 'All Recipes' ),
		'search_items'       => __( 'Search Recipes' ),
		'parent_item_colon'  => __( 'Parent Recipes:' ),
		'not_found'          => __( 'No Recipes found.' ),
		'not_found_in_trash' => __( 'No Recipes found in Trash.' )
	);

	$args = array(

		'labels'				=> $labels,
		'public'				=> TRUE,
		'query_var'				=> TRUE,
		'rewrite'				=> array('slug' => 'recipes', 'with_front' => FALSE),
		'capability_type'		=> 'post',
		'taxonomies'			=> array(),
		'supports'				=> array('title', 'editor', 'thumbnail', 'page-formats', 'comments'),
		'has_archive'			=> TRUE,
		'show_in_nav_menus'		=> FALSE

	);

	register_post_type('recipe', $args );

}

add_action( 'init', 'kb_register_recipes_post_type' );



function kb_register_recipes_taxonomies() {

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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
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
			'hierarchical' => true,
			'show_in_nav_menus'	=> false
		)
	);



}

add_action( 'init', 'kb_register_recipes_taxonomies' );




if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_recipe',
		'title' => 'Recipe',
		'fields' => array (
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

			array (
				'key' => 'field_530dba4377dcf',
				'label' => 'Gross Profit',
				'name' => 'gross_profit',
				'type' => 'number',
				'instructions' => 'The percentage of profit you would like to make on the dish',
				'default_value' => '70',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			), 

			array (
				'key' => 'field_530dba4377d6f',
				'label' => 'Menu Price',
				'name' => 'menu_price',
				'type' => 'number',
				'instructions' => 'A set price you would like to sell the dish for including VAT. VAT amount is set in Options. This is also used as the suggested price in the set menus',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			), 

			array (
				'key' => 'field_530dbbaa601ae',
				'label' => 'Skill Level',
				'name' => 'skill_level',
				'type' => 'select',
				'choices' => array (
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_530dbbcf601af',
				'label' => 'Preparation Time',
				'name' => 'preparation_time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'e.g. 1 hour 30 minutes',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_530dbbed601b0',
				'label' => 'Serving Time',
				'name' => 'cooking_time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'e.g. 1 hour 30 minutes',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
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
			),

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
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Ingredient',
			),
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
			),
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
						'key' => 'field_535f5187d5004',
						'label' => 'Allergens',
						'name' => 'sub_allergens',
						'type' => 'text',
						'instructions' => 'List allergens in sub recipes',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Recipe',
			),/*
			array (
				'key' => 'field_532aec311191d',
				'label' => 'Nutritional Information',
				'name' => 'nutritional_information',
				'type' => 'repeater',
				'instructions' => 'Create columns in the nutritional information table for each recipe',
				'sub_fields' => array (
					array (
						'key' => 'field_532aec5c1191e',
						'label' => 'Information Label',
						'name' => 'information_label',
						'type' => 'text',
						'instructions' => 'The type of nutritional information',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_532aec931191f',
						'label' => 'Information Value',
						'name' => 'information_value',
						'type' => 'text',
						'instructions' => 'The relevant value',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => 6,
				'layout' => 'table',
				'button_label' => 'Add Column',
			),*/
			array (
				'key' => 'field_538f8bb6fb825',
				'label' => 'Allergens Additional Info',
				'name' => 'allergens_additional_info',
				'type' => 'text',
				'instructions' => 'An extra free text area that appears above the list of allergens. Please keep this brief. Ideally no more than two lines of text. allergens are pulled automatically from each ingredient.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_530dbc66601b1',
				'label' => 'Equipment',
				'name' => 'equipment',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'recipe',
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


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_course-icon',
		'title' => 'Course Icon',
		'fields' => array (
			array (
				'key' => 'field_533171a706b74',
				'label' => 'icon',
				'name' => 'icon',
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
					'value' => 'course_category',
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