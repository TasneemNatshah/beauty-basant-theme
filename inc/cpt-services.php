<?php
/**
 * Custom Post Type: Service (spa/beauty treatments shown on the Services page).
 * Title = service name, content = description, meta = icon + price + duration.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_register_service_cpt() {
	register_post_type( 'service', array(
		'labels' => array(
			'name'          => __( 'Services', 'beauty-basant' ),
			'singular_name' => __( 'Service', 'beauty-basant' ),
			'add_new_item'  => __( 'Add New Service', 'beauty-basant' ),
			'edit_item'     => __( 'Edit Service', 'beauty-basant' ),
			'all_items'     => __( 'Services', 'beauty-basant' ),
			'menu_name'     => __( 'Services', 'beauty-basant' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-heart',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
	) );
}
add_action( 'init', 'beauty_basant_register_service_cpt' );

function beauty_basant_service_meta_box() {
	add_meta_box( 'service_details', __( 'Service Details', 'beauty-basant' ), 'beauty_basant_service_meta_box_html', 'service', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'beauty_basant_service_meta_box' );

function beauty_basant_service_meta_box_html( $post ) {
	wp_nonce_field( 'beauty_basant_service_save', 'beauty_basant_service_nonce' );
	$icon     = get_post_meta( $post->ID, '_service_icon', true );
	$icon     = $icon ? $icon : 'ti-sparkles';
	$price    = get_post_meta( $post->ID, '_service_price', true );
	$duration = get_post_meta( $post->ID, '_service_duration', true );
	?>
	<p>
		<label for="service_icon"><strong><?php esc_html_e( 'Icon', 'beauty-basant' ); ?></strong></label><br>
		<select id="service_icon" name="service_icon" class="widefat">
			<?php foreach ( beauty_basant_benefit_icon_choices() as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $icon, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="service_price"><strong><?php esc_html_e( 'Price (e.g. JOD 25.00)', 'beauty-basant' ); ?></strong></label><br>
		<input type="text" id="service_price" name="service_price" class="widefat" value="<?php echo esc_attr( $price ); ?>">
	</p>
	<p>
		<label for="service_duration"><strong><?php esc_html_e( 'Duration (e.g. 45 min)', 'beauty-basant' ); ?></strong></label><br>
		<input type="text" id="service_duration" name="service_duration" class="widefat" value="<?php echo esc_attr( $duration ); ?>">
	</p>
	<p><em><?php esc_html_e( 'Use the content editor above for the service description. Featured image is used as the card photo.', 'beauty-basant' ); ?></em></p>
	<?php
}

function beauty_basant_save_service_meta( $post_id ) {
	if ( ! isset( $_POST['beauty_basant_service_nonce'] ) || ! wp_verify_nonce( $_POST['beauty_basant_service_nonce'], 'beauty_basant_service_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['service_icon'] ) ) {
		update_post_meta( $post_id, '_service_icon', sanitize_html_class( $_POST['service_icon'] ) );
	}
	if ( isset( $_POST['service_price'] ) ) {
		update_post_meta( $post_id, '_service_price', sanitize_text_field( $_POST['service_price'] ) );
	}
	if ( isset( $_POST['service_duration'] ) ) {
		update_post_meta( $post_id, '_service_duration', sanitize_text_field( $_POST['service_duration'] ) );
	}
}
add_action( 'save_post_service', 'beauty_basant_save_service_meta' );

/**
 * Seed sample services on theme activation if none exist yet.
 */
function beauty_basant_seed_services() {
	if ( get_option( 'beauty_basant_services_seeded' ) ) {
		return;
	}

	$existing = get_posts( array( 'post_type' => 'service', 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( empty( $existing ) ) {
		$services = array(
			array(
				'title'    => 'Dead Sea Mud Facial',
				'desc'     => 'A deeply purifying facial using warm mineral mud to draw out impurities and leave skin visibly refreshed.',
				'icon'     => 'ti-sparkles',
				'price'    => 'JOD 25.00',
				'duration' => '45 min',
			),
			array(
				'title'    => 'Mineral Salt Body Scrub',
				'desc'     => 'A full-body exfoliation with therapeutic Dead Sea salts, followed by a nourishing mineral oil massage.',
				'icon'     => 'ti-droplet',
				'price'    => 'JOD 35.00',
				'duration' => '60 min',
			),
			array(
				'title'    => 'Relaxing Spa Massage',
				'desc'     => 'A soothing full-body massage designed to relieve tension and restore balance using our signature mineral oils.',
				'icon'     => 'ti-heart',
				'price'    => 'JOD 40.00',
				'duration' => '60 min',
			),
			array(
				'title'    => 'Detox Wrap Treatment',
				'desc'     => 'A nourishing full-body wrap infused with Dead Sea minerals to detoxify and hydrate the skin.',
				'icon'     => 'ti-leaf',
				'price'    => 'JOD 30.00',
				'duration' => '50 min',
			),
		);

		foreach ( $services as $i => $service ) {
			$post_id = wp_insert_post( array(
				'post_type'    => 'service',
				'post_title'   => $service['title'],
				'post_content' => $service['desc'],
				'post_status'  => 'publish',
				'menu_order'   => $i,
			) );
			if ( $post_id ) {
				update_post_meta( $post_id, '_service_icon', $service['icon'] );
				update_post_meta( $post_id, '_service_price', $service['price'] );
				update_post_meta( $post_id, '_service_duration', $service['duration'] );
			}
		}
	}

	update_option( 'beauty_basant_services_seeded', 1 );
}
add_action( 'after_switch_theme', 'beauty_basant_seed_services' );
add_action( 'init', 'beauty_basant_seed_services', 20 );
