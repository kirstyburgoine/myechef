<?php
/* 
 * Custom post type archive for Recipes
 */

if ( isset( $_GET['order'] ) ) :
	$order = $_GET['order'];
endif;

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
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">


			<?php
			//if ( $order == "alphabet" ) :
				//global $query_string;
				//query_posts( $query_string . '&orderby=title&order=ASC' );
			//endif;
			
			if ( have_posts() ) :

				get_template_part('includes/content', 'order-results');  ?>

				<h1 class="archive-title">All Recipes</h1>



				<?php
					// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'recipe-archive' );



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
			//if ( $order == "alphabet" ) :
				//global $query_string;
				//query_posts( $query_string . '&orderby=title&order=ASC' );
			//endif;
			
			if ( have_posts() ) :

				get_template_part('includes/content', 'order-results');  ?>

				<h1 class="archive-title"><?php single_cat_title(); ?></h1>



				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'content', 'recipe-archive' );
					endwhile;


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


<?php //get_sidebar(); ?>
<?php get_footer(); ?>