<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rimplates.com
 * @since             1.0.0
 * @package           Rimplates
 *
 * @wordpress-plugin
 * Plugin Name:       Rimplates
 * Plugin URI:        https://rimplates.com
 * Description:       Rimplates is a dashboard maker for wordpress. Using this Plugin is simple, install it, RIMPLENET TEMPLATES will appear on your admin dashboard menu (with ability to add / create templates, dashboard ~ it supports both admin dashboard & user dashboard). You display the created templates/dashboard with shortcode, Use shortcode [rimplenet-template id=ID], Change the ID to your template ID created in RIMPLENET TEMPLATES PAGE. E.g if your ID is 5 , your valid shortcode will be [rimplenet-template id=5] 
 * Version:           1.0.0
 * Author:            rimplates
 * Author URI:        https://rimplates.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rimplates
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
define( 'RIMPLATES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rimplates-activator.php
 */
function activate_rimplates() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rimplates-activator.php';
	Rimplates_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rimplates-deactivator.php
 */
function deactivate_rimplates() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rimplates-deactivator.php';
	Rimplates_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rimplates' );
register_deactivation_hook( __FILE__, 'deactivate_rimplates' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rimplates.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rimplates() {

	$plugin = new Rimplates();
	$plugin->run();

}
run_rimplates();
