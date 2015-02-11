<?php
/* 
 * Custom post type archive for Contacts
 */

$order = $_GET['order'];

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
			query_posts( $query_string . '&meta_key=featured_contact&meta_value=Yes' ); 

			if ( have_posts() ) :  

			$ids = array(); ?>

				<h1 class="archive-title">Featured Contacts</h1>
				
				<?php
				while ( have_posts() ) : the_post(); 
				$ids[] = get_the_ID(); 

						get_template_part( 'content', 'contacts-archive' );
				
				endwhile; 

			endif; wp_reset_postdata(); 
			
			//------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------
			
			global $post;
			global $wp_query;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


	
				$main_args = array_merge(

			    	$wp_query->query_vars,
			    
				    array(
				        'post__not_in' => $ids,
				        'meta_key' => 'featured_contact',
				        'meta_value' => 'Yes',
				        'meta_compare' => '!=',
						'orderby' => 'title',
						'order' => 'ASC'
				    )
				);


		
			
			query_posts( $main_args );
			if ( have_posts() ) :  

				//get_template_part('includes/content', 'order-results'); 
			?>

				

				<h1 class="archive-title">All Contacts</h1>



				<?php
				while ( have_posts() ) : the_post();
				

					// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'supplier-archive' );

						

				endwhile; 
				if ( function_exists ( 'tw_pagination' ) ) : tw_pagination(); endif;
				next_posts_link();

			endif; wp_reset_postdata();


				
		

			
	endif;			
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	?>
	
			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
			
					<?php get_sidebar(); ?>



			</div>


		</div> <!-- // Grid -->

	</div>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>