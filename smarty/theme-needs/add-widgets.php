<?php

///////////
///////////
///////////
///////////
//Add Widgets

function boiler_widgets_init() {

    register_sidebar( array(
      'name'          => __( 'Sidebar Widgets', 'customsidebar' ),
      'id'            => 'sidebar-area',
      'description'   => __( 'Add widgets here to appear in your sidebar area.', 'customsidebar' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s mb-5">',
      'after_widget'  => '</div>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>',
    ) );
  
    register_sidebar( array(
      'name'          => __( 'Sidebar Widgets Posts', 'custompostsidebar' ),
      'id'            => 'post-sidebar-area',
      'description'   => __( 'Add widgets here to appear in your posts sidebar area.', 'custompostsidebar' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s mb-5">',
      'after_widget'  => '</div>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>',
    ) );
  
    register_sidebar( array(
      'name'          => __( 'Footer Contact', 'boiler' ),
      'id'            => 'footer-contact',
      'description'   => __( 'Add widgets here to appear in your footer area.', 'boiler' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>',
    ) );
  
    register_sidebar( array(
      'name'          => __( 'Footer Navi', 'boilerv' ),
      'id'            => 'footer-nav',
      'description'   => __( 'Add widgets here to appear in your footer area.', 'boiler' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>',
    ) );
  
  
  }
  add_action( 'widgets_init', 'boiler_widgets_init' );