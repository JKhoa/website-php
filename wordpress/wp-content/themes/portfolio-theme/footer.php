        </div><!-- .site-content -->

        <footer class="site-footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-links">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                            'echo'           => true,
                        ) );
                        ?>
                    </div>

                    <div class="social-links">
                        <?php
                        $social_links = array(
                            'facebook' => 'https://facebook.com',
                            'twitter'  => 'https://twitter.com',
                            'linkedin' => 'https://linkedin.com',
                            'github'   => 'https://github.com',
                            'email'    => 'mailto:contact@example.com',
                        );

                        foreach ( $social_links as $platform => $url ) {
                            echo '<a href="' . esc_url( $url ) . '" title="' . esc_attr( ucfirst( $platform ) ) . '" target="_blank" rel="noopener noreferrer">';
                            echo '<span class="dashicon">' . ucfirst( $platform ) . '</span>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>

                <div class="copyright">
                    <p><?php echo esc_html( get_bloginfo( 'name' ) ); ?> &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> — <?php esc_html_e( 'Tất cả quyền được bảo lưu', 'portfolio-theme' ); ?></p>
                </div>
            </div>
        </footer>

    </div><!-- .site-wrapper -->

    <?php wp_footer(); ?>
</body>
</html>
