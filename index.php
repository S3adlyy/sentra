<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra - Professional Productivity Suite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <style>
        :root {
            --primary: #00f0ff; /* Cyan */
            --primary-dark: #00c4d6;
            --secondary: #7b2cbf;
            --dark: #0a192f;
            --darker: #020c1b;
            --light: #e6f1ff;
            --lighter: #ffffff;
            --gray: #8892b0;
            --gray-light: #ccd6f6;
            --success: #2ecc71;
            --warning: #f39c12;
            --error: #e74c3c;
            --radius: 8px;
            --radius-lg: 16px;
            --shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
            --shadow-lg: 0 20px 30px -15px rgba(2, 12, 27, 0.7);
            --transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
            --nav-height: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: var(--darker);
            color: var(--gray-light);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Particles Background */
        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-color: var(--darker);
        }

        /* Gradient Overlay */
        .gradient-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 75% 50%, rgba(0, 240, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--nav-height);
            padding: 0 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            backdrop-filter: blur(10px);
            background-color: rgba(10, 25, 47, 0.8);
            border-bottom: 1px solid rgba(100, 255, 255, 0.1);
            transition: var(--transition);
        }

        header.scrolled {
            height: 70px;
            background-color: rgba(2, 12, 27, 0.95);
            box-shadow: var(--shadow);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--lighter);
            text-decoration: none;
            transition: var(--transition);
        }

        .logo img {
            height: 36px;
            width: auto;
            transition: var(--transition);
        }

        header.scrolled .logo img {
            height: 30px;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-subtext {
            font-size: 0.6rem;
            font-weight: 400;
            color: var(--primary);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            color: var(--gray-light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a:hover {
            color: var(--primary);
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

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a.active {
            color: var(--primary);
        }

        .nav-links a.active::after {
            width: 100%;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.4rem;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--dark);
        }

        .btn-primary:hover {
            background-color: var(--lighter);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -10px rgba(0, 240, 255, 0.5);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(0, 240, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -10px rgba(0, 240, 255, 0.3);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            font-size: 1.8rem;
            cursor: pointer;
            z-index: 101;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            padding-top: var(--nav-height);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 600px;
            z-index: 10;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--lighter);
        }

        .hero h1 span {
            color: var(--primary);
            position: relative;
        }

        .hero h1 span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: rgba(0, 240, 255, 0.3);
            z-index: -1;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--gray);
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
            border-radius: var(--radius-lg);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: #6a1b9a;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -10px rgba(123, 44, 191, 0.5);
        }

        .stats {
            display: flex;
            gap: 3rem;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-image {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 45%;
            max-width: 700px;
            z-index: 5;
            filter: drop-shadow(0 20px 30px rgba(0, 240, 255, 0.2));
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(-50%) translateX(0); }
            50% { transform: translateY(-50%) translateX(-20px) translateY(-10px); }
            100% { transform: translateY(-50%) translateX(0); }
        }

        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--gray);
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            z-index: 10;
        }

        .scroll-down::after {
            content: '';
            display: block;
            width: 1px;
            height: 50px;
            background-color: var(--gray);
            animation: scrollPulse 2s infinite;
        }

        @keyframes scrollPulse {
            0% { opacity: 1; }
            50% { opacity: 0.2; }
            100% { opacity: 1; }
        }

        /* Features Section */
        .section {
            padding: 8rem 5%;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-title h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--lighter);
        }

        .section-title h2 span {
            color: var(--primary);
        }

        .section-title p {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .section-title .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            margin: 1.5rem auto;
            border-radius: 2px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: rgba(10, 25, 47, 0.5);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            transition: var(--transition);
            border: 1px solid rgba(100, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 0;
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(100, 255, 255, 0.3);
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 240, 255, 0.1), rgba(10, 25, 47, 0.5));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
            font-size: 1.8rem;
            border: 1px solid rgba(100, 255, 255, 0.2);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--lighter);
        }

        .feature-card p {
            color: var(--gray);
            font-size: 0.95rem;
        }

        /* Download Section */
        .download-section {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            border-radius: var(--radius-lg);
            padding: 5rem;
            text-align: center;
            margin: 0 auto;
            max-width: 1000px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(100, 255, 255, 0.1);
            box-shadow: var(--shadow-lg);
        }

        .download-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 240, 255, 0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .download-section h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1.5rem;
            color: var(--lighter);
        }

        .download-section h2 span {
            color: var(--primary);
        }

        .download-section p {
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
        }

        .download-options {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .download-card {
            background-color: rgba(10, 25, 47, 0.7);
            border-radius: var(--radius-lg);
            padding: 2rem;
            width: 220px;
            transition: var(--transition);
            border: 1px solid rgba(100, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .download-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .download-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
            border-color: rgba(100, 255, 255, 0.3);
        }

        .download-card:hover::after {
            transform: scaleX(1);
        }

        .download-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .download-card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
            color: var(--lighter);
        }

        .download-card p {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1.5rem;
        }

        .version-selector {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            align-items: center;
        }

        .version-selector label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .version-selector select {
            background-color: rgba(10, 25, 47, 0.7);
            border: 1px solid rgba(100, 255, 255, 0.2);
            color: var(--lighter);
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .version-selector select:hover {
            border-color: var(--primary);
        }

        .version-selector select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 240, 255, 0.2);
        }

        /* Testimonials */
        .testimonials-container {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            padding: 2rem 0;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            max-width: 1400px;
            margin: 0 auto;
        }

        .testimonials-container::-webkit-scrollbar {
            display: none;
        }

        .testimonial-card {
            min-width: 400px;
            background-color: rgba(10, 25, 47, 0.5);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            scroll-snap-align: start;
            border: 1px solid rgba(100, 255, 255, 0.1);
            transition: var(--transition);
        }

        .testimonial-card:hover {
            border-color: rgba(100, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .testimonial-content {
            margin-bottom: 2rem;
            font-style: italic;
            color: var(--gray-light);
            position: relative;
        }

        .testimonial-content::before {
            content: '"';
            position: absolute;
            top: -1.5rem;
            left: -1rem;
            font-size: 5rem;
            color: rgba(0, 240, 255, 0.1);
            font-family: serif;
            line-height: 1;
            z-index: -1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }

        .author-info h4 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            color: var(--lighter);
        }

        .author-info p {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .author-company {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.3rem;
        }

        .author-company img {
            width: 20px;
            height: 20px;
            border-radius: 2px;
        }

        .author-company span {
            font-size: 0.8rem;
            color: var(--gray);
        }

        /* FAQ Section */
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 1rem;
            border-radius: var(--radius);
            overflow: hidden;
            border: 1px solid rgba(100, 255, 255, 0.1);
            transition: var(--transition);
        }

        .faq-item:hover {
            border-color: rgba(100, 255, 255, 0.3);
        }

        .faq-question {
            padding: 1.5rem;
            background-color: rgba(10, 25, 47, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .faq-question:hover {
            background-color: rgba(10, 25, 47, 0.7);
        }

        .faq-question h3 {
            font-size: 1.1rem;
            color: var(--lighter);
            font-weight: 600;
        }

        .faq-toggle {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            color: var(--primary);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
            background-color: rgba(10, 25, 47, 0.3);
        }

        .faq-answer-content {
            padding: 0 1.5rem 1.5rem;
            color: var(--gray);
        }

        .faq-item.active .faq-toggle {
            transform: rotate(180deg);
        }

        /* Newsletter */
        .newsletter {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.7) 0%, rgba(2, 12, 27, 0.9) 100%);
            border-radius: var(--radius-lg);
            padding: 4rem;
            text-align: center;
            margin: 6rem auto 0;
            max-width: 800px;
            border: 1px solid rgba(100, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .newsletter::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(0, 240, 255, 0.1) 0%, transparent 70%);
            z-index: -1;
        }

        .newsletter h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--lighter);
        }

        .newsletter p {
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
            gap: 1rem;
        }

        .newsletter-form input {
            flex: 1;
            padding: 1rem;
            border-radius: var(--radius);
            border: 1px solid rgba(100, 255, 255, 0.2);
            background-color: rgba(2, 12, 27, 0.7);
            color: var(--lighter);
            transition: var(--transition);
        }

        .newsletter-form input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 240, 255, 0.2);
        }

        .newsletter-form input::placeholder {
            color: var(--gray);
        }

        .newsletter-form button {
            padding: 0 2rem;
            border-radius: var(--radius);
            background-color: var(--primary);
            color: var(--dark);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-form button:hover {
            background-color: var(--lighter);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: rgba(2, 12, 27, 0.95);
            padding: 6rem 5% 3rem;
            border-top: 1px solid rgba(100, 255, 255, 0.1);
            margin-top: 6rem;
            position: relative;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 4rem;
            margin-bottom: 4rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-about {
            max-width: 300px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--lighter);
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .footer-logo img {
            height: 36px;
            width: auto;
        }

        .footer-about p {
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: rgba(100, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-light);
            transition: var(--transition);
            border: 1px solid rgba(100, 255, 255, 0.1);
        }

        .social-link:hover {
            background-color: rgba(0, 240, 255, 0.1);
            color: var(--primary);
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .footer-links h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--lighter);
            font-weight: 600;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a i {
            font-size: 0.7rem;
            color: var(--primary);
            opacity: 0;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .footer-links a:hover i {
            opacity: 1;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 3rem;
            border-top: 1px solid rgba(100, 255, 255, 0.1);
            color: var(--gray);
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-links-row {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-links-row a {
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .footer-links-row a:hover {
            color: var(--primary);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 1s cubic-bezier(0.645, 0.045, 0.355, 1) forwards;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        .delay-4 {
            animation-delay: 0.8s;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--darker);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .hero-image {
                width: 50%;
            }
        }

        @media (max-width: 992px) {
            .hero-image {
                width: 55%;
                opacity: 0.8;
            }
            
            .download-section {
                padding: 4rem;
            }
            
            .newsletter {
                padding: 3rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background-color: var(--dark);
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 2rem;
                transition: var(--transition);
                z-index: 99;
                box-shadow: -10px 0 30px rgba(2, 12, 27, 0.7);
            }

            .nav-links.active {
                right: 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: var(--nav-height);
                padding-bottom: 4rem;
            }

            .hero-content {
                align-items: center;
                margin-top: 3rem;
            }

            .hero h1 span::after {
                height: 6px;
                bottom: 3px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .stats {
                justify-content: center;
            }

            .hero-image {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                width: 80%;
                margin-top: 3rem;
                order: -1;
                opacity: 1;
            }

            .download-section {
                padding: 3rem 2rem;
            }

            .download-options {
                flex-direction: column;
                align-items: center;
            }

            .download-card {
                width: 100%;
                max-width: 300px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form button {
                padding: 1rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            
            .footer-about {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .download-section h2 {
                font-size: 2rem;
            }
            
            .testimonial-card {
                min-width: 300px;
                padding: 2rem;
            }
            
            .feature-card {
                padding: 2rem 1.5rem;
            }
            
            .newsletter {
                padding: 2rem 1.5rem;
            }
        }

         /* Auth Modal */
         .auth-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(2, 12, 27, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }
        
        .auth-modal.active {
            opacity: 1;
            visibility: visible;
        }
        
        .auth-container {
            background-color: var(--dark);
            border-radius: var(--radius-lg);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(100, 255, 255, 0.2);
            box-shadow: var(--shadow-lg);
            position: relative;
        }
        
        .close-auth {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            color: var(--gray);
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .close-auth:hover {
            color: var(--primary);
        }
        
        .auth-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--lighter);
            text-align: center;
        }
        
        .auth-subtitle {
            color: var(--gray);
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-providers {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .auth-provider-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: var(--radius);
            border: 1px solid rgba(100, 255, 255, 0.2);
            background-color: rgba(10, 25, 47, 0.5);
            color: var(--lighter);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .auth-provider-btn:hover {
            background-color: rgba(10, 25, 47, 0.8);
            transform: translateY(-2px);
        }
        
        .auth-provider-btn.github {
            color: var(--lighter);
        }
        
        .auth-provider-btn.google {
            color: var(--lighter);
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: rgba(100, 255, 255, 0.2);
            margin: 0 1rem;
        }
        
        .auth-email-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .auth-input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .auth-input-group label {
            color: var(--gray-light);
            font-size: 0.9rem;
        }
        
        .auth-input-group input {
            padding: 1rem;
            border-radius: var(--radius);
            border: 1px solid rgba(100, 255, 255, 0.2);
            background-color: rgba(2, 12, 27, 0.7);
            color: var(--lighter);
            transition: var(--transition);
        }
        
        .auth-input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 240, 255, 0.2);
        }
        
        .auth-submit-btn {
            padding: 1rem;
            border-radius: var(--radius);
            background-color: var(--primary);
            color: var(--dark);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }
        
        .auth-submit-btn:hover {
            background-color: var(--lighter);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
        }
        
        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
        
        .user-name {
            color: var(--lighter);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .logout-btn:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Particles Background -->
    <div id="particles-js"></div>
    <div class="gradient-overlay"></div>

    <!-- Header -->
    <header>
        <a href="#" class="logo">
            <img src="img/logo SENTRA cyan.png" alt="Sentra Logo">
            <div class="logo-text">
                <span>Sentra</span>
                <span class="logo-subtext">PRODUCTIVITY SUITE</span>
            </div>
        </a>
        
        <nav class="nav-links">
            <a href="#features" class="active">Features</a>
            <a href="#download">Download</a>
            <a href="#testimonials">Testimonials</a>
            <a href="#faq">FAQ</a>
        </nav>
        
        <div class="cta-buttons">
            <div id="auth-buttons">
                <button class="btn btn-outline" id="login-btn">Login</button>
                <button class="btn btn-primary" id="signup-btn">Sign Up</button>
            </div>
            <div id="user-profile" class="user-profile" style="display: none;">
                <img id="user-avatar" class="user-avatar" src="" alt="User Avatar">
                <span id="user-name" class="user-name"></span>
                <button class="logout-btn" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
        
        <button class="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1>Transform Your Workflow With <span>Sentra</span></h1>
            <p class="delay-1">The ultimate professional suite that combines powerful tools with intuitive design. Experience unparalleled productivity with our cutting-edge software solution.</p>
            
            <div class="hero-buttons delay-2">
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-download"></i> Download Now
                </button>
                <button class="btn btn-secondary btn-lg">
                    <i class="fas fa-play"></i> Watch Demo
                </button>
            </div>
            
            <div class="stats delay-3">
                <div class="stat-item">
                    <span class="stat-number">75K+</span>
                    <span class="stat-label">Downloads</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4.9★</span>
                    <span class="stat-label">Rating</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Uptime</span>
                </div>
            </div>
        </div>
    
        
        <div class="scroll-down fade-in delay-4">
            <span>Scroll Down</span>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="section-title fade-in">
            <h2>Professional <span>Features</span></h2>
            <p>Sentra comes packed with everything professionals need to maximize productivity</p>
            <div class="divider"></div>
        </div>
        
        <div class="features-grid">
            <div class="feature-card fade-in delay-1">
                <div class="feature-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <h3>Performance Optimized</h3>
                <p>Engineered for speed with minimal resource usage. Get more done without system slowdowns or lag.</p>
            </div>
            
            <div class="feature-card fade-in delay-2">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Enterprise Security</h3>
                <p>Military-grade encryption and compliance with industry security standards to protect your sensitive data.</p>
            </div>
            
            <div class="feature-card fade-in delay-3">
                <div class="feature-icon">
                    <i class="fas fa-cloud"></i>
                </div>
                <h3>Cloud Integration</h3>
                <p>Seamless synchronization across all your devices with real-time cloud backup and version control.</p>
            </div>
            
            <div class="feature-card fade-in delay-1">
                <div class="feature-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3>Custom Workflows</h3>
                <p>Tailor Sentra to your exact needs with customizable modules, plugins, and automation rules.</p>
            </div>
            
            <div class="feature-card fade-in delay-2">
                <div class="feature-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h3>AI Assistance</h3>
                <p>Smart suggestions, automated tasks, and predictive analytics powered by machine learning.</p>
            </div>
            
            <div class="feature-card fade-in delay-3">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>Priority Support</h3>
                <p>Dedicated 24/7 support with guaranteed response times for enterprise customers.</p>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section class="section" id="download">
        <div class="download-section fade-in">
            <h2>Download <span>Sentra</span> Now</h2>
            <p>Available for all professional platforms. Start boosting your productivity immediately with our industry-leading software.</p>
            <div class="divider"></div>
            
            <div class="download-options">
                <div class="download-card fade-in delay-1">
                    <div class="download-icon">
                        <i class="fab fa-windows"></i>
                    </div>
                    <h3>Windows</h3>
                    <p>Windows 10/11 64-bit</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
                
                <div class="download-card fade-in delay-2">
                    <div class="download-icon">
                        <i class="fab fa-apple"></i>
                    </div>
                    <h3>MacOS</h3>
                    <p>macOS 11.0 or later</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
                
                <div class="download-card fade-in delay-3">
                    <div class="download-icon">
                        <i class="fab fa-linux"></i>
                    </div>
                    <h3>Linux</h3>
                    <p>.deb, .rpm & AppImage</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </div>
            
            <div class="version-selector fade-in delay-4">
                <label for="version-select">Select Version:</label>
                <select id="version-select">
                    <option value="latest">Latest Stable (v2.4.1)</option>
                    <option value="beta">Beta (v2.5.0-beta)</option>
                    <option value="lts">LTS (v2.3.4)</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section" id="testimonials">
        <div class="section-title fade-in">
            <h2>Trusted by <span>Professionals</span></h2>
            <p>Join thousands of professionals who rely on Sentra for their daily productivity needs</p>
            <div class="divider"></div>
        </div>
        
        <div class="testimonials-container">
            <div class="testimonial-card fade-in delay-1">
                <div class="testimonial-content">
                    "Sentra has revolutionized our team's workflow. The seamless integration with our existing tools and the performance optimizations have saved us hundreds of hours each month."
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson" class="author-avatar">
                    <div class="author-info">
                        <h4>Sarah Johnson</h4>
                        <p>CTO, TechSolutions Inc.</p>
                        <div class="author-company">
                            <img src="https://logo.clearbit.com/techsolutions.com" alt="TechSolutions" onerror="this.style.display='none'">
                            <span>Enterprise Plan</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card fade-in delay-2">
                <div class="testimonial-content">
                    "As a developer, I appreciate Sentra's extensibility and clean API. The plugin system allows me to customize it exactly to my workflow needs, and the performance is exceptional."
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="author-avatar">
                    <div class="author-info">
                        <h4>Michael Chen</h4>
                        <p>Lead Developer, CodeCraft</p>
                        <div class="author-company">
                            <img src="https://logo.clearbit.com/codecraft.io" alt="CodeCraft" onerror="this.style.display='none'">
                            <span>Pro Plan</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card fade-in delay-3">
                <div class="testimonial-content">
                    "The security features in Sentra gave our compliance team the confidence we needed. The audit logging and encryption meet all our regulatory requirements without sacrificing performance."
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez" class="author-avatar">
                    <div class="author-info">
                        <h4>Emily Rodriguez</h4>
                        <p>Security Director, FinSecure</p>
                        <div class="author-company">
                            <img src="https://logo.clearbit.com/finsecure.com" alt="FinSecure" onerror="this.style.display='none'">
                            <span>Enterprise Plan</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card fade-in delay-1">
                <div class="testimonial-content">
                    "We evaluated over a dozen productivity suites before choosing Sentra. The combination of power, flexibility, and ease-of-use is unmatched in the market today."
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="David Kim" class="author-avatar">
                    <div class="author-info">
                        <h4>David Kim</h4>
                        <p>Product Manager, InnovateCo</p>
                        <div class="author-company">
                            <img src="https://logo.clearbit.com/innovateco.com" alt="InnovateCo" onerror="this.style.display='none'">
                            <span>Team Plan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section" id="faq">
        <div class="section-title fade-in">
            <h2>Frequently Asked <span>Questions</span></h2>
            <p>Everything you need to know about getting started with Sentra</p>
            <div class="divider"></div>
        </div>
        
        <div class="faq-container">
            <div class="faq-item fade-in delay-1">
                <div class="faq-question">
                    <h3>What are the system requirements for Sentra?</h3>
                    <div class="faq-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Sentra requires:</p>
                        <ul style="list-style-position: inside; margin-top: 0.5rem;">
                            <li><strong>Windows:</strong> Windows 10/11 64-bit, 4GB RAM, 2GHz processor</li>
                            <li><strong>macOS:</strong> macOS 11.0 or later, 4GB RAM, Apple Silicon or Intel Core i5</li>
                            <li><strong>Linux:</strong> Most modern distributions, 4GB RAM, 2GHz processor</li>
                        </ul>
                        <p style="margin-top: 1rem;">For optimal performance, we recommend 8GB RAM or more and an SSD.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item fade-in delay-2">
                <div class="faq-question">
                    <h3>How does Sentra handle data privacy and security?</h3>
                    <div class="faq-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Sentra employs multiple layers of security:</p>
                        <ul style="list-style-position: inside; margin-top: 0.5rem;">
                            <li>End-to-end AES-256 encryption for all data</li>
                            <li>Zero-knowledge architecture (we never have access to your data)</li>
                            <li>Regular third-party security audits</li>
                            <li>Compliance with GDPR, CCPA, and other privacy regulations</li>
                        </ul>
                        <p style="margin-top: 1rem;">Enterprise customers can request additional security features like IP restrictions and SAML SSO.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item fade-in delay-3">
                <div class="faq-question">
                    <h3>What support options are available?</h3>
                    <div class="faq-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>We offer multiple support tiers:</p>
                        <ul style="list-style-position: inside; margin-top: 0.5rem;">
                            <li><strong>Community:</strong> Documentation and community forums (free)</li>
                            <li><strong>Standard:</strong> Email support with 24-hour response (included with all paid plans)</li>
                            <li><strong>Priority:</strong> Live chat and phone support with 4-hour response (Pro and Enterprise plans)</li>
                            <li><strong>Enterprise:</strong> Dedicated account manager and 1-hour response SLA</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="faq-item fade-in delay-1">
                <div class="faq-question">
                    <h3>Can I try Sentra before purchasing?</h3>
                    <div class="faq-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Yes! Sentra offers a fully-featured 14-day free trial for all paid plans. No credit card is required to start your trial.</p>
                        <p style="margin-top: 1rem;">After your trial ends, you can continue using Sentra with our free plan which includes basic features, or upgrade to a paid plan for full functionality.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item fade-in delay-2">
                <div class="faq-question">
                    <h3>How often is Sentra updated?</h3>
                    <div class="faq-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>We maintain a rigorous release schedule:</p>
                        <ul style="list-style-position: inside; margin-top: 0.5rem;">
                            <li><strong>Patch releases:</strong> Weekly (bug fixes and minor improvements)</li>
                            <li><strong>Feature releases:</strong> Monthly (new functionality and enhancements)</li>
                            <li><strong>Major releases:</strong> Quarterly (significant new features and architectural improvements)</li>
                        </ul>
                        <p style="margin-top: 1rem;">Enterprise customers can opt for extended support releases with less frequent updates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <div class="section">
        <div class="newsletter fade-in">
            <h3>Stay Updated</h3>
            <p>Subscribe to our newsletter for product updates, tips, and exclusive offers.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <a href="#" class="footer-logo">
                    <img src="img/logo_SENTRA_cyan.png" alt="Sentra Logo">
                    <span>Sentra</span>
                </a>
                <p>The professional productivity suite designed to help you work smarter, faster, and more securely.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-discord"></i></a>
                </div>
            </div>
            
            <div class="footer-links">
                <h3>Product</h3>
                <ul>
                    <li><a href="#features">Features <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#download">Download <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Pricing <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Roadmap <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Changelog <i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Documentation <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Tutorials <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Blog <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Community <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">API <i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Careers <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Press <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Contact <i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="#">Legal <i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-links-row">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
                <a href="#">GDPR</a>
                <a href="#">Status</a>
            </div>
            <p>&copy; 2023 Sentra Technologies. All rights reserved.</p>
        </div>
    </footer>

    <div class="auth-modal" id="auth-modal">
        <div class="auth-container">
            <button class="close-auth" id="close-auth">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="auth-title" id="auth-modal-title">Welcome to Sentra</h2>
            <p class="auth-subtitle" id="auth-modal-subtitle">Sign in to access your dashboard</p>
            
            <div class="auth-providers">
                <button class="auth-provider-btn github" id="github-auth">
                    <i class="fab fa-github"></i>
                    Continue with GitHub
                </button>
                <button class="auth-provider-btn google" id="google-auth">
                    <i class="fab fa-google"></i>
                    Continue with Google
                </button>
            </div>
            
            <div class="auth-divider">
                or continue with email
            </div>
            
            <form class="auth-email-form" id="auth-email-form">
                <div class="auth-input-group">
                    <label for="auth-email">Email address</label>
                    <input type="email" id="auth-email" required placeholder="you@example.com">
                </div>
                
                <div class="auth-input-group" id="auth-password-group">
                    <label for="auth-password">Password</label>
                    <input type="password" id="auth-password" required placeholder="••••••••">
                </div>
                
                <button type="submit" class="auth-submit-btn" id="auth-submit-btn">
                    Continue
                </button>
            </form>
            
            <div class="auth-footer">
                <span id="auth-switch-text">Don't have an account?</span>
                <a href="#" id="auth-switch-btn">Sign up</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Initialize particles.js
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#00f0ff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        }
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 2,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#00f0ff",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": true,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 0.5
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
            
            // Remove Spline logo if present
            const splineViewer = document.querySelector('spline-viewer');
            if (splineViewer) {
                const shadowRoot = splineViewer.shadowRoot;
                if (shadowRoot) {
                    const logo = shadowRoot.querySelector('#logo');
                    if (logo) logo.remove();
                }
            }
            
            // Mobile menu toggle
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            
            mobileMenuBtn.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                mobileMenuBtn.innerHTML = navLinks.classList.contains('active') 
                    ? '<i class="fas fa-times"></i>' 
                    : '<i class="fas fa-bars"></i>';
            });
            
            // Close mobile menu when clicking a link
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                });
            });
            
            // FAQ accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', () => {
                    // Close all other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.faq-answer').style.maxHeight = null;
                        }
                    });
                    
                    // Toggle current item
                    item.classList.toggle('active');
                    const answer = item.querySelector('.faq-answer');
                    if (item.classList.contains('active')) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    } else {
                        answer.style.maxHeight = null;
                    }
                });
            });
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Scroll animations
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const fadeInOnScroll = () => {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementTop < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Initial check
            fadeInOnScroll();
            
            // Check on scroll
            window.addEventListener('scroll', fadeInOnScroll);
            
            // Header scroll effect
            const header = document.querySelector('header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Scroll down button
            document.querySelector('.scroll-down').addEventListener('click', () => {
                window.scrollTo({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            });
            
            // Download buttons functionality (example)
            document.querySelectorAll('.download-card .btn').forEach(button => {
                button.addEventListener('click', function() {
                    const platform = this.closest('.download-card').querySelector('h3').textContent;
                    const version = document.getElementById('version-select').value;
                    
                    // In a real implementation, this would redirect to the appropriate download
                    alert(`Downloading Sentra for ${platform} (${version} version)`);
                    
                    // Example of actual download implementation:
                    // let downloadUrl;
                    // switch(platform) {
                    //     case 'Windows':
                    //         downloadUrl = version === 'beta' ? 'windows-beta.exe' : 'windows-stable.exe';
                    //         break;
                    //     case 'MacOS':
                    //         downloadUrl = version === 'beta' ? 'macos-beta.dmg' : 'macos-stable.dmg';
                    //         break;
                    //     case 'Linux':
                    //         downloadUrl = version === 'beta' ? 'linux-beta.tar.gz' : 'linux-stable.tar.gz';
                    //         break;
                    // }
                    // window.location.href = downloadUrl;
                });
            });
            
            // Hero download button
            document.querySelector('.hero-buttons .btn-primary').addEventListener('click', function() {
                // Detect user's OS and suggest appropriate download
                const userOS = detectOS();
                alert(`In a real implementation, this would download Sentra for ${userOS}`);
                
                // You could show a platform selector modal here
                // showDownloadModal();
            });
            
            // Newsletter form
            const newsletterForm = document.querySelector('.newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('input').value;
                    // In a real implementation, you would send this to your backend
                    alert(`Thank you for subscribing with ${email}!`);
                    this.querySelector('input').value = '';
                });
            }
            
            // Helper function to detect OS
            function detectOS() {
                const userAgent = window.navigator.userAgent;
                const platform = window.navigator.platform;
                
                if (/Mac/i.test(platform)) return "MacOS";
                if (/Win/i.test(platform)) return "Windows";
                if (/Linux/i.test(platform)) return "Linux";
                
                if (/Android/i.test(userAgent)) return "Android";
                if (/iPhone|iPad|iPod/i.test(userAgent)) return "iOS";
                
                return "Unknown OS";
            }
        });
    </script>


