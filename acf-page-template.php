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
	<?php $content_tmpl = preg_replace( '/_/', '-', get_row_layout() ); ?>
	<?php get_template_part('template-parts/content', 'acf'); ?>
<?php endwhile; ?>
<?php get_footer();