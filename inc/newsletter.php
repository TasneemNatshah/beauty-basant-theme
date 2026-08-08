<?php
/**
 * Newsletter signup: stores subscriber emails as a custom post type entry.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_register_subscriber_cpt() {
	register_post_type( 'nl_subscriber', array(
		'labels' => array(
			'name'          => __( 'Newsletter Subscribers', 'beauty-basant' ),
			'singular_name' => __( 'Subscriber', 'beauty-basant' ),
			'menu_name'     => __( 'Subscribers', 'beauty-basant' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'edit.php?post_type=hero_slide',
		'supports'            => array( 'title' ),
		'capabilities'        => array(
			'create_posts' => 'do_not_allow',
		),
		'map_meta_cap'        => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
	) );
}
add_action( 'init', 'beauty_basant_register_subscriber_cpt' );

function beauty_basant_handle_subscribe() {
	check_ajax_referer( 'beauty_basant_newsletter', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'beauty-basant' ) ) );
	}

	$existing = get_page_by_title( $email, OBJECT, 'nl_subscriber' );
	if ( $existing ) {
		wp_send_json_success( array( 'message' => __( 'You are already subscribed. Thank you!', 'beauty-basant' ) ) );
	}

	wp_insert_post( array(
		'post_type'   => 'nl_subscriber',
		'post_title'  => $email,
		'post_status' => 'publish',
	) );

	wp_send_json_success( array( 'message' => __( 'Thanks for subscribing! Check your inbox for your 10% off code.', 'beauty-basant' ) ) );
}
add_action( 'wp_ajax_beauty_basant_subscribe', 'beauty_basant_handle_subscribe' );
add_action( 'wp_ajax_nopriv_beauty_basant_subscribe', 'beauty_basant_handle_subscribe' );
