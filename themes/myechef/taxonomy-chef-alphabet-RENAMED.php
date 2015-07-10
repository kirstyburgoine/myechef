<?php
/* 
 * TAxonmoy archives for alphabet in Chef-e-Pedia section so that they van be filter by alphabet
 * NOTE: Is this used still?
 * Changed name from taxonomy-chef-alphabet.php to test
 */

$order = $_GET['order'];

get_header(); ?>

	<div class="container pt">

		<div class="grid">

		<?php
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		global $blog_id;
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php
			
			global $query_string;
			query_posts( $query_string . '&posts_per_page=20' );

			
			if ( $order == "alphabet" ) :
				global $query_string;
				query_posts( $query_string . '&posts_per_page=20&orderby=name&order=ASC' );
			endif;
			
			
			if ( have_posts() ) : ?>

				

				<form method="get" action="" name="sort" class="sort">

					<label for="order">Sort articles by:</label>

					<select id="order" name="order">
        				<option name="latest" value="latest">Latest Added</option>
        				<option name="alphabet" value="alphabet" <?php if ( $order == "alphabet" ) :?>selected<?php endif; ?>>A to Z</option>
        			</select>

        			<input type="submit" class="searchme ss-icon" name="submit" id="sortbtn" value="down" />

		

        		</form>

				<h1 class="archive-title"><?php single_cat_title(); ?></h1>



				<?php
					// Start the Loop inside the include so post counts work.
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
		endif; ?>

		</div> <!-- // Grid -->

	</div>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>