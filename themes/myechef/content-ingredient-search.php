<?php 
global $current_user;
get_currentuserinfo();
?>


<?php 
$i = 0;
//while ( have_posts() ) : the_post();
$base_unit = get_field('base_unit'); 
$base_cost = get_field('base_cost'); 
$i++;
?>

	<?php 
	//------------------------------------------------------------
	//------------------------------------------------------------
	// Repeater Field for stock levels based on the business unit
	if ( get_field('stock_levels') ) : 

		while ( has_sub_field('stock_levels') ) : 

			$business_unit = get_sub_field('business_unit');
			$package_size = get_sub_field('package_size');
			$stock_level = get_sub_field('stock'); 

			//var_dump($business_unit);

			// echo $business_unit['ID'];
			// echo $current_user->ID; 

			//------------------------------------------------------------------
			// Find the current logged in user and if it matches a business unit 
			// that has stock levels saved, display them.
			
			// Also set so business admins and main admin can see all as well
			if ( $business_unit['ID'] == $current_user->ID ) : ?>

			<tr class="row-<?php echo $i; ?>">
				<td class="first cell-<?php echo $i; ?>">
					<p><?php the_title(); ?></p>
				</td>

				<td class="base-unit">
					<?php echo $base_unit; ?>
				</td>	

				<td class="base-cost" data-base-cost="<?php echo $base_cost; ?>">
					<?php echo $base_cost; ?>
				</td>	


				<td data-package-size="<?php echo $package_size; ?>">
					<?php echo $package_size; ?>
				</td>	

				<td data-stock-level="<?php echo $stock_level; ?>">
					<?php echo $stock_level; ?>
				</td>	

				<td class="total-volume">
				</td>	

				<td data-ingredient-cost="" class="total-cost">
				</td>	

			</tr>

			<?php 
			elseif ( current_user_can('administrator') ) : ?>

			<tr class="row-<?php echo $i; ?>">
				<td class="first cell-<?php echo $i; ?>">
					<p><?php the_title(); ?></p>
				</td>

				<td>
					<p><?php echo $business_unit['user_firstname']; ?> <?php echo $business_unit['user_lastname'];?></p>
				</td>

				<td class="base-unit">
					<?php echo $base_unit; ?>
				</td>	

				<td class="base-cost" data-base-cost="<?php echo $base_cost; ?>">
					<?php echo $base_cost; ?>
				</td>	


				<td data-package-size="<?php echo $package_size; ?>">
					<?php echo $package_size; ?>
				</td>	

				<td data-stock-level="<?php echo $stock_level; ?>">
					<?php echo $stock_level; ?>
				</td>	

				<td class="total-volume">
				</td>	

				<td class="total-cost">
				</td>	

			</tr>
			
			<?php
			endif;// ends if business ID
											
		
		endwhile; // ends while sub_field repeater loop 

	else : ?>

		<tr class="row-<?php echo $i; ?>">
				
			<td class="first cell-<?php echo $i; ?>">
				<p><?php the_title(); ?></p>
			</td>

			<?php if ( current_user_can('administrator') ) : ?>
			<td>
			</td>
		<?php endif; ?>

			<td class="base-unit">
				<?php echo $base_unit; ?>
			</td>	

			<td class="base-cost" data-base-cost="0">
				0
			</td>	

			<td data-package-size="0">
				0
			</td>	

			<td data-stock-level="0">
				0
			</td>	

			<td class="total-volume">
			</td>	

			<td data-ingredient-cost="" class="total-cost">
			</td>	

		</tr>
	<?php		
	endif; // ends if repeater field

//endwhile; // ends while have posts loops ?>



<?php //if(function_exists('tw_pagination')) tw_pagination(); ?>