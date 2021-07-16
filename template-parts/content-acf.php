<?php if(have_rows('content')) : ?>
	<?php 
		global $global_base_id;
		$global_base_id = 1;
	?>
	<?php while(have_rows('content')) : the_row(); ?>
		<?php $block_id = $global_base_id++; ?>
		<div id="block-<?php echo $block_id; ?>">
			<?php $ffw_content = preg_replace( '/_/', '-', get_row_layout() ); ?>
			<?php get_template_part('template-parts/blocks/acf', $ffw_content); ?>
		</div>
	<?php endwhile; ?>
<?php endif;