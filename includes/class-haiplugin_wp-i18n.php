<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://haicreative.com
 * @since      1.0.0
 *
 * @package    Haiplugin_wp
 * @subpackage Haiplugin_wp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Haiplugin_wp
 * @subpackage Haiplugin_wp/includes
 * @author     Ardika JM Consulting <ardi@jm-consulting.id>
 */
class Haiplugin_wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'haiplugin_wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
