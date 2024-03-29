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

        
        <link href="<?php bloginfo('template_directory'); ?>/public/styles/style.min.css" rel="stylesheet" type="text/css" media="screen"/>
        
        
        <link href="<?php bloginfo('template_directory'); ?>/public/styles/printstyle.min.css" rel="stylesheet" type="text/css" media="print" />

      
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

        <script>

            function get_quantity_multiplier() {

                var $servings_quantity = $('[name="serving-quantity"]'),
                    servings = $servings_quantity.val()
                    original_servings = $servings_quantity.data('original-value');

                if ( isNaN(servings) || servings < 1 ) {
                    servings = 1
                }

                // update the portion quantity value
                $('.js-portion-quantity').html(servings);

                return multiplier = servings / original_servings;

            }

        	function calculate_quantities() {

                var multiplier = get_quantity_multiplier();
                
                $('.ingredient-calculator tbody tr, .sub-recipe-calculator tbody tr').each(function() {

                    var $tr = $(this),
                        $td = $tr.find('td').first(),
                        quantity = convert_units($td.data('quantity') * multiplier, $td.data('base-unit'));
                        quantity_trimmed = quantity.quantity.toFixed(2)

                    $tr.find('.quantity').html( eval(quantity_trimmed) + quantity.unit);

                });

        	}

            function calculate_costs() {

                // Set to 0
                var total_value = 0,
                    portion_cost = 0,
                    multiplier = get_quantity_multiplier();
                
                $('.ingredient-calculator tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $row = $cell.closest('tr'),
                        price = (($cell.data('cost') / 100) * $cell.data('quantity')) * multiplier;

                    total_value += price;

                    $row.find('.price').html(price.toFixed(2));

                });
                
                // update ingredient totals
                portion_cost = (total_value / $('.js-cost-per-portion').data('portion-quantity')) / multiplier;
                $('.js-ingredient-cost-per-serving').html(total_value.toFixed(2));
                $('.js-ingredient-cost-per-portion').html(portion_cost.toFixed(2));

                $('.sub-recipe-calculator tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $row = $cell.closest('tr'),
                        price = $cell.data('cost') * multiplier;

                    total_value += price;

                    $row.find('.price').html(price.toFixed(2));

                });

                // update totals
                portion_cost = (total_value / $('.js-cost-per-portion').data('portion-quantity')) / multiplier;
                $('.js-cost-per-serving').html(total_value.toFixed(2));
                $('.js-cost-per-portion').html(portion_cost.toFixed(2));

                calculate_profits();
                calculate_profits_backwards();

            }

            function calculate_profits() {

                var total_amount = 100, // $('[name="total-amount"]').val(),
                    profit_amount = $('[name="profit-amount"]').val(),
                    portion_cost = parseFloat($('.js-cost-per-serving').html()),
                    portion_percent = parseFloat(total_amount - profit_amount),
                    gross_profit = parseFloat((portion_cost / portion_percent) * profit_amount),
                    total_cost = portion_cost + gross_profit;




                    var $servings_quantity = $('[name="serving-quantity"]'),
                    servings = $servings_quantity.val()
                    original_servings = $servings_quantity.data('original-value');

                    if ( isNaN(servings) || servings < 1 ) {
                        servings = 1
                    }

                    <?php
                    $vat_amount = get_field('vat_amount', 'option');
                    if ( !$vat_amount ) : $vat_amount = '0.2'; endif;

                    ?>
                    //portion_value = total_cost / $('.js-total-portion-selling-price').data('portion-quantity');
                    // changed so the estimated selling price per portion is divided by the number of portions in the text input field
                    portion_value = total_cost / servings;
                    portion_vat = portion_value * <?php echo $vat_amount; ?>;
                    portion_inc_vat = portion_vat + portion_value;

                // output the values
                $('.js-percent-per-serving').html(portion_percent.toFixed(0));
                $('.js-gross-profit').html(gross_profit.toFixed(2));
                $('.js-total-selling-price').html(total_cost.toFixed(2));



                $('.js-total-portion-selling-price').html(portion_value.toFixed(2));
                $('.js-total-portion-vat-price').html(portion_inc_vat.toFixed(2));

            }

            function calculate_profits_backwards() {

                <?php
                $vat_amount = get_field('vat_amount', 'option');
                if ( !$vat_amount ) : $vat_amount = '0.2'; endif;

                if ( $vat_divider !== '1' ) :
                $vat_divider = $vat_amount + 1;
                endif;
                ?>

                var desired_portion_price = $('[name="desired-portion-price"]').val(),

                    //vat_amount = desired_portion_price * <?php echo $vat_amount;?>;
                    total_desired_price = desired_portion_price / <?php echo $vat_divider;?>;
                    portion_cost = parseFloat($('.js-cost-per-serving').html()),
                    profit_amount = total_desired_price - portion_cost;

                    percentage_amount = (profit_amount / total_desired_price) * 100;



                    var $servings_quantity = $('[name="serving-quantity"]'),
                    servings = $servings_quantity.val()
                    original_servings = $servings_quantity.data('original-value');

                    if ( isNaN(servings) || servings < 1 ) {
                        servings = 1
                    }

                    portion_value = total_desired_price / servings;
                    portion_vat = portion_value * <?php echo $vat_amount; ?>;
                    portion_inc_vat = portion_vat + portion_value;

                // output the values
                $('.js-total-desired-price').html(total_desired_price.toFixed(2));
                $('.js-profit-percentage').html(percentage_amount.toFixed(0));
                $('.js-gross-profit-amount').html(profit_amount.toFixed(2));


                $('.js-preferred-portion-selling-price').html(portion_value.toFixed(2));
                $('.js-preferred-portion-vat-price').html(portion_inc_vat.toFixed(2));

            }

            /*
            function calculate_vat() {

                var vat = 0.2,
                    total_amount = 100,
                    profit_amount = $('[name="profit-amount"]').val(),
                    portion_cost = parseFloat($('.js-cost-per-serving').html()),
                    portion_percent = parseFloat(total_amount - profit_amount),
                    gross_profit = parseFloat((portion_cost / portion_percent) * profit_amount),
                    total_cost = portion_cost + gross_profit;



                    var $servings_quantity = $('[name="serving-quantity"]'),
                    servings = $servings_quantity.val()
                    original_servings = $servings_quantity.data('original-value');

                    if ( isNaN(servings) || servings < 1 ) {
                        servings = 1
                    }

                    portion_value = total_cost / servings;
                    vat_amount = portion_value * vat;
                    total_plus_vat = portion_value + vat_amount

                // output the values
                $('.js-total-portion-vat-price').html(total_plus_vat.toFixed(2));

            } */

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

