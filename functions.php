<?php
add_action( 'after_setup_theme', array( 'Jason', 'init' ) );
class Jason {
	public static $path = __DIR__;
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( 'Jason', 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( 'Jason', 'scripts' ) );
		add_action( 'jason_logo',					array( 'Jason', 'logo' ) );
		self::_remove_emoji();
		require_once( self::$path.'/includes/social-walker.php' );
		register_nav_menu( 'social', __( 'Social Links', 'jason' ) );
		require_once( self::$path.'/includes/work-walker.php' );
		register_nav_menu( 'work', __( 'Work Links', 'jason' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo' );
	}
	public static function styles() {
		wp_register_style( 'jason', get_stylesheet_directory_uri(). '/style.css', array( 'jason-google-fonts' ) );
		wp_register_style( 'jason-google-fonts', '//fonts.googleapis.com/css?family=Merriweather:300,400,700,900|Roboto:300,700&amp;subset=latin,latin-ext', array() );
		$logo = self::logo();
		$css = '#profile{background-image:url('.$logo.');}';
		wp_add_inline_style( 'jason', $css );
		wp_enqueue_style( 'jason' );
	}
	public static function scripts() {
	}
	public static function logo( $echo = false ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			$logo = $image[0];
		} else {
			$logo = get_stylesheet_directory_uri().'/assets/images/profile.png';
		}
		if ( $echo ) {
			echo $logo;
		} else {
			return $logo;
		}
	}
	private static function _remove_emoji() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
}
