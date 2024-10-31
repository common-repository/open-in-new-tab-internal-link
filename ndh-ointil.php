<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://nguyenduyhoang.com/
 * @since             1.0.0
 * @package           Ndh_Ointil
 *
 * @wordpress-plugin
 * Plugin Name:       Open In New Tab Internal Link
 * Plugin URI:        https://bitbucket.org/evilperry/ndh-ointil/downloads/
 * Description:       Open the link in a new tab for the Internal Link in the content of single post.
 * Version:           1.0.0
 * Author:            Nguyễn Duy Hoàng
 * Author URI:        https://nguyenduyhoang.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ndh-ointil
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
define( 'NDH_OINTIL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ndh-ointil-activator.php
 */
function activate_ndh_ointil() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ndh-ointil-activator.php';
	Ndh_Ointil_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ndh-ointil-deactivator.php
 */
function deactivate_ndh_ointil() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ndh-ointil-deactivator.php';
	Ndh_Ointil_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ndh_ointil' );
register_deactivation_hook( __FILE__, 'deactivate_ndh_ointil' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ndh-ointil.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ndh_ointil() {

	$plugin = new Ndh_Ointil();
	$plugin->run();

}
run_ndh_ointil();
