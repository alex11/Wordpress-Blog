<?php
// Area 6, located in the pagetemplate. Empty by default.
if ( function_exists('register_sidebar') ){
    register_sidebar( array(
		'name' => __( 'First Homepage Widget Area', 'buddypress' ),
		'id' => 'first-homepage-widget-area',
		'description' => __( 'The first homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 7, located in the pagetemplate. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Homepage Widget Area', 'buddypress' ),
		'id' => 'second-homepage-widget-area',
		'description' => __( 'The second homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
