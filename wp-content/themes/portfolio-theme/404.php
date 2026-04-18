<?php
/**
 * The template for displaying 404 pages
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <div class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! Không tìm thấy trang', 'portfolio-theme' ); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e( 'Trang bạn đang tìm kiếm không tồn tại.', 'portfolio-theme' ); ?></p>
                <p><?php esc_html_e( 'Có thể bạn đã nhập địa chỉ không chính xác hoặc trang đã được di chuyển.', 'portfolio-theme' ); ?></p>

                <?php get_search_form(); ?>

                <h3><?php esc_html_e( 'Các liên kết hữu ích', 'portfolio-theme' ); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Trang chủ', 'portfolio-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>"><?php esc_html_e( 'Dự án', 'portfolio-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_page_link() ); ?>"><?php esc_html_e( 'Về tôi', 'portfolio-theme' ); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
