<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="<?php wp_title(); ?>" property="og:title">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="main-header">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-sm-6" id="logo">
                        <a href="<?php echo home_url(); ?>">
                            <img alt="Inotek" id="logo-image" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png">
                        </a>
                    </div>
                    <div class="col-lg-8 hidden-xs">
                        <nav>
                            <?php
                            $main_nav_args = array(
                                'menu'            => '',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'list-unstyled list-inline',
                                'menu_id'         => 'main-menu',
                                'echo'            => true,
                                'fallback_cb'     => false,
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'item_spacing'    => 'preserve',
                                'depth'           => 0,
                                'walker'          => '',
                                'theme_location'  => 'main-menu',
                            );
                            wp_nav_menu($main_nav_args);
                            ?>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="pull-right">
                            <?php get_template_part('template-parts/menu/menu', 'main'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <main>