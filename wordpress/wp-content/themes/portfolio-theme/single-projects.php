<?php
/**
 * The template for displaying a single project
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
                    <div class="project-meta">
                        <?php
                        $categories = get_the_terms( get_the_ID(), 'project_category' );
                        if ( $categories && ! is_wp_error( $categories ) ) {
                            echo '<div class="project-categories">';
                            echo '<strong>' . esc_html__( 'Danh mục:', 'portfolio-theme' ) . '</strong> ';
                            $category_links = wp_list_pluck( $categories, 'name' );
                            echo wp_kses_post( implode( ', ', $category_links ) );
                            echo '</div>';
                        }
                        ?>
                    </div>
                </footer>
            </article>

            <nav class="post-navigation">
                <div class="nav-previous">
                    <?php previous_post_link( '%link', '← ' . esc_html__( 'Dự án trước', 'portfolio-theme' ) ); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link( '%link', esc_html__( 'Dự án sau', 'portfolio-theme' ) . ' →' ); ?>
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
