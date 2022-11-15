<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(isset($class) ? $class : ''); ?>>

<main>
    <section class="fourofour">
    
        <div class="container-fluid text-center p-5">
            <div class="row">

                <div class="col-md">
                    <a href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>">
                        <?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>
                    </a>

                    <h3>Seite nicht gefunden</h3>
                    <p>Leider existiert unter dieser URL keine Seite.<br><br>
                    <a href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo( 'description', 'display' );?>" class="btn btn-primary">Zur Startseite</a>
                    
                    
                </div>
                
            </div>
        </div>
    </section>
</main>

<?php wp_footer() ; ?>

</body>
</html>