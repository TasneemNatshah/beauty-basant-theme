<?php
/**
 * Homepage newsletter signup section.
 *
 * @package BeautyBasant
 */
?>
<section class="section newsletter">
	<div class="subtitle"><?php echo esc_html( beauty_basant_opt( 'newsletter_subtitle', 'Join Our Beauty Club' ) ); ?></div>
	<div class="title"><?php echo esc_html( beauty_basant_opt( 'newsletter_title', 'Get 10% Off Your First Order' ) ); ?></div>
	<p class="desc"><?php echo esc_html( beauty_basant_opt( 'newsletter_desc', 'Subscribe to our newsletter for exclusive discounts and skincare secrets.' ) ); ?></p>
	<form class="newsletter-form">
		<input type="email" name="email" required placeholder="<?php esc_attr_e( 'Enter your email address', 'beauty-basant' ); ?>">
		<button type="submit" class="btn-primary"><?php esc_html_e( 'Subscribe', 'beauty-basant' ); ?></button>
	</form>
	<div class="newsletter-message" role="status" aria-live="polite"></div>
</section>
