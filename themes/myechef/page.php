<?php
/**
 * The main page template file
 *
 */

get_header(); 

if ( have_posts() ) : the_post();  ?>


<div class="container pt">

	<div class="grid">


		<div class="grid__item palm-one-whole lap-one-whole three-quarters">



			<?php /* Commented out because <h1> is used in feature area dn <h2> should be in content rather 
			than confusing the admin with a sub heading custom field that makes the heading usage incosistent 
			for clients
			<h1><?php the_title(); ?></h1> */ ?>

			<?php the_content(); ?>

			<?php get_template_part('includes/content', 'print-footer'); ?>



		</div><!--

		--><div class="grid__item palm-one-whole lap-one-whole one-quarter">

				<?php get_sidebar(); ?>

		</div>


	</div> <!-- // Grid -->

</div>

<?php endif; ?>

<?php get_footer(); ?>