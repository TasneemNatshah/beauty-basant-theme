<?php
/**
 * Custom Customizer control: checkbox list of published WooCommerce products.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Beauty_Basant_Product_Picker_Control' ) ) {

	class Beauty_Basant_Product_Picker_Control extends WP_Customize_Control {

		public $type = 'beauty_basant_product_picker';

		public function render_content() {
			$products = class_exists( 'WooCommerce' )
				? get_posts( array(
					'post_type'      => 'product',
					'posts_per_page' => 200,
					'post_status'    => 'publish',
					'orderby'        => 'title',
					'order'          => 'ASC',
				) )
				: array();

			$selected = (array) $this->value();
			?>
			<label>
				<?php if ( $this->label ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<?php if ( $this->description ) : ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<?php if ( empty( $products ) ) : ?>
				<p><em><?php esc_html_e( 'No published products found yet.', 'beauty-basant' ); ?></em></p>
			<?php else : ?>
				<div class="beauty-basant-product-picker" style="max-height:220px;overflow-y:auto;border:1px solid #ddd;padding:8px;background:#fff;">
					<?php foreach ( $products as $product ) : ?>
						<label style="display:block;margin-bottom:6px;">
							<input
								type="checkbox"
								value="<?php echo esc_attr( $product->ID ); ?>"
								<?php checked( in_array( (string) $product->ID, array_map( 'strval', $selected ), true ) ); ?>
								class="beauty-basant-product-picker-checkbox"
							>
							<?php echo esc_html( $product->post_title ); ?>
						</label>
					<?php endforeach; ?>
				</div>
				<input
					type="hidden"
					<?php $this->link(); ?>
					value="<?php echo esc_attr( wp_json_encode( array_values( $selected ) ) ); ?>"
					class="beauty-basant-product-picker-input"
				>
				<script>
				(function () {
					var wrap = document.currentScript.closest( 'li' );
					if ( ! wrap ) { return; }
					var input = wrap.querySelector( '.beauty-basant-product-picker-input' );
					var boxes = wrap.querySelectorAll( '.beauty-basant-product-picker-checkbox' );
					function sync() {
						var vals = [];
						boxes.forEach( function ( box ) { if ( box.checked ) { vals.push( box.value ); } } );
						input.value = JSON.stringify( vals );
						input.dispatchEvent( new Event( 'change' ) );
					}
					boxes.forEach( function ( box ) { box.addEventListener( 'change', sync ); } );
				})();
				</script>
			<?php endif; ?>
			<?php
		}
	}
}
