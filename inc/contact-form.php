<?php
/**
 * Contact page: AJAX form handler that emails the site admin.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_handle_contact_form() {
	check_ajax_referer( 'beauty_basant_contact', 'nonce' );

	// Honeypot — bots fill every field, humans never see this one.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => __( 'Thanks! Your message has been sent.', 'beauty-basant' ) ) );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in your name, a valid email, and a message.', 'beauty-basant' ) ) );
	}

	$to      = beauty_basant_opt( 'contact_email', get_option( 'admin_email' ) );
	$subject = $subject ? $subject : __( 'New contact form message', 'beauty-basant' );

	$body  = sprintf( "%s: %s\n", __( 'Name', 'beauty-basant' ), $name );
	$body .= sprintf( "%s: %s\n\n", __( 'Email', 'beauty-basant' ), $email );
	$body .= $message;

	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, wp_specialchars_decode( $subject ), $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( 'Thanks! Your message has been sent — we\'ll get back to you soon.', 'beauty-basant' ) ) );
	}

	wp_send_json_error( array( 'message' => __( 'Sorry, something went wrong sending your message. Please try again later.', 'beauty-basant' ) ) );
}
add_action( 'wp_ajax_beauty_basant_contact', 'beauty_basant_handle_contact_form' );
add_action( 'wp_ajax_nopriv_beauty_basant_contact', 'beauty_basant_handle_contact_form' );
