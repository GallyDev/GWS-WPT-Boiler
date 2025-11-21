<?php
$name = basename( __DIR__ );

$block = [
	'title'             => __('Beispiel'),
	'description'       => __('Ein Beispiel-Block.'),
	'keywords'          => array('GWS', 'Beispiel'),

	'category'          => 'widgets',
	'icon'              => 'groups',
	'supports'          => array(),
	'mode'              => 'edit', // 'preview' oder 'edit'


	// automatisch generierte Werte
	'name'              => $name,
	'render_template' => get_theme_file_path( "/theme/blocks/$name/block.php" ),
];

// Pfade für Assets
$style_path = "/theme/blocks/$name/style.css";
$script_path = "/theme/blocks/$name/script.js";

// CSS einbinden, falls vorhanden
if ( file_exists( get_theme_file_path( $style_path ) ) ) {
    $v = filemtime( get_theme_file_path( $style_path ) );
    $block['enqueue_style'] = get_theme_file_uri( $style_path ) . '?v=' . $v;
}

// JS einbinden, falls vorhanden
if ( file_exists( get_theme_file_path( $script_path ) ) ) {
    $v = filemtime( get_theme_file_path( $script_path ) );
    $block['enqueue_script'] = get_theme_file_uri( $script_path ) . '?v=' . $v;
}

acf_register_block_type($block);