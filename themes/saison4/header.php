<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Page d'accueil -->
    <?php if (is_front_page()) : ?>
    <meta name="description" content="C'est la meta-description de la page d'accueil" />
    <?php endif; ?>
    <!-- Page du blog -->
    <?php if (is_home()) : ?>
    <meta name="description" content="C'est la meta-description de la page du blog des articles" />
    <?php endif; ?>
    <!-- Page category -->
    <?php if (is_category()) : ?>
    <meta name="description"
        content="C'est la meta-description des articles avec la category <?php echo single_cat_title('', false); ?>" />
    <?php endif; ?>
    <!-- Page tags -->
    <?php if (is_tag()) : ?>
    <meta name=" description"
        content="C'est la meta-description des articles avec le tag ou étiquette <?php echo single_tag_title('', false); ?>" />
    <?php endif; ?>
    <!-- ------------ -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>
    <main class="main">
        <header class="header_desktop">
            <!-- Assignation du menu principal -->
            <!-- Logo avec lien sur accueil -->
            <!-- <a href="<?php echo home_url('/'); ?>" class="header_logo_link">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" class="header_logo_img"
                    alt="Logo">
            </a>
            <?php
            wp_nav_menu(
                array(
                    'menu' => 'top-menu', // nom du menu en interne
                    'theme_location' => 'primary', // doit correspondre avec le menu dans functions.php
                    'container' => 'ul', // afin d'éviter d'avoir une div autour 
                    'menu_class' => 'header__menu__desktop', // ma classe personnalisée 
                )
            );
            ?> -->
        </header>

        <!-- <nav class="navbar sticky-top navbar-expand-md navbar-dark" style="background-color: #6f42c1;"> -->
        <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-info">
            <div class="container col-12 col-md-8 col-lg-6">
                <a class="navbar-brand text-uppercase fs-3" href="<?php echo home_url('/'); ?>">saison 4</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-white" id="main-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        // 'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 3,
                        'walker' => new bs5_Walker()
                    ));
                    ?>
                </div>
            </div>
        </nav>
        <!-- Exercice Test Jumbotron Saison 2 -->
        <section class="section-header container-fluid">
            <div class="container bg-secondary">
                <?php $theme_opts = get_option('dvmac_opts'); ?>
                <div class="row py-1">
                    <div class="col-sm-12 col-lg-4 order-sm-1 order-lg-0 d-flex flex-column align-items-center">
                        <img src="<?php echo $theme_opts['img_01_url']; ?>" alt="" class="img-fluid w-50">
                        <!-- stripslashes -> escape \ -->
                        <p><?php echo stripslashes($theme_opts['legend_01']); ?></p>
                    </div>
                    <div
                        class="col-sm-12 col-lg-8 order-sm-0 order-lg-1 d-flex justify-content-center align-items-center">
                        <h2 class="display-3 text-center text-light text-uppercase ">Formation Saison 4</h2>
                    </div>
                </div>
            </div>
        </section>