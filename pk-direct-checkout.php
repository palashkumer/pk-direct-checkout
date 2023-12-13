<?php
/**
 * Plugin Name: PK WooCommerce Direct Checkout
 * Description: This is about WooCommerce direct checkout button.
 * Version: 1.0.0
 * Author: Palash Kumer
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Function for direct checkout in shop page
 *
 * @return void
 */
function pkdc_shop_page() {
	include plugin_dir_path( __FILE__ ) . 'templates/pkdc-button.php';
}
add_action( 'woocommerce_after_shop_loop_item', 'pkdc_shop_page' );


/**
 * Function for direct checkout in product page
 *
 * @return void
 */
function pkdc_product_page() {
	include plugin_dir_path( __FILE__ ) . 'templates/pkdc-button.php';
}
add_action( 'woocommerce_after_add_to_cart_button', 'pkdc_product_page' );

/**
 * Enqueue styles.
 *
 * @return void
 */
function pkwcdc_admin_enqueue_styles() {

	// Enqueue my existing styles.
	wp_enqueue_style( 'pkwcdc_styles', plugins_url( 'assets/css/admin_style.css', __FILE__ ) );
}

add_action( 'admin_enqueue_scripts', 'pkwcdc_admin_enqueue_styles' );

/**
 * Enqueue styles.
 *
 * @return void
 */
function pkwcdc_enqueue_styles() {
	wp_enqueue_style( 'pkwcdc_styles', plugins_url( 'assets/css/style.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'pkwcdc_enqueue_styles' );


/**
 * Enqueue React Build js File.
 *
 * @return void
 */

function enqueue_admin_scripts() {
	$settings = require plugin_dir_path( __FILE__ ) . 'assets/build/index.asset.php';

	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script(
		'pk_direct_checkout_settings_page_content',
		$plugin_url . '/assets/build/index.js',
		array( 'wp-element', 'wp-api-fetch' ),
		'1.00',
		true
	);

	wp_localize_script(
		'pk_direct_checkout_settings_page_content',
		'pkdcSettings',
		array(
			'nonce' => wp_create_nonce( 'wp_rest' ),
		)
	);
}


add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );


/**
 * Function to add menu page
 *
 * @return void
 */
function pk_direct_checkout_menu_page() {
	add_menu_page(
		'PK Direct Checkout',
		'PK Direct Checkout',
		'manage_options',
		'pk-direct-checkout',
		'pk_direct_checkout_settings_page_content',
		'',
		5
	);
}
add_action( 'admin_menu', 'pk_direct_checkout_menu_page' );



/**
 * Callback function for the Menu page
 *
 * @return void
 */
function pk_direct_checkout_settings_page_content() {
	echo '<div class="wrap"><div id="pkwcdc-settings-root"></div></div>';
}


/**
 * Register REST API Endpoint for saving options.
 */
function pkdc_register_rest_endpoint() {
	register_rest_route(
		'pkdc/v1',
		'/save-options/',
		array(
			'methods'             => 'POST',
			'callback'            => 'pkdc_save_options',
			'permission_callback' => function () {
				return current_user_can( 'manage_options' );
			},
		)
	);
}

add_action( 'rest_api_init', 'pkdc_register_rest_endpoint' );

/**
 * Save Callback Function
 *
 * @return void
 */
function pkdc_save_options( $request ) {

	// $data = $request->get_json_params();

	$data = json_decode( $request->get_body(), true );

	// Validate and sanitize the data.
	$validated_data = array(
		'buy_now_button_label' => sanitize_text_field( $data['buy_now_button_label'] ),
		'buy_now_button_color' => sanitize_hex_color( $data['buy_now_button_color'] ),
		'buy_now_font_color'   => sanitize_hex_color( $data['buy_now_font_color'] ),
		'buy_now_font_size'    => intval( $data['buy_now_font_size'] ),
	);

	// Update options.
	update_option( 'buy_now_button_label', $validated_data['buy_now_button_label'] );
	update_option( 'buy_now_button_color', $validated_data['buy_now_button_color'] );
	update_option( 'buy_now_font_color', $validated_data['buy_now_font_color'] );
	update_option( 'buy_now_font_size', $validated_data['buy_now_font_size'] );

	return rest_ensure_response( 'Options saved successfully.' );
}


/**
 * Register REST API Endpoint for fetching options.
 */
function pkdc_register_get_options_endpoint() {
	register_rest_route(
		'pkdc/v1',
		'/options/',
		array(
			'methods'             => 'GET',
			'callback'            => 'pkdc_get_options',
			'permission_callback' => function () {
				return current_user_can( 'manage_options' );
			},
		)
	);
}

add_action( 'rest_api_init', 'pkdc_register_get_options_endpoint' );

/**
 * Callback function for fetching options.
 *
 * @return WP_REST_Response
 */
function pkdc_get_options() {
	$options = array(
		'buy_now_button_label' => get_option( 'buy_now_button_label', 'Buy Now' ),
		'buy_now_button_color' => get_option( 'buy_now_button_color', '#0073e5' ),
		'buy_now_font_color'   => get_option( 'buy_now_font_color', '#ffffff' ),
		'buy_now_font_size'    => get_option( 'buy_now_font_size', 16 ),
	);

	return rest_ensure_response( $options );
}
