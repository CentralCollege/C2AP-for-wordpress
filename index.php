<?php
/*
Plugin Name: C2AP for WordPress
Plugin URI: https://github.com/CentralCollege/C2AP-for-wordpress
Description: Expands Central College branding and features.
Version: 1.0.0
Author: Jacob Oyen (@jacoboyen)
*/
// -----------------------------------------------------------------------
// Customize the login screen
// -----------------------------------------------------------------------
function central_college_login_styles(){
	wp_enqueue_style('custom-login', plugin_dir_url( __FILE__ ) . 'login.css');
}
add_action('login_enqueue_scripts', 'central_college_login_styles');

// -----------------------------------------------------------------------
// Behind the scenes things that we want this plugin to do
// -----------------------------------------------------------------------
//Disable pingbacks
add_filter('xmlrpc_methods', 'remove_xmlrpc_pingback');
function remove_xmlrpc_pingback($methods){
	unset($methods['pingback.ping']);
	return $methods;
}

//Set session timeout to 20 minutes
function central_cookie_expiration($expiration){
	return 14400;
}
add_filter('auth_cookie_expiration', 'central_cookie_expiration');

?>
