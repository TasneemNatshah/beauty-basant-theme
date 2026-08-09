<?php
/**
 * Custom Post Type: Benefit Item (the icon+label strip above the footer).
 * Title = label text, meta = icon class. Add/remove items freely in wp-admin.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_register_benefit_cpt() {
	register_post_type( 'benefit_item', array(
		'labels' => array(
			'name'          => __( 'Benefits Bar', 'beauty-basant' ),
			'singular_name' => __( 'Benefit', 'beauty-basant' ),
			'add_new_item'  => __( 'Add New Benefit', 'beauty-basant' ),
			'edit_item'     => __( 'Edit Benefit', 'beauty-basant' ),
			'all_items'     => __( 'Benefits Bar', 'beauty-basant' ),
			'menu_name'     => __( 'Benefits Bar', 'beauty-basant' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-yes-alt',
		'supports'            => array( 'title', 'page-attributes' ),
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
	) );
}
add_action( 'init', 'beauty_basant_register_benefit_cpt' );

function beauty_basant_benefit_icon_choices() {
	return array(
		'ti-leaf'         => __( 'Leaf', 'beauty-basant' ),
		'ti-heart'        => __( 'Heart', 'beauty-basant' ),
		'ti-truck'        => __( 'Truck', 'beauty-basant' ),
		'ti-shield-check' => __( 'Shield Check', 'beauty-basant' ),
		'ti-recycle'      => __( 'Recycle', 'beauty-basant' ),
		'ti-award'        => __( 'Award', 'beauty-basant' ),
		'ti-droplet'      => __( 'Droplet', 'beauty-basant' ),
		'ti-sparkles'     => __( 'Sparkles', 'beauty-basant' ),
		'ti-gift'         => __( 'Gift', 'beauty-basant' ),
	);
}

function beauty_basant_benefit_meta_box() {
	add_meta_box( 'benefit_details', __( 'Icon', 'beauty-basant' ), 'beauty_basant_benefit_meta_box_html', 'benefit_item', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'beauty_basant_benefit_meta_box' );

function beauty_basant_benefit_meta_box_html( $post ) {
	wp_nonce_field( 'beauty_basant_benefit_save', 'beauty_basant_benefit_nonce' );
	$icon = get_post_meta( $post->ID, '_benefit_icon', true );
	$icon = $icon ? $icon : 'ti-leaf';
	?>
	<p>
		<select name="benefit_icon" class="widefat">
			<?php foreach ( beauty_basant_benefit_icon_choices() as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $icon, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p><em><?php esc_html_e( 'Post title is the label text shown under the icon.', 'beauty-basant' ); ?></em></p>
	<?php
}

function beauty_basant_save_benefit_meta( $post_id ) {
	if ( ! isset( $_POST['beauty_basant_benefit_nonce'] ) || ! wp_verify_nonce( $_POST['beauty_basant_benefit_nonce'], 'beauty_basant_benefit_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['benefit_icon'] ) ) {
		update_post_meta( $post_id, '_benefit_icon', sanitize_html_class( $_POST['benefit_icon'] ) );
	}
}
add_action( 'save_post_benefit_item', 'beauty_basant_save_benefit_meta' );

/**
 * Seed 3 default benefits on theme activation if none exist yet.
 */
function beauty_basant_seed_benefits() {
	if ( get_option( 'beauty_basant_benefits_seeded' ) ) {
		return;
	}

	$existing = get_posts( array( 'post_type' => 'benefit_item', 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( empty( $existing ) ) {
		$benefits = array(
			array( 'text' => '100% NATURAL', 'icon' => 'ti-leaf' ),
			array( 'text' => 'CRUELTY FREE', 'icon' => 'ti-heart' ),
			array( 'text' => 'FAST SHIPPING', 'icon' => 'ti-truck' ),
		);

		foreach ( $benefits as $i => $benefit ) {
			$post_id = wp_insert_post( array(
				'post_type'   => 'benefit_item',
				'post_title'  => $benefit['text'],
				'post_status' => 'publish',
				'menu_order'  => $i,
			) );
			if ( $post_id ) {
				update_post_meta( $post_id, '_benefit_icon', $benefit['icon'] );
			}
		}
	}

	update_option( 'beauty_basant_benefits_seeded', 1 );
}
add_action( 'after_switch_theme', 'beauty_basant_seed_benefits' );
add_action( 'init', 'beauty_basant_seed_benefits', 20 );
