<?php
$show_feedback_form = get_field('show_feedback_form', 'option');
if ( $show_feedback_form == 'Yes' ) :
get_template_part('content/incudes', 'feedbackform'); 
endif; ?>





<div class="credits">

	<div class="container">
					

			<?php
	        wp_nav_menu( 
	            array( 
	                'container' => '',
	                'menu_class' => 'nav nav--block menu alignright main-nav',
	                'theme_location' => 'secondary-menu' 
	        	) 
			); ?>

			<?php 
	        wp_nav_menu( 
	            array( 
	                'container' => '',
	                'menu_class' => 'nav nav--block menu',
	                'theme_location' => 'utility-menu' 
	        	) 
			);  ?>

			<p class="alignleft">
				<a href="http://www.kirstyburgoine.co.uk" title="Link to Kirsty Burgoine's website">Website by Kirsty Burgoine Ltd.</a>
				<br>© 2014 - MyEChef Ltd. Registered in England &amp; Wales. Company No:8612261
			</p>

		<div class="seperator"></div>

	</div>	

</div>

	<div id="logoutModal" class="reveal-modal">
	     <h1>Are you sure?</h1>
	     <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="btn">Logout <span class="ss-directright"></span></a>
	     <a class="close-reveal-modal">&#215;</a>
	</div>

	<div id="loginModal" class="reveal-modal">
	     <h1>Login to <?php bloginfo('name'); ?></h1>
	     <?php 
			  $args = array (
			  		'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] // Default redirect is back to the current page
			  );
			  wp_login_form( $args ); ?>
			  <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password" class="lost">Lost Password</a>
	</div>



</body>


<a href="#" class="scrollup"><i class="ss-icon">navigateup</i></a>  

<?php wp_footer(); ?>



</html>