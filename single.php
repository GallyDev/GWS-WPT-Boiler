<?php
/**
 * The template for displaying all single posts and attachments
 **/

get_header();
?>
<main>
  <section id="sectioncontent" class="paddingbox">
    <div class="container-fluid smallcontent">
        <?php if (function_exists('nav_breadcrumb')) nav_breadcrumb(); ?>
    </div>
    <div class="container-fluid smallcontent">
        
        <?php the_title('<h1>','</h1>'); ?>

        <div class="row">
            <div class="col">

                <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php the_content(); ?>
                </div>

                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
                
            </div>
        </div>
        <div class="row">
            <div class="col">

                <!--Commentzone-->
                <?php comments_template (); ?>
                
            </div>
        </div>
    </div>
	  
  </section>
</main>

<?php get_footer(); ?>