<?php // functions/users-roles.php


 //**************************************************
// Functions for custom roles and capabilities




function add_editor_capability() {

    $role = get_role( 'editor' );
    $role->add_cap( 'export' ); 
}
add_action( 'admin_init', 'add_editor_capability');



 //**************************************************
// Used to prevent sub site editors from creating administrator users for their site.
class JPB_User_Caps {

  // Add our filters
  function JPB_User_Caps(){
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }

  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

$jpb_user_caps = new JPB_User_Caps();



//Giving Editors Access to Gravity Forms
function add_grav_forms(){
        $role = get_role('editor');
        $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');