<?php
/*
 * Content for actual menus bit used on single chefs menus as it needs to be repeated if the site is not protected
 *
 */


				$event_type = get_the_terms( $post->ID , 'event_type' );
				$nationality = get_the_terms( $post->ID , 'nationality_category' );
				$menu_type = get_the_terms( $post->ID , 'chefs_menu_type' );

				$numETypes = count($event_type);
				$numNationality = count($nationality);
				$numMType = count($menu_type);
				$e = 0;
				$n = 0;
				$m = 0;



?>



 					<div class="utility ptrbl">

						<?php $nationality = get_the_terms(get_the_ID(), 'nationality_category'); ?>

						<?php if ( ! empty($nationality) ) : ?>

							<?php

								$nationality = current($nationality);
								$nationality_flag = get_field('flag', $nationality);

							?>

							

						<?php endif; ?>
						
						<ul class="utility-icons">
							<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
							<li>
								<?php /* <a href="<?php bloginfo('url');?>/nationality_category/<?php echo $nationality->slug; ?>" title="View all <?php echo $nationality->name; ?> dishes"> */ ?>
									<img src="<?php echo $nationality_flag['sizes']['flag']; ?>" alt="" class="alignright flag" />
								<?php /* </a> */ ?>
							</li>
						</ul>

						<?php /*

						<h4>Save Menu:</h4>
						<?php 
							global $wpb;
							echo $wpb->bookmark(); 

						*/ ?>

					</div>


					<header class="menu-title">
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




					<ul class="recipe-meta">

						
						<?php if ( $event_type ) : ?>
						<li><strong>Perfect for: </strong>
							<?php 	foreach ( $event_type as $etype ) :
										
											echo $etype->name . ', ';
										
									endforeach; ?>
						</li>
						<?php endif; ?>


						
						<?php if ( $menu_type ) : ?>
						<li><strong>Menu Type: </strong>
							<?php 	foreach ( $menu_type as $mtype ) :
										if( ++$m === $numMtype ) :
											echo $mtype->name;
										else :
											echo $mtype->name . ', ';
										endif;
									endforeach; ?>
						</li>
						<?php endif; ?>
						

					</ul>

					<hr>

					<?php 
					//------------------------------------------------------------------------------------------------
					//------------------------------------------------------------------------------------------------
					/* if ( !is_user_logged_in() ) :

					$not_logged_in = get_field('not_logged_in', 'option');  

						echo $not_logged_in;

					?>


					<?php 
					//------------------------------------------------------------------------------------------------
					//------------------------------------------------------------------------------------------------
					else : */ ?>

					<?php /*
					$portion_quantity = get_field('portion_quantity') ? get_field('portion_quantity') : 1; 
					$portion_quantity_text = get_field('portion_quantity_text') ? get_field('portion_quantity_text') : "portion"; 
					?>
				
					<p>These dishes make <input type="text" name="serving-quantity" value="<?php echo $portion_quantity; ?>" data-original-value="<?php echo $portion_quantity; ?>" class="portion-input" /> <?php echo $portion_quantity_text; ?>.</p>
					*/ ?>
			

					<!-- This is the main calculator bit -->
					<form action="" class="cost-calculator color-<?php echo strtolower($banner_color); ?>">
				
					<?php $serving_cost = 0.00; 

					$serving = get_field('serving');
    					if ( $serving == "" ) : $serving  = "Selling Price"; endif;?>

    				
					<?php
					// --------------------------------------------------------------------------------------
					// --------------------------------------------------------------------------------------
					// Start list of sub recipes as repeater field

			if( have_rows('fc_courses') ):					
				// loop through the rows of data
				$c_count = 0;
    			while ( have_rows('fc_courses') ) : the_row();
    			$c_count++;

    				if( get_row_layout() == 'add_course' ):

    					
					?>

					
					<h3><?php the_sub_field('course_name'); ?></h3>
					
					<table class="menu-builder-calculator-<?php echo $c_count; ?>">

					<thead>

						<tr>
							<th width="50%;"></th>
							
							<th width="25%;">Gross Profit<br /><small>per serving</small></th>
							<th width="25%;"><?php echo  $serving; ?><br /><small>per serving</small></th>
						</tr>

					</thead>

					<tbody>
							
					<?php 	
						$r_count = count( get_sub_field ( 'recipes_per_course' ) );

						while ( has_sub_field ( 'recipes_per_course' ) )  :

						//echo "text";
						$sub_recipe = get_sub_field('recipe');
						$sub_quantity = get_sub_field('quantity');
						$suggested_cost = get_sub_field('suggested_cost');
						//if ( $suggested_cost == " " ) : $suggested_cost = "0.00"; endif;
						$gross_profit = get_sub_field('gross_profit');
						if ( $gross_profit == "" ) : $gross_profit = "65"; endif;

						

						//if( $sub_recipe ) : 

							foreach( $sub_recipe as $s) :  
							?>

								<?php

 									$base_quantity_unit = get_field('recipe_quantity_unit', $s->ID);
									$sub_recipe_cost = get_sub_recipe_cost($s->ID, $sub_quantity);

								?>

								<tr>
													
									<td data-cost="<?php echo $suggested_cost; ?>"><a href="<?php echo get_permalink($s->ID); ?>"><?php echo get_the_title($s->ID); ?></a></td>
									<td><?php echo $gross_profit; ?>&#37;</td>
									<td>&pound;<span class="price"></span></td>

								</tr>
							
							<?php	

							endforeach;
							wp_reset_postdata();
						//endif;

						endwhile; // ends while repeater field ?>
					</tbody> 
					</table>

					<div class="grid">

						<div class="grid__item palm-one-whole one-quarter">

							</div><!--

						--><div class="grid__item palm-one-whole three-quarters">
			
							<table class="calculations-<?php echo $c_count; ?> course-totals">

								<tr class="total">
									<th width="66.5%;"><?php echo  $serving; ?> per Course</th>
									
									<td width="33.5%;" class="course_total">£<span class="js-total-portion-selling-price-<?php echo $c_count; ?>"></span></td>
								</tr>

								<tr class="average">
									<th width="66.5%;">Average Price per Serving</th>
									
									<td width="33.5%;" data-count="<?php echo $r_count; ?>">£<span class="js-average-portion-selling-price-<?php echo $c_count; ?>"></span></td>
								</tr>

								 

							</table>

						</div><!-- closes one-half -->

					</div><!-- closes grid -->



					<?php 
					// ends if row layout is add_course

					elseif( get_row_layout() == 'add_text_area' ):?>

						<h4><?php the_sub_field('text_area_title'); ?></h4>
						<?php the_sub_field('text_area'); ?>

					<?php endif; // emds if row layout is add text 



				endwhile;
			endif; // Ends flexible content ?>

				<hr />

					<?php 
					//------------------------------------------------------------------------------------
					//------------------------------------------------------------------------------------ 
					// Total  for whole menu ?>

					<div class="grid">

						<div class="grid__item palm-one-whole one-quarter">

							</div><!--

						--><div class="grid__item palm-one-whole three-quarters">
			
							<table class="calculations-total">

								<tr class="total">
									<th width="66.5%;">Total <?php echo  $serving; ?></th>
									
									<td width="33.5%;">£<span class="js-total-portion-selling-price-total"></span></td>
								</tr> 

							</table>

						</div><!-- closes one-half -->

					</div><!-- closes grid -->



				</form>			

				

				<div class="entry-content">
					<?php the_content(); ?>
				</div>




				
				<footer class="additional pt">
				



				<?php get_template_part('includes/content', 'print-footer'); ?>

				</footer>