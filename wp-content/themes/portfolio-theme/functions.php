<?php
/**
 * Portfolio Theme Functions
 *
 * @package portfolio-theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Set up theme defaults
 */
if ( ! function_exists( 'portfolio_theme_setup' ) ) {
    function portfolio_theme_setup() {
        // Add theme support for title tag
        add_theme_support( 'title-tag' );

        // Add theme support for post thumbnails
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 825, 300, true );

        // Add custom image size for projects
        add_image_size( 'portfolio-project', 400, 250, true );

        // Register menus
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Primary Menu', 'portfolio-theme' ),
            'footer-menu'  => esc_html__( 'Footer Menu', 'portfolio-theme' ),
        ) );

        // Add support for HTML5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Add support for custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 100,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

        // Load translation
        load_theme_textdomain( 'portfolio-theme', get_template_directory() . '/languages' );
    }
}
add_action( 'after_setup_theme', 'portfolio_theme_setup' );

/**
 * Enqueue styles and scripts
 */
if ( ! function_exists( 'portfolio_theme_enqueue' ) ) {
    function portfolio_theme_enqueue() {
        // Enqueue main stylesheet
        wp_enqueue_style(
            'portfolio-theme-style',
            get_stylesheet_uri(),
            array(),
            '1.0.0',
            'all'
        );

        // Enqueue theme script
        wp_enqueue_script(
            'portfolio-theme-script',
            get_template_directory_uri() . '/assets/js/main.js',
            array(),
            '1.0.0',
            true
        );

        // Localize script for AJAX
        wp_localize_script(
            'portfolio-theme-script',
            'portfolioTheme',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'portfolio-contact-nonce' ),
            )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'portfolio_theme_enqueue' );

/**
 * AJAX Handler for contact form
 */
if ( ! function_exists( 'portfolio_send_contact_email' ) ) {
    function portfolio_send_contact_email() {
        // Verify nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'portfolio-contact-nonce' ) ) {
            wp_send_json_error( array( 'message' => esc_html__( 'Xác thực không hợp lệ. Vui lòng tải lại trang.', 'portfolio-theme' ) ) );
        }

        // Simple validation
        if ( empty( $_POST['name'] ) || empty( $_POST['email'] ) || empty( $_POST['message'] ) ) {
            wp_send_json_error( array( 'message' => esc_html__( 'Vui lòng điền đầy đủ các thông tin bắt buộc.', 'portfolio-theme' ) ) );
        }

        $name    = sanitize_text_field( $_POST['name'] );
        $email   = sanitize_email( $_POST['email'] );
        $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : esc_html__( 'Contact Form Submission', 'portfolio-theme' );
        $message = sanitize_textarea_field( $_POST['message'] );

        // Admin email
        $to = get_option( 'admin_email' );
        $body = "Name: $name \nEmail: $email \nSubject: $subject \n\nMessage:\n$message";
        $headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>" );

        // In a real environment, wp_mail would send the email. 
        // For localhost/demo, we'll simulate success.
        // $sent = wp_mail( $to, $subject, $body, $headers );
        $sent = true; 

        if ( $sent ) {
            wp_send_json_success( array( 'message' => esc_html__( 'Cảm ơn! Tin nhắn của bạn đã được gửi thành công.', 'portfolio-theme' ) ) );
        } else {
            wp_send_json_error( array( 'message' => esc_html__( 'Có lỗi xảy ra khi gửi email. Vui lòng thử lại sau.', 'portfolio-theme' ) ) );
        }
    }
}
add_action( 'wp_ajax_send_contact_email', 'portfolio_send_contact_email' );
add_action( 'wp_ajax_nopriv_send_contact_email', 'portfolio_send_contact_email' );

/**
 * Register custom post types
 */
if ( ! function_exists( 'portfolio_register_post_types' ) ) {
    function portfolio_register_post_types() {
        // Register Projects post type
        $project_args = array(
            'public'            => true,
            'label'             => esc_html__( 'Projects', 'portfolio-theme' ),
            'singular_name'     => esc_html__( 'Project', 'portfolio-theme' ),
            'menu_name'         => esc_html__( 'Projects', 'portfolio-theme' ),
            'menu_icon'         => 'dashicons-portfolio',
            'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'has_archive'       => true,
            'rewrite'           => array( 'slug' => 'projects' ),
            'taxonomies'        => array( 'category', 'post_tag' ),
            'show_in_rest'      => true,
        );
        register_post_type( 'projects', $project_args );

        // Register Skills post type
        $skill_args = array(
            'public'            => true,
            'label'             => esc_html__( 'Skills', 'portfolio-theme' ),
            'singular_name'     => esc_html__( 'Skill', 'portfolio-theme' ),
            'menu_name'         => esc_html__( 'Skills', 'portfolio-theme' ),
            'menu_icon'         => 'dashicons-awards',
            'supports'          => array( 'title', 'editor' ),
            'has_archive'       => false,
            'rewrite'           => false,
            'show_in_rest'      => true,
        );
        register_post_type( 'skills', $skill_args );
    }
}
add_action( 'init', 'portfolio_register_post_types' );

