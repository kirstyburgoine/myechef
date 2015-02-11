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

	<form method="get" id="suppliersearch" action="<?php bloginfo('url'); ?>/menus-search-results" class="taxonomy-filter">
        
        <div class="grid">

        	<div class="grid__item one-half desk-one-fifth">

        		<label for="c">Event Type:</label>

		        <select id="c" name="c">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('event_type');
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

				<label for="g">Nationality:</label>

		        <select id="g" name="g">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('nationality_category');
					if ( !empty($terms) ) :

						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->slug; ?>" <?php if ( $term->slug == $g ) :?>selected<?php endif;?>><?php echo $term->name; ?></option>
						<?php 	
						endforeach;

					endif;
					?>

		        <select>

		    </div><!--
			--><div class="grid__item one-half desk-one-fifth">

				<label for="n">Menu Type:</label>

		        <select id="n" name="n">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('chefs_menu_type');
					if ( !empty($terms) ) :

						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->slug; ?>" <?php if ( $term->slug == $n ) :?>selected<?php endif;?>><?php echo $term->name; ?></option>
						<?php 	
						endforeach;

					endif;
					?>
		        <select>

		    </div><!--
			--><div class="grid__item one-half desk-one-fifth">

			    <?php //<input type="hidden" id="s" name="s" value="filter" /> ?>
		        
		        <input type="submit" class="searchme ss-icon" name="submit" id="searchsubmit" value="Search" />
				
		    </div><!--
			--><div class="grid__item one-half desk-one-fifth">
			</div>

    </div>

	</form>

</div>