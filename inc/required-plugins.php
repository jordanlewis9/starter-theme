<?php
/**
 * Required plugins
 *
 * @package Starter
 */

/**
 * TGM Plugin Activation
 */
require_once get_template_directory() . '/inc/vendor/class-tgm-plugin-activation.php';

/**
 * Register required plugins
 */
function starter_register_required_plugins() {
	$secure 	= get_template_directory_uri();
	$insecure 	= str_replace('https', 'http', $secure);
	$plugins 	= array(
		array(
			'name'     => 'Advanced Custom Fields Pro',
			'slug'     => 'advanced-custom-fields-pro',
			'source'   => $insecure . '/inc/plugins/advanced-custom-fields-pro.zip',
			'required' => true,
		),
		array(
			'name'     => 'Admin Columns Pro',
			'slug'     => 'admin-columns-pro',
			'source'   => $insecure . '/inc/plugins/admin-columns-pro.zip',
			'required' => true,
		),
		array(
			'name'     => 'Admin Columns Pro - Advanced Custom Fields (ACF',
			'slug'     => 'ac-addon-acf',
			'source'   => $insecure . '/inc/plugins/ac-addon-acf.zip',
			'required' => true,
		),
		array(
			'name'     => 'FacetWP',
			'slug'     => 'facetwp',
			'source'   => $insecure . '/inc/plugins/facetwp.zip',
			'required' => true,
		),
		array(
			'name'     => 'FacetWP - Relevanssi integration',
			'slug'     => 'facetwp-relevanssi',
			'source'   => $insecure . '/inc/plugins/facetwp-relevanssi.zip',
			'required' => true,
		),
		array(
			'name'     => 'Gravity Forms',
			'slug'     => 'gravityforms',
			'source'   => $insecure . '/inc/plugins/gravityforms.zip',
			'required' => true,
		),
		array(
			'name'     => 'ACF RGBA Color Picker',
			'slug'     => 'acf-rgba-color-picker',
			'required' => true,
		),
		array(
			'name'     => 'Relevanssi',
			'slug'     => 'relevanssi',
			'required' => true,
		)
	);
	$config  = array(
		'id'           => 'starter',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'starter_register_required_plugins' );
