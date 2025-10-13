<!DOCTYPE html>
<html lang="de" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma XY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Dark Theme Colors */
            --primary-dark: #00F8F3;
            --primary-light: #00C4C0;
            --primary-dark-accent: #009624;
            --secondary-dark: #007e33;
            --background-dark: #0a1929;
            --surface-dark: #12283a;
            --surface-light: #1a3a52;
            --text-primary-dark: #e0f7fa;
            --text-secondary-dark: #b2ebf2;
            --border-dark: #2a4d69;
            --shadow-dark: 0 10px 30px rgba(0, 0, 0, 0.5);
            
            /* Light Theme Colors */
            --background-light: #f0f8ff;
            --surface-light-theme: #ffffff;
            --text-primary-light: #0a1929;
            --text-secondary-light: #37474f;
            --border-light: #cfd8dc;
            --shadow-light: 0 10px 30px rgba(0, 0, 0, 0.1);
            
            /* Common Variables */
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --border-radius: 12px;
            --spacing: 30px;
        }

        /* Theme-specific variables */
        [data-theme="dark"] {
            --background: var(--background-dark);
            --surface: var(--surface-dark);
            --surface-alt: var(--surface-light);
            --text-primary: var(--text-primary-dark);
            --text-secondary: var(--text-secondary-dark);
            --border: var(--border-dark);
            --shadow: var(--shadow-dark);
            --primary: var(--primary-dark);
            --primary-accent: var(--primary-dark-accent);
        }

        [data-theme="light"] {
            --background: var(--background-light);
            --surface: var(--surface-light-theme);
            --surface-alt: #f0f0f0;
            --text-primary: var(--text-primary-light);
            --text-secondary: var(--text-secondary-light);
            --border: var(--border-light);
            --shadow: var(--shadow-light);
            --primary: var(--primary-light);
            --primary-accent: var(--secondary-dark);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            caret-color: transparent;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
            transition: var(--transition);
            overflow-x: hidden;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header & Navigation */
        header {
            background-color: var(--surface);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            background-color: rgba(18, 40, 58, 0.9);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            #animation: pulse 7s infinite;
            transition: var(--transition);
            font-family: 'Orbitron', sans-serif;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            height: 50px;
            margin-right: 25px;
            #animation: rotate 10s linear infinite;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 30px;
            position: relative;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            padding: 5px 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .theme-switch {
            display: flex;
            align-items: center;
            margin-left: 20px;
            cursor: pointer;
        }

        .theme-switch i {
            font-size: 1.5rem;
            color: var(--text-primary);
            transition: var(--transition);
            animation: float 3s ease-in-out infinite;
        }

        .theme-switch i:hover {
            color: var(--primary);
            transform: scale(1.2);
        }

        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-primary);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
            text-align: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0, 200, 83, 0.1) 0%, rgba(10, 25, 41, 0) 70%);
            z-index: -1;
        }

        .hero-content {
            z-index: 2;
            animation: fadeInUp 1s ease-out;
            margin-bottom: 40px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 5s ease infinite;
            background-size: 300% 300%;
            font-family: 'Orbitron', sans-serif;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--text-secondary);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .construction-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), var(--primary-accent));
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 200, 83, 0.3);
            animation: pulse 2s infinite;
        }

        /* Animated Background Elements */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary);
            opacity: 0.7;
            animation: float 15s infinite linear;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 80px;
                right: -100%;
                flex-direction: column;
                background-color: var(--surface);
                width: 100%;
                text-align: center;
                transition: var(--transition);
                box-shadow: 0 10px 10px rgba(0,0,0,0.1);
                padding: 20px 0;
                backdrop-filter: blur(10px);
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links li {
                margin: 20px 0;
            }

            .mobile-menu {
                display: block;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .section {
                padding: 70px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }

    </style>

</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">
                    Firma XY
                </a>
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Kontakt</a></li>
                        <li><a href="login.php" style="background: rgba(0, 200, 83, 0.2); padding: 8px 15px; border-radius: 20px;">
                        <i class="fas fa-user-lock"></i> Login
                        </a></li>
                    <li class="theme-switch" id="themeSwitch">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </li>
                </ul>
                <div class="mobile-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="particles" id="particles"></div>
        <div class="container">
            <div class="hero-content">
                <h1>Firma XY</h1>
                <p>Willkommen bei Firma XY...</p>
                <div class="construction-badge">
                    <i class="fas fa-hard-hat"></i> Im Aufbau
                </div>
            </div>
        </div>
    </section>

    <script>
        // Theme Switcher
        const themeSwitch = document.getElementById('themeSwitch');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        // Check for saved theme preference or respect OS preference
        const savedTheme = localStorage.getItem('theme');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Set initial theme
        if (savedTheme === 'light' || (!savedTheme && !prefersDarkScheme.matches)) {
            htmlElement.setAttribute('data-theme', 'light');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            htmlElement.setAttribute('data-theme', 'dark');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }

        // Toggle theme
        themeSwitch.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                htmlElement.setAttribute('data-theme', 'light');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.setAttribute('data-theme', 'dark');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Mobile Menu Toggle
        const mobileMenu = document.querySelector('.mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Vielen Dank für Ihre Nachricht! Wir werden uns in Kürze bei Ihnen melden.');
                this.reset();
            });
        }

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.3)';
                header.style.background = 'rgba(18, 40, 58, 0.95)';
            } else {
                header.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
                header.style.background = 'rgba(18, 40, 58, 0.9)';
            }
            
            // Update scroll progress bar
            const scrollTop = window.scrollY;
            const docHeight = document.body.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            document.getElementById('scrollProgressBar').style.width = scrollPercent + '%';
        });

        // Create animated particles for hero section
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random size
                const size = Math.random() * 20 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Random animation duration
                const duration = Math.random() * 20 + 10;
                particle.style.animationDuration = `${duration}s`;
                
                // Random delay
                const delay = Math.random() * 5;
                particle.style.animationDelay = `${delay}s`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Initialize particles on load
        window.addEventListener('load', () => {
            createParticles();
        });

        // Add construction animation to badge
        const constructionBadge = document.querySelector('.construction-badge');
        if (constructionBadge) {
            constructionBadge.style.animation = 'construction 3s infinite';
        }
    </script>
</body>
</html>

