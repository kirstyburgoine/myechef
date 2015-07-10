<?php
/* 
 * Custom post type archive for Recipes
 */

$c = $_GET['c'];
$g = $_GET['g'];
$n = $_GET['n'];




if ( $c || $g || $n ) { load_template ( TEMPLATEPATH . '/search-recipe.php' ); }

else {

get_header(); ?>

	<div class="container pt">

		<div class="grid">

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php
			if ( have_posts() ) : ?>


				<h1>Search Results</h1>

				<p>Your search for <?php if ($c) : echo "<i>" . $c . "</i>,"; endif;?> <?php if ($g) : echo "<i>" . $g . "</i>,"; endif;?> <?php if ($n) : echo "<i>" . $n . "</i>,"; endif;?> returned <?php echo $wp_query->found_posts; ?> result(s).</p>



				<?php
					
						get_template_part( 'content', 'recipe' );
					

					

				else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

				endif; wp_reset_query(); 
	


			
				?>
			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
			
					<?php get_sidebar(); ?>



			</div>


		</div> <!-- // Grid -->

	</div>


<?php get_footer(); ?>

<?php } ?>