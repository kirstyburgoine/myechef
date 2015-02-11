<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$c = $_GET['c'];
$g = $_GET['g'];
$n = $_GET['n'];

?>

<div id="searchbox">

	<form method="get" id="suppliersearch" action="<?php bloginfo('url'); ?>/ingredients-search-results" class="taxonomy-filter">
        
        <div class="grid">

        	<div class="grid__item one-half desk-one-fifth">

        		<label for="c">Supplier:</label>

		        <select id="c" name="c">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('ingredient_supplier');
					if ( !empty($terms) ) :

						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->slug; ?>" <?php if ( $term->slug == $c ) :?>selected<?php endif;?>><?php echo $term->name; ?></option>
						<?php 	
						endforeach;

					endif;
					?>
		        <select>

        	</div><!--
			--><div class="grid__item one-half desk-one-fifth">

				<label for="g">Storage Type:</label>

		        <select id="g" name="g">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('ingredient_category');
					if ( !empty($terms) ) :

						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->slug; ?>" <?php if ( $term->slug == $g ) :?>selected<?php endif;?>><?php echo $term->name; ?></option>
						<?php 	
						endforeach;

					endif;
					?>

		        <select>

		    </div><?php if ( current_user_can('business-admin') || current_user_can('administrator') ) : ?><!--
			--><div class="grid__item one-half desk-one-fifth">
				<?php /*
				<label for="n">Business Unit:</label>

		        <select id="n" name="n">

		        	<option value="">...</option>

			        <?php 
					//------------------------------------------------------------
					//------------------------------------------------------------
					// Repeater Field fto grab business unit
					if ( get_field('stock_levels') ) : 

						while ( has_sub_field('stock_levels') ) : 

							$business_unit = get_sub_field('business_unit'); ?>

							<option value="<?php echo $business_unit[ID]; ?>" <?php if ( $business_unit[ID] == $n ) :?>selected<?php endif;?>><?php echo $business_unit[user_firstname]; ?> <?php echo $business_unit[user_lastname]; ?></option>
						<?php 	
						endwhile;

					endif;
					?>
		        <select>
		        */ ?>

		        <?php 
		        //<input type="hidden" id="s" name="s" value="filter" /> 
		        // Moved from next grid item as there is only two filters for now ?>
		        
		        <input type="submit" class="searchme ss-icon" name="submit" id="searchsubmit" value="Search" />
				

		    </div><?php endif; ?><!--
			--><div class="grid__item one-half desk-one-fifth">

			    
		    </div><!--
			--><div class="grid__item one-half desk-one-fifth">
			</div>

    </div>

	</form>

</div>