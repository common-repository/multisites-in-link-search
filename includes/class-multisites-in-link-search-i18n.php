<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.andyboehm.com
 * @since      1.0.0
 *
 * @package    Multisites_In_Link_Search
 * @subpackage Multisites_In_Link_Search/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Multisites_In_Link_Search
 * @subpackage Multisites_In_Link_Search/includes
 * @author     Andy Boehm <boehmgraphics@gmail.com>
 */
class Multisites_In_Link_Search_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'multisites-in-link-search',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
