<?php
/**
 * Homepage products / collection section.
 * Uses WooCommerce featured products when WooCommerce is active,
 * otherwise falls back to static demo cards.
 *
 * @package BeautyBasant
 */
$collection_chosen = get_theme_mod( 'collection_products', array() );
$collection_limit  = ! empty( $collection_chosen ) ? count( $collection_chosen ) : 3;
$img_height        = (int) get_theme_mod( 'collection_image_height', 200 );
$img_height        = $img_height ? $img_height : 200;
?>
<section class="section" id="products" style="--product-img-height: <?php echo esc_attr( $img_height ); ?>px;">
	<div class="section-title-wrap">
		<div class="subtitle"><?php esc_html_e( 'Our Collection', 'beauty-basant' ); ?></div>
		<div class="title"><?php esc_html_e( 'Dead Sea Essentials', 'beauty-basant' ); ?></div>
	</div>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>

		<?php
		$products = beauty_basant_get_homepage_products( $collection_limit );
		if ( $products ) :
			?>
			<ul class="products product-grid">
				<?php foreach ( $products as $product ) : ?>
					<li class="product-card">
						<a href="<?php echo esc_url( $product->get_permalink() ); ?>" style="text-decoration:none;color:inherit;">
							<div class="product-img" style="background-image:url('<?php echo esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'beauty-basant-product' ) ?: wc_placeholder_img_src() ); ?>');"></div>
							<div class="product-info">
								<div class="product-name"><?php echo esc_html( $product->get_name() ); ?></div>
								<div class="product-desc"><?php echo esc_html( wp_trim_words( $product->get_short_description() ? $product->get_short_description() : $product->get_description(), 14 ) ); ?></div>
								<div class="product-bottom">
									<div class="product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
									<span class="btn-outline"><?php esc_html_e( 'View Product', 'beauty-basant' ); ?></span>
								</div>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="view-all-wrap">
				<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn-primary"><?php esc_html_e( 'View All Products', 'beauty-basant' ); ?></a>
			</div>
		<?php else : ?>
			<p style="text-align:center;color:var(--text-muted);">
				<?php esc_html_e( 'No products yet — add products in WooCommerce and mark a few as Featured to display them here.', 'beauty-basant' ); ?>
			</p>
		<?php endif; ?>

	<?php else : ?>

		<div class="product-grid">
			<div class="product-card">
				<div class="product-img" style="background-image: url('https://images.unsplash.com/photo-1567928269937-21468778d528?auto=format&fit=crop&w=600&q=80');"></div>
				<div class="product-info">
					<div class="product-name"><?php esc_html_e( 'Dead Sea Mineral Mud', 'beauty-basant' ); ?></div>
					<div class="product-desc"><?php esc_html_e( 'Deep cleansing mineral mask for purified skin texture.', 'beauty-basant' ); ?></div>
					<div class="product-bottom">
						<div class="product-price">JOD 12.00</div>
						<button class="btn-outline"><?php esc_html_e( 'Add to Cart', 'beauty-basant' ); ?></button>
					</div>
				</div>
			</div>
			<div class="product-card">
				<div class="product-img" style="background-image: url('https://images.unsplash.com/photo-1608248597266-c04508930495?auto=format&fit=crop&w=600&q=80');"></div>
				<div class="product-info">
					<div class="product-name"><?php esc_html_e( 'Natural Bath Salts', 'beauty-basant' ); ?></div>
					<div class="product-desc"><?php esc_html_e( 'Exfoliating body scrub for deep relaxation and soft skin.', 'beauty-basant' ); ?></div>
					<div class="product-bottom">
						<div class="product-price">JOD 9.00</div>
						<button class="btn-outline"><?php esc_html_e( 'Add to Cart', 'beauty-basant' ); ?></button>
					</div>
				</div>
			</div>
			<div class="product-card">
				<div class="product-img" style="background-image: url('https://images.unsplash.com/photo-1607006482689-d4e5114777b7?auto=format&fit=crop&w=600&q=80');"></div>
				<div class="product-info">
					<div class="product-name"><?php esc_html_e( 'Mineral Nourishing Soap', 'beauty-basant' ); ?></div>
					<div class="product-desc"><?php esc_html_e( 'Gentle daily cleanser enriched with vital Dead Sea minerals.', 'beauty-basant' ); ?></div>
					<div class="product-bottom">
						<div class="product-price">JOD 6.00</div>
						<button class="btn-outline"><?php esc_html_e( 'Add to Cart', 'beauty-basant' ); ?></button>
					</div>
				</div>
			</div>
		</div>
		<p style="text-align:center;color:var(--text-muted);margin-top:20px;">
			<?php esc_html_e( 'Activate WooCommerce to sell these products for real.', 'beauty-basant' ); ?>
		</p>

	<?php endif; ?>
</section>
