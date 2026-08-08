<?php
/**
 * Hero slider — pulls from the `hero_slide` CPT.
 *
 * @package BeautyBasant
 */

$slides_query = new WP_Query( array(
	'post_type'      => 'hero_slide',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

if ( ! $slides_query->have_posts() ) {
	return;
}
?>
<div class="hero-slider-container">

	<?php
	$index = 0;
	while ( $slides_query->have_posts() ) :
		$slides_query->the_post();
		$bg_url  = get_the_post_thumbnail_url( get_the_ID(), 'beauty-basant-hero' );
		$tag     = get_post_meta( get_the_ID(), '_hero_tag', true );
		$desc    = get_post_meta( get_the_ID(), '_hero_desc', true );
		$btn_txt = get_post_meta( get_the_ID(), '_hero_button_text', true );
		$btn_url = get_post_meta( get_the_ID(), '_hero_button_url', true );
		?>
		<div class="slide<?php echo 0 === $index ? ' active' : ''; ?>"<?php echo $bg_url ? ' style="background-image: url(\'' . esc_url( $bg_url ) . '\');"' : ''; ?>>
			<div class="slide-overlay"></div>
			<div class="hero-content">
				<?php if ( $tag ) : ?>
					<div class="hero-tag"><?php echo esc_html( $tag ); ?></div>
				<?php endif; ?>
				<h1 class="hero-title"><?php the_title(); ?></h1>
				<?php if ( $desc ) : ?>
					<p class="hero-desc"><?php echo esc_html( $desc ); ?></p>
				<?php endif; ?>
				<?php if ( $btn_txt ) : ?>
					<a href="<?php echo esc_url( $btn_url ? $btn_url : '#products' ); ?>" class="btn-primary"><?php echo esc_html( $btn_txt ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<?php
		$index++;
	endwhile;
	wp_reset_postdata();
	?>

	<?php if ( $slides_query->post_count > 1 ) : ?>
		<div class="slider-arrow prev"><i class="ti ti-chevron-left"></i></div>
		<div class="slider-arrow next"><i class="ti ti-chevron-right"></i></div>

		<div class="slider-dots">
			<?php for ( $i = 0; $i < $slides_query->post_count; $i++ ) : ?>
				<div class="dot<?php echo 0 === $i ? ' active' : ''; ?>"></div>
			<?php endfor; ?>
		</div>
	<?php endif; ?>

</div>
