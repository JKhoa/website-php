<?php
/**
 * The template for displaying project archive
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <h1 class="page-title"><?php esc_html_e( 'Dự án', 'portfolio-theme' ); ?></h1>

        <div class="projects-section">
            <div class="projects-grid">
                <?php
                $args = array(
                    'post_type'      => 'projects',
                    'posts_per_page' => 12,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' ); ?>>
                            <div class="project-image">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'portfolio-project' );
                                } else {
                                    echo '<span>' . esc_html__( 'Không có hình ảnh', 'portfolio-theme' ) . '</span>';
                                }
                                ?>
                            </div>
                            <div class="project-content">
                                <h3 class="project-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="project-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="project-link">
                                    <?php esc_html_e( 'Xem chi tiết →', 'portfolio-theme' ); ?>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>' . esc_html__( 'Không tìm thấy dự án nào.', 'portfolio-theme' ) . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
