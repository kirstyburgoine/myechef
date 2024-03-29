<?php 
//	while ( have_posts() ) : the_post();


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

<article class="post type-recipe">

	<div class="grid">

		<div class="grid__item palm-one-whole lap-one-third one-quarter">


<?php 
		
			// changed so that custom size and clas scan be added
			if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('recipe-thumb', array('class' => 'recipe--img'));
			endif;  ?>

		</div><!--

		--><div class="grid__item palm-one-whole lap-two-thirds three-quarters">

		
		<header class="recipe-title">

			<?php $nationality = get_the_terms(get_the_ID(), 'nationality_category'); 
			if ( ! empty($nationality) ) : 

				$nationality = current($nationality);
				$nationality_flag = get_field('flag', $nationality);
				?>

				<img src="<?php echo $nationality_flag['sizes']['flag']; ?>" alt="<?php echo $nationality->name;?>" class="img--right flag mb" />

			<?php endif; ?>

			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php if ( $small_description = get_field('small_description') ) : ?>
			
				<p><?php echo $small_description; ?></p>
			
			<?php endif; ?>
		</header>


		

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

		<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>

	</div>
</div>

<div class="seperator"></div>
</article>


<?php 
//	endwhile; ?>
