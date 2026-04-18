<?php
/**
 * The template for displaying comments
 *
 * @package portfolio-theme
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php
    if ( have_comments() ) {
        ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( 1 === $comment_count ) {
                echo esc_html_e( '1 Bình luận', 'portfolio-theme' );
            } else {
                echo esc_html( sprintf( _n( '%s Bình luận', '%s Bình luận', $comment_count, 'portfolio-theme' ), number_format_i18n( $comment_count ) ) );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'callback'    => 'portfolio_theme_comment',
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php
        the_comments_pagination( array(
            'prev_text' => esc_html__( '← Bình luận cũ hơn', 'portfolio-theme' ),
            'next_text' => esc_html__( 'Bình luận mới hơn →', 'portfolio-theme' ),
        ) );
    }

    if ( comments_open() ) {
        comment_form( array(
            'title_reply'       => esc_html__( 'Để lại bình luận', 'portfolio-theme' ),
            'label_submit'      => esc_html__( 'Gửi bình luận', 'portfolio-theme' ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
        ) );
    }
    ?>
</div>

<?php

/**
 * Custom comment template
 */
if ( ! function_exists( 'portfolio_theme_comment' ) ) {
    function portfolio_theme_comment( $comment, $args, $depth ) {
        ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( array( 'comment-item', 'depth-' . $depth ), $comment ); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    <b class="fn">
                        <?php
                        if ( 0 === $comment->user_id ) {
                            echo wp_kses_post( $comment->comment_author );
                        } else {
                            echo wp_kses_post( get_comment_author_link( $comment ) );
                        }
                        ?>
                    </b>
                    <span class="says"><?php esc_html_e( 'nói:', 'portfolio-theme' ); ?></span>
                </div>

                <time class="comment-time" datetime="<?php comment_time( 'c' ); ?>">
                    <?php comment_date( 'j F, Y' ); ?> @ <?php comment_time(); ?>
                </time>

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>

                <div class="comment-reply">
                    <?php
                    comment_reply_link( array_merge(
                        $args,
                        array(
                            'depth'      => $depth,
                            'max_depth'  => $args['max_depth'],
                            'before'     => '<span class="reply-link">',
                            'after'      => '</span>',
                        )
                    ) );
                    ?>
                </div>

                <?php
                if ( $comment->comment_approved === '0' ) {
                    echo '<p class="comment-awaiting-moderation">' . esc_html__( 'Bình luận của bạn đang chờ phê duyệt.', 'portfolio-theme' ) . '</p>';
                }
                ?>
            </article>
        <?php
    }
}
?>
