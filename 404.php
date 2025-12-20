<?php 

	$args = array(
		'name'        => 'error-404',
		'post_type'   => 'page',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	
	$page_404 = get_posts($args);
	if ($page_404) {
		$post = $page_404[0];
		setup_postdata( $post );
		
		if (file_exists(get_template_directory() . '/page.php')) {
			include( get_template_directory() . '/page.php' );
		} else {
			include( get_template_directory() . '/index.php' );
		}		
		
		wp_reset_postdata();
	} else {
		header("HTTP/1.0 404 Not Found");
		header("Location: " . home_url());
		exit();
	}