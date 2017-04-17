<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.johnperricruz.com
 * @since             1.0.0
 * @package           Primeview_Scripts
 *
 * @wordpress-plugin
 * Plugin Name:       Primeview Tracking Scripts
 * Plugin URI:        https://www.primeview.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Primeview
 * Author URI:        https://www.johnperricruz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       primeview-scripts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-primeview-scripts-activator.php
 */
function activate_primeview_scripts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-primeview-scripts-activator.php';
	Primeview_Scripts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-primeview-scripts-deactivator.php
 */
function deactivate_primeview_scripts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-primeview-scripts-deactivator.php';
	Primeview_Scripts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_primeview_scripts' );
register_deactivation_hook( __FILE__, 'deactivate_primeview_scripts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-primeview-scripts.php';
require plugin_dir_path( __FILE__ ) . 'apis/ScriptController.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_primeview_scripts() {
	$ScriptController = new ScriptController();
	
	$plugin = new Primeview_Scripts();
	$plugin->run();
}
run_primeview_scripts();
