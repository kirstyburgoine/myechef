<article class="post type-recipe">

	<div class="grid">

		<div class="grid__item palm-one-whole lap-one-third one-quarter">

		<?php 
		// changed so that custom size and clas scan be added
		if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('recipe-thumb', array('class' => 'recipe--img'));
		endif; ?>

		</div><!--

		--><div class="grid__item palm-one-whole lap-two-thirds three-quarters">

			<header class="recipe-title">

			<?php $nationality = get_the_terms(get_the_ID(), 'nationality_category'); 
			if ( ! empty($nationality) ) : 

				$nationality = current($nationality);
				$nationality_flag = get_field('flag', $nationality);
				?>

				<img src="<?php echo $nationality_flag['sizes']['flag']; ?>" alt="<?php echo $nationality->name;?>" class="img--right flag mb" />

			<?php endif; ?>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php /*if ( get_field('allergens') ) : ?>

						<p><strong>Allergens: </strong><?php echo implode(', ', get_field('allergens')); ?></p>

				<?php endif; */?>

				<?php 
							// Loop through the ingredients repeater field
							if ( get_field('ingredients') ) : 

								// create a new array for use later
								$allergens_array = array();

								while ( has_sub_field('ingredients') ) :
									
									// Get the ingredients relationship field
									$ingredients_list = get_sub_field('ingredients');
										
										//loop through each ingredient to find the allergens field
										$option_count = 0; 
										foreach ( $ingredients_list as $ingredient ) : 

											$allergens = get_field('allergens', $ingredient->ID); 

											// The allergens are stored in an array because they are a checkbox field
											foreach ( $allergens as $a ) :			

												// Loop through the allergens array and oush to the new array, 
												// checking to make sure the same allergen is not already in the array
												if(!in_array($a, $allergens_array, true)){
											        array_push($allergens_array, $a);
											    }

											endforeach; 

										endforeach; 
										wp_reset_postdata(); 

								endwhile; 

								//This is the bit where we print the newly created array of allergens outside of the foreach loops ?>
								<p>
									<?php 
									// find the last element
									$lastElement = end($allergens_array);
									sort($allergens_array);

									// loop through the new array
									foreach ( $allergens_array as $aa ) :
										
										// if the last element don't add a comma and space
										if ($aa == $lastElement ) :
											echo $aa.'';
										// else do add a comma and space
										else :
											echo $aa.', ';
										endif; 

									endforeach; ?>
								</p>
							<?php	
							//endif; ?>

							

						
					<?php  endif; ?>

			</header>

			<?php /* if ( $small_description = get_field('small_description') ) : ?>
				<div class="excerpt">
					<p><?php echo $small_description; ?></p>
				</div>
			<?php endif; */ ?>

		<div class="seperator"></div>
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

		<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>

	</div>

</div>

<div class="seperator"></div>
</article>