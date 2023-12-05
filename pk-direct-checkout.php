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

/**
 * Enqueue styles.
 *
 * @return void
 */
function pkwcdc_enqueue_styles() {
	wp_enqueue_style( 'your-plugin-styles', plugins_url( 'assets/css/style.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'pkwcdc_enqueue_styles' );


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
		'pk_direct_checkout_menu_page_content',
		'',
		5
	);

	// Add submenu page.
	add_submenu_page(
		'pk-direct-checkout',
		'Settings',
		'Settings',
		'manage_options',
		'pk-direct-checkout-settings',
		'pk_direct_checkout_settings_page_content'
	);
}
add_action( 'admin_menu', 'pk_direct_checkout_menu_page' );


/**
 *  Callback function for the main menu page
 *
 * @return void
 */
function pk_direct_checkout_menu_page_content() {
	echo '<div class="wrap"><h2>PK Direct Checkout</h2><p>Hello,I am Palash</p></div>';
}

/**
 * Callback function for the submenu page
 *
 * @return void
 */
function pk_direct_checkout_settings_page_content() {
	?>
	<div class="wrap">
		<h2>PK Direct Checkout Settings</h2>

		<form method="post" action="">
			<label for="buy_now_button_label">Buy Now Button Label: </label>
			<input type="text" name="buy_now_button_label" id="buy_now_button_label" value="<?php echo esc_attr( get_option( 'buy_now_button_label', 'Buy Now' ) ); ?>" />			
			<input type="submit" class="button button-primary" value="Save Changes" />
		</form>
		<?php
		if ( isset( $_POST['buy_now_button_label'] ) ) {
			$new_label = sanitize_text_field( wp_unslash( $_POST['buy_now_button_label'] ) );
			update_option( 'buy_now_button_label', $new_label );
			echo '<div class="updated"><p>Settings saved!</p></div>';
		}
		?>
	</div>
	<?php
}
