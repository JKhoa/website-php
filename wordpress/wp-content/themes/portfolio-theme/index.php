<?php
/**
 * Main Template File
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </span>
                            <span class="byline">
                                <?php esc_html_e( 'Bởi', 'portfolio-theme' ); ?>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>
                        </div>
                    </header>

                    <?php
                    if ( has_post_thumbnail() ) {
                        ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages( array(
                            'before'      => '<div class="page-links">' . esc_html__( 'Trang:', 'portfolio-theme' ),
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <div class="entry-tags">
                            <?php the_tags( '<span class="tag-label">' . esc_html__( 'Thẻ:', 'portfolio-theme' ) . '</span> ', ', ', '' ); ?>
                        </div>
                    </footer>
                </article>
                <?php
            }

            // Pagination
            the_posts_pagination( array(
                'mid_size'           => 2,
                'prev_text'          => esc_html__( '← Trước', 'portfolio-theme' ),
                'next_text'          => esc_html__( 'Tiếp →', 'portfolio-theme' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Trang', 'portfolio-theme' ) . ' </span>',
            ) );
        } else {
            ?>
            <div class="no-posts-found">
                <h2><?php esc_html_e( 'Không tìm thấy bài viết', 'portfolio-theme' ); ?></h2>
                <p><?php esc_html_e( 'Xin lỗi, nhưng không có bài viết nào phù hợp với tiêu chí tìm kiếm của bạn.', 'portfolio-theme' ); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
