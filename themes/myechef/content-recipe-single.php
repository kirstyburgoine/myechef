<?php
/*
 * Main content from the single recipe as it needs to be repated if not protected
 */
// Find the current user level
global $userdata; // Use global
get_currentuserinfo(); // Make sure global is set, if not set it.

$protected = get_field('protected', 'option');  
global $blog_id;
?>	

				<article class="type-recipe post">

					<div class="utility">

						<?php 
						// ---------------------------------------------------------------------
						// Nationality Flag
						$nationality = get_the_terms(get_the_ID(), 'nationality_category'); 

						if ( ! empty($nationality) ) : 

							$nationality = current($nationality);
							$nationality_flag = get_field('flag', $nationality);
							
						endif; ?>
						
						<ul class="utility-icons">
							<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
							<li>
								<?php /* <a href="<?php bloginfo('url');?>/nationality_category/<?php echo $nationality->slug; ?>" title="View all <?php echo $nationality->name; ?> dishes"> */ ?>
									<img src="<?php echo $nationality_flag['sizes']['flag']; ?>" alt="" class="alignright flag" />
								<?php /* </a> */ ?>
							</li>
						</ul>

						<h4>Save Recipe:</h4>
						<?php 
							global $wpb;
							echo $wpb->bookmark(); ?>

					</div>



					<header class="single-title">
						<h2><?php the_title(); ?></h2>
					</header>			


					<?php 
					// changed so that custom size and clas scan be added
					if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
					endif; ?>


					<?php if ( $small_description = get_field('small_description') ) : ?>
						<p><?php echo $small_description; ?></p>
					<?php endif; ?>


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
						<!-- Custom field - one to five option show eggs instead of numbers. Background position based on rating -->
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

					<hr>


					<?php 
					//------------------------------------------------------------------------------------------------
					//------------------------------------------------------------------------------------------------
					//else : ?>
					<h2>Ingredients</h2>

					<?php 
					$portion_quantity = get_field('portion_quantity') ? get_field('portion_quantity') : 1; 
					$portion_quantity_text = get_field('portion_quantity_text') ? get_field('portion_quantity_text') : "portion"; 
					?>
				
					<p>This recipe makes <input type="text" name="serving-quantity" value="<?php echo $portion_quantity; ?>" data-original-value="<?php echo $portion_quantity; ?>" class="portion-input" /> <?php echo $portion_quantity_text; ?>.</p>
					

					<!-- This is the main calculator bit -->
					<form action="" class="cost-calculator color-<?php echo strtolower($banner_color); ?>">
				
						<?php $serving_cost = 0.00; ?>

						<table class="ingredient-calculator">

							<thead>

								<tr>
									<th class="ingredient">Shopping List</th>
									<th class="quantity">Quantity</th>
									<th class="cost">Cost</th>
									<th class="checkbox"></th>
								</tr>

							</thead>

							<tbody>

								<?php if ( get_field('ingredients') ) : ?>

									<?php while ( has_sub_field('ingredients') ) : ?>

										<?php

											$ingredients_list = get_sub_field('ingredients');
											$quantity = get_sub_field('quantity');
											
										?>

										<tr>
										 	
											<?php if ( count($ingredients_list) > 1 ) : ?>



												<td data-quantity="<?php echo $quantity; ?>">

													<select class="js-related-ingredients">

														<?php $option_count = 0; ?>
													
														<?php foreach ( $ingredients_list as $ingredient ) : ?>

															<?php 
															$base_unit = get_field('base_unit', $ingredient->ID);
															$quantity = get_sub_field('quantity'); ?>

															<option data-cost="<?php echo get_ingredient_new_cost($ingredient->ID); ?>" data-base-unit="<?php echo $base_unit; ?>" data-cost="<?php echo $cost; ?>">Option <?php echo ++$option_count; ?>: <?php echo get_the_title($ingredient->ID); ?></option>
														
														<?php endforeach; 
														wp_reset_postdata(); ?>

													</select>

												</td>

											<?php else : ?>

												<?php 

													$ingredient = current($ingredients_list);
													$cost = get_ingredient_new_cost($ingredient->ID);
													$base_unit = get_field('base_unit', $ingredient->ID);

												?>

												<td data-quantity="<?php echo $quantity; ?>" data-base-unit="<?php echo $base_unit; ?>" data-cost="<?php echo $cost; ?>"><?php echo get_the_title($ingredient->ID); ?></td>
											
											<?php endif; ?>

											<td class="quantity"></td>
											<td>
												<?php  // Only show costs if logged in and level is above subscriber
												// First check if the site should be protected
												if ( $protected == 'Yes') :
													//------------------------------------------------------------------------------------------------
													//------------------------------------------------------------------------------------------------
													// If so, check if someone is logged in and they have permissions for this blog
													if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) :  ?>
														&pound;<span class="price"></span>
													<?php 
													endif; 

												else : ?>
														&pound;<span class="price"></span>
												<?php
												endif; ?>
											</td>

											<td><input type="checkbox" name="done" value="Yes"></td>
										</tr>

									<?php endwhile; ?>

								<?php endif; ?>

							</tbody>

							<tfoot>

								<?php if ( $seasoning = get_field('seasoning') ) : ?>

									<tr>
										<td><?php echo $seasoning; ?></td>
										
										<td></td>
										<td></td>
										<td></td>
									</tr>

								<?php endif; ?>

							</tfoot>

						</table>

						<?php 
						// --------------------------------------------------------------------------------------
						// --------------------------------------------------------------------------------------
						// Start new section for sub recipes
						// The totals for just the ingredients is included within this if statement because if 
						// there is no sub recipe we want the standard totals table only that is underneath the sub recipes
						if ( get_field ( 'sub_recipes' ) ) : ?>

						<div class="grid">

							<div class="grid__item palm-one-whole one-quarter">

								<?php 
								/*
								 * Hide bulk quatities for a later date 
								<p class="split">
									<span class="split__title">Need a cost for bulk quantities?<br>
									Bulk Servings: </span>

									<span><input type="text" name="serving-quantity" class="small-input" value="1"></span>
								</p>
								*/ ?>

							</div><!--

						--><div class="grid__item palm-one-whole three-quarters">


							<?php  // Only show ingredient totals if logged in and level is above subscriber
							// First check if the site should be protected
							if ( $protected == 'Yes') :
								//------------------------------------------------------------------------------------------------
								//------------------------------------------------------------------------------------------------
								// If so, check if someone is logged in and they have permissions for this blog
								if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>
			
							<table class="calculations">

								<tr>
									<th class="labels">Ingredients cost for <span class="js-portion-quantity"><?php echo $portion_quantity; ?></span> <?php echo ucfirst($portion_quantity_text);?>(s)</th>
									<td class="inputs"></td>
									<td class="calculations">&pound;<span class="js-ingredient-cost-per-serving"></span></td>
									<td class="checkbox-blank"> </td>
								</tr>

								<tr>
									<th class="labels">Ingredients Cost Per Single Portion</th>
									<td class="inputs"></td>
									<td class="calculations">&pound;<span class="js-ingredient-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span>
									</td>
									<td class="checkbox-blank"></td>
								</tr>

							</table>

							<?php endif; 
							endif; ?>

						</div><!-- closes one-half -->

					</div><!-- closes grid -->


					<?php
					// --------------------------------------------------------------------------------------
					// --------------------------------------------------------------------------------------
					// Start list of sub recipes as repeater field
					?>

					<h2>Required Sub Recipes</h2>

					
					<table class="sub-recipe-calculator">
							
					<?php 
					while ( has_sub_field ( 'sub_recipes' ) )  :

						//echo "text";
						$sub_recipe = get_sub_field('sub_recipe');
						$sub_quantity = get_sub_field('quantity');

						//print_r($sub_recipe);

						//if( $sub_recipe ) :

						
						// $base_quantity_unit = get_field('recipe_quantity_unit', $s->ID);
						// $sub_recipe_cost = get_sub_recipe_cost($s->ID, $sub_quantity);

					?>

					<tr>
							
						<?php if ( count($sub_recipe) > 1 ) : ?>

							<td data-quantity="<?php echo $sub_quantity; ?>" class="ingredients">

								<select class="js-sub-recipe">

									<?php $option_count = 0; ?>
								
									<?php foreach ( $sub_recipe as $recipe ) : ?>

										<?php 
										
											$base_quantity_unit = get_field('recipe_quantity_unit', $recipe->ID);
											$quantity = get_sub_field('quantity');

										?>

										<option data-cost="<?php echo get_sub_recipe_cost($recipe->ID, $quantity); ?>" data-base-unit="<?php echo $base_quantity_unit; ?>" data-cost="<?php echo $cost; ?>">Option <?php echo ++$option_count; ?>: <?php echo get_the_title($recipe->ID); ?></option>
									
									<?php endforeach; 
									wp_reset_postdata(); ?>

								</select>

							</td>

						<?php else : ?>

							<?php 

								$sub_recipe = current($sub_recipe);

								$base_quantity_unit = get_field('recipe_quantity_unit', $sub_recipe->ID);
								$sub_recipe_cost = get_sub_recipe_cost($sub_recipe->ID, $sub_quantity);

							?>

							<td data-quantity="<?php echo $sub_quantity; ?>" data-base-unit="<?php echo $base_quantity_unit; ?>" data-cost="<?php echo $sub_recipe_cost; ?>" class="ingredients"><a href="<?php echo get_permalink($sub_recipe->ID); ?>"><?php echo get_the_title($sub_recipe->ID); ?></a></td>
						
						<?php endif; ?>

						<td class="quantity"></td>
						<td>
							<?php  
							// Only show costs if logged in and level is above subscriber
							// First check if the site should be protected
							if ( $protected == 'Yes') :
								//------------------------------------------------------------------------------------------------
								//------------------------------------------------------------------------------------------------
								// If so, check if someone is logged in and they have permissions for this blog
								if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>
									&pound;<span class="price cost"></span>
								<?php 
								endif; 

							else : ?>
									&pound;<span class="price cost"></span>
							<?php
							endif;?>
						</td>

						<td class="checkbox"><input type="checkbox" name="done" value="Yes"></td>

					</tr>
						
						<?php	

						wp_reset_postdata();
						//endif;

					endwhile; ?>

					</table>
					<?php endif; ?>

					<?php
					// Ends the new sub recipes repeater field
					// --------------------------------------------------------------------------------------
					// --------------------------------------------------------------------------------------
					// Start main totals table for everything on the page
					// this is outside the if sub recipes statement so always on the page and is the default
					?>

						<div class="grid">

							<div class="grid__item palm-one-whole one-quarter">

								<?php 
								/*
								 * Hide bulk quatities for a later date 
								<p class="split">
									<span class="split__title">Need a cost for bulk quantities?<br>
									Bulk Servings: </span>

									<span><input type="text" name="serving-quantity" class="small-input" value="1"></span>
								</p>
								*/ ?>

							</div><!--

						--><div class="grid__item palm-one-whole three-quarters">

							<?php  
							// Only show all totals if logged in and protected or this is the main site

							// First check if the site should be protected
							if ( $protected == 'Yes') :
								//------------------------------------------------------------------------------------------------
								//------------------------------------------------------------------------------------------------
								// If so, check if someone is logged in and they have permissions for this blog
								if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>
			
								<table class="calculations">

									<tr>
										<th>Total Cost for <span class="js-portion-quantity"><?php echo $portion_quantity; ?></span> <?php echo ucfirst($portion_quantity_text);?>(s)</th>
										<td class="inputs"><span class="js-percent-per-serving">30</span>%</td>
										<td class="calculations">&pound;<span class="js-cost-per-serving"></span></td>
										<td class="checkbox-blank"></td>

									</tr>

									<tr>
										<th class="labels">Total Cost Per Single Portion</th>
										<td></td>
										<td class="calculations">&pound;<span class="js-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>
	 
									<tr>
									<?php 
									// -----------------------------------------------------
									// Custom amount of profit required. If not set it defaults to 70
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th>Gross Profit Required</th>
										<td><input type="text" name="profit-amount" class="small-input" value="<?php echo $profit_required; ?>">%</td>
										<td>&pound;<span class="js-gross-profit"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Total Estimated Selling Price</th>
										<td>100%</td>
										<td>&pound;<span class="js-total-selling-price"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Estimated Selling Price Per Single Portion</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-selling-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>
									<?php
									//-----------------------------------------------------
									// Added global VAT amount
				                    $vat_amount = get_field('vat_amount', 'option');
				                    if ( !$vat_amount ) : $vat_amount = '0.2'; endif;

				                    $vat_amount = $vat_amount * 100;
				                    ?>
									<tr>
										<th>Estimated Selling Price including VAT at <?php echo $vat_amount;?>%</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-vat-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>

								</table>


								<table class="calculations">

								<?php
									//-----------------------------------------------------
									// Added global VAT amount
				                    $vat_amount = get_field('vat_amount', 'option');
				                    if ( !$vat_amount ) : $vat_amount = '0.2'; endif;

				                    $vat_amount = $vat_amount * 100;
				                    ?>
									<tr>
										<th>Preferred Selling Price including VAT at <?php echo $vat_amount;?>%</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-vat-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Total Preferred Selling Price before VAT</th>
										<td>100%</td>
										<td>&pound;<span class="js-total-selling-price"></span></td>
										<td></td>

									</tr>


									<tr>
										<th>Preferrerd Price Per Single Portion</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-selling-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Total Cost for <span class="js-portion-quantity"><?php echo $portion_quantity; ?></span> <?php echo ucfirst($portion_quantity_text);?>(s)</th>
										<td class="inputs"><span class="js-percent-per-serving">30</span>%</td>
										<td class="calculations">&pound;<span class="js-cost-per-serving"></span></td>
										<td class="checkbox-blank"></td>

									</tr>

									<tr>
										<th class="labels">Total Cost Per Single Portion</th>
										<td></td>
										<td class="calculations">&pound;<span class="js-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>
	 
									<tr>
									<?php 
									// -----------------------------------------------------
									// Custom amount of profit required. If not set it defaults to 70
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th>Gross Profit Required</th>
										<td><input type="text" name="profit-amount" class="small-input" value="<?php echo $profit_required; ?>">%</td>
										<td>&pound;<span class="js-gross-profit"></span></td>
										<td></td>

									</tr>



									

								</table>


						<?php 
								endif; 
								// Ends if logged in and you have permission
								//------------------------------------------------------------------------------------------------
								//------------------------------------------------------------------------------------------------

						//------------------------------------------------------------------------------------------------
						//------------------------------------------------------------------------------------------------
						// Else the site is not protected so show the calculations
						else : ?>

							<table class="calculations">

								<tr>
									<th>Total Cost for <span class="js-portion-quantity"><?php echo $portion_quantity; ?></span> <?php echo ucfirst($portion_quantity_text);?>(s)</th>
									<td class="inputs"><span class="js-percent-per-serving">30</span>%</td>
									<td class="calculations">&pound;<span class="js-cost-per-serving"></span></td>
									<td class="checkbox-blank"></td>

								</tr>

								<tr>
									<th class="labels">Total Cost Per Single Portion</th>
									<td></td>
									<td class="calculations">&pound;<span class="js-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
									<td></td>

								</tr>
 
								<tr>
									<?php 
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th>Gross Profit Required</th>
										<td><input type="text" name="profit-amount" class="small-input" value="<?php echo $profit_required; ?>">%</td>
										<td>&pound;<span class="js-gross-profit"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Total Estimated Selling Price</th>
										<td>100%</td>
										<td>&pound;<span class="js-total-selling-price"></span></td>
										<td></td>

									</tr>

									<tr>
										<th>Estimated Selling Price Per Single Portion</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-selling-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>
									<?php
									//-----------------------------------------------------
									// Added global VAT amount
				                    $vat_amount = get_field('vat_amount', 'option');
				                    if ( !$vat_amount ) : $vat_amount = '0.2'; endif;

				                    $vat_amount = $vat_amount * 100;
				                    ?>
									<tr>
										<th>Estimated Selling Price including VAT at <?php echo $vat_amount;?>%</th>
										<td></td>
										<td>&pound;<span class="js-total-portion-vat-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
										<td></td>

									</tr>

							</table>

							<?php
							// New table working out sums for gross profit backwards. 
							//------------------------------------------------------------------------------------------------
							//------------------------------------------------------------------------------------------------ 

							$menu_price = get_field('menu_price');
							$menu_price = number_format((float)$menu_price, 2, '.', ''); ?>


							<table class="calculations">

								
									<tr>
										<th>Preferred Selling Price including VAT at <?php echo $vat_amount;?>%</th>
										<td></td>
										<?php /* <td>&pound;<span class="js-total-portion-vat-price" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td> */ ?>
										<td>&pound;<input type="text" name="desired-portion-price" class="small-input" value="<?php echo $menu_price; ?>"></td>
										<td></td>

									</tr>

									<tr>
										<th>Total Preferred Selling Price before VAT</th>
										<td>100%</td>
										<td>&pound;<span class="js-total-desired-price"></span></td>
										<td></td>

									</tr>



									<tr>
									<?php 
									// -----------------------------------------------------
									// Custom amount of profit required. If not set it defaults to 70
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th>Gross Profit</th>
										<td>1<?php echo $profit_required; ?>%</td>
										<td>&pound;<span class="js-gross-profit-amount"></span></td>
										<td></td>

									</tr>



	

								</table>

						<?php
						endif; 
						// Ends if the site should be protected or not
						//------------------------------------------------------------------------------------------------
						//------------------------------------------------------------------------------------------------ ?>

						</div><!-- closes one-half -->

					</div><!-- closes grid -->

				</form>			

				<?php 
				/* None of this is needed but saved for later
				if ( get_field('nutritional_information') ) : 
				$td = 0; ?>

				<h4>Nutrional Information</h4>

				<table class="nutrition">

					<tr>

					<?php 

					$columns = count( get_field('nutritional_information') );
					

					if ( $columns == 1 ) : $width = "100%"; endif;
					if ( $columns == 2 ) : $width = "50%"; endif;
					if ( $columns == 3 ) : $width = "33.33%"; endif;
					if ( $columns == 4 ) : $width = "25%"; endif;
					if ( $columns == 5 ) : $width = "20%"; endif;
					if ( $columns == 6 ) : $width = "16.66%"; endif;


					while ( has_sub_field('nutritional_information') ) : 
					$td++;

						$information_label = get_sub_field('information_label');
						$information_value = get_sub_field('information_value');



						if ( $td == 0 ) : $color = "purple"; endif;
						if ( $td == 1 ) : $color = "red"; endif;
						if ( $td == 2 ) : $color = "yellow"; endif;
						if ( $td == 3 ) : $color = "blue"; endif;
						if ( $td == 4 ) : $color = "green"; endif;
						if ( $td == 5 ) : $color = "brown"; endif;
											
					?>
						<td class="<?php echo $color; ?>" width="<?php echo $width;?>">

							<h5><?php echo $information_label; ?></h5>
							<?php echo $information_value; ?>

						</td>

					<?php 
					endwhile; ?>
					</tr>


				</table>

				<?php
				endif; */ ?>

				<hr>
				<div class="grid">

				
					<div class="grid__item palm-one-whole lap-one-half one-half">
					<?php if ( get_field('equipment') ) : ?>

						<h4>Equipment Needed</h4>
						<p><?php the_field('equipment'); ?></p>
					<?php endif; ?>

					</div><!--

				

				
					--><div class="grid__item palm-one-whole lap-one-half one-half">
					<?php 
					// 15.10.15 Allergens moved from recipes to each individual ingredient
					//if ( get_field('allergens') ) : ?>

						<div class="allergens">

							<h4>Allergens</h4>
							<p class="desc"><?php the_field('allergens_additional_info'); ?></p>

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

							

						</div>
					<?php  endif; ?>
					</div>

				
				<!-- -->
				</div>
				<hr>

				<h2>Method</h2>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>





				
				<footer class="additional pt">
				<?php /*
					<hr>

					<h3>More Starters</h3>

					<!-- TODO: Set up more recipes for footer -->
					<p>This area will pull 3 recipes from the same category as the one being viewed. In a later phase these will change to complimentary dishes based on menus created</p>
				*/ ?>

				<?php get_template_part('includes/content', 'print-footer'); ?>
				
				</footer>
				

				<?php
				//------------------------------------------------------------------------------------------------
				//------------------------------------------------------------------------------------------------
				// endif; // Ends if logged in ?>					
					
			</article>