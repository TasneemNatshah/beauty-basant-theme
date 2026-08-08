<?php
/**
 * Beauty Basant theme bootstrap.
 *
 * @package BeautyBasant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BEAUTY_BASANT_VERSION', '1.0.0' );
define( 'BEAUTY_BASANT_DIR', get_template_directory() );
define( 'BEAUTY_BASANT_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function beauty_basant_setup() {
	load_theme_textdomain( 'beauty-basant', BEAUTY_BASANT_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary'              => __( 'Primary Menu', 'beauty-basant' ),
		'footer-quick-links'   => __( 'Footer — Quick Links', 'beauty-basant' ),
		'footer-customer-care' => __( 'Footer — Customer Care', 'beauty-basant' ),
	) );

	add_image_size( 'beauty-basant-hero', 1600, 800, true );
	add_image_size( 'beauty-basant-product', 600, 600, true );
}
add_action( 'after_setup_theme', 'beauty_basant_setup' );

/**
 * Enqueue styles and scripts.
 */
function beauty_basant_scripts() {
	wp_enqueue_style( 'beauty-basant-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css', array(), null );
	wp_enqueue_style( 'beauty-basant-theme', BEAUTY_BASANT_URI . '/assets/css/theme.css', array(), BEAUTY_BASANT_VERSION );
	wp_enqueue_style( 'beauty-basant-style', get_stylesheet_uri(), array(), BEAUTY_BASANT_VERSION );

	wp_enqueue_script( 'beauty-basant-main', BEAUTY_BASANT_URI . '/assets/js/main.js', array(), BEAUTY_BASANT_VERSION, true );
	wp_localize_script( 'beauty-basant-main', 'beautyBasant', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'beauty_basant_newsletter' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'beauty_basant_scripts' );

/**
 * Includes.
 */
require BEAUTY_BASANT_DIR . '/inc/template-tags.php';
require BEAUTY_BASANT_DIR . '/inc/customizer.php';
require BEAUTY_BASANT_DIR . '/inc/cpt-hero-slides.php';
require BEAUTY_BASANT_DIR . '/inc/cpt-testimonials.php';
require BEAUTY_BASANT_DIR . '/inc/newsletter.php';

if ( class_exists( 'WooCommerce' ) ) {
	require BEAUTY_BASANT_DIR . '/inc/woocommerce.php';
}

/**
 * Register widget areas (footer columns fall back to widgets if no menu assigned).
 */
function beauty_basant_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'beauty-basant' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'Appears on the shop and product pages.', 'beauty-basant' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'beauty_basant_widgets_init' );

/**
 * Excerpt length / ellipsis.
 */
add_filter( 'excerpt_length', function ( $length ) { return 22; } );
add_filter( 'excerpt_more', function ( $more ) { return '&hellip;'; } );

/**
 * Content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}
