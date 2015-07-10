<?php
/**
 * The main home file
 * Template Name: Home
 */

get_header(); 
 
$banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif;
?>

<div class="meal-types">

	<div class="container">

		<h2>Or Browse by Course</h2>

	<?php  
	   	$terms = get_terms('course_category');
		$count = count($terms);

		//print_r ( $terms );
		
		if ( !empty($terms) ) : ?>
			
			<ul class="nav hover-color-<?php echo strtolower($banner_color);?>">
		 	
		 	<?php
			foreach ( $terms as $term ) :

				$course_icon = get_field('icon', $term);
			
				?>
		   		
		   		<?php 
		   		if ( $term->count > 0 ) : ?>
				<li>
					<a href="<?php bloginfo('url')?>/course_category/<?php echo $term->slug; ?>">

						<?php if ( $course_icon ) :?>
							<img src="<?php echo $course_icon['sizes']['courses']; ?>" alt="" class="aligncenter" />
						<?php endif; ?>
						<h3><?php echo $term->name; ?></h3>

					</a>

				</li>
				<?php 
				endif; 

			endforeach;

		 	echo '</ul>';
		
		endif; // ends if $terms is not empty ?>

	</div>

</div> <?php // closes meal-types div ?>


<?php 
//-------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------
// Start the main loop for the page content

if ( have_posts() ) : the_post(); 

$content_area_2 = get_field('content_area_2'); ?>


<div class="container pt">

	<div class="grid">


		<div class="grid__item palm-one-whole lap-one-whole two-thirds">

			

			<div class="entry-content">

				<?php the_content(); ?>

			</div>

		</div><!--

		--><div class="grid__item palm-one-whole lap-one-whole one-third">

		<?php
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		global $blog_id;
		if ( is_user_logged_in() && current_user_can_for_blog( $blog_id, "read" ) ) : ?>


			<div class="sidebar">
				<?php 
				if ( is_active_sidebar( 'sidebar-3' ) ) : 
					dynamic_sidebar( 'sidebar-3' ); 
				endif; ?>

			</div>
		
		<?php 
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		// If not logged in show error text from Options page in admin
		else : ?>
				
			<div class="grid__item palm-one-whole lap-one-whole">
				<?php
				$not_logged_in = get_field('not_logged_in', 'option');  
				echo $not_logged_in;
				?>
			</div>

		<?php
		endif; ?>

		</div>


	</div> <!-- // Grid -->

</div>

<?php endif; ?>

<?php get_footer(); ?>