<?php
    if ( has_nav_menu( 'menu-nav-main' ) ) {
        wp_nav_menu( array(
        'theme_location' => 'menu-nav-main',
        'menu_class'     => 'nav-main', 
        'container'      => 'nav',      
        'container_class'=> 'main-navigation',
        'fallback_cb'    => false,   
        ) );
    }
?>