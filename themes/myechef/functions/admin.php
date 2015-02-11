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

?>