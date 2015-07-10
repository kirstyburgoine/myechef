<?php 
/*
 * Needed because its used on both single-chefedpedia and single-information_centre.php
 * These are basically the same custom posts but named differently for clients benefit
 */	
?>

<div class="utility ptrbl">

	<ul class="utility-icons">
		<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
	</ul>
				
</div>	
					
<header class="single-title">
		
	<h2><?php the_title(); ?></h2>
				
</header>			

<?php if ( $small_description = get_field('small_description') ) : ?>
	<p><?php echo $small_description; ?></p>
<?php endif; ?>

<hr>

<div class="entry-content">
	<?php the_content(); ?>
</div>

<footer class="additional pt">

	<h3>Did you find this article useful?</h3>
	<?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>
	<br />

	<?php get_template_part('includes/content', 'print-footer'); ?>

</footer>