<?php

/**
 * Plugin Name: JFW Be Lazy Support
 * Plugin URI: http://dinbror.dk/blog/blazy/
 * Description: Add JS blazy.js
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_blazy_scripts()
{
	wp_enqueue_script( 'jfw-blazy-script', get_template_directory_uri() . '/jfw_plugins/jfw_blazy_support/js/blazy.min.js', array( 'jquery' ), '20161221', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_blazy_scripts' );