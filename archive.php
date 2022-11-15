<?php
get_header();
?>

<main>
  <section id="sectioncontent" class="paddingbox">

        <div class="container-fluid ">
            <h1><?php the_archive_title(); ?></h1>
            <div class="row">
                <?php 
                $count = 1;
                while( have_posts() ) { the_post(); 
                    if ( $count % 2 == 1){ ?>
                        
                    <?php } ?>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="card text-center">
                                <figure>
                                    <a href="<?php the_permalink();?>" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>: <?php the_title();?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </figure>
                                <small><?php echo get_the_date(); ?></small>
                                <hr>
                                <div class="px-5">
                                    <h4><?php the_title();?></h4>
                                    <p><?php the_excerpt( );?></p>
                                </div>
                                <a class="btn mt-auto mb-5" href="<?php the_permalink();?>" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>: <?php the_title();?>">weiterlesen</a>
                            </div>
                        </div>
                    <?php if ( $count % 2 == 0 ){ ?>
                        
                    <?php } $count++; ?>
            
                <?php } 
                
               ?>
           </div>     
        </div>

        <div class="container text-center">
            <?php  echo paginate_links(); ?>
        </div>
        
  </section>
</main>

<?php get_footer(); ?>