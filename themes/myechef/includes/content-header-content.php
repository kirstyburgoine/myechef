<?php 
$banner_color = get_field('banner_colour_overlay', 'option');
if ( !$banner_color ) : $banner_color = "none"; endif;
?>

<div class="container">

    <div class="grid">

		<div class="grid__item two-fifths lap-one-third desk-one-fifth">
        </div><!--

        
        --><div class="grid__item three-fifths lap-two-thirds desk-four-fifths">
    

            <div class="utility-nav-container">

                <ul class="nav  nav--block  menu hover-color-<?php echo strtolower($banner_color); ?>">

                    <?php 
                    $current_user = wp_get_current_user();

                    if ( !is_user_logged_in() ) : ?>
                    <li>
                        <p><span class="ss-icon ss-users"></span> Hello there</p>
                    </li><!--
                    --><li>
                        <a href="#" data-reveal-id="loginModal" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal"><span class="ss-icon ss-lock"></span> Log In</a>
                    </li>
                        
                    <?php else : ?>  

                    <li>
                        <p><span class="ss-icon ss-users"></span> Hello <?php echo $current_user->user_firstname; ?></p>
                    </li><!--
                    --><li>
                        <a href="<?php bloginfo('url');?>/saved-recipes"><span class="ss-icon ss-attach"></span> Recipe Collections</a>
                    </li><!--
                    --><li>
                        <a href="#" data-reveal-id="logoutModal" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal"><span class="ss-icon ss-logout"></span> Log Out</a>
                    </li>  
                        
                    <?php endif; ?>    

                    
                </ul>

            </div>

        </div>

    </div>

</div>