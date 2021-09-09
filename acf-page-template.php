<?php
/* Template Name: ACF Page Template
 * The template for displaying special pages.
 *
 * This is the template that displays special pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Starter
 */
get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
    <?php 
        include_once(ABSPATH . 'wp-admin/includes/plugin.php'); 
        if(is_plugin_active('advanced-custom-fields-pro/acf.php')) {
    ?>
	   <?php $content_tmpl = preg_replace( '/_/', '-', get_row_layout() ); ?>
	   <?php get_template_part('template-parts/content', 'acf'); ?>
    <?php } ?>
<?php endwhile; ?>
<?php get_footer();