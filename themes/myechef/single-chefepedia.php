<?php 
/* 
 * Single page for each Chef-e-Pedia post
 * 
 */

get_header(); 

$protected = get_field('protected', 'option');  
global $blog_id;

$banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif;
?>

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
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : 
			?>

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php if ( have_posts() ) : the_post();  ?>

				<article class="type-recipe post">

					<?php get_template_part('content', 'chefepedia-single'); ?>

				</article>

			<?php endif; ?>

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

			<?php if ( have_posts() ) : the_post();  ?>
				<article class="type-recipe post">

					<?php get_template_part('content', 'chefepedia-single'); ?>

				</article>

			<?php endif; ?>

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