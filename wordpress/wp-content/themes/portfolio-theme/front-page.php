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
                            <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub" />
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" title="Facebook">
                            <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook" />
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener" title="Twitter">
                            <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" />
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener" title="LinkedIn">
                            <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" />
                        </a>
                        <a href="mailto:contact@jkhoa.dev" title="Email">
                            <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email" />
                        </a>
                    </div>
                </div>

                <div class="hero-image">
                    <?php
                    if ( has_post_thumbnail( get_option( 'page_on_front' ) ) ) {
                        echo get_the_post_thumbnail( get_option( 'page_on_front' ), 'large' );
                    } else {
                        ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-me.png" alt="Nguyễn Hoàng Anh Khoa" class="profile-image-custom" />
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
            <div class="about-wrapper single-column">
                <div class="about-image-banner" style="margin-bottom: 2rem; text-align: center;">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1200&auto=format&fit=crop" alt="Developer Workspace" style="width: 100%; height: 300px; object-fit: cover; border-radius: 1.5rem; box-shadow: var(--shadow-lg);" />
                </div>
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