/**
 * Register custom taxonomies
 */
if ( ! function_exists( 'portfolio_register_taxonomies' ) ) {
    function portfolio_register_taxonomies() {
        // Register Project Category taxonomy
        $cat_args = array(
            'hierarchical'      => true,
            'label'             => esc_html__( 'Project Categories', 'portfolio-theme' ),
            'singular_name'     => esc_html__( 'Project Category', 'portfolio-theme' ),
            'rewrite'           => array( 'slug' => 'project-category' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'project_category', 'projects', $cat_args );

        // Register Skill Category taxonomy
        $skill_cat_args = array(
            'hierarchical'      => true,
            'label'             => esc_html__( 'Skill Categories', 'portfolio-theme' ),
            'singular_name'     => esc_html__( 'Skill Category', 'portfolio-theme' ),
            'rewrite'           => array( 'slug' => 'skill-category' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'skill_category', 'skills', $skill_cat_args );
    }
}
add_action( 'init', 'portfolio_register_taxonomies' );

/**
 * Register widget areas
 */
if ( ! function_exists( 'portfolio_theme_widgets' ) ) {
    function portfolio_theme_widgets() {
        register_sidebar( array(
            'name'          => esc_html__( 'Primary Sidebar', 'portfolio-theme' ),
            'id'            => 'primary-sidebar',
            'description'   => esc_html__( 'Main sidebar', 'portfolio-theme' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widget Area', 'portfolio-theme' ),
            'id'            => 'footer-widgets',
            'description'   => esc_html__( 'Footer widgets', 'portfolio-theme' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'portfolio_theme_widgets' );

/**
 * Custom excerpt length
 */
if ( ! function_exists( 'portfolio_excerpt_length' ) ) {
    function portfolio_excerpt_length( $length ) {
        return 40;
    }
}
add_filter( 'excerpt_length', 'portfolio_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
if ( ! function_exists( 'portfolio_excerpt_more' ) ) {
    function portfolio_excerpt_more() {
        return '...';
    }
}
add_filter( 'excerpt_more', 'portfolio_excerpt_more' );

/**
 * Custom comment form
 */
if ( ! function_exists( 'portfolio_comment_form' ) ) {
    function portfolio_comment_form( $args = array(), $post_id = null ) {
        if ( null === $post_id ) {
            $post_id = get_the_ID();
        }

        $commenter = wp_get_current_commenter();
        $user      = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        $args = wp_parse_args( $args, array(
            'fields'             => array(
                'author' => '<p class="form-group"><label for="author">' . esc_html__( 'Name', 'portfolio-theme' ) . ' <span class="required">*</span></label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required /></p>',
                'email'  => '<p class="form-group"><label for="email">' . esc_html__( 'Email', 'portfolio-theme' ) . ' <span class="required">*</span></label> <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes" required /></p>',
                'url'    => '<p class="form-group"><label for="url">' . esc_html__( 'Website', 'portfolio-theme' ) . '</label> <input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
            ),
            'comment_field'      => '<p class="form-group"><label for="comment">' . esc_html__( 'Comment', 'portfolio-theme' ) . ' <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p>',
            'must_log_in'        => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'portfolio-theme' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'logged_in_as'       => '<p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out?</a>', 'portfolio-theme' ), get_edit_user_link(), $user->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'id_form'            => 'commentform',
            'id_submit'          => 'submit',
            'class_container'    => 'comment-respond',
            'class_form'         => 'comment-form',
            'class_submit'       => 'submit-button',
            'name_submit'        => esc_html__( 'Post Comment', 'portfolio-theme' ),
            'title_reply'        => esc_html__( 'Leave a Reply', 'portfolio-theme' ),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h3>',
        ) );

        comment_form( $args, $post_id );
    }
}

?>
