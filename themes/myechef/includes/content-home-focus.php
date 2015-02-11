<?php 
$bg_image = get_field('background_banner_image', 'option');

$recipe_text = get_field('recipes_intro_text', 'option'); 
$home_intro = get_field('intro_text');
?>



	<div class="features home-features" style="background-image: url('<?php echo $bg_image['sizes']['bg-banner']; ?>');">
	<div class="bg-color">


		<?php get_template_part('includes/content', 'header-content'); ?>

		<div class="pt">


			<div class="container">

				<div class="home-intro">

					<h1><?php the_title(); ?></h1>
					<p><?php echo $home_intro; ?></p>

				</div>

			</div>



			<?php
			$carousel = get_field('carousel_content'); 
			$carousel_title = get_field('carousel_title'); 

			if( $carousel ): ?>
			<div class="flexslider">

				<h2><?php echo $carousel_title; ?></h2>


						<ul class="slides">

						<?php	
						foreach( $carousel as $post): // variable must be called $post (IMPORTANT) 
							setup_postdata($post); 

							//Returns Array of Term Names for "course_category"
							$term_list = wp_get_post_terms($post->ID, 'course_category', array("fields" => "names"));
							//print_r($term_list); ?>

							<li class="featured-recipe">

								<a href="<?php the_permalink(); ?>">
									<?php 
									if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
										the_post_thumbnail('featured-recipe-thumb');
									endif; ?>

									<div class="recipe-meta">
										<span class="ss-icon ss-standard favorite-icon">favorite</span>
										
									</div>

									<div class="recipe-title">
										
										<span class="perfect">Perfect for: <?php if ( $term_list[1] ) : echo $term_list[0] .', ' .$term_list[1]; else : echo $term_list[0]; endif; ?></span>
										
										<h4><?php the_title(); ?> <span class="ss-icon ss-standard alignright arrowright">directright</span></h4>

									</div>	
								</a>

							
							</li>

						<?php 
							
						endforeach;
						wp_reset_postdata();  ?>

						</ul>

					</div>
					<?php
					endif;  ?>

		</div>

	</div>
	</div>