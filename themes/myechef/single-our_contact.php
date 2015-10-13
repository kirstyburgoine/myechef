<?php // single-recipes.php 

get_header(); 


if ( have_posts() ) : the_post(); 

$banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif;
?>


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


				<article class="type-recipe post">

					
					<header class="recipe-title">
						<h1><?php the_title(); ?></h1>
					</header>			

					<?php if ( $small_description = get_field('small_description') ) : ?>
						<p><?php echo $small_description; ?></p>
					<?php endif; ?>


					<?php 
					// changed so that custom size and clas scan be added
					if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
					endif; ?>

					

					<hr>

					

				<div class="entry-content">
					<?php the_content(); ?>
				</div>


				
				<footer class="additional pt">

					<?php get_template_part('includes/content', 'print-footer'); ?>
				
				</footer>
				
					
					
			</article>

	<?php endif; 
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ ?>

			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
				
				<?php get_sidebar(); ?>


			</div>

		</div> <!-- // Grid -->

	</div>

	<div class="share">
	
		<div class="container">
		</div>	

	</div>

<?php endif; ?>

<?php get_footer(); ?>