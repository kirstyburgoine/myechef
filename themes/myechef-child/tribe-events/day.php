<?php
/**
 * Day View Template
 * The wrapper template for day view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_before_template' ); ?>

<?php	
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
		if ( !is_user_logged_in() ) :

			$not_logged_in = get_field('not_logged_in', 'option');  
			echo $not_logged_in;
		else : ?>



<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'day/content' ) ?>

<?php endif;?>

<div class="tribe-clear"></div>

<?php do_action( 'tribe_events_after_template' ) ?>
