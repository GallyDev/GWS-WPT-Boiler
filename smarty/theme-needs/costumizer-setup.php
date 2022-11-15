<?php

///////////
///////////
///////////
///////////
//Costumizer

function boiler_colorPicker( $wp_customize){
     
  // Add ColorSettings 
  $wp_customize->add_setting( 'ci_color', array(
      'default' => '#0000ff',
  ));


  $wp_customize->add_setting( 'dark_color', array(
      'default' => '#000000',                        
  ));

  $wp_customize->add_setting( 'mid_color', array(
    'default' => '#f4f4f4',                        
  ));

  $wp_customize->add_setting( 'light_color', array(
    'default' => '#ffffff',                        
  ));


  // Add ColorControls
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ci_color', array(
      'label' => 'CI Color',
      'section' => 'boiler_setup',
      'settings' => 'ci_color'

  )));


  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_color', array(
      'label' => 'Dark Color',
      'section' => 'boiler_setup',
      'settings' => 'dark_color'
  )));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mid_color', array(
    'label' => 'Mid Color',
    'section' => 'boiler_setup',
    'settings' => 'mid_color'
  )));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'light_color', array(
    'label' => 'Light Color',
    'section' => 'boiler_setup',
    'settings' => 'light_color'
  )));

  //FOnt-Size

  $wp_customize->add_section( 'boiler_setup' , array(
    'title'      => 'Grundeinstellungen',
    'priority'   => 20,
    ));

    $wp_customize->add_setting( 'font_setup_default' , array(
        'default'     => '16px',
    ) );
    
    $wp_customize->add_control( 'font_setup_size', array(
        'label' => 'Body Schriftgrösse',
        'section'	=> 'boiler_setup',
        'settings' => 'font_setup_default',
        'type'	 => 'text',
    ) );

}

add_action( 'customize_register', 'boiler_colorPicker' );

//Set it as inline Root in Head in Frontend

function generate_theme_option_css(){
 
  $ciColor = get_theme_mod('ci_color');
  $darkColor = get_theme_mod('dark_color');
  $midColor = get_theme_mod('mid_color');
  $lightColor = get_theme_mod('light_color');

  $fontbase = get_theme_mod('font_setup_default', '16px');
  ?>
  <style type="text/css" id="boiler-theme-option-css">

      :root{
        <?php if(!empty($fontbase)): ?>
              --font-base: <?php echo $fontbase; ?> !important;
          <?php endif; ?>
          <?php if(!empty($ciColor)): ?>
            --ci-color: <?php echo $ciColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($darkColor)): ?>
              --dark-color: <?php echo $darkColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($midColor)): ?>
              --mid-color: <?php echo $midColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($lightColor)): ?>
              --light-color: <?php echo $lightColor; ?> !important;
          <?php endif; ?>
      }
   
  </style>    

  <?php 
}

add_action( 'wp_head', 'generate_theme_option_css' );

//Set it as Style Root in Gutenberg

function generate_theme_option_css_gutenberg(){
 
    $ciColor = get_theme_mod('ci_color');
    $darkColor = get_theme_mod('dark_color');
    $midColor = get_theme_mod('mid_color');
    $lightColor = get_theme_mod('light_color');
  
    $fontbase = get_theme_mod('font_setup_default');
    ?>
    <style type="text/css" id="gutenbergextra">
  
        .editor-styles-wrapper{
          <?php if(!empty($fontbase)): ?>
              --font-base: <?php echo $fontbase; ?> !important;
          <?php endif; ?>
          <?php if(!empty($ciColor)): ?>
            --ci-color: <?php echo $ciColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($darkColor)): ?>
              --dark-color: <?php echo $darkColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($midColor)): ?>
              --mid-color: <?php echo $midColor; ?> !important;
          <?php endif; ?>
          <?php if(!empty($lightColor)): ?>
              --light-color: <?php echo $lightColor; ?> !important;
          <?php endif; ?>
        }
     
    </style>    
  
    <?php
    
  }
  
  add_action( 'admin_head', 'generate_theme_option_css_gutenberg' );


