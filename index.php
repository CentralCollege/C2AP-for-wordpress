<?php
/*
Plugin Name: C2AP for WordPress
Plugin URI: https://github.com/jacoboyen/expanded-wp-profiles
Description: Adds expanded features to WordPress sites that integrate with www.central.edu
Version: 0.01
Author: Jacob Oyen (@jacoboyen)
*/

// -----------------------------------------------------------------------
// Expanded user profiles
// -----------------------------------------------------------------------
function show_expanded_profile_fields($user){?>
	<h3>Social Media</h3>
    <table class="form-table">
    	<tbody>
        	<tr>
                <th>
                	<label for="twitter">Twitter</label>
                </th>
                <td>
                	<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" />
                    <span class="description">Enter the full twitter URL for your account: http://twitter.com/centralcollege/</span>
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

add_action('show_user_profile', 'show_expanded_profile_fields');
add_action('edit_user_profile', 'show_expanded_profile_fields');

function save_expanded_profile_fields($user_id){
	if (!current_user_can('edit_user', $user_id)) return false;
	
		update_usermeta($user_id, 'twitter', $_POST['twitter']);
		update_usermeta($user_id, 'facebook', $_POST['facebook']);
}
add_action( 'personal_options_update', 'save_expanded_profile_fields' );
add_action( 'edit_user_profile_update', 'save_expanded_profile_fields' );

// -----------------------------------------------------------------------
// Add WordPress administation screens
// -----------------------------------------------------------------------
function central_plugin_menu(){
	/*add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );*/
	add_menu_page('Central Config Home', 'C2AP for WP', 'edit_pages', 'central-config', 'central_plugin_menu_display', '//img.centralcollege.info/icons/animal-monkey.png', 99);
	add_submenu_page('central-config', 'Text Area Restrictions', 'Text Area Restrictions', 'manage_options', 'tiny-mce', 'central_plugin_menu_display_tinyMCE' );
	add_submenu_page('central-config', 'Directory Listing', 'Directory Listing', 'edit_pages', 'directory-listing', 'central_plugin_menu_display_directory' );
	add_submenu_page('central-config', 'C2AP login', 'C2AP login', 'edit_pages', 'c2ap-login', 'central_plugin_menu_display_C2APlogin' );
}
// Central Config Page
function central_plugin_menu_display(){
	include 'dashboard.php';	
}
// Text Area Restrictions Page
function central_plugin_menu_display_tinyMCE(){
	include 'tiny-MCE-restrictions.php';
}
// Directory Listing Page
function central_plugin_menu_display_directory(){
	include 'directory.php';
}
// C2AP login
function central_plugin_menu_display_C2APlogin(){
	include 'c2ap.php';
}
add_action('admin_menu', 'central_plugin_menu');

// -----------------------------------------------------------------------
// Behind the scenes things that we want this plugin to do
// -----------------------------------------------------------------------
//Disable pingbacks
add_filter('xmlrpc_methods', 'remove_xmlrpc_pingback');
function remove_xmlrpc_pingback($methods){
	unset($methods['pingback.ping']);
	return $methods;
}
//Remove admin color schemes
function remove_admin_color_scheme(){
	global $_wp_admin_css_colors;
	$_wp_admin_css_colors = 0;
}
add_action('admin_head', 'remove_admin_color_scheme');

//Set session timeout to 20 minutes
function central_cookie_expiration($expiration){
	return 1200;
}
add_filter('auth_cookie_expiration', 'central_cookie_expiration');

?>