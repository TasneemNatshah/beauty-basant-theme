<?php
/**
 * Benefits banner — pulls from the `benefit_item` CPT so items can be
 * added/removed/reordered freely in wp-admin.
 *
 * @package BeautyBasant
 */

$benefits_query = new WP_Query( array(
	'post_type'      => 'benefit_item',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

if ( ! $benefits_query->have_posts() ) {
	return;
}
?>
<div class="benefits-bar">
	<?php
	while ( $benefits_query->have_posts() ) :
		$benefits_query->the_post();
		$icon = get_post_meta( get_the_ID(), '_benefit_icon', true );
		$icon = $icon ? $icon : 'ti-leaf';
		?>
		<div class="benefit-item">
			<i class="ti <?php echo esc_attr( $icon ); ?>"></i>
			<span><?php the_title(); ?></span>
		</div>
	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
