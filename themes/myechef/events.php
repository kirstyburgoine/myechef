<?php
/**
 * Template Name: Events
 *
 */

get_header(); 

if ( have_posts() ) : the_post();  ?>


<div class="container pt">

	<div class="grid">


		<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php the_content(); ?>

		</div><!--

		--><div class="grid__item palm-one-whole lap-one-whole one-quarter">

				<?php get_sidebar(); ?>

		</div>


	</div> <!-- // Grid -->

</div>

<?php endif; ?>

<?php get_footer(); ?>