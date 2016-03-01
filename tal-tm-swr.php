<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://twitter.com/zerofoolcoder
 * @since             1.0.0
 * @package           Tal_Tm_Swr
 *
 * @wordpress-plugin
 * Plugin Name:       Talentua TallerMasters Songwriter Reviewer
 * Plugin URI:        https://github.com/zerofoolcoder/talentua-tallermasters-songwriter-reviewer
 * Description:       This plugin allows you to review the candidates registered to the workshop
 * Version:           1.0.2
 * Author:            0FC
 * Author URI:        https://twitter.com/zerofoolcoder
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tal-tm-swr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tal-tm-swr-activator.php
 */
function activate_tal_tm_swr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tal-tm-swr-activator.php';
	Tal_Tm_Swr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tal-tm-swr-deactivator.php
 */
function deactivate_tal_tm_swr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tal-tm-swr-deactivator.php';
	Tal_Tm_Swr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tal_tm_swr' );
register_deactivation_hook( __FILE__, 'deactivate_tal_tm_swr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tal-tm-swr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tal_tm_swr() {

	$plugin = new Tal_Tm_Swr();
	$plugin->run();

}
run_tal_tm_swr();
