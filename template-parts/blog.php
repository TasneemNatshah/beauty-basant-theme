<?php
/**
 * Homepage "Latest Posts" section — last 3 blog posts, styled as cards
 * matching the "Our Collection" product-card look.
 *
 * @package BeautyBasant
 */

$posts_query = new WP_Query( array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
) );

if ( ! $posts_query->have_posts() ) {
	return;
}

$img_height = (int) get_theme_mod( 'collection_image_height', 200 );
$img_height = $img_height ? $img_height : 200;
?>
<section class="section" id="latest-posts" style="--product-img-height: <?php echo esc_attr( $img_height ); ?>px;">
	<div class="section-title-wrap">
		<div class="subtitle"><?php esc_html_e( 'From The Journal', 'beauty-basant' ); ?></div>
		<div class="title"><?php esc_html_e( 'Latest From The Blog', 'beauty-basant' ); ?></div>
	</div>

	<ul class="products product-grid">
		<?php
		while ( $posts_query->have_posts() ) :
			$posts_query->the_post();
			$thumb = get_the_post_thumbnail_url( get_the_ID(), 'beauty-basant-product' );
			?>
			<li class="product-card">
				<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;">
					<?php if ( $thumb ) : ?>
						<div class="product-img" style="background-image:url('<?php echo esc_url( $thumb ); ?>');"></div>
					<?php endif; ?>
					<div class="product-info">
						<div class="product-name"><?php the_title(); ?></div>
						<div class="product-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></div>
						<div class="product-bottom">
							<div class="product-price"><?php echo esc_html( get_the_date() ); ?></div>
							<span class="btn-outline"><?php esc_html_e( 'Read More', 'beauty-basant' ); ?></span>
						</div>
					</div>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>

	<?php $blog_page_id = (int) get_option( 'page_for_posts' ); ?>
	<div class="view-all-wrap">
		<a href="<?php echo esc_url( $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/' ) ); ?>" class="btn-primary"><?php esc_html_e( 'View All Posts', 'beauty-basant' ); ?></a>
	</div>
</section>
<?php wp_reset_postdata(); ?>
