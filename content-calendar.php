<?php

/*

Plugin Name: Content Calendar
Author: Mithilesh
Version: 1.0.0

*/

if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !defined( 'CALENDAR_PLUGIN_VERSION' ) ) {
    define( 'CALENDAR_PLUGIN_VERSION', '1.0.0' );
}

if( !defined( 'CALENDAR_PLUGIN_DIR' ) ) {
    define( 'CALENDAR_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
}

if( !defined( 'CALENDAR_PLUGIN_DIR_PATH' ) ) {
    define( 'CALENDAR_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Enqueue Scripts

require CALENDAR_PLUGIN_DIR_PATH  . 'scripts.php';

// Adding Settings page of our plugin

require CALENDAR_PLUGIN_DIR_PATH . 'Include/event-page.php';

// Adding Form to the page

require CALENDAR_PLUGIN_DIR_PATH . 'Include/event-form.php';

// Create table

require CALENDAR_PLUGIN_DIR_PATH . 'Include/db.php';

?>
