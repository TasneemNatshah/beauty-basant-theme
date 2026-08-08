<?php
/**
 * Homepage "Our Story" section — editable via Customizer.
 *
 * @package BeautyBasant
 */

$image_id  = beauty_basant_opt( 'story_image', 0 );
$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'beauty-basant-hero' ) : 'https://images.unsplash.com/photo-1512290900676-26c2a4d4850d?auto=format&fit=crop&w=800&q=80';
?>
<section class="section story-section" id="about">
	<div class="story-img" style="background-image:url('<?php echo esc_url( $image_url ); ?>');"></div>
	<div class="story-content">
		<div class="subtitle"><?php echo esc_html( beauty_basant_opt( 'story_subtitle', 'The Lowest Point On Earth' ) ); ?></div>
		<div class="title" style="margin-bottom: 20px;"><?php echo esc_html( beauty_basant_opt( 'story_title', 'Why Beauty Basant?' ) ); ?></div>
		<p><?php echo wp_kses_post( beauty_basant_opt( 'story_paragraph_1', '' ) ); ?></p>
		<p><?php echo wp_kses_post( beauty_basant_opt( 'story_paragraph_2', '' ) ); ?></p>
		<a href="<?php echo esc_url( beauty_basant_opt( 'story_button_url', '#' ) ); ?>" class="btn-primary"><?php echo esc_html( beauty_basant_opt( 'story_button_text', 'Learn More' ) ); ?></a>
	</div>
</section>
