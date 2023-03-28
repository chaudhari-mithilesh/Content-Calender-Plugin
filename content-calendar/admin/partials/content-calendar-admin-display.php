<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://mithilesh.com/
 * @since      1.0.0
 *
 * @package    Content_Calendar
 * @subpackage Content_Calendar/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

function event_page_html()
{

?>
    <div class="form-container">
        <form method="post" class="inp-form">
            <input type="hidden" name="action" value="cc_form">
            <div>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required> <br>
            </div>

            <div>
                <label for="occassion">Occassion:</label>
                <input type="text" name="occassion" id="occassion"> <br>
            </div>

            <div>
                <label for="post_title">Post Title:</label>
                <input type="text" name="post_title" id="title" required> <br>
            </div>

            <div>
                <label for="author">Author:</label>
                <select name="author" id="author" required>
                    <?php
                    $users = get_users(array(
                        'fields' => array('ID', 'display_name')
                    ));
                    foreach ($users as $user) {
                        echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
                    }
                    ?>
                </select> <br>
            </div>

            <div>
                <label for="reviewer">Reviewer:</label>
                <select name="reviewer" id="reviewer" required>
                    <?php
                    $admins = get_users(array(
                        'role'  => 'administrator',
                        'fields' => array('ID', 'display_name')
                    ));

                    foreach ($admins as $admin) {
                        echo '<option value = "' . $admin->ID . '">' . $admin->display_name . '</option>';
                    }
                    ?>
                </select> <br>
            </div>

            <div class="btn">
                <?php submit_button('Schedule Post') ?>
            </div>
        </form>
    </div>
<?php
}

function print_schedule()
{
?>

    <h1 class="tab-title">Upcoming Events</h1>

    <?php

    global $wpdb;
    $table_name = $wpdb->prefix . 'events';

    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE date >= DATE( NOW() ) ORDER BY date");

    echo '<table id="upcoming-table" >';
    echo '<thead><tr><th>ID</th><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row->id . '</td>';
        echo '<td>' . $row->date . '</td>';
        echo '<td>' . $row->occassion . '</td>';
        echo '<td>' . $row->post_title . '</td>';
        echo '<td>' . get_userdata($row->author)->user_login . '</td>';
        echo '<td>' . get_userdata($row->reviewer)->user_login . '</td>';
        echo '</tr>';
    }
    echo '</table>';


    ?>
    <h1 class="tab-title">Closed Events</h1>
<?php

    global $wpdb;
    $table_name = $wpdb->prefix . 'events';

    $data = $wpdb->get_results("SELECT * FROM $table_name WHERE date < DATE(NOW()) ORDER BY date DESC");

    echo '<table id="upcoming-table">';
    echo '<thead><tr><th>ID</th><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row->id . '</td>';
        echo '<td>' . $row->date . '</td>';
        echo '<td>' . $row->occassion . '</td>';
        echo '<td>' . $row->post_title . '</td>';
        echo '<td>' . (get_userdata($row->author) ? get_userdata($row->author)->user_login : 'N/A') . '</td>';
        echo '<td>' . (get_userdata($row->reviewer) ? get_userdata($row->reviewer)->user_login : 'N/A') . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

?>