<?php

// Include custom navwalker
require_once('smarty/theme-needs/bs5navwalker.php'); 

// HTMl Sitemap
require_once('smarty/theme-needs/html-sitemap.php'); 

// Permalink setup
require_once('smarty/theme-needs/permalink-setup.php'); 

// Add widgets
require_once('smarty/theme-needs/add-widgets.php'); 

// Breadcrumb
require_once('smarty/theme-needs/breadcrumb.php'); 

// Costumizer setup
add_theme_support( 'custom-logo' );
require_once('smarty/theme-needs/costumizer-setup.php'); 

// Include cptfile
//require_once('smarty/theme-needs/cpt.php'); 


/* for Contact-Form-7 */
define('WPCF7_AUTOP', false);

//Support
add_post_type_support( 'page', 'excerpt' );

//SVG Upload
function enable_svg_upload( $upload_mimes ) {
  $upload_mimes['svg'] = 'image/svg+xml';
  $upload_mimes['svgz'] = 'image/svg+xml';
  return $upload_mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );


//Add ThemeCSS

function theme_css_files(){
  wp_enqueue_style("bscss",get_template_directory_uri().'/assets/css/bootstrap.min.css');
  wp_enqueue_style("bsicons",get_template_directory_uri().'/assets/css/bootstrap-icons.css');
  wp_enqueue_style("maincss",get_template_directory_uri().'/assets/css/main.css');
}
add_action('wp_enqueue_scripts', 'theme_css_files');


//LoginStyle

function custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri(). '/assets/css/costum-login.css" />'; 
}
add_action('login_head', 'custom_login');

//LoginLink
// changing the logo link from wordpress.org to your site
function mb_login_url() {  return 'https://www.gally-websolutions.com?wordpress=support'; }
add_filter( 'login_headerurl', 'mb_login_url' );

// changing the alt text on the logo to show your site name
function mb_login_title() { return get_option( 'blogname' ); }
add_filter( 'login_headertitle', 'mb_login_title' );


// Add Gutenberg Styling

add_action( 'after_setup_theme', 'boiler_gutenberg_css' );
 
function boiler_gutenberg_css(){
 
	add_theme_support( 'editor-styles' ); 
	add_editor_style( 'assets/css/main-editor.css' ); 
 
}


//Add ThemeScripts

function theme_js_files(){
 
  wp_enqueue_script('bsjs', get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array(), false, true); 
  wp_enqueue_script('functionjs', get_template_directory_uri().'/assets/js/functions.js', array('jquery'), false, true);

}
add_action('wp_enqueue_scripts', 'theme_js_files');


//Remove uneccesary

add_action( 'template_redirect', function(){
    ob_start( function( $buffer ){
        $buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
        
        // Also works with other attributes...
        $buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
        $buffer = str_replace( array( 'frameborder="0"', "frameborder='0'" ), '', $buffer );
        $buffer = str_replace( array( 'scrolling="no"', "scrolling='no'" ), '', $buffer );
        
        return $buffer;
    });
});

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


//Add thumbnail, automatic feed links and title tag support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );


//Add Exerptlength
function boiler_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'boiler_custom_excerpt_length', 999 );


function wpdocs_my_search_form( $form ) {
  $form = '<form role="search" method="get" id="searchform" class="searchform " action="' . home_url( '/' ) . '" >
  <div class="input-group"><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
  <input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
  <button class="btn " type="submit"><i class="bi bi-search"></i></button>
  </div>
  </form>';

  return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


//Alternativtext Column
function wpse_media_extra_column( $cols ) {
    $cols["alt"] = "ALT";
    return $cols;
}

function wpse_media_extra_column_value( $column_name, $id ) {
    if( $column_name == 'alt' )
        echo get_post_meta( $id, '_wp_attachment_image_alt', true);
}
add_filter( 'manage_media_columns', 'wpse_media_extra_column' );
add_action( 'manage_media_custom_column', 'wpse_media_extra_column_value', 10, 2 );


//  Search 

function custom_search_form( $form ) {
  $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
  <div class="input-group mb-3">
  <input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" aria-describedby="suche" placeholder="Finden Sie Ihren Kurs oder Lehrgang">
  <button class="btn btn-green px-5 m-0" type="submit" id="suche"><i class="bi bi-search"></i></button>
  </div>
    
  </form>';

  return $form;
}

add_filter( 'get_search_form', 'custom_search_form', 100 );

add_action( 'pre_get_posts', function( $query ) {

  // Check that it is the query we want to change: front-end search query
  if( $query->is_main_query() && ! is_admin() && $query->is_search() ) {

      // Change the query parameters
      $query->set( 'posts_per_page', -1 );

  }

} );

// END THEME OPTIONS

?>