<?php
/**
 * The template for displaying search results
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <h1 class="page-title">
            <?php
            printf(
                esc_html__( 'Kết quả tìm kiếm cho: %s', 'portfolio-theme' ),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>

        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </span>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="more-link">
                            <?php esc_html_e( 'Đọc thêm →', 'portfolio-theme' ); ?>
                        </a>
                    </div>
                </article>
                <?php
            }

            the_posts_pagination( array(
                'mid_size'           => 2,
                'prev_text'          => esc_html__( '← Trước', 'portfolio-theme' ),
                'next_text'          => esc_html__( 'Tiếp →', 'portfolio-theme' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Trang', 'portfolio-theme' ) . ' </span>',
            ) );
        } else {
            ?>
            <div class="no-posts-found">
                <h2><?php esc_html_e( 'Không tìm thấy kết quả', 'portfolio-theme' ); ?></h2>
                <p><?php esc_html_e( 'Xin lỗi, nhưng không có bài viết nào phù hợp với tiêu chí tìm kiếm của bạn. Vui lòng thử lại.', 'portfolio-theme' ); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
