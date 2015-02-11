<?php 
$args = array(
	'post_type' => 'ingredients',
	
);

$t_query = new WP_Query( $args );

if ( $t_query->have_posts() ) :

	while ( $t_query->have_posts() ) : 
		$t_query->the_post();

		$base_unit = get_field('base_unit'); 
		$base_cost = get_field('base_cost'); 

		if ( get_field('stock_levels') ) : 

		while ( has_sub_field('stock_levels') ) : 

			$business_unit = get_sub_field('business_unit');
			$package_size = get_sub_field('package_size');
			$stock_level = get_sub_field('stock'); 

			// var_dump($business_unit);

			// echo $business_unit['ID'];
			// echo $current_user->ID; 

			//------------------------------------------------------------------
			// Find the current logged in user and if it matches a business unit 
			// that has stock levels saved, display them.
			
			// Also set so business admins and main admin can see all as well
			if ( $business_unit['ID'] == $current_user->ID || current_user_can('editor') || current_user_can('administrator') ) :
			?>
				<td data-package-size="<?php echo $package_size; ?>">
					<?php echo $package_size; ?>
				</td>	

				<td data-stock-level="<?php echo $stock_level; ?>">
					<?php echo $stock_level; ?>
				</td>	



			<?php 
			endif;
											
		
		endwhile; 

	endwhile;

endif;

wp_reset_postdata();
?>