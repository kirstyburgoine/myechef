<?php 
$order = $_GET['order']; 

if ( is_post_type_archive( 'chefs_menu' ) || 'chefs_menu' == get_post_type() || is_page_template('search-chefs_menu.php') ) :
	$order_title = "menus";
else :
	$order_title = "recipes";
endif;
?>

		<form method="get" action="" name="sort" class="sort">

			<label for="order">Sort <?php echo $order_title; ?> by:</label>

			<select id="order" name="order">
  				<option name="latest" value="latest">Latest Added</option>
   				<option name="alphabet" value="alphabet" <?php if ( $order == "alphabet" ) :?>selected<?php endif; ?>>A to Z</option>
   			</select>

   			<input type="submit" class="searchme ss-icon" name="submit" id="sortbtn" value="down" />

   		</form>