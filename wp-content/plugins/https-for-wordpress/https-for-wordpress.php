<?php
/*
Plugin Name: HTTPS for WordPress
Plugin URI: 
Description: Check to see if SSL is used. This will update any template functions which require SSL to be used.
Author: Chris Black
Version: .2
Author URI: http://cjbonline.org
*/

add_filter('option_siteurl', 'sslForStore');
add_filter('option_home', 'sslForStore');
add_filter('option_url', 'sslForStore');
add_filter('option_wpurl', 'sslForStore');
add_filter('option_stylesheet_url', 'sslForStore');
add_filter('option_template_url', 'sslForStore');


function sslForStore($value) {
	if($_SERVER["HTTPS"] == "on") {
		$value = preg_replace('|/+$|', '', $value);
		$value = preg_replace('|http://|', 'https://', $value);
	}

	return $value;
}

?>
