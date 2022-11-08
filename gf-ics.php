<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/kalamalahala
 * @since             1.0.0
 * @package           Gf_Ics
 *
 * @wordpress-plugin
 * Plugin Name:       Gravity Forms .ics Hook
 * Plugin URI:        https://thejohnson.group/
 * Description:       Hooks into desired form submission and attaches a generated ICS file to the notification.
 * Version:           1.0.0
 * Author:            Tyler Karle
 * Author URI:        https://github.com/kalamalahala
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gf-ics
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
define( 'GF_ICS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gf-ics-activator.php
 */
function activate_gf_ics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gf-ics-activator.php';
	Gf_Ics_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gf-ics-deactivator.php
 */
function deactivate_gf_ics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gf-ics-deactivator.php';
	Gf_Ics_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gf_ics' );
register_deactivation_hook( __FILE__, 'deactivate_gf_ics' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gf-ics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gf_ics() {

	$plugin = new Gf_Ics();
	$plugin->run();

}
run_gf_ics();
