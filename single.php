<?php
/**
 * Single post template.
 *
 * @package BeautyBasant
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<section class="section">
			<div class="section-title-wrap">
				<div class="subtitle"><?php echo esc_html( get_the_date() ); ?></div>
				<div class="title"><?php the_title(); ?></div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="story-img" style="height:320px;margin-bottom:35px;max-width:900px;margin-left:auto;margin-right:auto;background-image:url('<?php the_post_thumbnail_url( 'beauty-basant-hero' ); ?>');"></div>
			<?php endif; ?>
			<div class="entry-content" style="max-width:800px;margin:0 auto;color:var(--text-muted);">
				<?php the_content(); ?>
			</div>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beauty-basant' ),
				'after'  => '</div>',
			) );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		</section>
		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
