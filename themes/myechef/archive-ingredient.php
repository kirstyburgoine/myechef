<?php
/* 
 * Custom post type archive for Recipes
 */

if ( isset( $_GET['all'] ) ) :
	$order = $_GET['all'];
endif;

global $blog_id;

// echo $order;

get_header(); ?>

	<div class="container pt">

		<div class="grid">

		<?php
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">



			<?php
			global $query_string;

			if ( $order == "yes" ) :
				query_posts( $query_string . '&posts_per_page=-1&orderby=title&order=ASC' );
			
			else :
			// Order ingredients alphabetically 
			query_posts( $query_string . '&posts_per_page=30&orderby=title&order=ASC' );

			endif;
			
			if ( have_posts() ) : ?>

			<div class="utility">

				<ul class="utility-icons">
					<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
					<li><a href="" class="ss-icon file" title="Save this report">File</a></li>
				</ul>

				

				<?php 
				while ( have_posts() ) : the_post();
					get_template_part('includes/content', 'all-ingredients'); 
				endwhile; ?>

			</div>

				<h1 class="archive-title">Ingredients</h1>

				<?php
					get_template_part('content', 'includes/ingredient-totals');


					// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'ingredient-archive' );



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
		endif; ?>
		

		</div> <!-- // Grid -->

	</div>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>