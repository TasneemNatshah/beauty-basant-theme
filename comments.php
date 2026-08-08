<?php
/**
 * Comments template.
 *
 * @package BeautyBasant
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area" style="max-width:800px;margin:50px auto 0;">

	<?php if ( have_comments() ) : ?>
		<h3 class="title" style="font-size:20px;margin-bottom:25px;">
			<?php
			printf(
				esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'beauty-basant' ) ),
				number_format_i18n( get_comments_number() )
			);
			?>
		</h3>

		<ol class="comment-list" style="list-style:none;">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p><?php esc_html_e( 'Comments are closed.', 'beauty-basant' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'class_submit' => 'btn-primary',
	) );
	?>

</div>
