<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter_Theme
 */
?>
		<a href="#0" class="cd-top">Top</a>
		<?php wp_footer(); ?>
		<?php if(have_rows('footer_scripts', 'options')) : ?>
			<?php while(have_rows('footer_scripts', 'options' )) : the_row(); ?>
				<?php 
					$script = get_sub_field('script');
				?>
				<?php echo $script; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</body>
</html>
