<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
		<?php 
			include_once(ABSPATH . 'wp-admin/includes/plugin.php'); 
			if(is_plugin_active('advanced-custom-fields-pro/acf.php')) {
		?>
			<?php if(have_rows('header_scripts', 'options')) : ?>
				<?php while(have_rows('header_scripts', 'options')) : the_row(); ?>
					<?php 
						$script = get_sub_field('script');
					?>
					<?php echo $script; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php } ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<?php get_template_part('template-parts/navs/nav', 'utility'); ?>
		<?php get_template_part('template-parts/navs/nav', 'primary'); ?>