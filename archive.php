<?php
/**
 * Generic archive template (categories, tags, dates, authors).
 *
 * @package BeautyBasant
 */

get_header();
?>

<main id="primary" class="site-main section">
	<div class="section-title-wrap">
		<div class="subtitle"><?php esc_html_e( 'Archive', 'beauty-basant' ); ?></div>
		<div class="title"><?php the_archive_title(); ?></div>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="reviews-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'review-card' ); ?>>
					<h2 class="product-name"><a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;"><?php the_title(); ?></a></h2>
					<div class="review-text"><?php the_excerpt(); ?></div>
					<a href="<?php the_permalink(); ?>" class="btn-outline"><?php esc_html_e( 'Read More', 'beauty-basant' ); ?></a>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<div class="view-all-wrap"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'beauty-basant' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
