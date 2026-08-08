<?php
/**
 * Custom Post Type: Testimonial.
 * Title = reviewer name, content = review text, meta = star rating (1-5).
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_register_testimonial_cpt() {
	register_post_type( 'testimonial', array(
		'labels' => array(
			'name'          => __( 'Testimonials', 'beauty-basant' ),
			'singular_name' => __( 'Testimonial', 'beauty-basant' ),
			'add_new_item'  => __( 'Add New Testimonial', 'beauty-basant' ),
			'edit_item'     => __( 'Edit Testimonial', 'beauty-basant' ),
			'all_items'     => __( 'Testimonials', 'beauty-basant' ),
			'menu_name'     => __( 'Testimonials', 'beauty-basant' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-star-filled',
		'supports'            => array( 'title', 'editor', 'page-attributes' ),
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
	) );
}
add_action( 'init', 'beauty_basant_register_testimonial_cpt' );

function beauty_basant_testimonial_meta_box() {
	add_meta_box( 'testimonial_rating', __( 'Rating', 'beauty-basant' ), 'beauty_basant_testimonial_meta_box_html', 'testimonial', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'beauty_basant_testimonial_meta_box' );

function beauty_basant_testimonial_meta_box_html( $post ) {
	wp_nonce_field( 'beauty_basant_testimonial_save', 'beauty_basant_testimonial_nonce' );
	$rating = get_post_meta( $post->ID, '_testimonial_rating', true );
	$rating = $rating ? $rating : 5;
	?>
	<p>
		<label for="testimonial_rating"><strong><?php esc_html_e( 'Star rating (1–5)', 'beauty-basant' ); ?></strong></label><br>
		<select id="testimonial_rating" name="testimonial_rating" class="widefat">
			<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
				<option value="<?php echo esc_attr( $i ); ?>" <?php selected( (int) $rating, $i ); ?>><?php echo esc_html( str_repeat( '★', $i ) ); ?></option>
			<?php endfor; ?>
		</select>
	</p>
	<p><em><?php esc_html_e( 'Post title is the reviewer name. Use the content editor for the review text.', 'beauty-basant' ); ?></em></p>
	<?php
}

function beauty_basant_save_testimonial_meta( $post_id ) {
	if ( ! isset( $_POST['beauty_basant_testimonial_nonce'] ) || ! wp_verify_nonce( $_POST['beauty_basant_testimonial_nonce'], 'beauty_basant_testimonial_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['testimonial_rating'] ) ) {
		update_post_meta( $post_id, '_testimonial_rating', absint( $_POST['testimonial_rating'] ) );
	}
}
add_action( 'save_post_testimonial', 'beauty_basant_save_testimonial_meta' );

/**
 * Seed 3 default testimonials on theme activation if none exist yet.
 */
function beauty_basant_seed_testimonials() {
	if ( get_option( 'beauty_basant_testimonials_seeded' ) ) {
		return;
	}

	$existing = get_posts( array( 'post_type' => 'testimonial', 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( empty( $existing ) ) {
		$testimonials = array(
			array(
				'name'   => 'Sarah A.',
				'text'   => 'The mud mask left my skin feeling intensely refreshed and clean right from the first use. Highly recommended!',
				'rating' => 5,
			),
			array(
				'name'   => 'Rania K.',
				'text'   => 'Elegant packaging and remarkable quality. The bath salt scrub is perfect after a long working week.',
				'rating' => 5,
			),
			array(
				'name'   => 'Mona H.',
				'text'   => 'Natural products that deliver on their promises. The mineral soap has become an essential part of my daily routine.',
				'rating' => 5,
			),
		);

		foreach ( $testimonials as $i => $t ) {
			$post_id = wp_insert_post( array(
				'post_type'    => 'testimonial',
				'post_title'   => $t['name'],
				'post_content' => $t['text'],
				'post_status'  => 'publish',
				'menu_order'   => $i,
			) );
			if ( $post_id ) {
				update_post_meta( $post_id, '_testimonial_rating', $t['rating'] );
			}
		}
	}

	update_option( 'beauty_basant_testimonials_seeded', 1 );
}
add_action( 'after_switch_theme', 'beauty_basant_seed_testimonials' );
