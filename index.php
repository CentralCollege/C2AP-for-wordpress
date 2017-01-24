<?php
/*
Plugin Name: C2AP for WordPress
Plugin URI: https://github.com/CentralCollege/C2AP-for-wordpress
Description: Core functionality for Central College WordPress installs.
Version: 2.0.0
Author: Jacob Oyen (@jacoboyen)
*/

// -----------------------------------------------------------------------
// Expanded user profiles
// -----------------------------------------------------------------------
function cui_show_expanded_profile_fields($user){?>
	<h3>Social Media</h3>
    <table class="form-table">
    	<tbody>
        	<tr>
                <th>
                	<label for="twitter">Twitter</label>
                </th>
                <td>
                	<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" />
                    <span class="description">Enter your twitter user: Example: @centralcollege</span>
                </td>
			</tr>
            <tr>
                <th>
                	<label for="facebook">Facebook</label>
                </th>
                <td>
                	<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" />
                    <span class="description">Enter the full facebook URL for your account: http://facebook.com/centralcollege/</span>
                </td>
			</tr>
		</tbody>
	</table>
<?php }

add_action('show_user_profile', 'cui_show_expanded_profile_fields');
add_action('edit_user_profile', 'cui_show_expanded_profile_fields');

function cui_save_expanded_profile_fields($user_id){
	if (!current_user_can('edit_user', $user_id)) return false;

		update_usermeta($user_id, 'twitter', $_POST['twitter']);
		update_usermeta($user_id, 'facebook', $_POST['facebook']);
}
add_action( 'personal_options_update', 'cui_save_expanded_profile_fields' );
add_action( 'edit_user_profile_update', 'cui_save_expanded_profile_fields' );

// -----------------------------------------------------------------------
// Remove admin color schemes option
// -----------------------------------------------------------------------
function cui_remove_admin_color_scheme(){
	global $_wp_admin_css_colors;
	$_wp_admin_css_colors = 0;
}
add_action('admin_head', 'cui_remove_admin_color_scheme');

// -----------------------------------------------------------------------
// Set session timeout to 60 minutes
// -----------------------------------------------------------------------
function cui_cookie_expiration($expiration){
	return 3600;
}
add_filter('auth_cookie_expiration', 'cui_central_cookie_expiration');

// -----------------------------------------------------------------------
// Add styles to WordPress admin
// -----------------------------------------------------------------------
function cui_load_homepage_admin_styles(){
	wp_enqueue_style('central-style', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), '0.0.1');
}
add_action('admin_enqueue_scripts', 'cui_load_homepage_admin_styles');

// -----------------------------------------------------------------------
// Change login screen
// -----------------------------------------------------------------------
function cui_login_styles(){
  wp_enqueue_style('central-login-style', plugin_dir_url( __FILE__ ) . 'css/login.css', array(), '0.0.1');
}
add_action( 'login_enqueue_scripts', 'cui_login_styles', 10);


?>
