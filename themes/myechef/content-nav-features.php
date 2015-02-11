<?php 
$bg_image = get_field('background_banner_image', 'option');
$recipe_text = get_field('recipes_intro_text', 'option'); 

$feature_description = get_field('feature_area_description');?>





	<div class="features <?php if ( is_home() || is_page('34') ) : ?>home-features<?php endif;?>" style="background-image: url('<?php echo $bg_image['sizes']['bg-banner']; ?>');">

		<div class="container pt">

			<div class="grid">

				<?php 
				//----------------------------------------------------------------------------------------------------
				//----------------------------------------------------------------------------------------------------
				if ( is_home() || is_page('34') ) : ?>

				

					<?php
					$carousel = get_field('carousel_content', 'option'); 

					if( $carousel ): ?>
					<div class="home-flexslider">

						<ul class="slides">

						<?php	
						foreach( $carousel as $post): // variable must be called $post (IMPORTANT) 
							setup_postdata($post); ?>

							<li>

								<div class="grid">

									<div class="grid__item one-half">

										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

										<?php if ( $small_description = get_field('small_description') ) : ?>
											<p><?php echo $small_description; ?></p>
										<?php endif; ?>

										<a href="<?php the_permalink(); ?>" class="btn alignleft">Full Details <span class="ss-directright"></span></a>
	
									

									</div><!--

									--><div class="grid__item one-half">	


										<?php 
										if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
											the_post_thumbnail('featured-recipe');
										endif; ?>

											
									</div>

								</div>
							
							</li>

						<?php 
							
						endforeach;
						wp_reset_postdata();  ?>

						</ul>

					</div>
					<?php
					endif;  ?>



				<?php 
				//----------------------------------------------------------------------------------------------------
				//----------------------------------------------------------------------------------------------------
				else : ?>

				<div class="grid__item three-quarters">

					<?php 
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					if ( is_post_type_archive( $post_types ) || 'recipe' == get_post_type() ) : ?>

						<h1>Recipes Index</h1>
						<p><?php echo $recipe_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// if not the custom post type archive use the settings for that page.
					// -------------------------------------------------------------------
					else : ?>

						<h1><?php the_title();?></h1>
						<p><?php echo  $feature_description; ?></p>

					<?php
					endif; 
					// -------------------------------------------------------------------
					// Search recipes archive text.
					// -------------------------------------------------------------------
					?>
					<hr>

						<h2>Search for Recipes</h2>

						<?php get_search_form(); ?>

				</div><!--

				--><div class="grid__item one-quarter">

					<?php
					$featured_posts = get_field('featured_recipes', 'option'); 

					if( $featured_posts ): ?>
					<div class="flexslider">

						<ul class="slides">

						<?php	
						foreach( $featured_posts as $post): // variable must be called $post (IMPORTANT) 
							setup_postdata($post); 

							//Returns Array of Term Names for "course_category"
							$term_list = wp_get_post_terms($post->ID, 'course_category', array("fields" => "names"));
							//print_r($term_list);
							?>

							<li class="featured-recipe">

								<a href="<?php the_permalink(); ?>">
									<?php 
									if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
										the_post_thumbnail('featured-recipe-thumb');
									endif; ?>

									<div class="recipe-meta">
										<span class="ss-icon ss-standard favorite-icon">love</span>
										<span class="favorite"><?php echo $term_list[0]; ?></span>
									</div>

									<div class="recipe-title">
										<span class="ss-icon ss-standard alignright">directright</span>
										<h4><?php the_title(); ?></h4>
									</div>	
								</a>

							</li>

						<?php 
							
						endforeach; 

						wp_reset_postdata();?>

						</ul>

					</div>
					<?php
					endif;  ?>

				</div>

			<?php 
			//----------------------------------------------------------------------------------------------------
			//----------------------------------------------------------------------------------------------------
			endif; ?>

			</div>

		</div>

	</div>


	

<?php //endif; wp_reset_query(); ?>