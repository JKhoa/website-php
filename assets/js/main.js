/**
 * Portfolio Theme Main Script (Static version for GitHub Pages)
 */

(function () {
    'use strict';

    // DARK MODE TOGGLE
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const htmlElement = document.documentElement;

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
            isDark ? disableDarkMode() : enableDarkMode();
        });
    }

    initDarkMode();

    // HAMBURGER MENU
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

        primaryMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function () {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
                primaryMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });

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

    // SMOOTH SCROLL
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // CONTACT FORM — static version uses mailto
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        const nameInput = contactForm.querySelector('input[name="name"]');
        const emailInput = contactForm.querySelector('input[name="email"]');
        const subjectInput = contactForm.querySelector('input[name="subject"]');
        const messageInput = contactForm.querySelector('textarea[name="message"]');

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
            if (errorDiv) errorDiv.remove();
            input.classList.remove('input-error');
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        if (nameInput) {
            nameInput.addEventListener('blur', function () {
                this.value.trim().length < 3
                    ? showError(this, 'Tên phải có ít nhất 3 ký tự')
                    : removeError(this);
            });
        }

        if (emailInput) {
            emailInput.addEventListener('blur', function () {
                isValidEmail(this.value)
                    ? removeError(this)
                    : showError(this, 'Email không hợp lệ');
            });
        }

        if (messageInput) {
            messageInput.addEventListener('blur', function () {
                this.value.trim().length < 10
                    ? showError(this, 'Tin nhắn phải có ít nhất 10 ký tự')
                    : removeError(this);
            });
        }

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            let isValid = true;

            if (!nameInput || nameInput.value.trim().length < 3) {
                if (nameInput) showError(nameInput, 'Tên phải có ít nhất 3 ký tự');
                isValid = false;
            } else {
                removeError(nameInput);
            }

            if (!emailInput || !isValidEmail(emailInput.value)) {
                if (emailInput) showError(emailInput, 'Email không hợp lệ');
                isValid = false;
            } else {
                removeError(emailInput);
            }

            if (!subjectInput || subjectInput.value.trim().length === 0) {
                if (subjectInput) showError(subjectInput, 'Tiêu đề không được để trống');
                isValid = false;
            } else {
                removeError(subjectInput);
            }

            if (!messageInput || messageInput.value.trim().length < 10) {
                if (messageInput) showError(messageInput, 'Tin nhắn phải có ít nhất 10 ký tự');
                isValid = false;
            } else {
                removeError(messageInput);
            }

            if (!isValid) return;

            // Open mailto with form data
            const to = 'nhakhoa1004@gmail.com';
            const subject = encodeURIComponent(subjectInput.value);
            const body = encodeURIComponent(
                `Từ: ${nameInput.value}\nEmail: ${emailInput.value}\n\n${messageInput.value}`
            );
            window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;

            const successMsg = document.createElement('div');
            successMsg.className = 'form-success';
            successMsg.innerHTML = '<i class="fas fa-check-circle"></i> Đang mở ứng dụng email của bạn...';
            contactForm.insertBefore(successMsg, contactForm.firstChild);
            setTimeout(() => successMsg.remove(), 5000);
            contactForm.reset();
        });
    }

    // BACK TO TOP BUTTON
    const newScrollButton = document.createElement('button');
    newScrollButton.id = 'scroll-to-top';
    newScrollButton.className = 'scroll-to-top';
    newScrollButton.innerHTML = '<i class="fas fa-chevron-up"></i>';
    newScrollButton.setAttribute('aria-label', 'Scroll to top');
    document.body.appendChild(newScrollButton);

    window.addEventListener('scroll', function () {
        newScrollButton.classList.toggle('visible', window.pageYOffset > 300);
    });

    newScrollButton.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ANIMATE ON SCROLL
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('animated');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -100px 0px' });

        document.querySelectorAll('.skill-card, .project-card, .about-section').forEach(el => {
            observer.observe(el);
        });
    }

})();
