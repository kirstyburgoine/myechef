<?php 
$bg_image = get_field('background_banner_image', 'option');

$recipe_text = get_field('recipes_intro_text', 'option'); 
$ingredient_text = get_field('ingredient_intro_text', 'option'); 
$wastage_text = get_field('wastage_intro_text', 'option'); 
$events_text = get_field('events_intro_text', 'option'); 
$suppliers_text = get_field('suppliers_intro_text', 'option'); 
$contacts_text = get_field('contacts_intro_text', 'option'); 
$chefepedia_text = get_field('chef-e-pedia_intro_text', 'option'); 
$information_centre_text = get_field('information_centre_intro_text', 'option'); 
$chefs_menu_text = get_field('chefs_menus_intro_text', 'option'); 
$feature_description = get_field('feature_area_description');
?>

	

	<div class="features page-features" style="background-image: url('<?php echo $bg_image['sizes']['bg-banner']; ?>');">
	<div class="bg-color">

		<?php get_template_part('includes/content', 'header-content'); ?>

		<div class="container pt">

			<div class="grid">

				<div class="grid__item one-whole lap-two-thirds desk-three-quarters">

					<?php echo '<!-- ' . basename( get_page_template() ) . ' -->'; ?>

					<?php 
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					if ( is_page_template('events.php') || is_post_type_archive( 'tribe_events' ) || 'tribe_events' == get_post_type()) : ?>

						<h1>Events Calendar</h1>
						<p><?php echo $events_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'recipe' ) || 'recipe' == get_post_type() || is_page_template('search-recipe.php')  ) : ?>

						<h1>Recipes Index</h1>
						<p><?php echo $recipe_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'ingredient' ) || 'ingredient' == get_post_type() || is_page_template('search-ingredient.php')  ) : ?>

						<h1>Ingredients Stock</h1>
						<p><?php echo $ingredient_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'wastage' ) || 'wastage' == get_post_type() || is_page_template('search-wastage.php')  ) : ?>

						<h1>Additional Food Costs</h1>
						<p><?php echo $wastage_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'supplier' ) || 'supplier' == get_post_type() || is_page_template('search-supplier.php') ) : ?>

						<h1>Suppliers Directory</h1>
						<p><?php echo $suppliers_text;?></p>
					
					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'our_contact' ) || 'our_contact' == get_post_type() || is_page_template('search-our_contact.php') ) : ?>

						<h1>Contacts Directory</h1>
						<p><?php echo $contacts_text;?></p>
					
					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'information_centre' ) || 'information_centre' == get_post_type() ) : ?>

						<h1>Information Centre</h1>
						<p><?php echo $information_centre_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'chefepedia' ) || 'chefepedia' == get_post_type() ) : ?>

						<h1>Chef-E-Pedia</h1>
						<p><?php echo $chefepedia_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If a custom post type archive use the settings from options.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'chefs_menu' ) || 'chefs_menu' == get_post_type() || is_page_template('search-chefs_menu.php') ) :  ?>

						<h1>Menus</h1>
						<p><?php echo $chefs_menu_text;?></p>

					<?php
					// -------------------------------------------------------------------
					// If the blog section
					// -------------------------------------------------------------------
					elseif ( is_archive() ) :  ?>
						
						<h1>

							<?php 
							if ( is_category() ) :
								single_cat_title(); ?>
		
							<?php elseif ( is_tag() ) : ?>
								Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
	                    
	                    
							<?php elseif ( is_day() ) : ?>
								<?php printf( __( 'Daily Archives: %s', 'parentheme' ), '<span>' . get_the_date() . '</span>' ); ?>
							
							<?php elseif ( is_month() ) : ?>
								<?php printf( __( 'Monthly Archives: %s', 'parentheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'parentheme' ) ) . '</span>' ); ?>
							
							<?php elseif ( is_year() ) : ?>
								<?php printf( __( 'Yearly Archives: %s', 'parentheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'parentheme' ) ) . '</span>' ); ?>
							
							<?php else : ?>
								<?php _e( 'Blog Archives', 'parentheme' ); ?>
							<?php endif; ?>

						</h1>

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
					// Ends archive text options.
					// -------------------------------------------------------------------
					?>
					<hr>

					<?php 
					// -------------------------------------------------------------------
					// If in events section show custom taxonomy as buttons filter events.
					// -------------------------------------------------------------------
					/* if ( is_page_template('events.php') || 'tribe_events' == get_post_type()) : ?>

						<h3>Search for events by category</h3>

						<ul class="nav nav--block menu-events">
						<?php	
						$terms = get_terms('tribe_events_cat');
						//var_dump($terms);
						if ( !empty($terms) ) :

							foreach ( $terms as $term ) : ?>
								<li><a href="<?php bloginfo('url');?>/events/category/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php 	
							endforeach;

						endif;
						?>
						</ul>

					<?php 
					// -------------------------------------------------------------------
					// Else If in supplier section show custom search form with 3 
					// taxomomies as drop downs.
					// -------------------------------------------------------------------
					else */

					if ( is_post_type_archive( 'supplier' ) || 'supplier' == get_post_type() || is_page_template('search-supplier.php') ) : ?>

						<h3>Search for Suppliers by</h3>

						<?php
						get_template_part('includes/content', 'supplier-searchform');

					// -------------------------------------------------------------------
					// Else If in contacts section show custom search form with 3 
					// taxomomies as drop downs.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'our_contact' ) || 'our_contact' == get_post_type() || is_page_template('search-our_contact.php') ) : ?>

						<h3>Search for Contacts by</h3>

						<?php
						get_template_part('includes/content', 'contact-searchform');

					// -------------------------------------------------------------------
					// Else If in chefepedia section show custom A-Z taxonomy and free 
					// search box
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'chefepedia' ) || 'chefepedia' == get_post_type() || is_tax ('alphabet') ) : 

						$terms = get_terms('alphabet', 'hide_empty=0');
						$count = count($terms);
						
						if ( $count > 0 ) :
							
							echo '<ul class="alphabet-terms">';
						 	
							foreach ( $terms as $term ) :
								?>
						   	
								<li><?php if ( $term->count > 0 ) : ?>
										<a href="<?php bloginfo('url')?>/alphabet/<?php echo $term->slug; ?>" title="<?php echo $term->name; ?>">
									<?php endif; ?>

									<?php echo $term->name; ?>

									<?php if ( $term->count > 0 ) : ?>
										</a>
									<?php endif; ?>
								</li>
							
						 <?php	
						 	endforeach;
						 	
						 	echo "</ul>";
						
						endif; 

					// -------------------------------------------------------------------
					// Else If in chefepedia section show custom A-Z taxonomy and free 
					// search box
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'information_centre' ) || 'information_centre' == get_post_type() || is_tax ('information_centre') ) : 

						$terms = get_terms('alphabet', 'hide_empty=0');
						$count = count($terms);
						
						if ( $count > 0 ) :
							
							echo '<ul class="alphabet-terms">';
						 	
							foreach ( $terms as $term ) :
								?>
						   	
								<li><?php if ( $term->count > 0 ) : ?>
										<a href="<?php bloginfo('url')?>/alphabet/<?php echo $term->slug; ?>" title="<?php echo $term->name; ?>">
									<?php endif; ?>

									<?php echo $term->name; ?>

									<?php if ( $term->count > 0 ) : ?>
										</a>
									<?php endif; ?>
								</li>
							
						 <?php	
						 	endforeach;
						 	
						 	echo "</ul>";
						
						endif; 

					// -------------------------------------------------------------------
					// Else If in Menus section show custom search form with 3 
					// taxomomies as drop downs.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'chefs_menu' ) || 'chefs_menu' == get_post_type() || is_page_template('search-chefs_menu.php') ) : ?>

						<h3>Search for Menus by</h3>

						<?php
						get_template_part('includes/content', 'menu-searchform');

					// -------------------------------------------------------------------
					// Else If in Ingredients / Stock Take section show custom search form with 2-3 
					// taxomomies as drop downs.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'ingredient' ) || 'ingredient' == get_post_type() || is_page_template('search-ingredient.php') ) : ?>

						<h3>Provide Stock level reports for</h3>

						<?php
						get_template_part('includes/content', 'ingredient-searchform');

					// -------------------------------------------------------------------
					// Else If in Wastage section show custom search form with 3 
					// taxomomies as drop downs.
					// -------------------------------------------------------------------
					elseif ( is_post_type_archive( 'wastage' ) || 'wastage' == get_post_type() || is_page_template('search-wastage.php') ) : ?>

						<h3>Search for Additional Costs reports by</h3>

						<?php
						get_template_part('includes/content', 'wastage-searchform');

					// -------------------------------------------------------------------
					// Else show the recipes search as default.
					// -------------------------------------------------------------------
					else : ?>


						<h3>Search for Recipes by</h3>

						<?php get_search_form(); ?>

					<?php endif; ?>


		

				</div><!--

				--><div class="grid__item one-whole lap-one-third desk-one-quarter">

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

						wp_reset_postdata();?>

						</ul>

					</div>
					<?php
					endif;  ?>

				</div>



			</div>

		</div>

	</div>
	</div>