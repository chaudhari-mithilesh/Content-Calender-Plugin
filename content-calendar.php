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

// Create table

function create_event_tables() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upcoming_events";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        date date NOT NULL,
        occassion text,
        post_title text NOT NULL,
        author varchar(40) NOT NULL,
        reviewer varchar(40) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_event_tables' );

// Form Submmition

function form_submit() {
    global $wpdb;

    if( isset( $_POST['date'] ) && isset( $_POST['occassion'] ) && isset( $_POST['post_title'] ) && isset( $_POST['author'] ) && isset( $_POST['reviewer'] ) ) {
        $table_name = $wpdb->prefix . "upcoming_events";
        $date = sanitize_text_field( $_POST['date'] );
        $occassion = sanitize_text_field( $_POST['occassion'] );
        $post_title = sanitize_text_field( $_POST['post_title'] );
        $author = sanitize_text_field( $_POST['author'] );
        $reviewer = sanitize_text_field( $_POST['reviewer'] );

        $wpdb->insert(
            $table_name,
            array(
                'date'       => $date,
                'occassion'  => $occassion,
                'post_title' => $post_title,
                'author'     => $author,
                'reviewer'   => $reviewer
            )
        );
    }
}

function submitBtn() {
    if( isset( $_POST['submit'] ) ) {
        form_submit();
    }
}

add_action( 'init', 'submitBtn' );

?>
