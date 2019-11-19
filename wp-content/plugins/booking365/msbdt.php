<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://scheduler.bdtask.com/
 * @since             1.0.0
 * @package           Msbdt
 *
 * @wordpress-plugin
 * Plugin Name:       Booking365
 * Plugin URI:        http://scheduler.bdtask.com/plugindemo/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            bdtask
 * Author URI:        http://bdtask.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       multi-scheduler
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-msbdt-activator.php
 */
function activate_msbdt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-msbdt-activator.php';
	Msbdt_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-msbdt-deactivator.php
 */
function deactivate_msbdt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-msbdt-deactivator.php';
	Msbdt_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_msbdt' );
register_deactivation_hook( __FILE__, 'deactivate_msbdt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-msbdt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_msbdt() {

	$plugin = new Msbdt();
	$plugin->run();

}
run_msbdt();
