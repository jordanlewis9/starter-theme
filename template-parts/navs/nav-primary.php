<?php if(has_nav_menu('primary')) : ?>
	<div class="primary-nav-wrap">
		<nav class="primary-nav">
			<ul class="primary-menu sm sm-simple">
				<?php
					$defaults = array(
						'theme_location'  => 'primary',
						'menu'            => 'primary',
						'container'       => false,
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'depth'           => 10,
						'walker'          => ''
					);
					wp_nav_menu( $defaults );
				?>
			</ul>
		</nav>
	</div>
<?php endif;