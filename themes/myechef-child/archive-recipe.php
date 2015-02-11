<?php
/* 
 * Custom post type archive for Recipes
 */

if ( isset( $_GET['order'] ) ) :
	$order = $_GET['order'];
endif;

get_header(); ?>

	<div class="container pt">

		<div class="grid">

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">


	<?php
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
		if ( !is_user_logged_in() ) :

			$not_logged_in = get_field('not_logged_in', 'option');  
			echo $not_logged_in;
			
		else : ?>

			<?php
			if ( $order == "alphabet" ) :
				global $query_string;
				query_posts( $query_string . '&orderby=title&order=ASC' );
			endif;
			
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
				
	<?php endif; 
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ ?>
			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
			
					<?php get_sidebar(); ?>



			</div>


		</div> <!-- // Grid -->

	</div>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>