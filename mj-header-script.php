<?php

/**
 * @link              http://18.139.104.249/
 * @since             1.0.0
 * @package           MJ Header Script
 *
 * @wordpress-plugin
 * Plugin Name:       MJ Header Script
 * Plugin URI:        http://18.139.104.249/
 * Description:       Display a script on the header for the tracking ID that is set on the settings page
 * Version:           1.0.0
 * Author:            JP Baroma
 * Author URI:        jonathanbaroma@mediajel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mj-header-script
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
define( 'MJ_Header_Script_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_mj_header_script() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mj-header-script-activator.php';
	MJ_Header_Script_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_mj_header_script() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mj-header-script-deactivator.php';
	MJ_Header_Script_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mj_header_script' );
register_deactivation_hook( __FILE__, 'deactivate_mj_header_script' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mj-header-script.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mj_header_script() {

	$plugin = new MJ_Header_Script();
	$plugin->run();

}
run_mj_header_script();
