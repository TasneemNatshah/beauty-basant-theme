<?php
/**
 * Footer template.
 *
 * @package BeautyBasant
 */
?>
	<!-- Footer -->
	<footer class="site-footer" id="contact">
		<div class="footer-grid">
			<div class="footer-col">
				<h3><?php bloginfo( 'name' ); ?></h3>
				<p><?php echo esc_html( beauty_basant_opt( 'footer_about', 'Your trusted destination for premium skincare crafted with authentic Dead Sea mineral nutrients.' ) ); ?></p>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'QUICK LINKS', 'beauty-basant' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-quick-links' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-quick-links',
						'container'      => false,
						'menu_class'     => '',
						'depth'          => 1,
					) );
				} else {
					?>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'beauty-basant' ); ?></a></li>
						<li><a href="#about"><?php esc_html_e( 'Our Story', 'beauty-basant' ); ?></a></li>
						<li><a href="#products"><?php esc_html_e( 'Products', 'beauty-basant' ); ?></a></li>
						<li><a href="#reviews"><?php esc_html_e( 'Reviews', 'beauty-basant' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'CUSTOMER CARE', 'beauty-basant' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-customer-care' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-customer-care',
						'container'      => false,
						'menu_class'     => '',
						'depth'          => 1,
					) );
				} else {
					?>
					<ul>
						<li><a href="#"><?php esc_html_e( 'Shipping & Delivery', 'beauty-basant' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'Return Policy', 'beauty-basant' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'FAQs', 'beauty-basant' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'Terms & Conditions', 'beauty-basant' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'CONTACT US', 'beauty-basant' ); ?></h4>
				<ul class="footer-contact">
					<li><i class="ti ti-mail"></i> <?php echo esc_html( beauty_basant_opt( 'contact_email', 'info@beautybasant.com' ) ); ?></li>
					<li><i class="ti ti-phone"></i> <?php echo esc_html( beauty_basant_opt( 'contact_phone', '+962 7 9000 0000' ) ); ?></li>
					<li><i class="ti ti-map-pin"></i> <?php echo esc_html( beauty_basant_opt( 'contact_address', 'Amman, Jordan' ) ); ?></li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<div>
				<?php
				$copyright = beauty_basant_opt( 'footer_copyright', '© {year} Beauty Basant. All rights reserved.' );
				echo esc_html( str_replace( '{year}', gmdate( 'Y' ), $copyright ) );
				?>
			</div>
			<div class="footer-social">
				<?php
				$social = array(
					'social_instagram' => 'ti-brand-instagram',
					'social_facebook'  => 'ti-brand-facebook',
					'social_whatsapp'  => 'ti-brand-whatsapp',
				);
				foreach ( $social as $key => $icon ) :
					$url = beauty_basant_opt( $key, '#' );
					?>
					<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><i class="ti <?php echo esc_attr( $icon ); ?>"></i></a>
				<?php endforeach; ?>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
