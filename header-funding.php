<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
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
                <div class="col-lg-6 col-sm-6" id="logo">
                    <a href="<?php echo home_url(); ?>">
                        <img alt="Inotek" id="logo-image" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png">
                    </a>
                </div>
                <div class="col-lg-6 col-sm-6 text-right microsite-inotek">
                    <a href="<?php echo home_url(); ?>"<strong>inotek.org</strong></a>
                </div>
            </div>
        </div>
    </header>
</div>

<main>
