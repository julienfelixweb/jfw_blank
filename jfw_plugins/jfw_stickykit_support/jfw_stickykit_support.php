<?php

/**
 * Plugin Name: JFW Sticky Kit Support
 * Plugin URI: http://leafo.net/sticky-kit/
 * Description: Add JS jquery.sticky-kit.min.js
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_stickykit_scripts()
{
	wp_enqueue_script( 'jfw-stickykit-script', get_template_directory_uri() . '/jfw_plugins/jfw_stickykit_support/js/jquery.sticky-kit.min.js', array( 'jquery' ), '201680110', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_stickykit_scripts' );