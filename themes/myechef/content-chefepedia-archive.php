<?php 
while ( have_posts() ) : the_post(); ?>

<article class="post type-recipe type-chefepedia">

	<header class="recipe-title">		
		
		<h2>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>	
		
	</header>

	<?php //if ( $small_description = get_field('small_description') ) : 
		$small_description = get_field('small_description'); ?>

		<div class="excerpt">
			<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>
			<p><?php echo $small_description; ?></p>
		</div>
	<?php //endif; ?>


<div class="seperator"></div>
</article>

<?php 
endwhile; ?>

<?php if(function_exists('tw_pagination')) tw_pagination(); ?>