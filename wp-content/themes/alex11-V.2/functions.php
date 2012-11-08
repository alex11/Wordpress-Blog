<?php
// Area 6, located in the pagetemplate. Empty by default.
if ( function_exists('register_sidebar') ){
	register_sidebar( array(
		'name' => __( 'First full side Homepage Widget Area', 'buddypress' ),
		'id' => 'first-fullside-homepage-widget-area',
		'description' => __( 'The first full side homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
    register_sidebar( array(
		'name' => __( 'Left Homepage Widget Area', 'buddypress' ),
		'id' => 'left-homepage-widget-area',
		'description' => __( 'The left homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 7, located in the pagetemplate. Empty by default.
	register_sidebar( array(
		'name' => __( 'Right Homepage Widget Area', 'buddypress' ),
		'id' => 'right-homepage-widget-area',
		'description' => __( 'The right homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Second full side Homepage Widget Area', 'buddypress' ),
		'id' => 'second-fullside-homepage-widget-area',
		'description' => __( 'The second full side homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
