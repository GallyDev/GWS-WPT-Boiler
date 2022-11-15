<?php if ( is_active_sidebar( 'post-sidebar-area' )  ) : ?>
                
    <div class="col-md-3 post-sidebar-widget-area" role="complementary">
        <?php dynamic_sidebar( 'post-sidebar-area' ); ?>
    </div>
    
<?php endif; ?>