// moved outside calculate_menus() function so all totals can be added up
var total_value1 = 0,
    total_value2 = 0,
    total_value3 = 0,
    total_value4 = 0,
    total_value5 = 0,
    total_average1 = 0;
    total_average2 = 0;
    total_average3 = 0;
    total_average4 = 0;
    total_average5 = 0;






function calculate_course_totals() {

   // $(".menu-builder").each(function(){
        
        $('.calculator-1 tbody tr').each(function () {

            var $cell = $(this).find('td:first-child'),
                $cell2 = $(this).find('td:nth-child(2)'),
                $row = $cell.closest('tr'),
                price = $cell.data('cost'),
                servings = $cell2.data('servings');

            if (!price) {
                price = 0
            }

            if (isNaN(servings) || servings < 1) {
                servings = 1
            }

            //console.log(servings);
            singleprice = price / servings;

            // Display the price for the dish in the last column
            $row.find('.price').html(singleprice.toFixed(2));

            // Add up each price
            total_value1 += singleprice;

        });

        $('.calculations-1 tbody tr.average').each(function () {
            // divide by total row count to find the average cost
            var $av_cell = $(this).find('td:nth-child(2)'),
                average_count1 = $av_cell.data('count');

            total_average1 = total_value1 / average_count1;

        });

        //---------------------------------------------------------

        $('.calculator-2 tbody tr').each(function () {

            var $cell = $(this).find('td:first-child'),
                $cell2 = $(this).find('td:nth-child(2)'),
                $row = $cell.closest('tr'),
                price = $cell.data('cost'),
                servings = $cell2.data('servings');

            if (!price) {
                price = 0
            }

            if (isNaN(servings) || servings < 1) {
                servings = 1
            }

            //console.log(servings);
            singleprice = price / servings;

            // Display the price for the dish in the last column
            $row.find('.price').html(singleprice.toFixed(2));

            // Add up each price
            total_value2 += singleprice;

        });

        $('.calculations-2 tbody tr.average').each(function () {
            // divide by total row count to find the average cost
            var $av_cell = $(this).find('td:nth-child(2)'),
                average_count2 = $av_cell.data('count');

            total_average2 = total_value2 / average_count2;

        });

        //---------------------------------------------------------

        $('.calculator-3 tbody tr').each(function () {

            var $cell = $(this).find('td:first-child'),
                $cell2 = $(this).find('td:nth-child(2)'),
                $row = $cell.closest('tr'),
                price = $cell.data('cost'),
                servings = $cell2.data('servings');

            if (!price) {
                price = 0
            }

            if (isNaN(servings) || servings < 1) {
                servings = 1
            }

            //console.log(servings);
            singleprice = price / servings;

            // Display the price for the dish in the last column
            $row.find('.price').html(singleprice.toFixed(2));

            // Add up each price
            total_value3 += singleprice;

        });

        $('.calculations-3 tbody tr.average').each(function () {
            // divide by total row count to find the average cost
            var $av_cell = $(this).find('td:nth-child(2)'),
                average_count3 = $av_cell.data('count');

            total_average3 = total_value3 / average_count3;

        });

        //---------------------------------------------------------

        $('.calculator-4 tbody tr').each(function () {

            var $cell = $(this).find('td:first-child'),
                $cell2 = $(this).find('td:nth-child(2)'),
                $row = $cell.closest('tr'),
                price = $cell.data('cost'),
                servings = $cell2.data('servings');

            if (!price) {
                price = 0
            }

            if (isNaN(servings) || servings < 1) {
                servings = 1
            }

            //console.log(servings);
            singleprice = price / servings;

            // Display the price for the dish in the last column
            $row.find('.price').html(singleprice.toFixed(2));

            // Add up each price
            total_value4 += singleprice;

        });

        $('.calculations-4 tbody tr.average').each(function () {
            // divide by total row count to find the average cost
            var $av_cell = $(this).find('td:nth-child(2)'),
                average_count4 = $av_cell.data('count');

            total_average4 = total_value4 / average_count4;

        });

        //---------------------------------------------------------

        $('.calculator-5 tbody tr').each(function () {

            var $cell = $(this).find('td:first-child'),
                $cell2 = $(this).find('td:nth-child(2)'),
                $row = $cell.closest('tr'),
                price = $cell.data('cost'),
                servings = $cell2.data('servings');

            if (!price) {
                price = 0
            }

            if (isNaN(servings) || servings < 1) {
                servings = 1
            }

            //console.log(servings);
            singleprice = price / servings;

            // Display the price for the dish in the last column
            $row.find('.price').html(singleprice.toFixed(2));

            // Add up each price
            total_value5 += singleprice;

        });

        $('.calculations-5 tbody tr.average').each(function () {
            // divide by total row count to find the average cost
            var $av_cell = $(this).find('td:nth-child(2)'),
                average_count5 = $av_cell.data('count');

            total_average5 = total_value5 / average_count5;

        });

    $('.calculations-1 .js-course-total-price').html(total_value1.toFixed(2));
    $('.calculations-1 .js-course-average-price').html(total_average1.toFixed(2));

    $('.calculations-2 .js-course-total-price').html(total_value2.toFixed(2));
    $('.calculations-2 .js-course-average-price').html(total_average2.toFixed(2));

    $('.calculations-3 .js-course-total-price').html(total_value3.toFixed(2));
    $('.calculations-3 .js-course-average-price').html(total_average3.toFixed(2));

    $('.calculations-4 .js-course-total-price').html(total_value4.toFixed(2));
    $('.calculations-4 .js-course-average-price').html(total_average4.toFixed(2));

    $('.calculations-5 .js-course-total-price').html(total_value5.toFixed(2));
    $('.calculations-5 .js-course-average-price').html(total_average5.toFixed(2));
    
   // });


}

