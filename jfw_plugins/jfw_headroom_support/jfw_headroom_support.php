<?php

/**
 * Plugin Name: JFW Headroom Support
 * Plugin URI: https://wicky.nillia.ms/headroom.js/
 * Description: Add JS headroom.js
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_headroom_scripts()
{
	wp_enqueue_script( 'jfw-headroom-script', get_template_directory_uri() . '/jfw_plugins/jfw_headroom_support/js/headroom.min.js', array( 'jquery' ), '201680110', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_headroom_scripts' );