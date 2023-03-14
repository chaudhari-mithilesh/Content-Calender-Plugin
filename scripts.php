<?php

if( !function_exists( 'calendar_plugin_scripts' ) ) {
    function calendar_plugin_scripts() {
        
        wp_register_style( 'content-calendar-css', CALENDAR_PLUGIN_DIR. 'Assets/CSS/style.css' );
        wp_enqueue_style( 'content-calendar-css' );

        wp_enqueue_script('calendar-script', CALENDAR_PLUGIN_DIR. 'Assets/JS/calendar.js');
        wp_localize_script('calendar-script', 'pluginConstants', array(
            'dirPath' => CALENDAR_PLUGIN_DIR_PATH,
            'pluginVersion' => CALENDAR_PLUGIN_VERSION
        ));
    }

    add_action( 'admin_enqueue_scripts', 'calendar_plugin_scripts' );
}

?>