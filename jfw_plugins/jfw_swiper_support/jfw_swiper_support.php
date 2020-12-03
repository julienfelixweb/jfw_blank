<?php

/**
 * Plugin Name: JFW Swiper Support
 * Plugin URI: https://wicky.nillia.ms/headroom.js/
 * Description: Add JS swiper.js
 * Version: 1.0.0
 * Author: ©
 * Author URI: http://julienfelix.com
 * License:
 */
 
function jfw_swiper_scripts()
{
	wp_enqueue_style( 'jfw-swiper-style', get_stylesheet_uri(), array(), md5(filemtime(dirname(__FILE__) . "/jfw_plugins/jfw_swiper_support/css/swiper.min.css")) );
	wp_enqueue_script( 'jfw-swiper-script', get_template_directory_uri() . '/jfw_plugins/jfw_swiper_support/js/swiper.min.js', array( 'jquery' ), '20200420', true );
}
add_action( 'wp_enqueue_scripts', 'jfw_swiper_scripts' );