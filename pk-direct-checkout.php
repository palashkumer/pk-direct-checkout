<?php
/**
 * Plugin Name: PK WooCom Direct Checkout
 * Description: This is about wooCom direct checkout button
 * Version: 1.0.0
 * Author: Palash Kumer
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function pkwcdc_enqueue_styles() {
	wp_enqueue_style( 'your-plugin-styles', plugins_url( 'assets/css/style.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'pkwcdc_enqueue_styles' );


function pkdc_button() {
	include plugin_dir_path( __FILE__ ) . 'templates/pkdc-button.php';
}
add_action( 'woocommerce_after_shop_loop_item', 'pkdc_button' );
