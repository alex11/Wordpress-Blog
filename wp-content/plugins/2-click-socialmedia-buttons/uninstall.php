<?php
/**
 * Uninstall
 *
 * Cleaning up the Database
 */

global $wpdb;

if(!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}

delete_option('twoclick_buttons_settings');
?>