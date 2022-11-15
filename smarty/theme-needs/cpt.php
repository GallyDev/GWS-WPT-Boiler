<?php
// All CPTs

function post_type_labels($singular = 'Post', $plural = 'Posts') {
    $p_lower = strtolower($plural);
    $s_lower = strtolower($singular);

    return [
        'name' => $plural,
        'singular_name' => $singular,
        'add_new_item' => "Neu: $singular",
        'edit_item' => "Bearbeite $singular",
        'view_item' => "Zeige $singular",
        'view_items' => "Zeige $plural",
        'search_items' => "Suche $plural",
        'not_found' => "Keine $plural gefunden",
        'not_found_in_trash' => "Keine $plural in Papierkorb gefunden",
        'all_items' => "Alle $plural",
        'archives' => "$singular Archives",
        'attributes' => "$singular Attribute",
    ];
}

//CPT einrichten

add_action( 'init', function() {
    $type = 'personen';
    $labels = post_type_labels('Person', 'Personen');
    $supports = ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'];

    $arguments = [
        'show_in_rest' => true, // Required for Gutenberg
        'supports' => $supports, // Required for Gutenberg
        'hierarchical' => true, 
        'has_archive' => true,
        'public' => true,
        'description' => '',
        'menu_icon' => 'dashicons-desktop',
        'labels'  => $labels,
    ];
    register_post_type( $type, $arguments);
});







