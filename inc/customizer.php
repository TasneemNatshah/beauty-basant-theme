<?php
/**
 * Customizer settings.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require BEAUTY_BASANT_DIR . '/inc/class-product-picker-control.php';

function beauty_basant_sanitize_checkbox( $checked ) {
	return (bool) $checked;
}

function beauty_basant_sanitize_product_ids( $value ) {
	$ids = json_decode( is_string( $value ) ? $value : '', true );
	if ( ! is_array( $ids ) ) {
		return array();
	}
	return array_map( 'absint', $ids );
}

function beauty_basant_customize_register( $wp_customize ) {

	/* ---------------------------------------------------------------
	 * Homepage Sections — show/hide
	 * ------------------------------------------------------------- */
	$wp_customize->add_panel( 'beauty_basant_homepage', array(
		'title'    => __( 'Homepage', 'beauty-basant' ),
		'priority' => 20,
	) );

	$wp_customize->add_section( 'beauty_basant_sections', array(
		'title'       => __( 'Section Visibility', 'beauty-basant' ),
		'panel'       => 'beauty_basant_homepage',
		'description' => __( 'Turn homepage sections on or off.', 'beauty-basant' ),
		'priority'    => 5,
	) );

	$sections = array(
		'section_hero'         => array( 'label' => __( 'Show Hero Slider', 'beauty-basant' ), 'default' => true ),
		'section_collection'   => array( 'label' => __( 'Show Our Collection', 'beauty-basant' ), 'default' => true ),
		'section_posts'        => array( 'label' => __( 'Show Latest Posts', 'beauty-basant' ), 'default' => true ),
		'section_story'        => array( 'label' => __( 'Show Our Story', 'beauty-basant' ), 'default' => true ),
		'section_testimonials' => array( 'label' => __( 'Show Testimonials', 'beauty-basant' ), 'default' => true ),
		'section_benefits'     => array( 'label' => __( 'Show Benefits Bar', 'beauty-basant' ), 'default' => true ),
	);

	foreach ( $sections as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $field['default'],
			'sanitize_callback' => 'beauty_basant_sanitize_checkbox',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field['label'],
			'section' => 'beauty_basant_sections',
			'type'    => 'checkbox',
		) );
	}

	/* ---------------------------------------------------------------
	 * Our Collection — which products + image height
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_collection', array(
		'title'       => __( 'Our Collection', 'beauty-basant' ),
		'panel'       => 'beauty_basant_homepage',
		'description' => __( 'Choose which products appear in the homepage collection grid. Leave empty to auto-show featured (or latest) products.', 'beauty-basant' ),
		'priority'    => 10,
	) );

	$wp_customize->add_setting( 'collection_products', array(
		'default'           => array(),
		'sanitize_callback' => 'beauty_basant_sanitize_product_ids',
	) );
	$wp_customize->add_control( new Beauty_Basant_Product_Picker_Control( $wp_customize, 'collection_products', array(
		'label'   => __( 'Products to display', 'beauty-basant' ),
		'section' => 'beauty_basant_collection',
	) ) );

	$wp_customize->add_setting( 'collection_image_height', array(
		'default'           => 200,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'collection_image_height', array(
		'label'       => __( 'Product image height (px)', 'beauty-basant' ),
		'description' => __( 'Also used for the latest-posts card images.', 'beauty-basant' ),
		'section'     => 'beauty_basant_collection',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 100, 'max' => 500, 'step' => 10 ),
	) );

	/* ---------------------------------------------------------------
	 * Top Bar
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_topbar', array(
		'title'    => __( 'Top Bar', 'beauty-basant' ),
		'priority' => 25,
	) );

	$wp_customize->add_setting( 'topbar_message', array(
		'default'           => 'Free shipping on all orders over JOD 30',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'topbar_message', array(
		'label'   => __( 'Announcement message', 'beauty-basant' ),
		'section' => 'beauty_basant_topbar',
		'type'    => 'text',
	) );

	/* ---------------------------------------------------------------
	 * Story / About Section
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_story', array(
		'title'    => __( 'Homepage — Our Story Section', 'beauty-basant' ),
		'panel'    => 'beauty_basant_homepage',
		'priority' => 15,
	) );

	$story_fields = array(
		'story_subtitle'    => array( 'label' => __( 'Eyebrow subtitle', 'beauty-basant' ), 'default' => 'The Lowest Point On Earth', 'type' => 'text' ),
		'story_title'       => array( 'label' => __( 'Heading', 'beauty-basant' ), 'default' => 'Why Beauty Basant?', 'type' => 'text' ),
		'story_paragraph_1' => array( 'label' => __( 'Paragraph 1', 'beauty-basant' ), 'default' => 'At Beauty Basant, we believe true beauty begins with natural purity. We harvest mineral-rich mud and salt from the Dead Sea and infuse them with organic oils to bring you a luxurious spa experience at home.', 'type' => 'textarea' ),
		'story_paragraph_2' => array( 'label' => __( 'Paragraph 2', 'beauty-basant' ), 'default' => 'All our products are ethically sourced, cruelty-free, and formulated without harsh chemicals to respect even the most sensitive skin types.', 'type' => 'textarea' ),
		'story_button_text' => array( 'label' => __( 'Button text', 'beauty-basant' ), 'default' => 'Learn More', 'type' => 'text' ),
		'story_button_url'  => array( 'label' => __( 'Button URL', 'beauty-basant' ), 'default' => '#', 'type' => 'url' ),
	);

	foreach ( $story_fields as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $field['default'],
			'sanitize_callback' => 'url' === $field['type'] ? 'esc_url_raw' : ( 'textarea' === $field['type'] ? 'wp_kses_post' : 'sanitize_text_field' ),
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field['label'],
			'section' => 'beauty_basant_story',
			'type'    => $field['type'],
		) );
	}

	$wp_customize->add_setting( 'story_image', array(
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'story_image', array(
		'label'     => __( 'Story image', 'beauty-basant' ),
		'section'   => 'beauty_basant_story',
		'mime_type' => 'image',
	) ) );

	/* ---------------------------------------------------------------
	 * Contact & Social
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_contact', array(
		'title'    => __( 'Contact & Social Links', 'beauty-basant' ),
		'priority' => 45,
	) );

	$contact_fields = array(
		'contact_email'    => array( 'label' => __( 'Email address', 'beauty-basant' ), 'default' => 'info@beautybasant.com', 'sanitize' => 'sanitize_email' ),
		'contact_phone'    => array( 'label' => __( 'Phone number', 'beauty-basant' ), 'default' => '+962 7 9000 0000', 'sanitize' => 'sanitize_text_field' ),
		'contact_address'  => array( 'label' => __( 'Address', 'beauty-basant' ), 'default' => 'Amman, Jordan', 'sanitize' => 'sanitize_text_field' ),
		'contact_map_embed'=> array( 'label' => __( 'Google Maps embed URL (optional)', 'beauty-basant' ), 'default' => '', 'sanitize' => 'esc_url_raw' ),
		'social_instagram' => array( 'label' => __( 'Instagram URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
		'social_facebook'  => array( 'label' => __( 'Facebook URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
		'social_whatsapp'  => array( 'label' => __( 'WhatsApp URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
	);
	foreach ( $contact_fields as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $field['default'],
			'sanitize_callback' => $field['sanitize'],
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field['label'],
			'section' => 'beauty_basant_contact',
			'type'    => 'text',
		) );
	}

	/* ---------------------------------------------------------------
	 * Footer
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_footer', array(
		'title'    => __( 'Footer', 'beauty-basant' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'footer_about', array(
		'default'           => 'Your trusted destination for premium skincare crafted with authentic Dead Sea mineral nutrients.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'footer_about', array(
		'label'   => __( 'About text', 'beauty-basant' ),
		'section' => 'beauty_basant_footer',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'footer_copyright', array(
		'default'           => '© {year} Beauty Basant. All rights reserved.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'footer_copyright', array(
		'label'       => __( 'Copyright text', 'beauty-basant' ),
		'description' => __( 'Use {year} to insert the current year automatically.', 'beauty-basant' ),
		'section'     => 'beauty_basant_footer',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'beauty_basant_customize_register' );

/**
 * Small getter helper with fallback defaults, used throughout templates.
 */
function beauty_basant_opt( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}
