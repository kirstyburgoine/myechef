<div class="print-only">
	
						<?php
						$company_logo = get_field('company_logo', 'option');
						if ($company_logo) : 
						    $logo_class = "logo";
						else :
						    $logo_class = "logo fallback";
						endif; 
						?>

						<hr>

						<?php if ( $logo_class == 'logo fallback') : ?>
                        	<img src="http://myechef.co.uk/wp-content/themes/myechef/public/assets/img/myechef.jpg" height="84px" width="120px" class="print-only alignleft" />
                        <?php else : ?>
                        	<img src="<?php echo $company_logo['sizes']['logo']; ?>" width="120px" class="print-only alignleft" />
                        <?php endif; ?>
					
						<p class="alignleft">Printed from <?php bloginfo('name'); ?> <br /><?php the_permalink(); ?></p>
					
</div>