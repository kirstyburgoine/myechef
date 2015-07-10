<?php 
// Should be the same as content-recipe-archive.php
//while ( have_posts() ) : the_post();

?>

<article class="post type-recipe">


		<?php 
		// changed so that custom size and clas scan be added
		if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
		endif; ?>

		



		
		

	
		<header class="recipe-title">

			<?php $nationality = get_the_terms(get_the_ID(), 'nationality_category'); 
			if ( ! empty($nationality) ) : 

				$nationality = current($nationality);
				$nationality_flag = get_field('flag', $nationality);
				?>

				<img src="<?php echo $nationality_flag['sizes']['flag']; ?>" alt="<?php echo $nationality->name;?>" class="img--right flag mb" />

			<?php endif; ?>

		
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>

		<?php if ( $small_description = get_field('small_description') ) : ?>
			<div class="excerpt">
				<p><?php echo $small_description; ?></p>
			</div>
		<?php endif; ?>
		

		<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>


		
		<?php

		$skill_levels = array(
			0 => '-13px -16px',
			1 => '-13px -53px',
			2 => '-13px -91px',
			3 => '-13px -128px',
			4 => '-13px -165px',
			5 => '-13px -201px'
		);

		$skill_level = get_field('skill_level') ? get_field('skill_level') : 0;
		$skill_level_css = $skill_levels[$skill_level];

		$terms = get_the_terms( $post->ID , 'course_category' );
								
		$numItems = count($terms);
		$t = 0;

		?>

		<ul class="recipe-meta">
			<li><strong>Skill:</strong> <span class="rating" style="background-position: <?php echo $skill_level_css; ?>"><?php echo $skill_level; ?> Eggs</span></li> 

			<?php if ( $preperation_time = get_field('preparation_time') ) : ?>
			<li><strong>Preparation Time:</strong> <?php echo $preperation_time; ?></li> <!-- Custom field - text field -->
			<?php endif; ?>

			<?php if ( $cooking_time = get_field('cooking_time') ) : ?>
			<li><strong>Service Time:</strong> <?php echo $cooking_time; ?></li> <!-- Custom field - text field -->
			<?php endif; ?>

			<?php if ( $terms ) : ?>
			<li><strong>Perfect For:</strong> 
				<?php 	foreach ( $terms as $term ) :
							if( ++$t === $numItems ) :
								echo $term->name;
							else :
								echo $term->name . ', ';
							endif;
						endforeach; ?>
			</li>
			<?php endif; ?>
		</ul>




<div class="seperator"></div>
</article>


<?php //endwhile; ?>

<?php //if(function_exists('tw_pagination')) tw_pagination(); ?>