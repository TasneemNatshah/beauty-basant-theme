<?php
/**
 * Custom Post Type: Hero Slide.
 * Fields: title (H1), tag (small eyebrow), description, featured image (background),
 * button label & URL — all editable from wp-admin.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_register_hero_slide_cpt() {
	register_post_type( 'hero_slide', array(
		'labels' => array(
			'name'               => __( 'Hero Slides', 'beauty-basant' ),
			'singular_name'      => __( 'Hero Slide', 'beauty-basant' ),
			'add_new_item'       => __( 'Add New Slide', 'beauty-basant' ),
			'edit_item'          => __( 'Edit Slide', 'beauty-basant' ),
			'all_items'          => __( 'Hero Slides', 'beauty-basant' ),
			'menu_name'          => __( 'Hero Slides', 'beauty-basant' ),
		),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-images-alt2',
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
		'has_archive'        => false,
		'exclude_from_search'=> true,
		'publicly_queryable' => false,
	) );
}
add_action( 'init', 'beauty_basant_register_hero_slide_cpt' );

function beauty_basant_hero_slide_meta_box() {
	add_meta_box( 'hero_slide_details', __( 'Slide Details', 'beauty-basant' ), 'beauty_basant_hero_slide_meta_box_html', 'hero_slide', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'beauty_basant_hero_slide_meta_box' );

function beauty_basant_hero_slide_meta_box_html( $post ) {
	wp_nonce_field( 'beauty_basant_hero_slide_save', 'beauty_basant_hero_slide_nonce' );

	$tag         = get_post_meta( $post->ID, '_hero_tag', true );
	$desc        = get_post_meta( $post->ID, '_hero_desc', true );
	$button_text = get_post_meta( $post->ID, '_hero_button_text', true );
	$button_url  = get_post_meta( $post->ID, '_hero_button_url', true );
	?>
	<p>
		<label for="hero_tag"><strong><?php esc_html_e( 'Eyebrow tag', 'beauty-basant' ); ?></strong></label><br>
		<input type="text" id="hero_tag" name="hero_tag" class="widefat" value="<?php echo esc_attr( $tag ); ?>" placeholder="Pure Minerals From The Dead Sea">
	</p>
	<p>
		<em><?php esc_html_e( 'Use the post title as the big headline. Featured image is used as the slide background.', 'beauty-basant' ); ?></em>
	</p>
	<p>
		<label for="hero_desc"><strong><?php esc_html_e( 'Description', 'beauty-basant' ); ?></strong></label><br>
		<textarea id="hero_desc" name="hero_desc" class="widefat" rows="3"><?php echo esc_textarea( $desc ); ?></textarea>
	</p>
	<p>
		<label for="hero_button_text"><strong><?php esc_html_e( 'Button text', 'beauty-basant' ); ?></strong></label><br>
		<input type="text" id="hero_button_text" name="hero_button_text" class="widefat" value="<?php echo esc_attr( $button_text ); ?>" placeholder="Discover Products">
	</p>
	<p>
		<label for="hero_button_url"><strong><?php esc_html_e( 'Button URL', 'beauty-basant' ); ?></strong></label><br>
		<input type="url" id="hero_button_url" name="hero_button_url" class="widefat" value="<?php echo esc_url( $button_url ); ?>" placeholder="#products">
	</p>
	<?php
}

function beauty_basant_save_hero_slide_meta( $post_id ) {
	if ( ! isset( $_POST['beauty_basant_hero_slide_nonce'] ) || ! wp_verify_nonce( $_POST['beauty_basant_hero_slide_nonce'], 'beauty_basant_hero_slide_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'hero_tag'         => '_hero_tag',
		'hero_desc'        => '_hero_desc',
		'hero_button_text' => '_hero_button_text',
		'hero_button_url'  => '_hero_button_url',
	);

	foreach ( $fields as $post_key => $meta_key ) {
		if ( isset( $_POST[ $post_key ] ) ) {
			$value = 'hero_button_url' === $post_key ? esc_url_raw( $_POST[ $post_key ] ) : sanitize_textarea_field( $_POST[ $post_key ] );
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post_hero_slide', 'beauty_basant_save_hero_slide_meta' );

/**
 * Seed 3 default slides on theme activation if none exist yet.
 */
function beauty_basant_seed_hero_slides() {
	if ( get_option( 'beauty_basant_slides_seeded' ) ) {
		return;
	}

	$existing = get_posts( array( 'post_type' => 'hero_slide', 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( empty( $existing ) ) {
		$slides = array(
			array(
				'title' => 'Radiant skin, rooted in nature',
				'tag'   => 'Pure Minerals From The Dead Sea',
				'desc'  => 'Discover our luxurious skincare line enriched with natural mud, salts, and essential minerals harvested directly from the Dead Sea.',
				'btn'   => 'Discover Products',
				'url'   => '#products',
			),
			array(
				'title' => 'Deep cleansing mineral masks',
				'tag'   => 'Nourish & Restore',
				'desc'  => 'Purify your pores and revitalize your skin cells with authentic Dead Sea mud treatments.',
				'btn'   => 'Shop Masks',
				'url'   => '#products',
			),
			array(
				'title' => 'Home spa experience',
				'tag'   => '100% Organic Spa Care',
				'desc'  => 'Relax and soothe your body with therapeutic natural mineral salts and nourishing essential soaps.',
				'btn'   => 'Explore Salts',
				'url'   => '#products',
			),
		);

		foreach ( $slides as $i => $slide ) {
			$post_id = wp_insert_post( array(
				'post_type'   => 'hero_slide',
				'post_title'  => $slide['title'],
				'post_status' => 'publish',
				'menu_order'  => $i,
			) );
			if ( $post_id ) {
				update_post_meta( $post_id, '_hero_tag', $slide['tag'] );
				update_post_meta( $post_id, '_hero_desc', $slide['desc'] );
				update_post_meta( $post_id, '_hero_button_text', $slide['btn'] );
				update_post_meta( $post_id, '_hero_button_url', $slide['url'] );
			}
		}
	}

	update_option( 'beauty_basant_slides_seeded', 1 );
}
add_action( 'after_switch_theme', 'beauty_basant_seed_hero_slides' );
