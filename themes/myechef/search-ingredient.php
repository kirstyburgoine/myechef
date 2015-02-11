<?php
/* 
 * Custom post type archive for menus
 * Template Name: Ingredient Search Results
 */

if ( isset( $_GET['c'] ) ) :
	$c = $_GET['c'];
endif;

if ( isset( $_GET['g'] ) ) :
	$g = $_GET['g'];
endif;

if ( isset( $_GET['n'] ) ) :
	$n = $_GET['n'];
endif;

//echo $c ."+". $g ."+". $n;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


get_header(); ?>

	<div class="container pt">

		<div class="grid">

			<div class="grid__item palm-one-whole lap-one-whole three-quarters">

			<?php
			// If any of the specific search terms are in the URL setup the custom query
			// Otherwise no paramaters are needed for the standard search template
			// if ( $c || $g || $n ) :

				if ( $c  ) :
				$args = array(
					'post_type' => 'ingredient',
					'tax_query' => array(
						array(
							'taxonomy' => 'ingredient_supplier',
							'field' => 'slug',
							'terms' => $c
						)
					),
					'posts_per_page' => -1,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				
				if ( $g  ) :
				$args = array(
					'post_type' => 'ingredient',
					'tax_query' => array(
						array(
							'taxonomy' => 'ingredient_category',
							'field' => 'slug',
							'terms' => $g
						)
					),
					'posts_per_page' => -1,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
				
				/*
				if ( $n  ) :
				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'chefs_menu_type',
							'field' => 'slug',
							'terms' => $n
						)
					),
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
				*/
				
				if ( $c  && $g ) :
				$args = array(
					'post_type' => 'ingredient',
					'ingredient_supplier' => $c,
					'ingredient_category' => $g,
					'posts_per_page' => -1,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
				
				/*
				if ( $c  && $n ) :
				$args = array(
					'post_type' => 'ingredient',
					'ingredient_supplier' => $c,
					'chefs_menu_type' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
				

				if ( $g  && $n ) :
				$args = array(
					'post_type' => 'ingredient',
					'nationality_category' => $g,
					'chefs_menu_type' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $c  && $g && $n ) :
				$args = array(
					'post_type' => 'ingredient',
					'event_type' => $c,
					'nationality_category' => $g,
					'chefs_menu_type' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
				*/
			
			// Get current page and append to custom query parameters array
			//$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			// Instantiate custom query
			$custom_query = new WP_Query( $args );

			// Pagination fix
			$temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $custom_query;
		
			
			//query_posts( $args );

			// endif;

if ( $custom_query->have_posts() ) : 

	$cz = ucwords(str_replace("-", " ", $c));
	$gz = ucwords(str_replace("-", " ", $g));
	$nz = ucwords(str_replace("-", " ", $n));

	?>
	<div class="utility">

		<ul class="utility-icons">
			<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
			<li><a href="" class="ss-icon file" title="Save this report">File</a></li>
		</ul>
	
	</div>

	<h1>Search Results for <?php if ($c) : echo "<i>" . $cz . "</i>,"; endif;?> <?php if ($g) : echo "<i>" . $gz . "</i>,"; endif;?> <?php if ($n) : echo "<i>" . $nz . "</i>,"; endif;?></h1>
	<p>Your search returned <?php echo $wp_query->found_posts; ?> individual ingredients.</p>



	<?php 
	global $current_user;
	get_currentuserinfo();
	?>

	<table class="ingredients-stock-levels <?php if ( current_user_can('business-admin') || current_user_can('administrator') ) : ?>admin<?php else :?>editor<?php endif;?>">

	<thead>
		<tr>
			<th></th>
			<?php if ( current_user_can('business-admin') || current_user_can('administrator') ) : ?><th>Business Unit</th><?php endif;?>
			<th>Unit of Measure</th>
			<th>Cost per single unit</th>
			<th>Package Size</th>
			<th>Stock Level</th>
			<th>Total Volume</th>
			<th>Total Cost</th>
		</tr>
	</thead>

	<tbody>
	
	<?php
		while ( $custom_query->have_posts() ) : $custom_query->the_post();

			get_template_part( 'content', 'ingredient-search' );

		endwhile;

		if ( function_exists( 'tw_pagination' ) ) : tw_pagination(); endif; ?>

	</tbody>

	</table>


	<div class="grid">

		<div class="grid__item palm-one-whole one-half">
		</div><!--

		--><div class="grid__item palm-one-whole one-half">


			<table class="ingredient-totals">

				<tr>
					<th>Total Cost</th>
					
					<td class="totals-calculation">£<span class="js-total-cost"></span></td>
					

				</tr>

			</table>
		</div>
	</div>
<?php					
else : ?>

				<h1>Search Results</h1>

				<p>Your search returned 0 results.</p>

				<?php 
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif; //wp_reset_query(); 
			wp_reset_postdata();


				// Reset main query object
				$wp_query = NULL;
				$wp_query = $temp_query;
				?>
			</div><!--

			--><div class="grid__item palm-one-whole lap-one-whole one-quarter">
			
					<?php get_sidebar(); ?>



			</div>


		</div> <!-- // Grid -->

	</div>


<?php get_footer(); ?>