<?php
/**
 * The template for displaying the front page (based on jkhoa.dev)
 *
 * @package portfolio-theme
 */

get_header();
?>

<main class="site-main">
    <!-- Hero Section with Profile Photo -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-wrapper">
                <div class="hero-content">
                    <h1><?php esc_html_e( 'Xin chào! Tôi là Nguyễn Hoàng Anh Khoa', 'portfolio-theme' ); ?></h1>
                    <p class="hero-subtitle"><?php esc_html_e( 'Developer & Student', 'portfolio-theme' ); ?></p>
                    <p class="hero-description">
                        <?php esc_html_e( 'Passionate about web development, mobile development, and modern technologies', 'portfolio-theme' ); ?>
                    </p>

                    <div class="cta-buttons">
                        <a href="#about" class="cta-button"><?php esc_html_e( 'Tìm hiểu thêm', 'portfolio-theme' ); ?></a>
                        <a href="#contact" class="cta-button outline"><?php esc_html_e( 'Liên hệ tôi', 'portfolio-theme' ); ?></a>
                    </div>

                    <div class="hero-socials">
                        <a href="https://github.com/jkhoa" target="_blank" rel="noopener" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="mailto:contact@jkhoa.dev" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>

                <div class="hero-image">
                    <?php
                    if ( has_post_thumbnail( get_option( 'page_on_front' ) ) ) {
                        echo get_the_post_thumbnail( get_option( 'page_on_front' ), 'large' );
                    } else {
                        ?>
                        <div class="profile-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2><?php esc_html_e( 'Về tôi', 'portfolio-theme' ); ?></h2>
            <div class="about-wrapper">
                <div class="about-content">
                    <?php
                    $about_page = get_pages( array( 'title' => 'About' ) );
                    if ( $about_page ) {
                        echo wp_kses_post( $about_page[0]->post_content );
                    } else {
                        ?>
                        <p><?php esc_html_e( 'Tôi là một developer passionate với kỹ năng trong web development, mobile development, và các công nghệ mới. Tôi yêu thích học hỏi và xây dựng các sản phẩm có ý nghĩa.', 'portfolio-theme' ); ?></p>
                        <p><?php esc_html_e( 'Hiện đang học tập và làm việc với các công nghệ: JavaScript, React, Node.js, Python, C#, và nhiều công nghệ khác.', 'portfolio-theme' ); ?></p>
                        <?php
                    }
                    ?>
                </div>

                <div class="about-achievements">
                    <h3><?php esc_html_e( 'Thành tích', 'portfolio-theme' ); ?></h3>
                    <ul>
                        <li>
                            <span class="achievement-year">2024</span>
                            <span class="achievement-text"><?php esc_html_e( 'Hoàn thành Lab 01 - Các công nghệ mới', 'portfolio-theme' ); ?></span>
                        </li>
                        <li>
                            <span class="achievement-year">2024</span>
                            <span class="achievement-text"><?php esc_html_e( 'Hoàn thành Lab 02 - Full-stack Development', 'portfolio-theme' ); ?></span>
                        </li>
                        <li>
                            <span class="achievement-year">2023</span>
                            <span class="achievement-text"><?php esc_html_e( 'Bắt đầu hành trình lập trình web', 'portfolio-theme' ); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section">
        <div class="container">
            <h2><?php esc_html_e( 'Kỹ năng của tôi', 'portfolio-theme' ); ?></h2>

            <div class="skills-categories">
                <!-- Programming Languages -->
                <div class="skill-category">
                    <h3><i class="fas fa-code"></i> <?php esc_html_e( 'Ngôn ngữ lập trình', 'portfolio-theme' ); ?></h3>
                    <div class="skills-grid">
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-js"></i>
                            </div>
                            <h4>JavaScript/TypeScript</h4>
                            <p><?php esc_html_e( 'ES6+, Async/Await, Promise', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-python"></i>
                            </div>
                            <h4>Python</h4>
                            <p><?php esc_html_e( 'Django, Flask, Data Analysis', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-windows"></i>
                            </div>
                            <h4>C# / .NET</h4>
                            <p><?php esc_html_e( 'ASP.NET, Entity Framework', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-php"></i>
                            </div>
                            <h4>PHP & WordPress</h4>
                            <p><?php esc_html_e( 'Theme Development, Plugins', 'portfolio-theme' ); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Databases -->
                <div class="skill-category">
                    <h3><i class="fas fa-database"></i> <?php esc_html_e( 'Database & Backend', 'portfolio-theme' ); ?></h3>
                    <div class="skills-grid">
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <h4>SQL / MySQL</h4>
                            <p><?php esc_html_e( 'Query Optimization, Indexing', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h4>MongoDB</h4>
                            <p><?php esc_html_e( 'NoSQL, Aggregation Pipeline', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-node-js"></i>
                            </div>
                            <h4>Node.js</h4>
                            <p><?php esc_html_e( 'Express, RESTful APIs', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-docker"></i>
                            </div>
                            <h4>Docker</h4>
                            <p><?php esc_html_e( 'Containerization, Compose', 'portfolio-theme' ); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Frontend & Tools -->
                <div class="skill-category">
                    <h3><i class="fas fa-paint-brush"></i> <?php esc_html_e( 'Frontend & Tools', 'portfolio-theme' ); ?></h3>
                    <div class="skills-grid">
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-react"></i>
                            </div>
                            <h4>React / Next.js</h4>
                            <p><?php esc_html_e( 'Hooks, SSR, App Router', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fas fa-cube"></i>
                            </div>
                            <h4>Tailwind CSS</h4>
                            <p><?php esc_html_e( 'Utility-first, Responsive', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fab fa-git-alt"></i>
                            </div>
                            <h4>Git & GitHub</h4>
                            <p><?php esc_html_e( 'Version Control, Collaboration', 'portfolio-theme' ); ?></p>
                        </div>
                        <div class="skill-card">
                            <div class="skill-icon">
                                <i class="fas fa-terminal"></i>
                            </div>
                            <h4>CLI & DevTools</h4>
                            <p><?php esc_html_e( 'Bash, npm, Build Tools', 'portfolio-theme' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section">
        <div class="container">
            <h2><?php esc_html_e( 'Dự án tiêu biểu', 'portfolio-theme' ); ?></h2>
            <div class="projects-grid">
                <?php
                $projects_args = array(
                    'post_type'      => 'projects',
                    'posts_per_page' => 6,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $projects_query = new WP_Query( $projects_args );

                if ( $projects_query->have_posts() ) {
                    while ( $projects_query->have_posts() ) {
                        $projects_query->the_post();
                        ?>
                        <article class="project-card">
                            <div class="project-image">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'portfolio-project' );
                                } else {
                                    echo '<div class="project-placeholder"><i class="fas fa-code"></i></div>';
                                }
                                ?>
                                <div class="project-overlay">
                                    <a href="<?php the_permalink(); ?>" class="project-view-btn">
                                        <?php esc_html_e( 'Xem chi tiết', 'portfolio-theme' ); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 15 ) ); ?></p>

                                <div class="project-tags">
                                    <?php
                                    $tags = get_the_tags();
                                    if ( $tags ) {
                                        foreach ( $tags as $tag ) {
                                            echo '<span class="project-tag">' . esc_html( $tag->name ) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="project-links">
                                    <a href="<?php the_permalink(); ?>" class="project-link">
                                        <?php esc_html_e( 'Live Demo', 'portfolio-theme' ); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="https://github.com/jkhoa" target="_blank" rel="noopener" class="project-link">
                                        <?php esc_html_e( 'Source Code', 'portfolio-theme' ); ?>
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2><?php esc_html_e( 'Liên hệ tôi', 'portfolio-theme' ); ?></h2>
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h3><?php esc_html_e( 'Bạn có câu hỏi? Hãy để lại tin nhắn!', 'portfolio-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Tôi sẽ cố gắng trả lời trong 24 giờ.', 'portfolio-theme' ); ?></p>

                    <div class="contact-details">
                        <div class="contact-detail">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong><?php esc_html_e( 'Email', 'portfolio-theme' ); ?></strong>
                                <a href="mailto:contact@jkhoa.dev">contact@jkhoa.dev</a>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong><?php esc_html_e( 'Vị trí', 'portfolio-theme' ); ?></strong>
                                <p><?php esc_html_e( 'Việt Nam', 'portfolio-theme' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-wrapper">
                    <form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="contact-form" class="contact-form">
                        <div class="form-group">
                            <label for="name"><?php esc_html_e( 'Họ tên', 'portfolio-theme' ); ?> <span class="required">*</span></label>
                            <input type="text" id="name" name="name" placeholder="<?php esc_attr_e( 'Nhập tên của bạn', 'portfolio-theme' ); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php esc_html_e( 'Email', 'portfolio-theme' ); ?> <span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="<?php esc_attr_e( 'example@email.com', 'portfolio-theme' ); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="subject"><?php esc_html_e( 'Tiêu đề', 'portfolio-theme' ); ?> <span class="required">*</span></label>
                            <input type="text" id="subject" name="subject" placeholder="<?php esc_attr_e( 'Tiêu đề tin nhắn', 'portfolio-theme' ); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="message"><?php esc_html_e( 'Tin nhắn', 'portfolio-theme' ); ?> <span class="required">*</span></label>
                            <textarea id="message" name="message" placeholder="<?php esc_attr_e( 'Nội dung tin nhắn của bạn...', 'portfolio-theme' ); ?>" required></textarea>
                        </div>
                        <button type="submit" class="submit-button"><?php esc_html_e( 'Gửi tin nhắn', 'portfolio-theme' ); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
