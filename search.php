<?php
get_header();?>

<main>
    <section class="sectioncontent" class="paddingbox">
    <div class="container-fluid">
            <h1 class="search-title mb-0"> <?php echo $wp_query->found_posts; ?>
            <?php _e( 'Suchergebnisse für', 'locale' ); ?>: "<?php the_search_query(); ?>" </h1>     

            <div class="searchbox w-100 py-5">
                <?php get_search_form(); ?>
                
            </div>

                <?php if ( have_posts() ) { ?>

                    <?php while ( have_posts() ) { the_post(); 
                        
                    ?>

                    <div class="row result align-items-center">
                        <?php $postType = get_post_type_object(get_post_type());
                            if ($postType) {
                                $typename = esc_html($postType->labels->singular_name);
                            } ?>
                
                                <a class="blockbtn" href="<?php the_permalink(); ?>" title="<?php echo get_bloginfo('name'); ?>"></a>
                    

                        <div class="col-md-6">
                            <h5 class="mb-0">
                                <?php the_title();?>
                            </h5>
                        </div>

                        <div class="col-6 col-md-4">
                            <?php echo $typename;?><br>
                            <?php $category = get_the_category();
             $allcategory = get_the_category(); 
        foreach ($allcategory as $category) {

            // Get the ID of a given category
    $category_id = get_cat_ID( $category->cat_name);
 
    // Get the URL of this category
    $category_link = get_category_link( $category_id );
        ?>
          <small><?php echo $category->cat_name; ?></small>
        <?php 
        }
        ?>
                        </div>
                        

                        <div class="col-6 col-md-2 text-end">
                            <a href="<?php the_permalink(); ?>" class="btn" title="<?php echo get_bloginfo('name'); ?>" ><?php _e( '+', 'brooker'); ?></a></h5>
                        </div>

                    </div>

                    <?php } ?>
                <?php } ?>
        </div>
    </section>
</main>



<?php get_footer(); ?>