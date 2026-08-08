<?php
/**
 * Customizer settings.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function beauty_basant_customize_register( $wp_customize ) {

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
		'priority' => 30,
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
		'label'    => __( 'Story image', 'beauty-basant' ),
		'section'  => 'beauty_basant_story',
		'mime_type' => 'image',
	) ) );

	/* ---------------------------------------------------------------
	 * Newsletter Section
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_newsletter', array(
		'title'    => __( 'Homepage — Newsletter Section', 'beauty-basant' ),
		'priority' => 35,
	) );

	$newsletter_fields = array(
		'newsletter_subtitle'   => array( 'label' => __( 'Eyebrow subtitle', 'beauty-basant' ), 'default' => 'Join Our Beauty Club' ),
		'newsletter_title'      => array( 'label' => __( 'Heading', 'beauty-basant' ), 'default' => 'Get 10% Off Your First Order' ),
		'newsletter_desc'       => array( 'label' => __( 'Description', 'beauty-basant' ), 'default' => 'Subscribe to our newsletter for exclusive discounts and skincare secrets.' ),
	);
	foreach ( $newsletter_fields as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $field['default'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field['label'],
			'section' => 'beauty_basant_newsletter',
			'type'    => 'text',
		) );
	}

	/* ---------------------------------------------------------------
	 * Benefits Bar (3 fixed items)
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_benefits', array(
		'title'    => __( 'Homepage — Benefits Bar', 'beauty-basant' ),
		'priority' => 40,
	) );

	$icon_choices = array(
		'ti-leaf'          => __( 'Leaf', 'beauty-basant' ),
		'ti-heart'         => __( 'Heart', 'beauty-basant' ),
		'ti-truck'         => __( 'Truck', 'beauty-basant' ),
		'ti-shield-check'  => __( 'Shield Check', 'beauty-basant' ),
		'ti-recycle'       => __( 'Recycle', 'beauty-basant' ),
		'ti-award'         => __( 'Award', 'beauty-basant' ),
	);

	$defaults = array(
		1 => array( 'icon' => 'ti-leaf', 'text' => '100% NATURAL' ),
		2 => array( 'icon' => 'ti-heart', 'text' => 'CRUELTY FREE' ),
		3 => array( 'icon' => 'ti-truck', 'text' => 'FAST SHIPPING' ),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( "benefit_{$i}_icon", array(
			'default'           => $defaults[ $i ]['icon'],
			'sanitize_callback' => 'sanitize_html_class',
		) );
		$wp_customize->add_control( "benefit_{$i}_icon", array(
			'label'   => sprintf( __( 'Item %d icon', 'beauty-basant' ), $i ),
			'section' => 'beauty_basant_benefits',
			'type'    => 'select',
			'choices' => $icon_choices,
		) );

		$wp_customize->add_setting( "benefit_{$i}_text", array(
			'default'           => $defaults[ $i ]['text'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "benefit_{$i}_text", array(
			'label'   => sprintf( __( 'Item %d text', 'beauty-basant' ), $i ),
			'section' => 'beauty_basant_benefits',
			'type'    => 'text',
		) );
	}

	/* ---------------------------------------------------------------
	 * Contact & Social
	 * ------------------------------------------------------------- */
	$wp_customize->add_section( 'beauty_basant_contact', array(
		'title'    => __( 'Contact & Social Links', 'beauty-basant' ),
		'priority' => 45,
	) );

	$contact_fields = array(
		'contact_email'      => array( 'label' => __( 'Email address', 'beauty-basant' ), 'default' => 'info@beautybasant.com', 'sanitize' => 'sanitize_email' ),
		'contact_phone'      => array( 'label' => __( 'Phone number', 'beauty-basant' ), 'default' => '+962 7 9000 0000', 'sanitize' => 'sanitize_text_field' ),
		'contact_address'    => array( 'label' => __( 'Address', 'beauty-basant' ), 'default' => 'Amman, Jordan', 'sanitize' => 'sanitize_text_field' ),
		'social_instagram'   => array( 'label' => __( 'Instagram URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
		'social_facebook'    => array( 'label' => __( 'Facebook URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
		'social_whatsapp'    => array( 'label' => __( 'WhatsApp URL', 'beauty-basant' ), 'default' => '#', 'sanitize' => 'esc_url_raw' ),
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
