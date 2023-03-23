<?php
function event_page_html() {
    
    ?>
      <div class="form-container">
        <form method="post" class = "inp-form">
            <input type="hidden" name="action" value="cc_form">
            <div>
                <label for="date" >Date:</label>
                <input type="date" name="date" id="date" required> <br>
            </div>

            <div>
                <label for="occassion" >Occassion:</label>
                <input type="text" name="occassion" id="occassion"> <br>
            </div>

            <div>
                <label for="post_title" >Post Title:</label>
                <input type="text" name="post_title" id="title" required> <br>
            </div>

            <div>
                <label for="author" >Author:</label>
                <select name="author" id="author" required>
                    <?php
                        $users = get_users( array(
                            'fields' =>array( 'ID', 'display_name' )
                        ) );
                        foreach ($users as $user) {
                            echo '<option value="' . $user->ID . '">'. $user->display_name . '</option>';
                        }
                    ?>
                </select> <br>
            </div>

            <div>
                <label for="reviewer">Reviewer:</label>
                <select name="reviewer" id="reviewer" required>
                    <?php
                    $admins = get_users( array(
                        'role'  => 'administrator',
                        'fields'=> array( 'ID', 'display_name' )
                    ) );

                    foreach( $admins as $admin ) {
                        echo '<option value = "' . $admin->ID . '">' . $admin->display_name . '</option>';
                    }
                    ?>
                </select> <br>
            </div>

            <div class="btn">
                <?php submit_button( 'Schedule Post' ) ?>
            </div>
        </form>
    </div>
    <?php
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

?>