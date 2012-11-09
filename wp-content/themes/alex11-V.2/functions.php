<?php
if ( function_exists('register_sidebar') ){
	register_sidebar( array(
		'name' => __( ' Startseite - Nicht angemeldete Benutzer', 'buddypress' ),
		'id' => 'fullside-only-loggedout-homepage-widget-area',
		'description' => __( 'The full side homepage widget area only logged out', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Startseite - 1. volle Breite', 'buddypress' ),
		'id' => 'first-fullside-homepage-widget-area',
		'description' => __( 'The first full side homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
    register_sidebar( array(
		'name' => __( 'Startseite - Links', 'buddypress' ),
		'id' => 'left-homepage-widget-area',
		'description' => __( 'The left homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 7, located in the pagetemplate. Empty by default.
	register_sidebar( array(
		'name' => __( 'Startseite - Rechts', 'buddypress' ),
		'id' => 'right-homepage-widget-area',
		'description' => __( 'The right homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Startseite - 2. volle Breite', 'buddypress' ),
		'id' => 'second-fullside-homepage-widget-area',
		'description' => __( 'The second full side homepage widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
