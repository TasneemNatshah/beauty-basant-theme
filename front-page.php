<?php
/**
 * Front page — assembles the homepage sections.
 *
 * @package BeautyBasant
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/hero-slider' ); ?>
	<?php get_template_part( 'template-parts/products' ); ?>
	<?php get_template_part( 'template-parts/story' ); ?>
	<?php get_template_part( 'template-parts/testimonials' ); ?>
	<?php get_template_part( 'template-parts/newsletter' ); ?>
	<?php get_template_part( 'template-parts/benefits' ); ?>

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
