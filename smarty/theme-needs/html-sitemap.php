<?php

///////////
///////////
///////////
///////////
//Sitemap


function get_html_sitemap( $atts ){

    $return = '';
    $args = array('public'=>1);

// Types ignorieren
    $ignoreposttypes = array('attachment', 'testimonials', 'personen', 'raeume', 'infoanlaesse', 'kursdaten', 'arbeitsstellen', 'suchbegriffe', 'course_dates');

    $post_types = get_post_types( $args, 'objects' ); 
$return .= '<div class="row">';

    foreach ( $post_types as $post_type ) {
        if( !in_array($post_type->name,$ignoreposttypes)){
             $return .= '<div class="col-md-6 col-lg-4 col-xxl-4 mb-5" >';
            $return .= '<h2 class="mb-3">' . $post_type->labels->name.'</h2>';
            $args = array(
                'posts_per_page'   => -1,
                'post_type'        => $post_type->name,
                'post_status'      => 'publish'
            );
            $posts_array = get_posts( $args ); 
            $return .=  '<ul>';
            foreach($posts_array as $pst){
                $return .=  '<li><a href="'.get_permalink($pst->ID).'">'.$pst->post_title.'</a></li>';
            }
            $return .=  '</ul>';
            $return .= '</div>';
        }
    }
$return .= '</div>';
return $return;
}
add_shortcode( 'htmlSitemap', 'get_html_sitemap' );
