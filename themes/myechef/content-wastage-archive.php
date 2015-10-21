<article class="post type-recipe">

	<header class="recipe-title">

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	</header>

	<?php  
	if ( $small_description = get_field('small_description') ) : ?>
		<div class="excerpt">
			<p><?php echo $small_description; ?></p>
		</div>
	<?php 
	endif;  ?>

	<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>

<div class="seperator"></div>
</article>