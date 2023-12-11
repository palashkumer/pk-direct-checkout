<?php

// Retrieve existing options.
	$button_label = get_option( 'buy_now_button_label', 'Buy Now' );
	$button_color = get_option( 'buy_now_button_color', '#0073e5' );
	$font_color   = get_option( 'buy_now_font_color', '#ffffff' );
	$font_size    = get_option( 'buy_now_font_size', 16 );

	// Check if the form is submitted.
if ( isset( $_POST['submit_pk_direct_checkout_settings'] ) ) {
	// Sanitize and update options.
	$new_label      = sanitize_text_field( $_POST['buy_now_button_label'] );
	$new_color      = sanitize_text_field( $_POST['buy_now_button_color'] );
	$new_font_color = sanitize_text_field( $_POST['buy_now_font_color'] );
	$new_font_size  = sanitize_text_field( $_POST['buy_now_font_size'] );

	update_option( 'buy_now_button_label', $new_label );
	update_option( 'buy_now_button_color', $new_color );
	update_option( 'buy_now_font_color', $new_font_color );
	update_option( 'buy_now_font_size', $new_font_size );

	// Display a success message.
	echo '<div class="updated"><p>Settings saved!</p></div>';
}
?>
	<div class="wrap">
		<h2 class="settings-title">PK Direct Checkout Button Setting</h2>

		<form class="form-container" method="post" action="">

		
		<div class="pkdc-input-field">
				<label class="pkdc-label" for="buy_now_button_label">Buy Now Button Label </label>
				<input type="text" class="input-box-style" name="buy_now_button_label" id="buy_now_button_label" value="<?php echo esc_attr( $button_label ); ?>" />            
			</div>
			
			<div class="pkdc-input-field">
				<label class="pkdc-label" for="buy_now_button_color">Button Color </label>
				<input type="color" class="input-box-style" name="buy_now_button_color" id="buy_now_button_color" value="<?php echo esc_attr( $button_color ); ?>" />
			</div>
			
			
			<div class="pkdc-input-field">
				<label class="pkdc-label" for="buy_now_font_color">Font Color </label>
				<input type="color" class="input-box-style" name="buy_now_font_color" id="buy_now_font_color" value="<?php echo esc_attr( $font_color ); ?>" />
			</div>

			<div class="pkdc-input-field">
				<label class="pkdc-label" for="buy_now_font_size">Font Size </label>
				<input type="number" class="input-box-style" name="buy_now_font_size" id="buy_now_font_size" value="<?php echo esc_attr( $font_size ); ?>" />
			</div>
			
			<div>
				<input type="submit" id="save-btn" class="button button-primary" name="submit_pk_direct_checkout_settings" value="Save Changes" />
			</div>
			
			
		</form>
	</div>
	<?php
