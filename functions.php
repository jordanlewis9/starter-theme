<?php
/**
 * Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Starter_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

if (!function_exists('starter_theme_setup')) :
	function starter_theme_setup() {
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// navigation menus
		register_nav_menus( array(
			'primary'   => 'Primary Menu',
			'utility'   => 'Utility Menu',
			'footer'   	=> 'Footer Menu'
		));

		// remove ul from wp_nav_menu for quicker and/or better access to selectors
		function remove_ul ( $menu ){
			return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
		}
		add_filter( 'wp_nav_menu', 'remove_ul' );

		// add class "active" to active menu item
		add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
		function special_nav_class($classes, $item){
			if( in_array('current-menu-item', $classes) ){
				$classes[] = 'active ';
			}
			return $classes;
		}

		// add class to first and last menu items for wp_nav_menu
		function first_and_last_menu_class($items) {
			$items[1]->classes[] = 'first';
			$items[count($items)]->classes[] = 'last';
			return $items;
		}
		add_filter('wp_nav_menu_objects', 'first_and_last_menu_class');

	}
endif;
add_action( 'after_setup_theme', 'starter_theme_setup' );

// declare woocommerce support
function starter_theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'starter_theme_add_woocommerce_support' );

// allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// allow shortcodes in acf textareas
function text_area_shortcode($value, $post_id, $field) {
	if (is_admin()) {
		return $value;
	}
	return do_shortcode($value);
}
add_filter('acf/load_value/type=textarea', 'text_area_shortcode', 10, 3);

// check to see if acf is active and then do stuff or don't
include_once(ABSPATH . 'wp-admin/includes/plugin.php'); 
if(is_plugin_active('advanced-custom-fields-pro/acf.php')) {

	// register widget areas
	function starter_theme_widgets_init() {
		register_sidebar( array(
			'name' 			=> 'Footer 1',
			'id' 			=> 'footer-1',
			'before_widget' => '<div id="footer-widget-1" class="footer-widget footer-widget-1 %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="footer-widget-title footer-widget-title-1">',
			'after_title' 	=> '</h4>',
		));
		register_sidebar( array(
			'name' 			=> 'Footer 2',
			'id' 			=> 'footer-2',
			'before_widget' => '<div id="footer-widget-2" class="footer-widget footer-widget-2 %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="footer-widget-title footer-widget-title-2">',
			'after_title' 	=> '</h4>',
		));
		register_sidebar( array(
			'name' 			=> 'Footer 3',
			'id' 			=> 'footer-3',
			'before_widget' => '<div id="footer-widget-3" class="footer-widget footer-widget-3 %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="footer-widget-title footer-widget-title-3">',
			'after_title' 	=> '</h4>',
		));
		register_sidebar( array(
			'name' 			=> 'Footer 4',
			'id' 			=> 'footer-4',
			'before_widget' => '<div id="footer-widget-4" class="footer-widget footer-widget-4 %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="footer-widget-title footer-widget-title-4">',
			'after_title' 	=> '</h4>',
		));
	}
	add_action( 'widgets_init', 'starter_theme_widgets_init' );

	// set favicon
	function add_my_favicon() {
		$favicon_path = get_field('favicon', 'options');
		echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '" />';
	}
	add_action( 'wp_head', 'add_my_favicon' ); //front end
	add_action( 'admin_head', 'add_my_favicon' ); //admin end

	// remove default editor from acf page template
	function remove_editor() {
		if (isset($_GET['post'])) {
			$id = $_GET['post'];
			$template = get_post_meta($id, '_wp_page_template', true);
			switch ($template) {
				case 'acf-page-template.php':
					remove_post_type_support( 'page', 'editor' );
					remove_post_type_support( 'page', 'thumbnail' );
					remove_post_type_support( 'page', 'comments' );
					remove_post_type_support( 'page', 'revisions' );
				break;
				default :
				// Don't remove any other template.
				break;
			}
		}
	}
	add_action('init', 'remove_editor');

	// acf options pages
	if ( function_exists( 'acf_add_options_page' ) ) {
		$child = acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Options',
			'menu_title' 	=> 'Theme Options',
			'menu_slug'   	=> 'theme-options',
			'parent_slug' 	=> 'themes.php',
		));
		$child = acf_add_options_sub_page(array(
			'page_title' 	=> 'Blog Settings',
			'menu_title' 	=> 'Blog Settings',
			'menu_slug'   	=> 'blog-settings',
			'parent_slug' 	=> 'edit.php',
		));
	}
}

// disable custom css in customizer
add_action('customize_register', 'jt_customize_register');
function jt_customize_register($wp_customize) {
	$wp_customize->remove_control('custom_css');
}

// disable autosave
add_action( 'admin_init', 'disable_autosave' );
function disable_autosave() {
	wp_deregister_script( 'autosave' );
}

// disable file edits
function disable_file_edit_action() {
	define('DISALLOW_FILE_EDIT', true);
}
add_action('init','disable_file_edit_action');

// allow additional upload mime types
function starter_upload_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'starter_upload_mimes');

require_once get_template_directory() . '/inc/required-plugins.php';

require_once get_template_directory() . '/inc/shortcodes.php';

// scripts n' styles
function starter_theme_scripts() {
	wp_enqueue_style( 'starter-styles', get_template_directory_uri() . '/build/bundle.css', null, '20201217' );
	wp_enqueue_script( 'starter-scripts', get_template_directory_uri() . '/build/bundle.js', null, '20201217' );
}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

function starter_theme_enqueue_admin_stuff() {
		wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin/admin.css', false, '1.0.0' );
		wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'starter_theme_enqueue_admin_stuff' );