<?php
define('THEME_VERSION', '1.0.0' .  time());

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'templates' );
add_theme_support( 'custom-logo' );

// WP Menüs / Navigation
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
  register_nav_menus(
      array(
		'menu-nav-main' 	  => __( 'Navigation: Hauptmenü' ),
		'menu-nav-secondary'  => __( 'Navigation: Sekundärmenü' ),
		'menu-legal'	 	  => __( 'Navigation: Rechtliches' ),
		'menu-footer'	 	  => __( 'Footer: Menü' ),
      )
  );
}

// SVG Upload
function enable_svg_upload( $upload_mimes ) {
	$upload_mimes['svg'] = 'image/svg+xml';
	$upload_mimes['svgz'] = 'image/svg+xml';
	return $upload_mimes;
  }
  add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );

  // REMOVE WP EMOJI
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );


// Add Scripts

$scripts = [
	// [
	// 	'handle' => 'gws-functions',
	// 	'src' => get_template_directory_uri().'/assets/js/functions.js',
	// 	'deps' => [],
	// 	'ver' => THEME_VERSION . filemtime( get_theme_file_path('/assets/js/functions.js') ),
	// 	'in_footer' => true
	// ],
];

function theme_js_files(){
	global $scripts;
	foreach($scripts as $script){
		wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
	}
}
add_action('wp_enqueue_scripts', 'theme_js_files');




//Add CSS

$styles = [
	[
		'handle' => 'mother',
		'src' => get_theme_file_uri('/assets/css/mother.css'),
		'deps' => [],
		'ver' => THEME_VERSION . filemtime( get_theme_file_path('/assets/css/mother.css') ),
		'media' => 'all', 
		'editor' => false // false = nur frontend, 'only' = nur editor, true = beides
	],
];

function theme_assets(){
	global $styles;
	foreach($styles as $style){
		if($style['editor'] !== 'only'){
			wp_enqueue_style( $style['handle'], $style['src'], $style['deps'], $style['ver'], $style['media'] );
		}
	}
}
add_action('wp_enqueue_scripts', 'theme_assets');

function boiler_gutenberg_css(){
	global $styles;
	add_theme_support( 'editor-styles' ); 
	foreach($styles as $style){
		if($style['editor']){
			$src = $style['src'];
			$src = str_replace(get_template_directory_uri(), '', $src);
			add_editor_style( $src );
		}
	}
}
add_action( 'after_setup_theme', 'boiler_gutenberg_css' );


// ACF Blocks
function my_acf_blocks_init() {

	if( function_exists('acf_register_block_type') ) {
		// alle Ordner im blocks Verzeichnis durchgehen
		$blocks_dir = get_theme_file_path('/theme/blocks/');
		$blocks = array_filter(glob($blocks_dir . '*'), 'is_dir');
		foreach($blocks as $block){
			if(basename($block)[0] === '_')continue;
			if(file_exists($block . '/config.php')){
				include_once($block . '/config.php');
			}

		}
			
	}
  
}
add_action('acf/init', 'my_acf_blocks_init');


// Gutenberg Block Rendering anpassen 
add_filter( 'render_block_core/details', 'render_details', 10, 2 );
function render_details( $block_content, $block ) {
	$block_content = preg_replace('/<summary>(.*?)<\/summary>/', '<summary><h3>$1</h3></summary>', $block_content);
    return $block_content;
}