<?php
global $product;
if ( $product->is_type( 'simple' ) ) {
			$product_id = $product->get_id();

				$checkout_url  = wc_get_checkout_url();
				$buy_now_url   = esc_url( add_query_arg( 'add-to-cart', $product_id, $checkout_url ) );
				$buy_now_label = get_option( 'buy_now_button_label', 'Buy Now' );
				$button_color  = get_option( 'buy_now_button_color', '#0073e5' );
				$font_color    = get_option( 'buy_now_font_color', '#ffffff' );
				$font_size     = get_option( 'buy_now_font_size', 16 );

	?>

			<a href="<?php echo esc_url( $buy_now_url ); ?>" class="buy-now-button" style="background-color: <?php echo esc_attr( $button_color ); ?>;
				color: <?php echo esc_attr( $font_color ); ?>;
				font-size: <?php echo esc_attr( $font_size ) . 'px'; ?>;">
				<?php echo esc_html( $buy_now_label ); ?>
			</a>
<?php } ?>
