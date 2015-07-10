<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Plugin Name: MyEchef - Additional Options
 * Description: More site options specific to MyEChef. Originally created with ACF and exported to a plugin
 * Version: 1.0
 * Author: Kirsty Burgoine
 * Author URI: http://www.kirstyburgoine.co.uk
 */


// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// Home Page Options

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-page-options',
		'title' => 'Home Page Options',
		'fields' => array (
			array (
				'key' => 'field_53f8546704b4f',
				'label' => 'Intro text',
				'name' => 'intro_text',
				'type' => 'textarea',
				'instructions' => 'this is displayed above the main carousel on the homepage',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53f8548704b50',
				'label' => 'Carousel Title',
				'name' => 'carousel_title',
				'type' => 'text',
				'default_value' => 'Our Favourite Recipes',
				'placeholder' => 'Our Favourite Recipes',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 35,
			),
			array (
				'key' => 'field_53f854b804b51',
				'label' => 'Carousel Content',
				'name' => 'carousel_content',
				'type' => 'relationship',
				'instructions' => 'Select the content to be used on the homepage in the main carousel. This is set to a maximum of 10.',
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
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => '-18',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'index.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'featured_image',
			),
		),
		'menu_order' => 0,
	));
}


// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// Standard Page Options

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-options-2',
		'title' => 'Page Options',
		'fields' => array (
			array (
				'key' => 'field_53f85832329d4',
				'label' => 'Feature Area Description',
				'name' => 'feature_area_description',
				'type' => 'textarea',
				'instructions' => 'Add a basic description of the page to the main feature area. this is very good for accessibility as well as giving an outline of the content',
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
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'index.php',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tribe_events',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// Global Options for each site

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_global-options',
		'title' => 'Global Options',
		'fields' => array (
			array (
				'key' => 'field_751959b2f131e',
				'label' => 'Protected',
				'name' => 'protected',
				'type' => 'radio',
				'instructions' => 'Should this website be accessible only to people that can login?',
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
				'key' => 'field_532b747075112',
				'label' => 'Not Logged In',
				'name' => 'not_logged_in',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_751959b2f131e',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Text area displayed instead of premium content to encourage people to join My EChef to gain access to that content.',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_53f866d47cec2',
				'label' => 'Company Logo',
				'name' => 'company_logo',
				'type' => 'image',
				'instructions' => 'Maximum Width is 195px;',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_53298f96aa8df',
				'label' => 'Banner Background Image',
				'name' => 'background_banner_image',
				'type' => 'image',
				'instructions' => 'Upload a background image for the main focus area on all pages. This should be used as a background image to set a theme only. No text should be used within the images because not all of the image will display on all devices.
	
	The ideal size for this image would be 1280 x 550',
				'save_format' => 'object',
				'preview_size' => 'admin-banner',
				'library' => 'all',
			),
			array (
				'key' => 'field_5331b8dc441c5',
				'label' => 'Banner Colour Overlay',
				'name' => 'banner_colour_overlay',
				'type' => 'select',
				'instructions' => 'Select the colour to overlay the main background image and set other colours in the theme to match',
				'required' => 1,
				'choices' => array (
					'None' => 'None',
					'Purple' => 'Purple',
					'Red' => 'Red',
					'Yellow' => 'Yellow',
					'Blue' => 'Blue',
					'Green' => 'Green',
					'Brown' => 'Brown',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_532b0157ecb9c',
				'label' => 'Featured Recipes',
				'name' => 'featured_recipes',
				'type' => 'relationship',
				'instructions' => 'Select the recipes to be featured in the main banner area on every page. This is limited to a maximum of 5.',
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
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 5,
			),
			array (
				'key' => 'field_541adb7e1c944',
				'label' => 'show feedback form',
				'name' => 'show_feedback_form',
				'type' => 'radio',
				'instructions' => 'Choose whether to display the feedback form.',
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
				'key' => 'field_53f854670789f',
				'label' => 'Analytics Code',
				'name' => 'analytics_code',
				'type' => 'textarea',
				'instructions' => 'Paste the full Google Analytics code without the script tags here',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5329c5c7abde9',
				'label' => 'Recipes Intro Text',
				'name' => 'recipes_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for recipe listings.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5370b16f3fddb',
				'label' => 'Events Intro Text',
				'name' => 'events_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on the calendar pages for events and seasonal produce listings.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53a9605b458e1',
				'label' => 'Suppliers Intro Text',
				'name' => 'suppliers_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for suppliers.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53a9605b458e9',
				'label' => 'Contacts Intro Text',
				'name' => 'contacts_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for contacts on sub sites.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53a96085d7e33',
				'label' => 'Chef-e-pedia Intro Text',
				'name' => 'chef-e-pedia_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for the chef-e-pedia section.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53a96085d7e55',
				'label' => 'Information Centre Intro Text',
				'name' => 'information_centre_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for the information centre section on sub sites.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53de5e83a4a28',
				'label' => 'Chef\'s Menus Intro Text',
				'name' => 'chefs_menus_intro_text',
				'type' => 'textarea',
				'instructions' => 'This is the area at the top of the page that displays on archive pages for the Chef\'s Menus section.',
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
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



?>