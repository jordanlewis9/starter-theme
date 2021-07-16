<?php 
// change logo link on login page
function  custom_login_title() {
	return get_option('blogname');
}
add_filter('login_headertext', 'custom_login_title');

add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url($url) {
	return '/';
}

// customize wp-login
function my_login_logo() { ?>
	<?php 
		$login_logo 			= get_field('login_logo', 'options');
		$login_logo_width 		= get_field('login_logo_width', 'options');
		$login_logo_height 		= get_field('login_logo_height', 'options');
		$login_button_color 	= get_field('login_button_color', 'options');
	?>
	<style type="text/css">
		body {
			background: #FFFFFF !important;
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;
		}
		#login h1 a,
		.login h1 a {
			background-image: url('<?php echo get_template_directory_uri(); ?>/img/logo.svg');
			height: 61px;
			width: 222px;
			background-size: 222px 61px;
			background-repeat: no-repeat;
			padding-bottom: 0;
		}
		form#loginform {
			border-radius: 4px !important;
			box-shadow: 5px 5px 20px rgba(0, 0, 0, .5);
			background: #fff !important;
		}
		.wp-core-ui .button-primary {
			text-transform: uppercase;
			background: #002855 !important;
			border-color: #002855 !important;
			border: 1px solid #002855 !important;
			box-shadow: none !important;
			color: #fff;
			text-decoration: none;
			text-shadow: none !important;
			transition: all 0.2s linear !important;
			border-radius: 50px !important;
			height: 50px !important;
			padding: 0 40px !important;
		}
		.wp-core-ui .button-primary:hover {
			background: #FFFFFF !important;
			border: 1px solid #002855 !important;
			color: #002855 !important;
		}
		#nav {
			color: #fff !important;
			text-align: center !important;
		}
		#backtoblog {
			text-align: center !important;
		}
		#nav a {
			padding: 0 10px;
		}
		#nav a,
		#backtoblog a,
		a.privacy-policy-link {
			color: #002855 !important;
			transition: color 0.2s linear !important;
			text-decoration: none !important;
		}
		#nav a:hover,
		#backtoblog a:hover,
		a.privacy-policy-link:hover {
			color: #002855 !important;
		}
		.message {
			border-left: 4px solid #002855 !important;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );