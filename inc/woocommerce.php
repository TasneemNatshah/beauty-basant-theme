<?php
/**
 * WooCommerce integration & template hooks.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Replace WooCommerce's default wrappers with our own `.section` markup so
 * shop/archive/single pages sit inside the same layout as the rest of the site.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function beauty_basant_wc_wrapper_start() {
	echo '<section class="section woocommerce-page-wrap"><div class="woocommerce-container">';
}
add_action( 'woocommerce_before_main_content', 'beauty_basant_wc_wrapper_start', 10 );

function beauty_basant_wc_wrapper_end() {
	echo '</div></section>';
}
add_action( 'woocommerce_after_main_content', 'beauty_basant_wc_wrapper_end', 10 );

/**
 * Products per row / per page.
 */
add_filter( 'loop_shop_columns', function () { return 3; } );
add_filter( 'loop_shop_per_page', function () { return 12; } );

/**
 * Cart icon in the header links straight to the cart page; account icon to My Account.
 * (Used directly in header.php via beauty_basant_cart_url() / beauty_basant_account_url().)
 */

/**
 * Declare WooCommerce support already added in functions.php; here we just
 * make sure the default WooCommerce stylesheet is disabled since we style
 * WooCommerce markup ourselves in assets/css/theme.css.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Mini helper: featured products for the homepage collection grid.
 */
function beauty_basant_get_homepage_products( $limit = 3 ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return array();
	}

	$featured = wc_get_featured_product_ids();
	$args     = array(
		'status'  => 'publish',
		'limit'   => $limit,
		'orderby' => 'date',
		'order'   => 'DESC',
	);

	if ( ! empty( $featured ) ) {
		$args['include'] = $featured;
		$args['limit']   = $limit;
	}

	return wc_get_products( $args );
}
