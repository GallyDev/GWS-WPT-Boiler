<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>

</head>


<body <?php body_class(isset($class) ? $class : ''); ?> id="pagetop">




    <!--Navigation-->
        <?php include ("smarty/theme-parts/navigation.php"); ?>
    <!--EndNavigation-->


	<?php 
		$featuredIMGurl = get_the_post_thumbnail_url( $postID, 'full' );
	?>

    <header class="single">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md p-0">
                    
                    <figure class="mb-0 position-relative">
						<?php if(!empty($featuredIMGurl)) { ?>
                        	<img class="featuredimage" loading="lazy" src="<?php echo $featuredIMGurl; ?>" alt="<?php echo get_bloginfo('name'); ?> - <?php the_title(); ?>">
						<?php } else { ?>
							<img class="featuredimage" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/style/fallback.svg" alt="<?php echo get_bloginfo('name'); ?> - <?php the_title(); ?>">
						<?php } ?>
                    </figure>
                     
                </div>
            </div>
        </div>
    </header>


   


