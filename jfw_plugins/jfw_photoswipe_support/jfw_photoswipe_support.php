<?php

/**
 * Plugin Name: JFW Photo Swipe Support
 * Plugin URI: https://github.com/dimsemenov/photoswipe
 * Description: Add Photo Swipe Files
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_photoswipe_scripts()
{
	wp_enqueue_style( 'jfw-photoswipe-style', get_template_directory_uri() . '/jfw_plugins/jfw_photoswipe_support/dist/photoswipe.css' );
	wp_enqueue_style( 'jfw-photoswipe-skin-style', get_template_directory_uri() . '/jfw_plugins/jfw_photoswipe_support/dist/default-skin/default-skin.css' );
	wp_enqueue_script( 'jfw-photoswipe-script', get_template_directory_uri() . '/jfw_plugins/jfw_photoswipe_support/dist/photoswipe.min.js', array( 'jquery' ), '20200522', true );
	wp_enqueue_script( 'jfw-photoswipe-ui-script', get_template_directory_uri() . '/jfw_plugins/jfw_photoswipe_support/dist/photoswipe-ui-default.min.js', array( 'jquery' ), '20200522', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_photoswipe_scripts' );