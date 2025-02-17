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
                                'menu_class'      => 'list-unstyled list-inline',
                                'menu_id'         => 'main-menu',
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

        <!-- Mobile Menu -->
        <div id="mobile-menu-wrapper" class="visible-xs">
            <button id="mobile-menu-toggle">☰</button>
            <nav id="mobile-menu">
                <?php
                $mobile_nav_args = array(
                    'menu'            => '',
                    'container'       => '',
                    'menu_class'      => 'mobile-menu-list',
                    'menu_id'         => 'mobile-menu-list',
                    'theme_location'  => 'main-menu',
                );
                wp_nav_menu($mobile_nav_args);
                ?>
            </nav>
        </div>
    </div>

    <script>
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('open');
        });
    </script>

    <style>
        #mobile-menu-wrapper {
            position: relative;
            text-align: right;
            padding: 10px;
        }

        #mobile-menu-toggle {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        #mobile-menu {
            display: none;
            background: #333;
            padding: 10px;
            position: absolute;
            top: 40px;
            right: 10px;
            width: 200px;
            border-radius: 5px;
        }

        #mobile-menu.open {
            display: block;
        }

        .mobile-menu-list {
            list-style: none;
            padding: 0;
        }

        .mobile-menu-list li a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
    </style>