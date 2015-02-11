<?php 



	$address = get_field('address');
	$telephone = get_field('telephone');
	$email = get_field('email');
	$website_address = get_field('website_address');
	$featured = get_field('featured_supplier');

	$type_terms = get_the_terms( $post->ID , 'contact_type' );
	$location_terms = get_the_terms( $post->ID , 'location' );
	$delivery_terms = get_the_terms( $post->ID , 'position' );
							
	$numTypes = count($type_terms);
	$numLocations = count($location_terms);
	$numDelivery = count($delivery_terms);
	$t = 0;
	$l = 0;
	$d = 0;
	?>

<article class="post type-recipe">


		<?php 
		//if ( $featured == 'Yes' ) :
			// changed so that custom size and clas scan be added
			if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
			endif; 

		//endif; ?>
		

	
		<header class="recipe-title">

			<h2>
				<?php /* if ( $featured == 'Yes' ) :?><a href="<?php the_permalink(); ?>"><?php endif; */ ?>
					<?php the_title(); ?>
				<?php /* if ( $featured == 'Yes' ) :?></a><?php endif; */ ?>
			</h2>


		
		</header>

		<div class="excerpt">
			<p class="bold"><strong>
			<?php if ( $type_terms ) : ?>
				<?php 	foreach ( $type_terms as $type ) :
							
								echo $type->name . ', ';
							
						endforeach; ?>
			
			<?php endif; ?>

			<?php if ( $location_terms ) : ?>
			based in 
				<?php 	foreach ( $location_terms as $location ) :
							
								echo $location->name . ', ';
							
						endforeach; ?>
			
			<?php endif; ?>

			<?php if ( $delivery_terms ) : ?>
			
				<?php 	foreach ( $delivery_terms as $delivery ) :
							if( ++$d === $numDelivery ) :
								echo $delivery->name;
							else :
								echo $delivery->name . ', ';
							endif;
						endforeach; ?>
			
			<?php endif; ?>
			</strong></p>

		<?php if ( $small_description = get_field('small_description') ) : ?>
			
				<p><?php echo $small_description; ?></p>
			
		<?php endif; ?>
		</div>

		
		<?php /* if ( $featured == 'Yes' ) :?>
			<a href="<?php the_permalink(); ?>" class="btn alignright mb">Full Details <span class="ss-directright"></span></a>
		<?php endif; */ ?>

		


		<p>
			<small><?php if ( $address ) : echo $address; endif;?><br />
			<?php if ( $telephone ) : echo "Tel: ".$telephone; endif;?>	<?php if ( $email ) : echo '<a href="mailto:'.$email.'">'.$email.'</a>'; endif;?> <?php if ( $website_address ) : echo '<a href="'.$website_address.'" target="_blank">'.$website_address.'</a>'; endif;?>
			</small>
		</p>
		





	




<div class="seperator"></div>
</article>


