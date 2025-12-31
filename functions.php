<?php
define('THEME_VERSION', '1.0.0.');

// Superadmin wird wahrscheinlich von Debugian vordefiniert
if(!defined('SUPERADMIN_DOMAIN')) 	define('SUPERADMIN_DOMAIN', 'gally-websolutions');

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

$scripts = [
	// [
	// 	'handle' => 'gws-functions',
	// 	'src' => get_template_directory_uri().'/assets/js/functions.js',
	// 	'deps' => [],
	// 	'ver' => THEME_VERSION . filemtime( get_theme_file_path('/assets/js/functions.js') ),
	// 	'in_footer' => true
	// ],
];

function boiler_menus() {
  register_nav_menus(
      array(
		'menu-nav-main' 	  => __( 'Navigation: Hauptmenü' ),
		'menu-nav-secondary'  => __( 'Navigation: Sekundärmenü' ),
		'menu-legal'	 	  => __( 'Navigation: Rechtliches' ),
		'menu-footer'	 	  => __( 'Footer: Menü' ),
      )
  );
}



add_action('admin_menu', 'gws_boiler_modules');
function gws_boiler_modules() {
	if(strpos(wp_get_current_user()->user_email, SUPERADMIN_DOMAIN)){
		add_submenu_page('themes.php', 'Modules', '<strong class="gws">GWS</strong> Module', 'manage_options', 'gwt-modules-boiler', 'gwt_modules_boiler');
	}
}

function gwt_modules_boiler() {
	$repo = escapeshellarg('https://github.com/GallyDev/GWS-WPTModule-Boiler.git');
	$mod_folder = get_theme_file_path('/theme/modules/');
	$modules = [];
	$repo_path = sys_get_temp_dir() . '/gws-modules-' . time();
	shell_exec('git clone ' . $repo . ' ' . escapeshellarg($repo_path));

	$install = $_POST['install'] ?? [];

	if(is_dir($repo_path)) {
		$folders = array_filter(glob($repo_path . '/*'), 'is_dir');
		foreach($folders as $folder) {
			$readme_file = $folder . '/README.md';
			$readme_text = '';
			if(file_exists($readme_file)) {
				$readme_text = file_get_contents($readme_file);
			}
			$modules[basename($folder)] = $readme_text;
		}
	}


	?>
		<div class="wrap">
			<h1>
				<strong class="gws">GWS</strong> Git-Module für das Boiler Theme

				<a href="https://github.com/GallyDev/GWS-WPTModule-Boiler" target="_blank" style="float:right" class="button button-primary">Zum GitHub Repository</a>
			</h1>
			
			<form method="post" action="?page=gwt-modules-boiler" class="gws-repos">
				<?php
				global $remove;
				foreach($modules as $module_name => $readme_text){
					$readme_text = explode("\n", $readme_text);
					$title = str_replace('# ', '', array_shift($readme_text));
					$readme_text = esc_html(array_shift($readme_text));
					$readme_text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $readme_text);

					$inst = '✅ Das Modul ist bereits installiert.<br><small>Wenn du es neu installieren möchtest, musst du den Ordner <code style="font-size:inherit">theme/modules/'.$module_name.'</code> löschen.</small>';
					if(in_array($module_name, $install)){
						$source = $repo_path . '/' . $module_name;
						$destination = $mod_folder . $module_name;
						$remove = false;
						if(!file_exists($destination)) {
							shell_exec('cp -r ' . escapeshellarg($source) . ' ' . escapeshellarg($destination));
							$inst = '✅ Das Modul wurde erfolgreich installiert.';

							if(file_exists($destination . '/setup.php')){
								ob_start();
									include_once($destination . '/setup.php');
								$ret = ob_get_clean();
								$inst .= ' <br><small>ℹ️ Das Setup-Skript wurde ausgeführt.';
								if(!empty($ret)){
									$inst .= ' Ausgabe: <pre>' . esc_html($ret) . '</pre>';
								}
								$inst .= '</small>';
								if($remove){
									shell_exec('rm -rf ' . escapeshellarg($destination));
									$inst .= '⚠️ Das Modul wurde wieder gelöscht, da das Setup-Skript dies verlangt hat.';
								}
							}


						}else{
							$inst = '⚠️ Das Modul konnte nicht installiert werden, da es bereits existiert.';
						}

					}

					?>
					<div style="background: #fff; padding: 1em; border: 1px solid #ccc; margin-bottom: 2em;">
						<h2>
							<?= esc_html($title); ?>
							<a href="https://github.com/GallyDev/GWS-WPTModule-Boiler/tree/main/<?=$module_name?>" class="page-title-action" target="_blank">Doku</a>
						</h2>
						<p><?= $readme_text;?></p>
						<?php if(file_exists($mod_folder . $module_name) || in_array($module_name, $install)){
							?>
							<label>
								<?= $inst ?>
							</label>
							<?php
						}else{ ?>
							<label>
								<input type="checkbox" name="install[]" value="<?=$module_name?>">
								installieren
							</label>
						<?php } ?>
					</div>
					<?php
				}
				?>
				
					<span>
						<input type="submit" name="submit_debugian_repos" id="submit_debugian_repos" class="button button-primary" value="Ausgewählte Module installieren">
					</span>
			</form>
		</div>
	<?php

	if(is_dir($repo_path)) shell_exec('rm -rf ' . escapeshellarg($repo_path));
}


$modules_dir = get_theme_file_path('/theme/modules/');
if(is_dir($modules_dir)){
	$mod_folders = array_filter(glob($modules_dir . '/*'), 'is_dir');
	foreach($mod_folders as $mod_folder){
		// get all php, js and css files in the module folder and include them
		$files = glob($mod_folder . '/*.{php,js,css}', GLOB_BRACE);
		foreach($files as $file){
			$filename = basename($file);
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if($ext === 'js'){
				$handle = 'module-' . basename($mod_folder) . '-' . basename($file, '.js');
				$src = str_replace(get_template_directory_uri(), '', get_theme_file_uri(str_replace(get_theme_file_path(), '', $file)));
				$scripts[] = [
					'handle' => $handle,
					'src' => get_theme_file_uri($src),
					'deps' => [],
					'ver' => THEME_VERSION . filemtime( $file ),
					'in_footer' => true
				];
			}elseif($ext === 'css'){
				$handle = 'module-' . basename($mod_folder) . '-' . basename($file, '.css');
				$src = str_replace(get_template_directory_uri(), '', get_theme_file_uri(str_replace(get_theme_file_path(), '', $file)));
				$styles[] = [
					'handle' => $handle,
					'src' => get_theme_file_uri($src),
					'deps' => [],
					'ver' => THEME_VERSION . filemtime( $file ),
					'media' => 'all',
					'editor' => false
				];
			}elseif($filename === 'functions.php'){
				include_once($file);
			}
		}
	}
}

		




add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'templates' );
add_theme_support( 'custom-logo' );
add_action( 'init', 'boiler_menus' );

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


function theme_js_files(){
	global $scripts;
	foreach($scripts as $script){
		wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
	}
}
add_action('wp_enqueue_scripts', 'theme_js_files');


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