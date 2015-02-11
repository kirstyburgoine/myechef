<?php 
while ( have_posts() ) : the_post();

?>

<article class="post type-recipe">


		<?php 
			/*
			// changed so that custom size and clas scan be added
			if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
			endif; 
			*/
		 ?>
		

	
		<header class="recipe-title">

			<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>
		

			<h2>
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>

			
		
		</header>

		<?php if ( $small_description = get_field('small_description') ) : ?>
			<div class="excerpt">
				<p><?php echo $small_description; ?></p>
			</div>
		<?php endif; ?>



<div class="seperator"></div>
</article>


<?php endwhile; ?>

<?php if(function_exists('tw_pagination')) tw_pagination(); ?>