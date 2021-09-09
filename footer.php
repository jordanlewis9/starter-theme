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
		<div class="ffw-widgets">
			<div class="ffw-widget">
				<?php if(is_active_sidebar('footer-1')) : ?>
					<?php dynamic_sidebar('footer-1'); ?>
				<?php endif; ?>
			</div>
			<div class="ffw-widget">
				<?php if(is_active_sidebar('footer-2')) : ?>
					<?php dynamic_sidebar('footer-2'); ?>
				<?php endif; ?>
			</div>
			<div class="ffw-widget">
				<?php if(is_active_sidebar('footer-3')) : ?>
					<?php dynamic_sidebar('footer-3'); ?>
				<?php endif; ?>
			</div>
			<div class="ffw-widget">
				<?php if(is_active_sidebar('footer-4')) : ?>
					<?php dynamic_sidebar('footer-4'); ?>
				<?php endif; ?>
			</div>
		</div>
		<a href="#0" class="cd-top">Top</a>
		<?php wp_footer(); ?>
		<?php 
			include_once(ABSPATH . 'wp-admin/includes/plugin.php'); 
			if(is_plugin_active('advanced-custom-fields-pro/acf.php')) {
		?>
			<?php if(have_rows('footer_scripts', 'options')) : ?>
				<?php while(have_rows('footer_scripts', 'options' )) : the_row(); ?>
					<?php 
						$script = get_sub_field('script');
					?>
					<?php echo $script; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php } ?>
	</body>
</html>
