<?php
/**
 * Header template.
 *
 * @package BeautyBasant
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<!-- Top Bar -->
	<div class="top-bar">
		<div><?php echo esc_html( beauty_basant_opt( 'topbar_message', 'Free shipping on all orders over JOD 30' ) ); ?></div>
		<div class="top-bar-links">
			<a class="top-bar-item" href="<?php echo esc_url( beauty_basant_account_url() ); ?>">
				<i class="ti ti-user"></i> <?php esc_html_e( 'LOGIN / ACCOUNT', 'beauty-basant' ); ?>
			</a>
			<a class="top-bar-item" href="<?php echo esc_url( beauty_basant_cart_url() ); ?>">
				<i class="ti ti-shopping-bag"></i> <?php printf( esc_html__( 'CART (%d)', 'beauty-basant' ), (int) beauty_basant_cart_count() ); ?>
			</a>
		</div>
	</div>

	<!-- Main Navigation -->
	<header class="site-header">
		<div class="logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>

		<nav class="main-navigation" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'beauty-basant' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => '',
					'depth'          => 2,
				) );
			} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'HOME', 'beauty-basant' ); ?></a></li>
					<li><a href="#about"><?php esc_html_e( 'OUR STORY', 'beauty-basant' ); ?></a></li>
					<li><a href="#products"><?php esc_html_e( 'PRODUCTS', 'beauty-basant' ); ?></a></li>
					<li><a href="#reviews"><?php esc_html_e( 'REVIEWS', 'beauty-basant' ); ?></a></li>
					<li><a href="#contact"><?php esc_html_e( 'CONTACT', 'beauty-basant' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</nav>

		<div class="header-icons">
			<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'beauty-basant' ); ?>">
				<i class="ti ti-search"></i>
			</a>
			<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'beauty-basant' ); ?>">
				<i class="ti ti-menu-2"></i>
			</button>
		</div>
	</header>
