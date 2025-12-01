<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="search-modal" class="search-modal-overlay">
        <button class="close-search">&times;</button>
        <div class="search-container">
            <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                <input type="search" class="search-field" placeholder="חפש כרטיס ביקור..." value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="search-submit">חפש</button>
            </form>
            <p class="search-instruction">הקלד שם, תפקיד או חברה ולחץ Enter</p>
        </div>
    </div>

    <div class="mobile-menu-overlay">
        <div class="mobile-menu-inner">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu', // השם שרשמנו בפונקציות
                'container'      => false,          // בלי עטיפת DIV מיותרת
                'menu_class'     => 'mobile-nav-list', // הקלאס ל-UL
                'fallback_cb'    => false           // אם אין תפריט, אל תציג כלום
            ));
            ?>
        </div>
    </div>

    <header class="site-header">
        <div class="container header-grid">
            <div class="site-logo">
                <a href="<?php echo home_url(); ?>">
                    <span class="logo-text">VCARD<span class="dot">.</span></span>
                </a>
            </div>

            <div class="header-tools">
                <button class="search-trigger" aria-label="חיפוש">
                    <i class="dashicons dashicons-search"></i>
                </button>

                <button class="hamburger-btn" aria-label="תפריט">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <main class="site-main">