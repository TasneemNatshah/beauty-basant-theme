<?php
/**
 * Default page template.
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
				<div class="title"><?php the_title(); ?></div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="story-img" style="height:320px;margin-bottom:35px;background-image:url('<?php the_post_thumbnail_url( 'beauty-basant-hero' ); ?>');"></div>
			<?php endif; ?>
			<div class="entry-content" style="max-width:800px;margin:0 auto;color:var(--text-muted);">
				<?php the_content(); ?>
			</div>
			<?php
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
