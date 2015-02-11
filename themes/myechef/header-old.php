<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<!-- TODO: Retina stuff in header -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php wp_title( '|', true, 'right' ); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="shortcut icon" type="image/ico" href="favicon.png" />
        <link rel="shortcut icon" href="favicon.png"> 
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link href="<?php bloginfo('template_directory'); ?>/public/assets/fonts/ss-steedicons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="<?php bloginfo('template_directory'); ?>/public/assets/fonts/ss-social-circle.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="<?php bloginfo('template_directory'); ?>/public/assets/fonts/ss-standard.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">


        <link href="<?php bloginfo('template_directory'); ?>/public/styles/style.min.css" rel="stylesheet" type="text/css" media="all"/>

      
        <script type="text/javascript" src="//use.typekit.net/ong5fia.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <!-- Shims -->
        <!--[if lt IE 9]>
            <script src="<?php bloginfo('template_directory'); ?>/public/scripts/html5shiv.min.js"></script>
            <script src="<?php bloginfo('template_directory'); ?>/public/scripts/respond.min.js"></script>


        <!-- Web App -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script>

        	function calculate_quantities() {

                var servings = $('[name="serving-quantity"]').val();

        		if ( isNaN(servings) || servings < 1 ) {
        			servings = 1
        		}
				
				$('.calculator tbody tr').each(function() {

					var $tr = $(this),
                        $td = $tr.find('td').first(),
						quantity = convert_units($td.data('quantity') * servings, $td.data('base-unit'));

					$tr.find('.quantity').html(quantity.quantity + quantity.unit);


        		});

        	}

        	function calculate_costs() {

        		var total_value = 0;
				
				$('.calculator tbody tr').each(function() {

					var $cell = $(this).find('td:first-child'),
                        $row = $cell.closest('tr'),
						price = ($cell.data('cost') / 100) * $cell.data('quantity');

					total_value += price;

					$row.find('.price').html(price.toFixed(2));

        		});        			

				$('.js-cost-per-portion').html(total_value.toFixed(2));

				calculate_profits();

        	}

        	function calculate_profits() {

    		    var total_amount = $('[name="total-amount"]').val(),
    				profit_amount = $('[name="profit-amount"]').val(),
    				portion_cost = parseFloat($('.js-cost-per-portion').html()),
    				portion_percent = parseFloat(total_amount - profit_amount),
    				gross_profit = parseFloat((portion_cost / portion_percent) * profit_amount),
    				total_cost = portion_cost + gross_profit;

    			// output the values
    			$('.js-percent-per-portion').html(portion_percent.toFixed(0));
    			$('.js-gross-profit').html(gross_profit.toFixed(2));
				$('.js-total-selling-price').html(total_cost.toFixed(2));

        	}

        	function convert_units(quantity, unit) {

        		var output = {quantity: quantity, unit: unit};

        		var conversion = {
        			g: {
        				unit: 'kg',
        				scale: 1000
        			},
        			ml: {
        				unit: 'l',
        				scale: 1000
        			},
                    na : {
                        unit: '',
                        scale: 1
                    }
        		};

        		if ( conversion[unit] == undefined ) {
        			return output;
        		}

        		var temp_quantity = quantity / conversion[unit].scale;

        		if ( temp_quantity >= 1 ) {
        			output = convert_units(temp_quantity, conversion[unit].unit);
        		}

        		return output;

        	}

        	$(document).ready(function() {

        		$('.js-related-ingredients').on('change', function() {

        			var $self = $(this).find('option:selected'),
        				$cell = $self.closest('td');

                    $cell.data('cost', $self.data('cost'));
                    $cell.data('base-unit', $self.data('base-unit'));

                    calculate_quantities();
        			calculate_costs();

        		}).trigger('change');

        		$('[name="serving-quantity"]').on('keyup', function() {
					calculate_quantities();
        		}).trigger('keyup');

        		$('[name="serving-quantity"]').on('blur', function() {
					
        			var $self = $(this);

					if ( isNaN($self.val()) || $self.val() < 1 ) {
	        			$self.val(1);
	        		}

        		});

        		$('[name="profit-amount"], [name="total-amount"]').on('keyup', function() {

					calculate_profits();

        		});

        		calculate_costs();

        	});

        </script>

        <?php wp_head(); ?>

    </head>

<?php $banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif; ?>

<body class="wrapper <?php echo strtolower($banner_color); ?>">

            <div class="container">

                <div class="header-nav">

                    <?php
                    wp_nav_menu( 
                        array( 
                            'container' => '',
                            'menu_id' => 'main-menu',
                            'menu_class' => 'nav nav--block menu',
                            'theme_location' => 'primary-menu' 
                        ) 
                    ); ?>

                    <div class="seperator"></div>

                </div>

                <div class="logo-container">
                    <h1 class="logo">
                        <a href="<?php bloginfo('url'); ?>">My EChef</a>
                    </h1>
                </div>

            </div>




<?php 
//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
if ( is_home() || is_page('34') ) : 

    get_template_part('includes/content', 'home-focus'); 

else : 

    get_template_part('includes/content', 'page-focus'); 

endif; ?>


