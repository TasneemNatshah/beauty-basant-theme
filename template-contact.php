<?php
/**
 * Template Name: Contact Us
 *
 * @package BeautyBasant
 */

get_header();
beauty_basant_page_hero( __( 'Get In Touch', 'beauty-basant' ), get_the_title() );
?>

<main id="primary" class="site-main section contact-page">

	<div class="contact-grid">
		<div class="contact-card">
			<i class="ti ti-mail"></i>
			<h3><?php esc_html_e( 'Email Us', 'beauty-basant' ); ?></h3>
			<p><a href="mailto:<?php echo esc_attr( beauty_basant_opt( 'contact_email', 'info@beautybasant.com' ) ); ?>"><?php echo esc_html( beauty_basant_opt( 'contact_email', 'info@beautybasant.com' ) ); ?></a></p>
		</div>
		<div class="contact-card">
			<i class="ti ti-phone"></i>
			<h3><?php esc_html_e( 'Call Us', 'beauty-basant' ); ?></h3>
			<p><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', beauty_basant_opt( 'contact_phone', '' ) ) ); ?>"><?php echo esc_html( beauty_basant_opt( 'contact_phone', '+962 7 9000 0000' ) ); ?></a></p>
		</div>
		<div class="contact-card">
			<i class="ti ti-map-pin"></i>
			<h3><?php esc_html_e( 'Visit Us', 'beauty-basant' ); ?></h3>
			<p><?php echo esc_html( beauty_basant_opt( 'contact_address', 'Amman, Jordan' ) ); ?></p>
		</div>
	</div>

	<div class="contact-panel">
		<div class="contact-panel-form">
			<div class="section-title-wrap" style="text-align:left;margin-bottom:25px;">
				<div class="subtitle"><?php esc_html_e( 'Send A Message', 'beauty-basant' ); ?></div>
				<div class="title"><?php esc_html_e( "We'd Love To Hear From You", 'beauty-basant' ); ?></div>
			</div>

			<form class="contact-form">
				<div class="form-row">
					<div class="form-field">
						<label for="cf_name"><?php esc_html_e( 'Name', 'beauty-basant' ); ?></label>
						<input type="text" id="cf_name" name="name" required>
					</div>
					<div class="form-field">
						<label for="cf_email"><?php esc_html_e( 'Email', 'beauty-basant' ); ?></label>
						<input type="email" id="cf_email" name="email" required>
					</div>
				</div>
				<div class="form-field">
					<label for="cf_subject"><?php esc_html_e( 'Subject', 'beauty-basant' ); ?></label>
					<input type="text" id="cf_subject" name="subject">
				</div>
				<div class="form-field">
					<label for="cf_message"><?php esc_html_e( 'Message', 'beauty-basant' ); ?></label>
					<textarea id="cf_message" name="message" rows="5" required></textarea>
				</div>
				<!-- Honeypot: left empty by humans, hidden via CSS -->
				<div class="form-field form-honeypot" aria-hidden="true">
					<label for="cf_website"><?php esc_html_e( 'Website', 'beauty-basant' ); ?></label>
					<input type="text" id="cf_website" name="website" tabindex="-1" autocomplete="off">
				</div>
				<button type="submit" class="btn-primary"><?php esc_html_e( 'Send Message', 'beauty-basant' ); ?></button>
				<div class="form-message" role="status" aria-live="polite"></div>
			</form>
		</div>

		<?php $map_embed = beauty_basant_opt( 'contact_map_embed', '' ); ?>
		<div class="contact-panel-map">
			<?php if ( $map_embed ) : ?>
				<iframe src="<?php echo esc_url( $map_embed ); ?>" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php esc_attr_e( 'Location map', 'beauty-basant' ); ?>"></iframe>
			<?php else : ?>
				<div class="contact-panel-map-placeholder">
					<i class="ti ti-map-2"></i>
					<p><?php esc_html_e( 'Add a Google Maps embed URL in Customize → Contact & Social Links to show a map here.', 'beauty-basant' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) :
			?>
			<div class="entry-content" style="max-width:800px;margin:50px auto 0;color:var(--text-muted);">
				<?php the_content(); ?>
			</div>
			<?php
		endif;
	endwhile;
	?>
</main>

<?php
get_footer();
