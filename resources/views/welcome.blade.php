<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warung Babi Guling Sari Nadi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: #fff3ec;
            --dark: #1a1008;
            --dark-2: #2d1a06;
            --gray: #f7f3ef;
            --text: #3d2b1a;
            --text-light: #8c7060;
            --white: #ffffff;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--white);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(26, 16, 8, 0.97);
            backdrop-filter: blur(12px);
            padding: 0 5%;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(211, 84, 0, 0.25);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .nav-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-brand-text {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .nav-brand-text span {
            color: var(--orange);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--orange);
            transition: width 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-outline {
            padding: 8px 20px;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            color: white;
            background: transparent;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.25s;
            cursor: pointer;
        }

        .btn-outline:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            padding: 8px 22px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--orange-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.4);
        }

        /* ── HERO ── */
        .hero {
            min-height: calc(100vh - 72px);
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('/image/BackGround Landing Page.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 0 8%;
            gap: 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Decorative leaf sketches */
        .hero-deco {
            position: absolute;
            opacity: 0.06;
            pointer-events: none;
        }

        .hero-deco-2 {
            bottom: 5%;
            left: 5%;
            font-size: 120px;
            color: var(--orange);
            transform: rotate(15deg);
        }

        .hero-left {
            position: relative;
            z-index: 1;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(211, 84, 0, 0.15);
            border: 1px solid rgba(211, 84, 0, 0.35);
            color: var(--orange);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .hero-tag::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--orange);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: 0.5;
                transform: scale(1.3)
            }
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.6rem, 5vw, 4.2rem);
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-title em {
            color: var(--orange);
            font-style: italic;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 420px;
            margin-bottom: 36px;
        }

        .hero-cta {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            padding: 14px 32px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 8px 30px rgba(211, 84, 0, 0.4);
        }

        .btn-hero-primary:hover {
            background: var(--orange-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(211, 84, 0, 0.5);
        }

        .btn-hero-secondary {
            padding: 14px 32px;
            background: transparent;
            color: white;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-hero-secondary:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.07);
        }

        .hero-socials {
            display: flex;
            gap: 14px;
            margin-top: 48px;
        }

        .social-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-circle:hover {
            border-color: var(--orange);
            color: var(--orange);
            transform: translateY(-2px);
        }

        /* Hero right: stacked image composition */
        .hero-right {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-img-wrap {
            position: relative;
            width: 100%;
            max-width: 520px;
        }

        .hero-img-main {
            width: 78%;
            aspect-ratio: 4/5;
            object-fit: cover;
            border-radius: 20px;
            display: block;
            margin-left: auto;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
            background: linear-gradient(135deg, #8B4513, #d35400);
            position: relative;
            overflow: hidden;
        }

        .hero-img-main::after {
            content: '🍖';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 6rem;
        }

        .hero-img-float {
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 55%;
            aspect-ratio: 1;
            border-radius: 16px;
            background: linear-gradient(135deg, #c0392b, #8B0000);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .hero-badge {
            position: absolute;
            top: 30px;
            right: -10px;
            background: var(--orange);
            color: white;
            padding: 16px;
            border-radius: 16px;
            text-align: center;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(211, 84, 0, 0.5);
            animation: float 3s ease-in-out infinite;
        }

        .hero-badge-num {
            font-size: 1.8rem;
            display: block;
            line-height: 1;
        }

        .hero-badge-text {
            font-size: 0.7rem;
            opacity: 0.85;
            letter-spacing: 0.05em;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }
        }

        /* ── STATS STRIP ── */
        .stats-strip {
            background: var(--orange);
            padding: 28px 8%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 900;
            display: block;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8rem;
            opacity: 0.85;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .stat-divider {
            width: 1px;
            height: 50px;
            background: rgba(255, 255, 255, 0.3);
        }

        /* ── SECTION COMMON ── */
        section {
            padding: 90px 8%;
        }

        .section-eyebrow {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-eyebrow::before {
            content: '';
            width: 28px;
            height: 2px;
            background: var(--orange);
            border-radius: 2px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-desc {
            color: var(--text-light);
            font-size: 0.97rem;
            line-height: 1.75;
            max-width: 460px;
        }

        /* ── SPECIAL DISHES ── */
        .dishes-section {
            background: var(--gray);
        }

        .dishes-header {
            text-align: center;
            margin-bottom: 56px;
        }

        .dishes-header .section-eyebrow {
            justify-content: center;
        }

        .dishes-header .section-eyebrow::before {
            display: none;
        }

        /* ── FIX 1: 4 kolom 1 baris, centered & balanced ── */
        .dishes-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dish-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .dish-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(211, 84, 0, 0.15);
        }

        .dish-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #f0a060, #d35400);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
            overflow: hidden;
        }

        .dish-price-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: var(--dark);
            color: white;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .dish-body {
            padding: 20px 22px 24px;
        }

        .dish-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .dish-desc {
            font-size: 0.85rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        /* ── ABOUT / CHEF ── */
        .about-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-img-wrap {
            position: relative;
        }

        .about-img-main {
            width: 85%;
            aspect-ratio: 3/4;
            border-radius: 24px;
            background: linear-gradient(135deg, #f0a060, #d35400, #8B0000);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            box-shadow: 0 20px 70px rgba(211, 84, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .about-accent {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 55%;
            aspect-ratio: 1;
            background: var(--orange);
            border-radius: 20px;
            opacity: 0.12;
        }

        .about-card-float {
            position: absolute;
            top: 40px;
            right: -10px;
            background: white;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
            min-width: 160px;
        }

        .about-card-float .num {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--orange);
            font-weight: 900;
        }

        .about-card-float .lbl {
            font-size: 0.78rem;
            color: var(--text-light);
            line-height: 1.3;
        }

        .about-features {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 36px;
        }

        .about-feat {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .feat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            background: var(--orange-pale);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--orange);
        }

        .feat-title {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .feat-desc {
            font-size: 0.83rem;
            color: var(--text-light);
            line-height: 1.55;
        }

        .about-cta {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .btn-orange {
            padding: 13px 30px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-orange:hover {
            background: var(--orange-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(211, 84, 0, 0.35);
        }

        .btn-dark {
            padding: 13px 30px;
            background: var(--dark);
            color: white;
            border: none;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-dark:hover {
            background: var(--dark-2);
            transform: translateY(-2px);
        }

        /* ── LOKASI ── */
        .lokasi-section {
            background: white;
        }

        .lokasi-inner {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
        }

        .map-wrap {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            aspect-ratio: 4/3;
        }

        .map-wrap iframe {
            width: 100%;
            height: 100%;
            border: 0;
            display: block;
        }

        .lokasi-info {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-row {
            display: flex;
            gap: 18px;
            align-items: flex-start;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            background: var(--orange-pale);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--orange);
            font-size: 1.1rem;
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-light);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .info-val {
            font-size: 0.95rem;
            color: var(--dark);
            font-weight: 500;
        }

        /* ── KONTAK / CTA BANNER ── */
        .kontak-section {
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .kontak-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.2) 0%, transparent 70%);
        }

        .kontak-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .kontak-cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            color: white;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .kontak-cta-title em {
            color: var(--orange);
        }

        .kontak-desc {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.95rem;
            line-height: 1.75;
            margin-bottom: 36px;
        }

        .newsletter-form {
            display: flex;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            overflow: hidden;
            padding: 6px 6px 6px 20px;
        }

        .newsletter-form input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
        }

        .newsletter-form input::placeholder {
            color: rgba(255, 255, 255, 0.35);
        }

        .newsletter-form button {
            background: var(--orange);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.25s;
            white-space: nowrap;
        }

        .newsletter-form button:hover {
            background: var(--orange-light);
        }

        .kontak-channels {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .channel-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .channel-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateX(4px);
        }

        .channel-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .ch-wa {
            background: rgba(37, 211, 102, 0.2);
            color: #25d366;
        }

        .ch-ig {
            background: rgba(225, 48, 108, 0.2);
            color: #e1306c;
        }

        .ch-grab {
            background: rgba(0, 173, 96, 0.2);
            color: #00ad60;
        }

        .channel-info {
            flex: 1;
        }

        .channel-name {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .channel-val {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.8rem;
            margin-top: 2px;
        }

        .channel-arrow {
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
        }

        /* ── FOOTER ── */
        footer {
            background: #0e0803;
            padding: 28px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-copy {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.82rem;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.35);
            text-decoration: none;
            font-size: 0.82rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--orange);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 60px 6%;
            }

            .hero-desc {
                margin: 0 auto 36px;
            }

            .hero-cta {
                justify-content: center;
            }

            .hero-socials {
                justify-content: center;
            }

            .hero-right {
                display: none;
            }

            .about-section {
                grid-template-columns: 1fr;
            }

            .about-img-wrap {
                display: none;
            }

            .testi-slider {
                grid-template-columns: 1fr;
            }

            .lokasi-inner {
                grid-template-columns: 1fr;
            }

            .kontak-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .stat-divider {
                display: none;
            }

            .nav-links,
            .nav-actions {
                display: none;
            }

            .dishes-grid {
                grid-template-columns: repeat(2, 1fr);
                max-width: 100%;
            }
        }

        /* ── ENTRANCE ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.7s ease both;
        }

        .delay-1 {
            animation-delay: 0.15s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.45s;
        }

        .delay-4 {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="#" class="nav-brand">
            <div class="nav-logo"> <img src="{{ asset('image/logo_sari_nadi_transparent.png') }}" alt="Logo"></div>
            <div class="nav-brand-text">Sari <span>Nadi</span></div>
        </a>
        <ul class="nav-links">
            <li><a href="#beranda" class="active" data-target="beranda">Beranda</a></li>
            <li><a href="#menu" data-target="menu">Menu</a></li>
            <li><a href="#lokasi" data-target="lokasi">Lokasi</a></li>
            <li><a href="#kontak" data-target="kontak">Kontak</a></li>
        </ul>
        {{-- <div class="nav-actions">
            @if (Route::has('login'))
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-outline">Register</a>
                @endif
                <a href="{{ route('login') }}" class="btn-primary">Log in</a>
            @endif
        </div> --}}
    </nav>

    <!-- HERO -->
    <section id="beranda" class="hero">
        <div class="hero-deco hero-deco-2"><i class="fas fa-pepper-hot"></i></div>

        <div class="hero-left">
            <div class="hero-tag fade-up">Kuliner Khas Bali</div>
            <h1 class="hero-title fade-up delay-1">
                Cita Rasa <em>Babi Guling</em><br>Otentik Bali
            </h1>
            <p class="hero-desc fade-up delay-2">
                Kulit renyah keemasan, daging empuk dibumbui rempah pilihan, dan tempat yang nyaman — tempat kuliner
                Bali sejak 1993.
            </p>
            <div class="hero-cta fade-up delay-3">
                <a href="#menu" class="btn-hero-primary"><i class="fas fa-utensils"></i> Lihat Menu</a>
                <a href="#lokasi" class="btn-hero-secondary">Temukan Kami</a>
            </div>
            {{-- <div class="hero-socials fade-up delay-4 px-0">
                <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-circle"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-circle"><i class="fab fa-whatsapp"></i></a>
            </div> --}}
        </div>

        <div class="hero-right fade-up delay-2">
            <div class="hero-img-wrap">
                <div class="hero-img-main"></div>
                <div class="hero-img-float">🍖</div>
                <div class="hero-badge">
                    <span class="hero-badge-num">25+</span>
                    <span class="hero-badge-text">Tahun<br>Melayani</span>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- STATS STRIP -->
    <div class="stats-strip">
        <div class="stat-item">
            <span class="stat-num">500+</span>
            <span class="stat-label">Porsi / Hari</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <span class="stat-num">4.9★</span>
            <span class="stat-label">Rating Google</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <span class="stat-num">25+</span>
            <span class="stat-label">Tahun Pengalaman</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <span class="stat-num">10rb+</span>
            <span class="stat-label">Pelanggan Setia</span>
        </div>
    </div> --}}

    <!-- MENU -->
    <section id="menu" class="dishes-section">
        <div class="dishes-header">
            <div class="section-eyebrow">Menu Spesial Kami</div>
            <h2 class="section-title">Menu Favorit Pelanggan</h2>
            <p class="section-desc" style="margin: 0 auto; text-align:center;">Setiap hidangan dimasak segar setiap hari
                menggunakan bumbu Bali tradisional turun-temurun.</p>
        </div>

        <!-- FIX 1: 2×2 grid, max-width + margin:auto → centered & balanced -->
        <div class="dishes-grid">
            <div class="dish-card">
                <div class="dish-img">🍛
                    <div class="dish-price-badge">Rp 45rb</div>
                </div>
                <div class="dish-body">
                    <div class="dish-name">Paket Prima</div>
                    <div class="dish-desc">Nasi kuning, babi guling, sate lilit, urutan, dan sambal matah segar.</div>
                </div>
            </div>

            <div class="dish-card">
                <div class="dish-img" style="background: linear-gradient(135deg, #c0392b, #d35400);">🍱
                    <div class="dish-price-badge">Rp 30rb</div>
                </div>
                <div class="dish-body">
                    <div class="dish-name">Paket Jajan</div>
                    <div class="dish-desc">Nasi, babi guling, dan sambal matah. Cocok untuk makan siang ringan.</div>
                </div>
            </div>

            <div class="dish-card">
                <div class="dish-img" style="background: linear-gradient(135deg, #8B4513, #c0392b);">🍢
                    <div class="dish-price-badge">Rp 20rb</div>
                </div>
                <div class="dish-body">
                    <div class="dish-name">Sate Lilit</div>
                    <div class="dish-desc">Sate khas Bali dari ikan tenggiri dan daging cincang bumbu rempah pilihan.
                    </div>
                </div>
            </div>

            <div class="dish-card">
                <div class="dish-img" style="background: linear-gradient(135deg, #d35400, #f39c12);">🥩
                    <div class="dish-price-badge">Rp 35rb</div>
                </div>
                <div class="dish-body">
                    <div class="dish-name">Babi Guling Porsi</div>
                    <div class="dish-desc">Kulit renyah dan daging empuk babi guling dengan lawar dan urutan.</div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- ABOUT / CHEF -->
    <section class="about-section" style="padding: 90px 8%;">
        <div class="about-img-wrap">
            <div class="about-img-main">👨‍🍳
                <div class="about-accent"></div>
            </div>
            <div class="about-card-float">
                <div class="num">98%</div>
                <div class="lbl">Kepuasan<br>Pelanggan</div>
            </div>
        </div>
        <div class="about-right">
            <div class="section-eyebrow">Tentang Kami</div>
            <h2 class="section-title">Warung Dengan Hati, Masakan Dengan Jiwa</h2>
            <p class="section-desc">Berdiri sejak 1998, Sari Nadi menjaga resep rahasia keluarga untuk menghadirkan babi guling paling otentik di Bali. Setiap bumbu dipilih segar setiap pagi.</p>

            <div class="about-features">
                <div class="about-feat">
                    <div class="feat-icon"><i class="fas fa-leaf"></i></div>
                    <div>
                        <div class="feat-title">Bumbu Segar Setiap Hari</div>
                        <div class="feat-desc">Rempah dipilih dan diracik setiap pagi untuk menjaga kesegaran cita rasa khas Bali.</div>
                    </div>
                </div>
                <div class="about-feat">
                    <div class="feat-icon"><i class="fas fa-fire"></i></div>
                    <div>
                        <div class="feat-title">Resep Turun-Temurun</div>
                        <div class="feat-desc">Teknik memasak tradisional Bali yang dijaga keasliannya selama lebih dari 25 tahun.</div>
                    </div>
                </div>
                <div class="about-feat">
                    <div class="feat-icon"><i class="fas fa-award"></i></div>
                    <div>
                        <div class="feat-title">Penghargaan Kuliner Bali</div>
                        <div class="feat-desc">Diakui sebagai salah satu warung babi guling terbaik di Bali oleh berbagai media.</div>
                    </div>
                </div>
            </div>

            <div class="about-cta">
                <a href="#menu" class="btn-orange"><i class="fas fa-utensils"></i> Lihat Menu</a>
                <a href="#lokasi" class="btn-dark"><i class="fas fa-map-marker-alt"></i> Kunjungi Kami</a>
            </div>
        </div>
    </section> --}}

    <!-- LOKASI -->
    <section id="lokasi" class="lokasi-section">
        <div class="lokasi-inner">
            <div>
                <div class="section-eyebrow">Temukan Kami</div>
                <h2 class="section-title">Lokasi Warung Sari Nadi</h2>
                <p class="section-desc" style="margin-bottom: 36px;">Mudah dijangkau di pusat Bali. Buka setiap hari
                    dari pagi hingga hidangan habis terjual.</p>

                <div class="lokasi-info">
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="info-label">Alamat</div>
                            <div class="info-val">Jl. Diponegoro No.747, Pedungan, Denpasar Selatan, Kota Denpasar,
                                Bali, Indonesia</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <div class="info-label">Jam Buka</div>
                            <div class="info-val">Setiap Hari: 07.00 – 19.00</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="info-label">Telepon / WhatsApp</div>
                            <div class="info-val">+62 813-3729-0894</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px;">
                    <a href="https://maps.app.goo.gl/B7pak8hQDXgmFd2R6" target="_blank" class="btn-orange"
                        style="display: inline-flex;">
                        <i class="fas fa-directions"></i> Petunjuk Arah
                    </a>
                </div>
            </div>

            <!-- FIX 2: Google Maps embed diarahkan ke Jl. Diponegoro No.747, Pedungan, Denpasar Selatan -->
            <div class="map-wrap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.7506283079624!2d115.21300527368147!3d-8.715214088843648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2416bd2d60299%3A0x787b37456ff9970c!2sWarung%20Babi%20Guling%20Sari%20Nadi!5e0!3m2!1sid!2sid!4v1773303057281!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="kontak-section">
        <div class="kontak-inner">
            <div>
                <div class="section-eyebrow" style="color: rgba(255,255,255,0.5);">Tetap Terhubung</div>
                <h2 class="kontak-cta-title">Dapatkan <em>Promo</em> &amp; Info Terbaru</h2>
                <p class="kontak-desc">Ikuti kami untuk mendapatkan promo spesial, menu baru, dan info event langsung!
                </p>
                {{-- <div class="newsletter-form">
                    <input type="email" placeholder="Masukkan email Anda...">
                    <button type="button">Subscribe</button>
                </div> --}}
            </div>

            <div class="kontak-channels">
                <h3
                    style="color: rgba(255,255,255,0.6); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                    Hubungi Langsung</h3>
                <a href="https://wa.me/6281337290894" class="channel-card" target="_blank">
                    <div class="channel-icon ch-wa"><i class="fab fa-whatsapp"></i></div>
                    <div class="channel-info">
                        <div class="channel-name">WhatsApp</div>
                        <div class="channel-val">+62 813-3729-0894</div>
                    </div>
                    <i class="fas fa-chevron-right channel-arrow"></i>
                </a>
                <a href="https://www.instagram.com/sarinadi_warung?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    class="channel-card" target="_blank">
                    <div class="channel-icon ch-ig"><i class="fab fa-instagram"></i></div>
                    <div class="channel-info">
                        <div class="channel-name">Instagram</div>
                        <div class="channel-val">@sarinadiwarung</div>
                    </div>
                    <i class="fas fa-chevron-right channel-arrow"></i>
                </a>
                <a href="https://r.grab.com/g/6-20260310_004654_669426ff7d3c4cc4b51ec1b034af63d5_MEXMPS-6-C25TGXVXABTBA6"
                    class="channel-card">
                    <div class="channel-icon ch-grab"><i class="fas fa-motorcycle"></i></div>
                    <div class="channel-info">
                        <div class="channel-name">GrabFood</div>
                        <div class="channel-val">Pesan & Antar ke Rumah</div>
                    </div>
                    <i class="fas fa-chevron-right channel-arrow"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-copy">&copy; 2025 Warung Babi Guling Sari Nadi. All rights reserved.</div>
        <div class="footer-links">
            <a href="#beranda">Beranda</a>
            <a href="#menu">Menu</a>
            <a href="#lokasi">Lokasi</a>
            <a href="#kontak">Kontak</a>
        </div>
    </footer>

    <script>
        // Active nav highlight on scroll
        const sections = document.querySelectorAll('section[id], .hero[id]');
        const navLinks = document.querySelectorAll('.nav-links a');

        function updateActive() {
            let current = '';
            const scrollY = window.pageYOffset;
            const winH = window.innerHeight;
            const docH = document.documentElement.scrollHeight;

            if (scrollY + winH >= docH - 10) {
                current = 'kontak';
            } else {
                sections.forEach(sec => {
                    if (scrollY >= sec.offsetTop - winH / 3) current = sec.id;
                });
            }

            navLinks.forEach(a => {
                a.classList.toggle('active', a.getAttribute('data-target') === current || a.getAttribute('href') ===
                    '#' + current);
            });
        }

        window.addEventListener('scroll', updateActive, {
            passive: true
        });
        updateActive();
    </script>
</body>

</html>
