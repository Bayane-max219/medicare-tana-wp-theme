<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="container header-inner">

        <!-- Logo -->
        <div class="site-logo">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                    <span class="logo-hexagon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <polygon points="21,2 38,11.5 38,30.5 21,40 4,30.5 4,11.5" fill="#0a6bb8"/>
                            <rect x="18" y="10" width="6" height="22" rx="2" fill="white"/>
                            <rect x="10" y="18" width="22" height="6" rx="2" fill="white"/>
                        </svg>
                    </span>
                    <span class="logo-name">
                        <strong>Medi</strong><span>Care<em>Tana</em></span>
                    </span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="site-nav" id="site-nav" aria-label="Navigation principale">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'nav-list',
                'container'      => false,
                'fallback_cb'    => function() {
                    echo '<ul class="nav-list">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#medecins">Médecins</a></li>
                        <li><a href="#apropos">À propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>';
                },
            ]);
            ?>
        </nav>

        <!-- CTA Header -->
        <div class="header-cta">
            <a href="#contact" class="btn btn-primary btn-sm">
                <i class="fas fa-calendar-check"></i>
                Prendre RDV
            </a>
        </div>

        <!-- Burger menu (mobile) -->
        <button class="burger-menu" id="burger-menu" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>

<!-- Overlay mobile menu -->
<div class="nav-overlay" id="nav-overlay"></div>
