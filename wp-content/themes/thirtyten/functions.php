<?php

function thirtyten_setup(){

/* Add additional default headers  All Photos are by Aaron Hockley of Hockley Photography */
	$thirty_ten_dir =	get_bloginfo('stylesheet_directory');
	register_default_headers( array (
		'lights' => array (
			'url' => "$thirty_ten_dir/images/lights.jpg",
			'thumbnail_url' => "$thirty_ten_dir/images/lights-thumbnail.jpg",
			'description' => __( 'Lights by Aaron Hockley', 'thirtyten' )
		),
		'train' => array (
			'url' => "$thirty_ten_dir/images/train.jpg",
			'thumbnail_url' => "$thirty_ten_dir/images/train-thumbnail.jpg",
			'description' => __( 'Train by Aaron Hockley', 'thirtyten' )
		),
		'bridge' => array (
			'url' => "$thirty_ten_dir/images/bridge.jpg",
			'thumbnail_url' => "$thirty_ten_dir/images/bridge-thumbnail.jpg",
			'description' => __( 'Bridge by Aaron Hockley', 'thirtyten' )
		)

	));

	/* Remove the twenty ten keep reading link and add my own */
	remove_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );
	add_filter ('excerpt_more', 'thirtyten_excerpt_more' );

}

function thirtyten_excerpt_more($more){
	return '&nbsp;&hellip; <a href="'. get_permalink() . '">' . __('finish&nbsp;reading&nbsp;'.get_the_title() .'', 'twentyten') . '</a>';
}


add_action( 'after_setup_theme', 'thirtyten_setup' );


require_once('text-wrangler.php');
add_filter('gettext', array('Thirty_Ten_Text_Wrangler', 'site_generator'), 10, 4);
add_filter('gettext', array('Thirty_Ten_Text_Wrangler', 'single_meta'), 10, 4);

require_once( STYLESHEETPATH . '/options.php');



