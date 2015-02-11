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

	<form method="get" id="searchform" action="<?php //echo esc_url( home_url( '/' ) ); ?><?php bloginfo('url'); ?>/recipe-search-results" class="taxonomy-filter">
        
        <div class="grid">

        	<div class="grid__item one-half desk-one-fifth">

        		<label for="c">Course:</label>

		        <select id="c" name="c">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('course_category');
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

				<label for="g">Food Group:</label>

		        <select id="g" name="g">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('food_group_category');
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

				<label for="n">Nationality:</label>

		        <select id="n" name="n">

		        	<option value="">...</option>

			        <?php	
					$terms = get_terms('nationality_category');
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