<?php
/**
 * 404 template.
 *
 * @package BeautyBasant
 */

get_header();
?>

<main id="primary" class="site-main section" style="text-align:center;">
	<div class="subtitle"><?php esc_html_e( '404 Error', 'beauty-basant' ); ?></div>
	<div class="title" style="margin-bottom:20px;"><?php esc_html_e( 'Page Not Found', 'beauty-basant' ); ?></div>
	<p style="color:var(--text-muted);max-width:500px;margin:0 auto 30px;">
		<?php esc_html_e( "The page you're looking for doesn't exist or has been moved.", 'beauty-basant' ); ?>
	</p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary"><?php esc_html_e( 'Back to Home', 'beauty-basant' ); ?></a>
</main>

<?php
get_footer();
