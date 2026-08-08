<?php
/**
 * Reusable template helper functions.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output star rating icons (Tabler icons) for a 1-5 integer rating.
 */
function beauty_basant_star_rating( $rating = 5 ) {
	$rating = max( 0, min( 5, (int) $rating ) );
	$out    = '';
	for ( $i = 0; $i < 5; $i++ ) {
		$out .= $i < $rating ? '<i class="ti ti-star-filled"></i>' : '<i class="ti ti-star"></i>';
	}
	return $out;
}

/**
 * Render the WooCommerce cart count badge (0 if WooCommerce is inactive).
 */
function beauty_basant_cart_count() {
	if ( class_exists( 'WooCommerce' ) && WC()->cart ) {
		return WC()->cart->get_cart_contents_count();
	}
	return 0;
}

/**
 * URL helper: cart page (falls back to '#').
 */
function beauty_basant_cart_url() {
	if ( function_exists( 'wc_get_cart_url' ) ) {
		return wc_get_cart_url();
	}
	return '#';
}

/**
 * URL helper: account page (falls back to '#').
 */
function beauty_basant_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'myaccount' );
	}
	return '#';
}
