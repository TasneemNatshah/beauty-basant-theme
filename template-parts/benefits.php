<?php
/**
 * Benefits banner (3 fixed items, editable via Customizer).
 *
 * @package BeautyBasant
 */
?>
<div class="benefits-bar">
	<?php for ( $i = 1; $i <= 3; $i++ ) :
		$icon = beauty_basant_opt( "benefit_{$i}_icon", 'ti-leaf' );
		$text = beauty_basant_opt( "benefit_{$i}_text", '' );
		if ( ! $text ) {
			continue;
		}
		?>
		<div class="benefit-item">
			<i class="ti <?php echo esc_attr( $icon ); ?>"></i>
			<span><?php echo esc_html( $text ); ?></span>
		</div>
	<?php endfor; ?>
</div>
