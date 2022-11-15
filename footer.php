<footer>
    <div class="container-fluid paddingbox">

     <div class="row">

        <?php if ( is_active_sidebar( 'footer-contact' )  ) : ?>
            <div class="col-md-6 widget-area" role="complementary" id="footercontact">
            <?php dynamic_sidebar( 'footer-contact' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-nav' )  ) : ?>
            <div class="col-md-3 widget-area" role="complementary" id="footermenu">
                <?php dynamic_sidebar( 'footer-nav' ); ?>
            </div>
        <?php endif; ?>
           
        
     </div>

</footer>

<?php wp_footer() ; ?>

</body>
</html>