<?php
/* 
 * Custom post type archive for Suppliers. Contacts is basically the same code
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
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>

		<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php 
			//------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------
			// Featured Suppliers

			query_posts( $query_string . '&meta_key=featured_supplier&meta_value=Yes' ); 

			if ( have_posts() ) :  

				// Get the IDs of featured so we can exclude them in second loop below
				$ids = array(); ?>

				<h1 class="archive-title">Featured Suppliers</h1>
				
				<?php
				while ( have_posts() ) : the_post(); 
				$ids[] = get_the_ID(); 

						get_template_part( 'content', 'supplier-archive' );
				
				endwhile; 

			endif; wp_reset_postdata(); 
			
			//------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------
			// Standard Suppliers

			global $post;
			global $wp_query;
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
				$main_args = array_merge(

			    	$wp_query->query_vars,
				    array(
				        'post__not_in' => $ids,
				        'meta_key' => 'featured_supplier',
				        'meta_value' => 'Yes',
				        'meta_compare' => '!=',
						'orderby' => 'title',
						'order' => 'ASC'
				    )
				);
			
				query_posts( $main_args );
				if ( have_posts() ) :  ?>

				

					<h1 class="archive-title">All Suppliers</h1>

					<?php
					while ( have_posts() ) : the_post();
				
						// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'supplier-archive' );

					endwhile; 
					if ( function_exists ( 'tw_pagination' ) ) : tw_pagination(); endif;
					next_posts_link();

				endif; wp_reset_postdata(); ?>

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
			//------------------------------------------------------------------------------------------------
			// Featured Suppliers

			query_posts( $query_string . '&meta_key=featured_supplier&meta_value=Yes' ); 

			if ( have_posts() ) :  

				// Get the IDs of featured so we can exclude them in second loop below
				$ids = array(); ?>

				<h1 class="archive-title">Featured Suppliers</h1>
				
				<?php
				while ( have_posts() ) : the_post(); 
				$ids[] = get_the_ID(); 

						get_template_part( 'content', 'supplier-archive' );
				
				endwhile; 

			endif; wp_reset_postdata(); 
			
			//------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------
			// Standard Suppliers

			global $post;
			global $wp_query;
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
				$main_args = array_merge(

			    	$wp_query->query_vars,
				    array(
				        'post__not_in' => $ids,
				        'meta_key' => 'featured_supplier',
				        'meta_value' => 'Yes',
				        'meta_compare' => '!=',
						'orderby' => 'title',
						'order' => 'ASC'
				    )
				);
			
				query_posts( $main_args );
				if ( have_posts() ) :  ?>

				

					<h1 class="archive-title">All Suppliers</h1>

					<?php
					while ( have_posts() ) : the_post();
				
						// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'supplier-archive' );

					endwhile; 
					if ( function_exists ( 'tw_pagination' ) ) : tw_pagination(); endif;
					next_posts_link();

				endif; wp_reset_postdata(); ?>

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