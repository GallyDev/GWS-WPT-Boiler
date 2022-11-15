<nav class="navbar navbar-expand-lg fixed" id="nav">
  <div class="container-fluid">
  	
    <a class="navbar-brand" href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>">
	<?php 
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
 
		if ( has_custom_logo() ) { ?>
			<img src="<?php echo esc_url( $logo[0] )?>" alt="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>"> <?php echo get_bloginfo('name'); ?>
		<?php } else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/style/logo.svg" alt="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>"> <?php echo get_bloginfo('name'); ?>
		<?php } ?>
    	
    </a>

	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list"></i>
    </button>

    <?php
	wp_nav_menu([
		'menu'            => 'haupt-menu',
		'theme_location'  => 'main-menu',
		'container'       => 'div',
		'container_id'    => 'navbarSupportedContent',
		'container_class' => 'collapse navbar-collapse',
		'menu_id'         => false,
		'menu_class'      => 'navbar-nav ms-auto',
		'depth'           => 2,
		'fallback_cb' => '__return_false',
		'walker'          => new bootstrap_5_wp_nav_menu_walker()
	]);
	?>

  </div>
</nav>
