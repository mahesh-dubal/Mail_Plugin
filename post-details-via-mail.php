<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mahesh-d.wisdmlabs.net
 * @since             1.0.0
 * @package           Post_Details_Via_Mail
 *
 * @wordpress-plugin
 * Plugin Name:       Daily Post Details via Mail
 * Plugin URI:        https://mahesh-d.wisdmlabs.net
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Mahesh Dubal
 * Author URI:        https://mahesh-d.wisdmlabs.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       post-details-via-mail
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
define( 'POST_DETAILS_VIA_MAIL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-details-via-mail-activator.php
 */
function activate_post_details_via_mail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-details-via-mail-activator.php';
	Post_Details_Via_Mail_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-details-via-mail-deactivator.php
 */
function deactivate_post_details_via_mail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-details-via-mail-deactivator.php';
	Post_Details_Via_Mail_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_post_details_via_mail' );
register_deactivation_hook( __FILE__, 'deactivate_post_details_via_mail' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-post-details-via-mail.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_post_details_via_mail() {

	$plugin = new Post_Details_Via_Mail();
	$plugin->run();

}
run_post_details_via_mail();
