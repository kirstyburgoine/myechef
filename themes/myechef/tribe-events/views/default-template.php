<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

$protected = get_field('protected', 'option');  
//echo "default = " . $protected;


global $blog_id;

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>

<div id="tribe-events-pg-template">

	<?php tribe_events_before_html(); ?>

	<?php
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	// Check to see if this should be protected first
	// echo "test " . $protected;

	if ( $protected == 'Yes') :
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		// If so, check if someone is logged in and they have permissions for this blog
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : 

		?>

			<?php tribe_get_view(); ?>


		<?php 
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		// If not logged in show error text from Options page in admin
		else : ?>
				
			<div class="grid__item palm-one-whole lap-one-whole">
				<?php
				$not_logged_in = get_field('not_logged_in', 'option');  
				echo $not_logged_in;
				?>
			</div>

		<?php
		endif; 
		// Ends if logged in and you have permission
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------

	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	// Else the site is not protected so just show the standard content
	else : ?>

		<?php tribe_get_view(); ?>

		<?php
	endif; 
	// Ends if the site should be protected or not
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	?>

	<?php tribe_events_after_html(); ?>

</div> <!-- #tribe-events-pg-template -->

<?php get_footer(); ?>