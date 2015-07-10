<article class="post type-recipe">

	<div class="grid">

		<div class="grid__item palm-one-whole lap-one-third one-quarter">


		<?php 
		// changed so that custom size and clas scan be added
		if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('recipe-thumb', array('class' => 'img--left'));
		endif; ?>
	
		</div><!--

		--><div class="grid__item palm-one-whole lap-two-thirds three-quarters">

	
		<header class="recipe-title">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="post-meta">
	        
				        <?php
							/* translators: used between list items, there is a space after the comma */
							$post_dated = get_the_time('d/m/y');
							$categories_list = get_the_category_list( __( ', ', 'parenttheme' ) );
							$categories = str_replace('rel="category tag"', '', $categories_list);

							/* translators: used between list items, there is a space after the comma */
							$tag_list = get_the_tag_list( '', __( ', ', 'parenttheme' ) );
							if ( '' != $tag_list ) {
								$utility_text = __( 'Posted in %1$s and tagged %2$s by %5$s on %7$s', 'parenttheme' );
							} elseif ( '' != $categories_list ) {
								$utility_text = __( 'Posted in %1$s by %5$s on %7$s', 'parenttheme' );
							} else {
								$utility_text = __( 'Posted by %5$s on %7$s', 'parenttheme' );
							}

							printf(
								$utility_text,
								$categories,
								$tag_list,
								esc_url( get_permalink() ),
								the_title_attribute( 'echo=0' ),
								get_the_author(),
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								$post_dated
							);
						?>
					
				        
				        </p>
		</header>

		
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>

		

		<a href="<?php the_permalink(); ?>" class="btn alignright mb">Read More <span class="ss-directright"></span></a>


	</div>
</div>

<div class="seperator"></div>
</article>