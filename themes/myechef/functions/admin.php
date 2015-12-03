<?php // functions/admin.php

function myechef_widgets_init() {
	//require get_template_directory() . '/inc/widgets.php';
	//register_widget( 'Twenty_Fourteen_Ephemera_Widget' );


	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'myechef' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar that appears on the right of pages.', 'myechef' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Feedback Widget Area', 'myechef' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears in the footer section of the site.', 'myechef' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Homepage Sidebar', 'myechef' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Sidebar thats appears on the right of the homepage only.', 'myechef' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'myechef_widgets_init' );


function mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
    foreach( $caps as $key => $capability ){
 
        if( $capability != 'do_not_allow' )
            continue;
 
        switch( $cap ) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }
 
    return $caps;
}
add_filter( 'map_meta_cap', 'mc_admin_users_caps', 1, 4 );
remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');
 
/**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
function mc_edit_permission_check() {
    global $current_user, $profileuser;
 
    $screen = get_current_screen();
 
    get_currentuserinfo();
 
    if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
        if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
            wp_die( __( 'You do not have permission to edit this user.' ) );
        } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
            wp_die( __( 'You do not have permission to edit this user.' ) );
        }
    }
 
}
add_filter( 'admin_head', 'mc_edit_permission_check', 1, 4 );

?>