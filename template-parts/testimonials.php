<?php
/**
 * Homepage testimonials section — pulls from the `testimonial` CPT.
 *
 * @package BeautyBasant
 */

$reviews_query = new WP_Query( array(
	'post_type'      => 'testimonial',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

if ( ! $reviews_query->have_posts() ) {
	return;
}
?>
<section class="section" id="reviews">
	<div class="section-title-wrap">
		<div class="subtitle"><?php esc_html_e( 'Real Experiences', 'beauty-basant' ); ?></div>
		<div class="title"><?php esc_html_e( 'What Our Clients Say', 'beauty-basant' ); ?></div>
	</div>

	<div class="reviews-grid">
		<?php while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
			<div class="review-card">
				<div class="stars"><?php echo beauty_basant_star_rating( get_post_meta( get_the_ID(), '_testimonial_rating', true ) ); ?></div>
				<div class="review-text">&ldquo;<?php echo esc_html( get_the_content() ); ?>&rdquo;</div>
				<div class="reviewer"><?php the_title(); ?></div>
			</div>
		<?php endwhile; ?>
	</div>
</section>
<?php wp_reset_postdata(); ?>
