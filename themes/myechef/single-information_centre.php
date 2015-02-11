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

					<div class="utility ptrbl">
						<ul class="utility-icons">
							<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
						</ul>
					</div>	
					
					<header class="single-title">
						<h2><?php the_title(); ?></h2>
					</header>			

					<?php if ( $small_description = get_field('small_description') ) : ?>
						<p><?php echo $small_description; ?></p>
					<?php endif; ?>

					<hr>


					<div class="entry-content">
						<?php the_content(); ?>
					</div>


					
					<footer class="additional pt">

						<h3>Did you find this article useful?</h3>
						<?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>
						<br />


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
	


	</div>

<?php endif; ?>

<?php get_footer(); ?>