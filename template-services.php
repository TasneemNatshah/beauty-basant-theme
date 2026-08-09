<?php
/**
 * Template Name: Services
 *
 * @package BeautyBasant
 */

get_header();
beauty_basant_page_hero( __( 'Spa & Treatments', 'beauty-basant' ), get_the_title() );

$services_query = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
?>

<main id="primary" class="site-main section services-page">

	<?php if ( $services_query->have_posts() ) : ?>
		<div class="services-grid">
			<?php
			while ( $services_query->have_posts() ) :
				$services_query->the_post();
				$icon     = get_post_meta( get_the_ID(), '_service_icon', true );
				$icon     = $icon ? $icon : 'ti-sparkles';
				$price    = get_post_meta( get_the_ID(), '_service_price', true );
				$duration = get_post_meta( get_the_ID(), '_service_duration', true );
				$thumb    = get_the_post_thumbnail_url( get_the_ID(), 'beauty-basant-service' );
				?>
				<div class="service-card">
					<?php if ( $thumb ) : ?>
						<div class="service-img" style="background-image:url('<?php echo esc_url( $thumb ); ?>');"></div>
					<?php else : ?>
						<div class="service-icon-badge"><i class="ti <?php echo esc_attr( $icon ); ?>"></i></div>
					<?php endif; ?>
					<div class="service-info">
						<div class="service-name"><?php the_title(); ?></div>
						<div class="service-desc"><?php the_content(); ?></div>
						<div class="service-meta">
							<?php if ( $duration ) : ?><span><i class="ti ti-clock"></i> <?php echo esc_html( $duration ); ?></span><?php endif; ?>
							<?php if ( $price ) : ?><span class="service-price"><?php echo esc_html( $price ); ?></span><?php endif; ?>
						</div>
						<a href="#contact" class="btn-outline"><?php esc_html_e( 'Book Now', 'beauty-basant' ); ?></a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p style="text-align:center;color:var(--text-muted);">
			<?php esc_html_e( 'No services added yet — add some under the "Services" menu in wp-admin.', 'beauty-basant' ); ?>
		</p>
	<?php endif; ?>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) :
			?>
			<div class="entry-content" style="max-width:800px;margin:50px auto 0;color:var(--text-muted);">
				<?php the_content(); ?>
			</div>
			<?php
		endif;
	endwhile;
	?>
</main>

<?php
get_footer();
