<?php
global $product;
$product_id    = $product->get_id();
$checkout_url  = wc_get_checkout_url();
$buy_now_url   = esc_url( add_query_arg( 'add-to-cart', $product_id, $checkout_url ) );
$buy_now_label = get_option( 'buy_now_button_label', 'Buy Now' );
?>

<a href="<?php echo $buy_now_url; ?>" class="buy-now-button">
	<?php echo esc_html( $buy_now_label ); ?>
</a>
