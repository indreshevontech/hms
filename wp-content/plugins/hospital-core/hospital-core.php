<?php
/**
 * @package hospital
 * @version 1.2
 */
/*
Plugin Name: hospital-core
Plugin URI: www.bdtask.com
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: bdtask
Version: 1.2
Author URI: www.bdtask.com
Text domain: hospital-core
*/

if( !function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if(!is_plugin_active('kingcomposer/kingcomposer.php')){
	
    return;
} 


require_once plugin_dir_path(__FILE__) . '/shortcodes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . '/inc/cp.php';


