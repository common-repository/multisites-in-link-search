<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.andyboehm.com
 * @since             1.0.0
 * @package           Multisites_In_Link_Search
 *
 * @wordpress-plugin
 * Plugin Name:       Multisites In Link Search
 * Plugin URI:        https://github.com/GusSalvador/multisites-in-better-link-search
 * Description:       Adds your multisite blogs to the internal link search tool as a Better Internal Link Search modifier. Requires Better Internal Link Search
 * Version:           1.0.0
 * Author:            Andy Boehm
 * Author URI:        www.andyboehm.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       multisites-in-link-search
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
define( 'Multisites_In_Link_Search_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-multisites-in-link-search-activator.php
 */
function activate_Multisites_In_Link_Search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multisites-in-link-search-activator.php';
	Multisites_In_Link_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-multisites-in-link-search-deactivator.php
 */
function deactivate_Multisites_In_Link_Search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multisites-in-link-search-deactivator.php';
	Multisites_In_Link_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Multisites_In_Link_Search' );
register_deactivation_hook( __FILE__, 'deactivate_Multisites_In_Link_Search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-multisites-in-link-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Multisites_In_Link_Search() {

	$plugin = new Multisites_In_Link_Search();
	$plugin->run();

}
run_Multisites_In_Link_Search();
