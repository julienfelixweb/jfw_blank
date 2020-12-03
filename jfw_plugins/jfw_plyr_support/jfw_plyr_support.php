<?php

/**
 * Plugin Name: JFW Plyr Support
 * Plugin URI: https://github.com/sampotts/plyr
 * Description: Add JS plyr
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_plyr_scripts()
{
	wp_enqueue_style( 'jfw-plyr--style', get_template_directory_uri() . '/jfw_plugins/jfw_plyr_support/dist/plyr.css' );
	wp_enqueue_script( 'jfw-plyr-script', get_template_directory_uri() . '/jfw_plugins/jfw_plyr_support/dist/plyr.js', array( 'jquery' ), '20190501', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_plyr_scripts' );