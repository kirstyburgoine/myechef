<?php
/*
 * Used on the standard single.php as the content needs to be repeated based opn whether protected or not
 */ ?>

 <article class="type-recipe post">

					<div class="utility ptrbl">
						<ul class="utility-icons">
							<li><a href="javascript:window.print()" class="ss-icon print" title="Print this page">Print</a></li>
						</ul>
					</div>	
					
					<header class="single-title">
						<h2><?php the_title(); ?></h2>
					</header>		




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

   					<hr>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					
					<footer class="additional pt">
						<?php get_template_part('includes/content', 'print-footer'); ?>
					</footer>
				
					
</article>


			<?php 
			if ('open' == $post->comment_status) : ?>

                    <!-- Start of comment wrapper -->
                    <div class="comment_wrapper">
                    
	                    <!-- Start of comment wrapper main -->
	                    <div class="comment_wrapper_main">
	                    
	                    <?php comments_template(); ?>
	                    <?php //comment_form(); ?>
	                    
	                    </div><!-- End of comment wrapper main -->
                    
                    	<div class="clear"></div>
                    
                    </div><!-- End of comment wrapper -->
                    
            <?php endif; ?> 