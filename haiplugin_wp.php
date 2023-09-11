<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://haicreative.com
 * @since             1.0.1
 * @package           Haiplugin_wp
 *
 * @wordpress-plugin
 * Plugin Name:       Hai Plugins - Language Detection
 * Plugin URI:        https://haicreative.com
 * Description:       This plugin is to detect the language of the form field to avoid spam
 * Version:           1.0.1
 * Author:            Ardika JM Consulting
 * Author URI:        https://haicreative.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       haiplugin_wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HAIPLUGIN_WP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-haiplugin_wp-activator.php
 */
function activate_haiplugin_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-haiplugin_wp-activator.php';
	Haiplugin_wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-haiplugin_wp-deactivator.php
 */
function deactivate_haiplugin_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-haiplugin_wp-deactivator.php';
	Haiplugin_wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_haiplugin_wp' );
register_deactivation_hook( __FILE__, 'deactivate_haiplugin_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-haiplugin_wp.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-haiplugin_wp_functions.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_haiplugin_wp() {

	$plugin = new Haiplugin_wp();
	$plugin->run();

}
run_haiplugin_wp();
