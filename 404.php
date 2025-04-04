<?php get_header();?>

<?php
	$args = array(
		'name'        => 'error-404',
		'post_type'   => 'page',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$page_404 = get_posts($args);
	if ($page_404) {
		$content = $page_404[0]->post_content;
		$content = apply_filters('the_content', $content);
		echo $content;
	}
?>

<?php get_header();?>