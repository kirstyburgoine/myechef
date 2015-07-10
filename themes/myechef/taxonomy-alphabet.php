<?php
/* 
 * Custom taxonomy archive for alphabet. This is used to sort chefepedia and information centre posts alphabetically
 * Code here should match archive-chefepedia.php and archive-information_centre.php exactly
 * Only reason it has its own template is because its a custom taxonomy
 */

$order = $_GET['order'];
$protected = get_field('protected', 'option');  

global $blog_id;

get_header(); ?>

<div class="container pt">

	<div class="grid">

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

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php	
				//------------------------------------------------------------------------------------------------
				// Start the loop
				global $query_string;
				query_posts( $query_string . '&posts_per_page=20&orderby=title&order=ASC' );
			
				if ( have_posts() ) : 
					
					get_template_part('content', 'order-results'); ?>

					<h1 class="archive-title">All Articles</h1>

					<?php	// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'chefepedia-archive' );

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif; wp_reset_query(); 
				?>

			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
					<?php get_sidebar(); ?>
			</div>

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
			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php	
				//------------------------------------------------------------------------------------------------
				// Start the loop
				global $query_string;
				query_posts( $query_string . '&posts_per_page=20&orderby=title&order=ASC' );
			
				if ( have_posts() ) : 
					
					get_template_part('content', 'order-results'); ?>

					<h1 class="archive-title">All Articles</h1>

					<?php	// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'chefepedia-archive' );

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif; wp_reset_query(); 
				?>

			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
					<?php get_sidebar(); ?>
			</div>

	<?php
	endif; 
	// Ends if the site should be protected or not
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	?>

	</div> <!-- // Grid -->

</div>



<?php get_footer(); ?>