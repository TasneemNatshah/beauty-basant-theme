<?php
/**
 * Auto-creates the Contact Us, Services, Terms & Conditions and Privacy
 * Policy pages on theme activation, if pages with those titles don't
 * already exist.
 *
 * NOTE: the Terms & Privacy content below is generic placeholder boilerplate,
 * not legal advice — the site owner should have it reviewed by a lawyer
 * before relying on it.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_create_page_if_missing( $title, $template = '', $content = '' ) {
	$existing = get_page_by_title( $title, OBJECT, 'page' );
	if ( $existing ) {
		return $existing->ID;
	}

	$page_id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_title'   => $title,
		'post_content' => $content,
		'post_status'  => 'publish',
	) );

	if ( $page_id && ! is_wp_error( $page_id ) && $template ) {
		update_post_meta( $page_id, '_wp_page_template', $template );
	}

	return $page_id;
}

function beauty_basant_seed_pages() {
	if ( get_option( 'beauty_basant_pages_seeded' ) ) {
		return;
	}

	$site_name  = get_bloginfo( 'name' );
	$site_url   = home_url( '/' );
	$admin_mail = get_option( 'admin_email' );

	beauty_basant_create_page_if_missing( __( 'Contact Us', 'beauty-basant' ), 'template-contact.php' );
	beauty_basant_create_page_if_missing( __( 'Services', 'beauty-basant' ), 'template-services.php' );

	$terms_content = "<p>These Terms and Conditions (\"Terms\") govern your use of {$site_name} ({$site_url}). By placing an order or using this website, you agree to be bound by these Terms.</p>

<h2>1. Use of This Site</h2>
<p>You agree to use this website only for lawful purposes and in a way that does not infringe the rights of, restrict, or inhibit anyone else's use of the site.</p>

<h2>2. Products & Pricing</h2>
<p>We make every effort to display our products and their prices accurately. However, we reserve the right to correct any errors, inaccuracies, or omissions, and to change or update information at any time without prior notice.</p>

<h2>3. Orders & Payment</h2>
<p>By placing an order, you confirm that all details you provide are accurate and complete. We reserve the right to refuse or cancel any order for any reason, including product availability, errors in pricing, or suspected fraud.</p>

<h2>4. Shipping & Delivery</h2>
<p>Delivery times are estimates only and are not guaranteed. Risk of loss and title for products pass to you upon delivery.</p>

<h2>5. Returns & Refunds</h2>
<p>Please refer to our Return Policy for information about returning products and requesting refunds.</p>

<h2>6. Intellectual Property</h2>
<p>All content on this site, including text, graphics, logos, and images, is the property of {$site_name} or its licensors and is protected by applicable intellectual property laws.</p>

<h2>7. Limitation of Liability</h2>
<p>{$site_name} shall not be liable for any indirect, incidental, or consequential damages arising from your use of this website or its products.</p>

<h2>8. Changes to These Terms</h2>
<p>We may update these Terms from time to time. Continued use of the site after changes are posted constitutes your acceptance of the revised Terms.</p>

<h2>9. Contact Us</h2>
<p>If you have any questions about these Terms, please contact us at <a href=\"mailto:{$admin_mail}\">{$admin_mail}</a>.</p>

<p><em>This is a general template and does not constitute legal advice. Please have these Terms reviewed by a qualified professional before publishing.</em></p>";

	beauty_basant_create_page_if_missing( __( 'Terms and Conditions', 'beauty-basant' ), '', $terms_content );

	$privacy_content = "<p>This Privacy Policy explains how {$site_name} (\"we\", \"us\", \"our\") collects, uses, and protects your personal information when you visit or shop on {$site_url}.</p>

<h2>1. Information We Collect</h2>
<p>We may collect personal information such as your name, email address, shipping address, phone number, and payment details when you place an order, create an account, or contact us.</p>

<h2>2. How We Use Your Information</h2>
<p>We use your information to process orders, provide customer support, send order updates, and — with your consent — send marketing communications. We do not sell your personal information to third parties.</p>

<h2>3. Cookies</h2>
<p>This site uses cookies to keep track of your cart contents, remember your preferences, and understand how visitors use the site.</p>

<h2>4. Payment Processing</h2>
<p>Payments are processed securely by our payment gateway providers. We do not store your full payment card details on our servers.</p>

<h2>5. Sharing Your Information</h2>
<p>We may share your information with trusted third parties who help us operate our business, such as shipping carriers and payment processors, solely to fulfill your order.</p>

<h2>6. Data Retention</h2>
<p>We retain your personal information only as long as necessary to fulfill the purposes described in this policy, or as required by law.</p>

<h2>7. Your Rights</h2>
<p>You may request access to, correction of, or deletion of your personal information at any time by contacting us.</p>

<h2>8. Changes to This Policy</h2>
<p>We may update this Privacy Policy from time to time. Any changes will be posted on this page.</p>

<h2>9. Contact Us</h2>
<p>If you have questions about this Privacy Policy, please contact us at <a href=\"mailto:{$admin_mail}\">{$admin_mail}</a>.</p>

<p><em>This is a general template and does not constitute legal advice. Please have this policy reviewed by a qualified professional before publishing.</em></p>";

	$privacy_page_id = beauty_basant_create_page_if_missing( __( 'Privacy Policy', 'beauty-basant' ), '', $privacy_content );

	if ( $privacy_page_id && ! is_wp_error( $privacy_page_id ) && ! get_option( 'wp_page_for_privacy_policy' ) ) {
		update_option( 'wp_page_for_privacy_policy', $privacy_page_id );
	}

	update_option( 'beauty_basant_pages_seeded', 1 );
}
add_action( 'after_switch_theme', 'beauty_basant_seed_pages' );
add_action( 'init', 'beauty_basant_seed_pages', 20 );
