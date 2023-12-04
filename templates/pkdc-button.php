<?php
global $product;
$product_id   = $product->get_id();
$checkout_url = wc_get_checkout_url();
$buy_now_url  = esc_url( add_query_arg( 'add-to-cart', $product_id, $checkout_url ) );
?>

<a href="<?php echo $buy_now_url; ?>" class="buy-now-button">
	<?php esc_html_e( 'Buy Now', 'your-text-domain' ); ?>
</a>
