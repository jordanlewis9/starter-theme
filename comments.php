<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Starter_Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if(post_password_required()) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if(have_comments()) : ?>
		<h2 class="comments-title">
			<?php
				$starter_theme_comment_count = get_comments_number();
			?>
			<?php if('1' === $starter_theme_comment_count) { ?>
				<?php 
					printf(
						/* translators: 1: title. */
						esc_html__('One thought on &ldquo;%1$s&rdquo;', 'starter-theme'),
						'<span>' . wp_kses_post(get_the_title()) . '</span>'
					);
				?>
			<?php } else { ?>
				<?php 
					printf(
						/* translators: 1: comment count number, 2: title. */
						esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $starter_theme_comment_count, 'comments title', 'starter-theme')),
						number_format_i18n($starter_theme_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span>' . wp_kses_post(get_the_title()) . '</span>'
					);
				?>
			<?php } ?>
		</h2>
		<?php the_comments_navigation(); ?>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
					)
				);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
		<?php if(! comments_open()) : ?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'starter-theme'); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>