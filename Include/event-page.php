<?php

function register_event_page() {

    add_menu_page( 
        __('Content Calendar', 'content-calendar'),
        'Content Calendar',
        'manage_options',
        'content-calendar',
        'content_calendar_callback',
        'dashicons-calendar-alt',
        40
     );


    add_submenu_page(
        'content-calendar',
        __('Schedule Event', 'content-calendar'),
        __('Schedule Event', 'content-calendar'),
        'manage_options',
        'schedule-event',
        'event_page_html'
    );

    add_submenu_page(
	    'content-calendar',
		__('View Schedule', 'content-calendar'),
		__('View Schedule', 'content-calendar'),
		'manage_options',
		'view-schedule',
		'print_schedule'
	);
}

add_action( 'admin_menu', 'register_event_page' );

?>