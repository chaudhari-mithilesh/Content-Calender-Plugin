<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://mithilesh.com/
 * @since             1.0.0
 * @package           Content_Calendar
 *
 * @wordpress-plugin
 * Plugin Name:       Content Calendar
 * Plugin URI:        https://http://localhost:10059/content-calendar
 * Description:       This plugin will allow the admin to maintain an event calendar for upcoming and already published posts.
 * Version:           1.0.0
 * Author:            Mithilesh
 * Author URI:        https://mithilesh.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       content-calendar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CONTENT_CALENDAR_VERSION', '1.0.0');
define('CALENDAR_PLUGIN_DIR', plugin_dir_url(__FILE__));
define('CALENDAR_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-content-calendar-activator.php
 */
function activate_content_calendar()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-content-calendar-activator.php';
	Content_Calendar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-content-calendar-deactivator.php
 */
function deactivate_content_calendar()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-content-calendar-deactivator.php';
	Content_Calendar_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_content_calendar');
register_deactivation_hook(__FILE__, 'deactivate_content_calendar');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-content-calendar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

//  $CUSTOM
// Create table
function create_event_tables()
{
	global $wpdb;

	$table_name = $wpdb->prefix . "events";
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name(
        id mediumint(9) AUTO_INCREMENT,
        date date NOT NULL,
        occassion text,
        post_title text NOT NULL,
        author varchar(40) NOT NULL,
        reviewer varchar(40) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

register_activation_hook(__FILE__, 'create_event_tables');

function run_content_calendar()
{

	$plugin = new Content_Calendar();
	$plugin->run();
}
run_content_calendar();