<script>
    // Firebase configuration - REPLACE WITH YOUR ACTUAL CONFIG
    const firebaseConfig = {
  apiKey: "AIzaSyBDkHoKXPjUUHPOc0_3obelvi5SlKCJLTQ",
  authDomain: "sentra-a8a27.firebaseapp.com",
  projectId: "sentra-a8a27",
  storageBucket: "sentra-a8a27.firebasestorage.app",
  messagingSenderId: "611105282487",
  appId: "1:611105282487:web:0f9a9c3e46b71d496ff032"
    };
    
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();
    
    // DOM Elements
    const authModal = document.getElementById('auth-modal');
    const closeAuth = document.getElementById('close-auth');
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    const authButtons = document.getElementById('auth-buttons');
    const userProfile = document.getElementById('user-profile');
    const userAvatar = document.getElementById('user-avatar');
    const userName = document.getElementById('user-name');
    const logoutBtn = document.getElementById('logout-btn');
    const githubAuth = document.getElementById('github-auth');
    const googleAuth = document.getElementById('google-auth');
    const authEmailForm = document.getElementById('auth-email-form');
    const authEmail = document.getElementById('auth-email');
    const authPassword = document.getElementById('auth-password');
    const authSubmitBtn = document.getElementById('auth-submit-btn');
    const authSwitchBtn = document.getElementById('auth-switch-btn');
    const authSwitchText = document.getElementById('auth-switch-text');
    const authModalTitle = document.getElementById('auth-modal-title');
    const authModalSubtitle = document.getElementById('auth-modal-subtitle');
    const authPasswordGroup = document.getElementById('auth-password-group');
    
    // Auth state
    let isLoginMode = true;
    
    // Toggle auth modal
    function toggleAuthModal(show) {
        if (show) {
            authModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            authModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    // Switch between login/signup
    function toggleAuthMode() {
        isLoginMode = !isLoginMode;
        
        if (isLoginMode) {
            authModalTitle.textContent = 'Welcome back to Sentra';
            authModalSubtitle.textContent = 'Sign in to access your dashboard';
            authSubmitBtn.textContent = 'Sign In';
            authSwitchText.textContent = "Don't have an account?";
            authSwitchBtn.textContent = 'Sign up';
            authPasswordGroup.style.display = 'flex';
        } else {
            authModalTitle.textContent = 'Create your Sentra account';
            authModalSubtitle.textContent = 'Get started with your productivity suite';
            authSubmitBtn.textContent = 'Sign Up';
            authSwitchText.textContent = "Already have an account?";
            authSwitchBtn.textContent = 'Sign in';
            authPasswordGroup.style.display = 'flex';
        }
    }
    
    // Update UI based on auth state
    function updateUI(user) {
        if (user) {
            // User is signed in
            authButtons.style.display = 'none';
            userProfile.style.display = 'flex';
            
            // Set user info
            userName.textContent = user.displayName || user.email;
            userAvatar.src = user.photoURL || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.email) + '&background=0f172a&color=00f0ff';
        } else {
            // User is signed out
            authButtons.style.display = 'flex';
            userProfile.style.display = 'none';
        }
    }
    
    // GitHub Auth
    async function signInWithGitHub() {
        const provider = new firebase.auth.GithubAuthProvider();
        try {
            await auth.signInWithPopup(provider);
            toggleAuthModal(false);
        } catch (error) {
            console.error('GitHub auth error:', error);
            alert('Failed to sign in with GitHub: ' + error.message);
        }
    }
    
    // Google Auth
    async function signInWithGoogle() {
        const provider = new firebase.auth.GoogleAuthProvider();
        try {
            await auth.signInWithPopup(provider);
            toggleAuthModal(false);
        } catch (error) {
            console.error('Google auth error:', error);
            alert('Failed to sign in with Google: ' + error.message);
        }
    }
    
    // Email/password auth
    async function handleEmailAuth() {
        const email = authEmail.value;
        const password = authPassword.value;
        
        try {
            if (isLoginMode) {
                await auth.signInWithEmailAndPassword(email, password);
            } else {
                await auth.createUserWithEmailAndPassword(email, password);
                // You might want to update the user's display name here
            }
            toggleAuthModal(false);
        } catch (error) {
            console.error('Email auth error:', error);
            alert('Authentication error: ' + error.message);
        }
    }
    
    // Sign out
    async function signOut() {
        try {
            await auth.signOut();
        } catch (error) {
            console.error('Sign out error:', error);
        }
    }
    
    // Event Listeners
    loginBtn.addEventListener('click', () => {
        isLoginMode = true;
        toggleAuthModal(true);
    });
    
    signupBtn.addEventListener('click', () => {
        isLoginMode = false;
        toggleAuthModal(true);
    });
    
    closeAuth.addEventListener('click', () => toggleAuthModal(false));
    authModal.addEventListener('click', (e) => {
        if (e.target === authModal) {
            toggleAuthModal(false);
        }
    });
    
    githubAuth.addEventListener('click', signInWithGitHub);
    googleAuth.addEventListener('click', signInWithGoogle);
    
    authEmailForm.addEventListener('submit', (e) => {
        e.preventDefault();
        handleEmailAuth();
    });
    
    authSwitchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        toggleAuthMode();
    });
    
    logoutBtn.addEventListener('click', signOut);
    
    // Auth state observer
    auth.onAuthStateChanged((user) => {
        updateUI(user);
    });
</script>

</body>
</html>