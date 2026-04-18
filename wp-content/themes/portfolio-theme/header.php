<?php
/**
 * The template for displaying the header
 *
 * @package portfolio-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="site-wrapper">
        <header class="site-header">
            <div class="container">
                <div class="site-branding">
                    <div class="logo-section">
                        <?php
                        if ( has_custom_logo() ) {
                            the_custom_logo();
                        } else {
                            ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <i class="fas fa-code"></i>
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </h1>
                            <?php
                            $blog_description = get_bloginfo( 'description', 'display' );
                            if ( $blog_description ) {
                                ?>
                                <p class="site-description"><?php echo esc_html( $blog_description ); ?></p>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="header-actions">
                        <button id="dark-mode-toggle" class="dark-mode-btn" title="<?php esc_attr_e( 'Chế độ tối', 'portfolio-theme' ); ?>">
                            <i class="fas fa-moon"></i>
                        </button>

                        <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span class="hamburger-label"><?php esc_html_e( 'Menu', 'portfolio-theme' ); ?></span>
                        </button>
                    </div>
                </div>

                <nav class="main-navigation" id="primary-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'wp_page_menu',
                        'depth'          => 2,
                    ) );
                    ?>
                </nav>
            </div>
        </header>

        <div class="site-content">
