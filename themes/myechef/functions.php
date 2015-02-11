<?php // functions.php

session_start();


if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

 //**************
// THEME SUPPORT

add_theme_support('post-thumbnails');
//add_theme_support('menus');


 //****************
// THUMBNAIL SIZES

add_image_size('recipe-thumb', 185, 185, TRUE);
add_image_size('flag', 75, 45, TRUE);
add_image_size('courses', 100, 100, TRUE);
add_image_size('featured-recipe-thumb', 280, 280, TRUE);
add_image_size('featured-recipe', 350, 350, TRUE);
add_image_size('bg-banner', 9999, 550, FALSE);
add_image_size('admin-banner', 600, 258, TRUE);
add_image_size('logo', 195, 9999, FALSE);

 //****************
// MENUS
register_nav_menu( 'primary-menu', __( 'Primary Menu', 'myechef' ) ); 
register_nav_menu( 'secondary-menu', __( 'Secondary Menu' ) );
register_nav_menu( 'utility-menu', __( 'Utility Menu' ) );

// Add legends to day view in calendar
//teccc_add_legend_view( 'day' );

 //****************
// SCRIPTS
function myechef_scripts() {
		
	if ( !is_admin() ) {
		
		wp_register_script('modernizr', get_template_directory_uri().'/public/scripts/modernizr.min.js', array('jquery' ), null, true );			
		wp_register_script('scroll', get_template_directory_uri().'/public/scripts/scrollTo.min.js', array('jquery' ), null, true );
		wp_register_script('flexslider', get_template_directory_uri().'/public/scripts/jquery.flexslider.min.js', array('jquery' ), null, true );
		wp_register_script('vids', get_template_directory_uri().'/public/scripts/jquery.fitvids.min.js', array('jquery' ), null, true );
		wp_register_script('qtip', get_template_directory_uri().'/public/scripts/jquery.qtip.min.js', array('jquery' ), null, true );
		wp_register_script('reveal', get_template_directory_uri().'/public/scripts/jquery.reveal.min.js', array('jquery' ), null, true );
		wp_register_script('slicknav', get_template_directory_uri().'/public/scripts/jquery.slicknav.min.js', array('jquery' ), null, true );
		wp_register_script('custom', get_template_directory_uri().'/public/scripts/custom.min.js', array ( 'jquery' ), null, true );
		
		
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'scroll' );
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'vids' );
		wp_enqueue_script( 'qtip' );
		wp_enqueue_script( 'reveal' );
		wp_enqueue_script( 'slicknav' );
		wp_enqueue_script( 'custom' );
			
	}

}
add_action('wp_enqueue_scripts', 'myechef_scripts');




 //*****************
// RECIPE FUNCTIONS

function get_ingredient_cost($id = NULL) {

	if ( empty($id) ) {
		$id = get_the_ID();
	}
	
	return get_field('base_cost', $id);

}

function get_sub_recipe_cost($recipe_id, $quantity) {

	$ingredients = get_field('ingredients', $recipe_id);
	$recipe_quantity = get_field('recipe_quantity', $recipe_id);
	$recipe_cost = 0.00;

	if ( ! $recipe_quantity || $recipe_quantity === 0 ) {
		return $recipe_cost;
	}

	foreach ( $ingredients as $ingredient_line ) {
		$ingredient = current($ingredient_line['ingredients']);
		$base_quantity = $ingredient_line['quantity'];

		$recipe_cost += get_field('base_cost', $ingredient->ID) * $base_quantity;
		
	}

	return (($recipe_cost / $recipe_quantity) * $quantity) / 100;	

}






// allow CV files to be uploaded via gravity form
add_filter('upload_mimes', 'my_upload_mimes');

function my_upload_mimes ( $existing_mimes=array() ) {
    $existing_mimes['csv'] = 'text/csv';
    return $existing_mimes;
}





 //************
// SHORT CODES

	function hr() {
		return '<hr />';
	}
	add_shortcode("hr", "hr");	

	function faq_shortcode( $atts, $content = null ) {
	   return '<div class="faq-container">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('faq', 'faq_shortcode');	



 //*********
// INCLUDES

// bury gorups of functionality within the functions/ directory
// loader.php will include all .php files from within

require_once('functions/loader.php');