<?php
/* 
 * Main archive for blog
 */

$order = $_GET['order'];

get_header(); ?>

	<div class="container pt">

		<div class="grid">

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php
			if ( have_posts() ) : ?>

				<h1 class="archive-title"><?php single_cat_title(); ?></h1>

				<?php
					// Start the Loop inside the include so post counts work.
						get_template_part( 'content', 'blog-archive' );



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


<?php //get_sidebar(); ?>
<?php get_footer(); ?>