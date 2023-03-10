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

if( !function_exists( 'calendar_plugin_scripts' ) ) {
    function calendar_plugin_scripts() {
        
        wp_enqueue_style( 'content-calendar-css', CALENDAR_PLUGIN_DIR. 'Assets/CSS/style.css', [], '1.0.0', true );
    }
    
    add_action( 'wp_enqueue_scripts', 'calendar_plugin_scripts' );
}

?>