function calculate_menus_total() {

    var menu_value = total_value1 + total_value2 + total_value3 + total_value4 + total_value5;
    $('.calculations-total tbody tr.total td:nth-child(2)').html(menu_value.toFixed(2));
    
}



            function calculate_stock_volume() {

                var total_volume = 0,
                    total_cost = 0

                <?php if ( current_user_can('editor') || current_user_can('administrator') ) : ?>

                $('.ingredients-stock-levels tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $row = $cell.closest('tr'),
                        $cell4 = $(this).find('td:nth-child(4)'),
                        $cell5 = $(this).find('td:nth-child(5)'),
                        $cell6 = $(this).find('td:nth-child(6)'),
                        
                        base_cost = $cell4.data('base-cost');
                        package_size = $cell5.data('package-size');
                        stock_level = $cell6.data('stock-level');
                       

                    if (! stock_level ) { stock_level = 0 }

                    total_volume = package_size * stock_level
                    total_cost = total_volume * base_cost
                
                    $row.find('.total-volume').html(total_volume.toFixed(2));
                    $row.find('.total-cost').html(total_cost.toFixed(2));

                });

                <?php else : ?>

                $('.ingredients-stock-levels tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $row = $cell.closest('tr'),
                        $cell3 = $(this).find('td:nth-child(3)'),
                        $cell4 = $(this).find('td:nth-child(4)'),
                        $cell5 = $(this).find('td:nth-child(5)'),
                        
                        base_cost = $cell3.data('base-cost');
                        package_size = $cell4.data('package-size');
                        stock_level = $cell5.data('stock-level');
                       

                    if (! stock_level ) { stock_level = 0 }

                    total_volume = package_size * stock_level
                    total_cost = total_volume * base_cost
                
                    $row.find('.total-volume').html(total_volume.toFixed(2));
                    $row.find('.total-cost').html(total_cost.toFixed(2));

                });

                 <?php endif; ?>


            }

            // Add up all of the total costs for ingredients at the bottom of the page
            function calculate_stock_report_totals() {

                // Set to 0
                var total_value = 0,
                    total_volume = 0,
                    total_cost = 0

                <?php if ( current_user_can('editor') || current_user_can('administrator') ) : ?>

                // If logged in as admin there are extra columns
                $('.ingredients-stock-levels tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $cell4 = $(this).find('td:nth-child(4)'),
                        $cell5 = $(this).find('td:nth-child(5)'),
                        $cell6 = $(this).find('td:nth-child(6)'),
                        $row = $cell.closest('tr')

                        base_cost = $cell4.data('base-cost');
                        package_size = $cell5.data('package-size');
                        stock_level = $cell6.data('stock-level');

                        total_volume = package_size * stock_level
                        total_cost = total_volume * base_cost
                
                    total_value += total_cost;

                });

                <?php else : ?>

                // If logged in as admin there are extra columns
                $('.ingredients-stock-levels tbody tr').each(function() {

                    var $cell = $(this).find('td:first-child'),
                        $cell3 = $(this).find('td:nth-child(3)'),
                        $cell4 = $(this).find('td:nth-child(4)'),
                        $cell5 = $(this).find('td:nth-child(5)'),
                        $row = $cell.closest('tr')

                        base_cost = $cell3.data('base-cost');
                        package_size = $cell4.data('package-size');
                        stock_level = $cell5.data('stock-level');

                        total_volume = package_size * stock_level
                        total_cost = total_volume * base_cost
                
                    total_value += total_cost;

                });
                <?php endif; ?>
                
                $('.js-total-cost').html(total_value.toFixed(2));

                
            }

        	$(document).ready(function() {

                // prevent calculations until all sub-ingredient/recipe
                // values have been applied to their parent

                var sub_calculations = false;

                $('.js-related-ingredients, .js-sub-recipe').on('change', function() {

                    var $self = $(this).find('option:selected'),
                        $cell = $self.closest('td');

                    $cell.data('cost', $self.data('cost'));
                    $cell.data('base-unit', $self.data('base-unit'));

                    if ( sub_calculations ) {
                        calculate_quantities();
                        calculate_costs();
                    }

                }).trigger('change');

                // now the sub-ingredient/recipe values have been
                // applied now allow calculations to be made

                sub_calculations = true;

        		$('[name="serving-quantity"]').on('keyup', function() {
					calculate_quantities();
                    calculate_costs();
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

                $('[name="desired-portion-price"]').on('keyup', function() {
                    calculate_profits_backwards();
                });


                calculate_quantities();
        		calculate_costs();
                //calculate_profits_backwards();
                //calculate_vat();
                //calculate_dish_totals();
                calculate_course_totals();
                calculate_menus_total();
                calculate_stock_volume()
                calculate_stock_report_totals()

        	});

        </script>

        <?php wp_head(); ?>

    </head>

<?php 
$banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif; 

$company_logo = get_field('company_logo', 'option');
if ($company_logo) : 
    $logo_class = "logo";
else :
    $logo_class = "logo fallback";
endif; 
?>



<body class="wrapper <?php echo strtolower($banner_color); ?> <?php echo basename( get_page_template() ); ?>">

            <div class="container">

                <div class="header-nav">

                    <?php
                    wp_nav_menu( 
                        array( 
                            'container' => '',
                            'menu_class' => 'nav nav--block menu main-nav menu-primary-menu',
                            'theme_location' => 'primary-menu' 
                        ) 
                    ); ?>

                    <div class="seperator"></div>

                </div>

                <div class="logo-container">

                    
                    <h1 class="<?php echo $logo_class;?>" <?php if ($company_logo) : ?>style="background-image: url(<?php echo $company_logo['sizes']['logo']; ?>);"<?php endif; ?>>
                        <a href="<?php bloginfo('url'); ?>">My EChef</a>



                    </h1>
                </div>

            </div>




<?php 
//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
if ( is_home() || is_page_template('index.php') ) : 

    get_template_part('includes/content', 'home-focus'); 
 

else : 

    get_template_part('includes/content', 'page-focus'); 

endif; ?>


