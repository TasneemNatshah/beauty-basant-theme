<?php
/**
 * Front page — assembles the homepage sections. Each section can be toggled
 * on/off from Appearance > Customize > Homepage > Section Visibility.
 *
 * @package BeautyBasant
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( get_theme_mod( 'section_hero', true ) ) : ?>
		<?php get_template_part( 'template-parts/hero-slider' ); ?>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'section_collection', true ) ) : ?>
		<?php get_template_part( 'template-parts/products' ); ?>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'section_posts', true ) ) : ?>
		<?php get_template_part( 'template-parts/blog' ); ?>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'section_story', true ) ) : ?>
		<?php get_template_part( 'template-parts/story' ); ?>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'section_testimonials', true ) ) : ?>
		<?php get_template_part( 'template-parts/testimonials' ); ?>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'section_benefits', true ) ) : ?>
		<?php get_template_part( 'template-parts/benefits' ); ?>
	<?php endif; ?>

	<?php
	// If the site owner assigned actual page content to the front page, show it too.
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			if ( trim( get_the_content() ) ) :
				?>
				<section class="section">
					<div class="entry-content"><?php the_content(); ?></div>
				</section>
				<?php
			endif;
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
