<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://mithilesh.com/
 * @since      1.0.0
 *
 * @package    Content_Calendar
 * @subpackage Content_Calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Content_Calendar
 * @subpackage Content_Calendar/admin
 * @author     Mithilesh <mithilesh.chaudhaudhari@wisdmlabs.com>
 */
class Content_Calendar_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		require_once(dirname(__FILE__) . '/partials/content-calendar-admin-display.php');
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/content-calendar-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/content-calendar-admin.js', array('jquery'), $this->version, false);
	}

	// Register Menu and Sub-menu Pages
	function register_event_page()
	{

		add_menu_page(
			__('Content Calendar', 'content-calendar'),
			'Content Calendar',
			'manage_options',
			'content-calendar',
			array($this, 'content_calendar_callback',),
			'dashicons-calendar-alt',
			40
		);


		add_submenu_page(
			'content-calendar',
			__('Schedule Event', 'content-calendar'),
			__('Schedule Event', 'content-calendar'),
			'manage_options',
			'schedule-event',
			array($this, 'content_calendar_form_callback')
		);

		add_submenu_page(
			'content-calendar',
			__('View Schedule', 'content-calendar'),
			__('View Schedule', 'content-calendar'),
			'manage_options',
			'view-schedule',
			array($this, 'content_calendar_schedule_callback')
		);
	}

	function content_calendar_callback()
	{
?>
		<h1 class="my-plugin-title"><?php esc_html_e(get_admin_page_title()); ?></h1>
	<?php
		event_page_html();
		print_schedule();
	}

	function content_calendar_form_callback()
	{
	?>
		<h1 class="my-plugin-title"><?php esc_html_e(get_admin_page_title()); ?></h1>
	<?php
		event_page_html();
	}

	function content_calendar_schedule_callback()
	{
	?>
		<h1 class="my-plugin-title"><?php esc_html_e(get_admin_page_title()); ?></h1>
		<br><br>
<?php
		print_schedule();
	}



	public function submitBtn()
	{
		if (isset($_POST['submit'])) {
			$this->form_submit();
		}
	}

	public function form_submit()
	{
		global $wpdb;

		if (isset($_POST['date']) && isset($_POST['occassion']) && isset($_POST['post_title']) && isset($_POST['author']) && isset($_POST['reviewer'])) {
			$table_name = $wpdb->prefix . "events";
			$date = sanitize_text_field($_POST['date']);
			$occassion = sanitize_text_field($_POST['occassion']);
			$post_title = sanitize_text_field($_POST['post_title']);
			$author = sanitize_text_field($_POST['author']);
			$reviewer = sanitize_text_field($_POST['reviewer']);

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
}
?>