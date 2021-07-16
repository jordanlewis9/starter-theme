<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Starter_Theme
 */
get_header(); ?>
<div class="section-wrap">
	<div class="inner">
		<main id="primary" class="site-main">
			<?php while(have_posts()) : the_post(); ?>
				<?php get_template_part('template-parts/content', get_post_type()); ?>
				<?php if(comments_open() || get_comments_number()) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endwhile; ?> 
		</main>
	</div>
</div>
<?php get_footer();
