<?php
/**
 * The template for displaying single posts
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <?php
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
                    <div class="entry-categories">
                        <?php the_category( ', ' ); ?>
                    </div>
                    <div class="entry-tags">
                        <?php the_tags( '<span class="tag-label">' . esc_html__( 'Thẻ:', 'portfolio-theme' ) . '</span> ', ', ', '' ); ?>
                    </div>
                </footer>
            </article>

            <nav class="post-navigation">
                <div class="nav-previous">
                    <?php previous_post_link( '%link', '← ' . esc_html__( 'Bài trước', 'portfolio-theme' ) ); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link( '%link', esc_html__( 'Bài sau', 'portfolio-theme' ) . ' →' ); ?>
                </div>
            </nav>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
