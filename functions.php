<?php

/**
 * @package JFW
 * @subpackage Blank
 * @since JFW Blank ! 1.0
 */





/*
 *
 * JFW - 2016-12-21
 * Julien Félix Web Themes plugins
 *
 */

// include 'jfw_plugins/jfw_blazy_support/jfw_blazy_support.php';





if ( ! function_exists( 'jfw_blank_setup' ) )
{

	function jfw_blank_setup()
	{

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		register_nav_menus( array( 'primary' => __( 'Primary Menu', 'jfw_blank' ) ) );
	}

}
add_action( 'after_setup_theme', 'jfw_blank_setup' );





function jfw_blank_scripts()
{
	wp_enqueue_style( 'jfw-blank-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jfw-blank-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151204', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_blank_scripts' );





/*
 *
 * JFW - 2015-07-30
 * Remove Emoji Support
 *
 */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );





/*
 *
 * JFW - 2015-12-15
 * Remove Tags Support
 *
 */

function myprefix_unregister_tags()
{

    unregister_taxonomy_for_object_type( 'post_tag', 'post' );

}
add_action( 'init', 'myprefix_unregister_tags' );





/*
 *
 * JFW - 2015-09-28
 * Remove from Dashboard Widgets
 *
 */

function remove_dashboard_widgets()
{

	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
	remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); // activity panel
	remove_action('welcome_panel', 'wp_welcome_panel'); // welcome panel
	// use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.

}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');





/*
 *
 * JFW - 2015-09-28
 * Remove WP Customize Tools
 *
 */

function remove_customize()
{
	$customize_url_arr = array();
	$customize_url_arr[] = 'customize.php'; // 3.x
	$customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
	$customize_url_arr[] = $customize_url; // 4.0 & 4.1
	if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') )
	{
		$customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
		$customize_url_arr[] = 'custom-header'; // 4.0
	}
	if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') )
	{
		$customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
		$customize_url_arr[] = 'custom-background'; // 4.0
	}
	foreach ( $customize_url_arr as $customize_url ) {
		remove_submenu_page( 'themes.php', $customize_url );
	}
}
add_action( 'admin_menu', 'remove_customize', 999 );





/*
 *
 * JFW - 2015-07-30
 * Remove from Backend Adminbar
 *
 */

function remove_admin_bar_links() {

	global $wp_admin_bar;

	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('about');
	$wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('documentation');
	$wp_admin_bar->remove_menu('support-forums');
	$wp_admin_bar->remove_menu('feedback');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('w3tc');
	$wp_admin_bar->remove_menu('customize');

}

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );





/*
 *
 * JFW - 2015-08-16
 * Shortcode to project emails
 * [email mail="mail@domain.com"]Email[/email]
 *
 */

function wpcodex_hide_email_shortcode( $atts , $content = null )
{

	$a = shortcode_atts( array( 'mail' => 'null' ), $atts );

	if ( ! is_email( $a['mail'] ) ) {
		return;
	}
	if ( $a['mail'] == 'null' ) {
		return;
	}
	if ( $content == 'null' ) {
		return;
	}

	$pretty_content;

	if( is_email( $content ) ) {
		$pretty_content = antispambot( $content );
	}else{
		$pretty_content = $content;
	}

	return '<a href="mailto:' . antispambot( $a['mail'] ) . '">' . $pretty_content . '</a>';

}

add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );



// !JFW - Remove from Backend Sidebar

function remove_menus ()
{
	global $menu;
	$restricted = array(
		__('Comments')
	);
	end( $menu );
	while( prev( $menu ) )
	{
		$value = explode( ' ', $menu[ key( $menu ) ][0] );
		if( in_array( $value[0] != NULL?$value[0]:"" , $restricted ) ) {
			unset( $menu[ key( $menu ) ] );
		}
	}
}
add_action('admin_menu', 'remove_menus');