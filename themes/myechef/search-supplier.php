<?php
/* 
 * Custom post type archive for suppliers
 * Template Name: supplier Search Results
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
					'post_type' => 'supplier',
					'tax_query' => array(
						array(
							'taxonomy' => 'supplier_type',
							'field' => 'slug',
							'terms' => $c
						)
					),
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $g  ) :
				$args = array(
					'post_type' => 'supplier',
					'tax_query' => array(
						array(
							'taxonomy' => 'location',
							'field' => 'slug',
							'terms' => $g
						)
					),
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $n  ) :
				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'delivery',
							'field' => 'slug',
							'terms' => $n
						)
					),
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $c  && $g ) :
				$args = array(
					'post_type' => 'supplier',
					'supplier_type' => $c,
					'location' => $g,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $c  && $n ) :
				$args = array(
					'post_type' => 'supplier',
					'supplier_type' => $c,
					'delivery' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $g  && $n ) :
				$args = array(
					'post_type' => 'supplier',
					'location' => $g,
					'delivery' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;

				if ( $c  && $g && $n ) :
				$args = array(
					'post_type' => 'supplier',
					'supplier_type' => $c,
					'location' => $g,
					'delivery' => $n,
					'paged' => $paged,
					'orderby' => 'title'
				);
				endif;
			
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


				<h1>Search Results for <?php if ($c) : echo "<i>" . $cz . "</i>,"; endif;?> <?php if ($g) : echo "<i>" . $gz . "</i>,"; endif;?> <?php if ($n) : echo "<i>" . $nz . "</i>,"; endif;?></h1>

				<p>Your search returned <?php echo $wp_query->found_posts; ?> result(s).</p>



				<?php
					while ( $custom_query->have_posts() ) : $custom_query->the_post();

						get_template_part( 'content', 'supplier-archive' );

					endwhile;

					if ( function_exists( 'tw_pagination' ) ) : tw_pagination(); endif; 
					
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