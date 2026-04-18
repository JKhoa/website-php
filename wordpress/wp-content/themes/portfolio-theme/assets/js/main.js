/**
 * Portfolio Theme Main Script
 * Features: Dark mode, Hamburger menu, Form validation, Back to top, Smooth scroll
 */

(function () {
    'use strict';

    // ========================================
    // DARK MODE TOGGLE
    // ========================================
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const htmlElement = document.documentElement;

    // Check stored preference or system preference
    function initDarkMode() {
        const savedMode = localStorage.getItem('portfolio-dark-mode');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedMode === 'true' || (savedMode === null && prefersDark)) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    }

    function enableDarkMode() {
        htmlElement.setAttribute('data-theme', 'dark');
        if (darkModeToggle) {
            darkModeToggle.setAttribute('title', 'Light mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        localStorage.setItem('portfolio-dark-mode', 'true');
    }

    function disableDarkMode() {
        htmlElement.removeAttribute('data-theme');
        if (darkModeToggle) {
            darkModeToggle.setAttribute('title', 'Dark mode');
            darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        }
        localStorage.setItem('portfolio-dark-mode', 'false');
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function () {
            const isDark = htmlElement.getAttribute('data-theme') === 'dark';
            if (isDark) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
    }

    initDarkMode();

    // ========================================
    // HAMBURGER MENU TOGGLE
    // ========================================
    const menuToggle = document.getElementById('menu-toggle');
    const primaryMenu = document.getElementById('primary-menu');

    if (menuToggle && primaryMenu) {
        menuToggle.addEventListener('click', function () {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            this.classList.toggle('active');
            primaryMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking on a link
        const menuLinks = primaryMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
                primaryMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            const isClickInsideMenu = primaryMenu.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle && primaryMenu.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
                primaryMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }

    // ========================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ========================================
    // FORM VALIDATION
    // ========================================
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        const nameInput = contactForm.querySelector('input[name="name"]');
        const emailInput = contactForm.querySelector('input[name="email"]');
        const subjectInput = contactForm.querySelector('input[name="subject"]');
        const messageInput = contactForm.querySelector('textarea[name="message"]');

        // Add error message function
        function showError(input, message) {
            removeError(input);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'form-error';
            errorDiv.textContent = message;
            input.parentElement.appendChild(errorDiv);
            input.classList.add('input-error');
        }

        function removeError(input) {
            const errorDiv = input.parentElement.querySelector('.form-error');
            if (errorDiv) {
                errorDiv.remove();
            }
            input.classList.remove('input-error');
        }

        // Validate email
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Real-time validation
        if (nameInput) {
            nameInput.addEventListener('blur', function () {
                if (this.value.trim().length < 3) {
                    showError(this, 'Tên phải có ít nhất 3 ký tự');
                } else {
                    removeError(this);
                }
            });
        }

        if (emailInput) {
            emailInput.addEventListener('blur', function () {
                if (!isValidEmail(this.value)) {
                    showError(this, 'Email không hợp lệ');
                } else {
                    removeError(this);
                }
            });
        }

        if (messageInput) {
            messageInput.addEventListener('blur', function () {
                if (this.value.trim().length < 10) {
                    showError(this, 'Tin nhắn phải có ít nhất 10 ký tự');
                } else {
                    removeError(this);
                }
            });
        }

        // Form submit
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validate all fields
            let isValid = true;

            // Validate name
            if (!nameInput || nameInput.value.trim().length < 3) {
                if (nameInput) showError(nameInput, 'Tên phải có ít nhất 3 ký tự');
                isValid = false;
            } else {
                removeError(nameInput);
            }

            // Validate email
            if (!emailInput || !isValidEmail(emailInput.value)) {
                if (emailInput) showError(emailInput, 'Email không hợp lệ');
                isValid = false;
            } else {
                removeError(emailInput);
            }

            // Validate subject
            if (!subjectInput || subjectInput.value.trim().length === 0) {
                if (subjectInput) showError(subjectInput, 'Tiêu đề không được để trống');
                isValid = false;
            } else {
                removeError(subjectInput);
            }

            // Validate message
            if (!messageInput || messageInput.value.trim().length < 10) {
                if (messageInput) showError(messageInput, 'Tin nhắn phải có ít nhất 10 ký tự');
                isValid = false;
            } else {
                removeError(messageInput);
            }

            if (!isValid) return;

            // Show loading state
            const submitBtn = this.querySelector('.submit-button');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';

            // Simulate form submission
            const formData = new FormData(this);
            formData.append('action', 'send_contact_email');
            if (portfolioTheme?.nonce) {
                formData.append('nonce', portfolioTheme.nonce);
            }

            fetch(portfolioTheme?.ajaxUrl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;

                if (data.success) {
                    // Show success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'form-success';
                    successMsg.innerHTML = '<i class="fas fa-check-circle"></i> ' + (data.message || 'Cảm ơn! Tin nhắn của bạn đã được gửi.');
                    this.insertBefore(successMsg, this.firstChild);

                    // Reset form
                    this.reset();

                    // Remove success message after 5s
                    setTimeout(() => {
                        successMsg.remove();
                    }, 5000);
                } else {
                    // Show error message
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'form-error-msg';
                    errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + (data.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
                    this.insertBefore(errorMsg, this.firstChild);

                    setTimeout(() => {
                        errorMsg.remove();
                    }, 5000);
                }

                submitBtn.textContent = originalText;
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;

                const errorMsg = document.createElement('div');
                errorMsg.className = 'form-error-msg';
                errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Có lỗi xảy ra. Vui lòng thử lại.';
                this.insertBefore(errorMsg, this.firstChild);

                setTimeout(() => {
                    errorMsg.remove();
                }, 5000);
            });
        });
    }

    // ========================================
    // BACK TO TOP BUTTON
    // ========================================
    const scrollButton = document.getElementById('scroll-to-top');

    if (!scrollButton) {
        const newScrollButton = document.createElement('button');
        newScrollButton.id = 'scroll-to-top';
        newScrollButton.className = 'scroll-to-top';
        newScrollButton.innerHTML = '<i class="fas fa-chevron-up"></i>';
        newScrollButton.setAttribute('aria-label', 'Scroll to top');
        document.body.appendChild(newScrollButton);
    }

    const topButton = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 300) {
            topButton.classList.add('visible');
        } else {
            topButton.classList.remove('visible');
        }
    });

    topButton.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // ========================================
    // LAZY LOAD IMAGES
    // ========================================
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });
        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // ========================================
    // ANIMATE ON SCROLL
    // ========================================
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observe all cards and sections
        document.querySelectorAll('.skill-card, .project-card, .about-section').forEach(el => {
            observer.observe(el);
        });
    }

})();
