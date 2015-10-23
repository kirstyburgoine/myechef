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
						
						<ul class="utility-icons">
							<li class="pt	rbl"><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
							
						</ul>

					</div>



					<header class="single-title">
						<h2><?php the_title(); ?></h2>
					</header>			


					<?php if ( $small_description = get_field('small_description') ) : ?>
						<p><?php echo $small_description; ?></p>
					<?php endif; ?>


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
									<th class="labels">Total Cost of Waste / Staff meals</th>
									<td class="inputs"></td>
									<td class="calculations">&pound;<span class="js-cost-per-serving"></span></td>
									<td class="checkbox-blank"></td>

								</tr>

								<tr>
									<th>Total Cost Per Single Portion</th>
									<td></td>
									<td class="calculations">&pound;<span class="js-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
									<td></td>

								</tr>

							</table>

							<table class="calculations table-two">
 
								<tr>
									<?php 
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th class="labels">Value of GP Lost</th>
										<td class="inputs"><input type="text" name="profit-amount" class="small-input" value="<?php echo $profit_required; ?>">%</td>
										<td class="calculations">&pound;<span class="js-gross-profit"></span></td>
										<td class="checkbox-blank"></td>

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
									<th class="labels">Total Cost of Waste / Staff meals</th>
									<td class="inputs"></td>
									<td class="calculations">&pound;<span class="js-cost-per-serving"></span></td>
									<td class="checkbox-blank"></td>

								</tr>

								<tr>
									<th>Total Cost Per Single Portion</th>
									<td></td>
									<td class="calculations">&pound;<span class="js-cost-per-portion" data-portion-quantity="<?php echo $portion_quantity; ?>"></span></td>
									<td></td>

								</tr>

							</table>

							<table class="calculations table-two">
 
								<tr>
									<?php 
										$profit_required = get_field('gross_profit'); 
										if ( ! $profit_required ) : $profit_required = '70'; endif;
									?>
										<th class="labels">Value of GP Lost</th>
										<td class="inputs"><input type="text" name="profit-amount" class="small-input" value="<?php echo $profit_required; ?>">%</td>
										<td class="calculations">&pound;<span class="js-gross-profit"></span></td>
										<td class="checkbox-blank"></td>

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
						endif; 
						// Ends if the site should be protected or not
						//------------------------------------------------------------------------------------------------
						//------------------------------------------------------------------------------------------------ ?>

						</div><!-- closes one-half -->

					</div><!-- closes grid -->

				</form>			

				

				<hr>

				<h2>Additional Notes:</h2>

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