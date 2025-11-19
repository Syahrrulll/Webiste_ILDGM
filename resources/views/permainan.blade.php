<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permainan - Literise</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --p: #7443ff;
            --pp: #d3a2ff;
            --w: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 100%);
            overflow-x: hidden;
            min-height: 100vh;
        }

        .literise-title {
            font-size: 6rem;
            font-weight: 800;
            color: #d8c4ff;
            text-shadow:
                0 0 10px #8c52ff,
                0 0 10px #8c52ff,
                0 0 30px #8c52ff,
                0 0 40px #ffffff,
                0 0 50px #ffffff;
            line-height: 1;
        }

        .subtitle-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* === TOMBOL GAME 3D BARU === */
        .btn-game-3d {
            background: linear-gradient(to bottom, #9d7aff, #7443ff);
            border-bottom: 6px solid #5228c7;
            border-radius: 16px;
            transition: all 0.1s;
            position: relative;
            top: 0;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .btn-game-3d:active {
            transform: translateY(4px);
            border-bottom: 2px solid #5228c7;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .btn-game-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            border-radius: 16px;
        }

        .header-btn {
            background: linear-gradient(90deg, #F472B6 0%, #EC4899 100%);
            box-shadow: 0 4px 15px -3px rgba(236, 72, 153, 0.5);
        }

        .platform-btn {
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .platform-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 12px 36px rgba(124, 58, 234, 0.08);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(124, 58, 234, 0.1);
            display: flex;
            flex-direction: column;
        }

        .feature-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 24px;
            background: conic-gradient(from 180deg, var(--p), var(--pp), var(--p));
            animation: rotate 4s linear infinite;
            z-index: 0;
            opacity: 0.8;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            inset: 2px;
            border-radius: 22px;
            background: #d9bbff;
            z-index: 1;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(116, 67, 255, 0.2);
        }

        .feature-card p {
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }

        /* === TOMBOL FEATURE CARD 3D === */
        .feature-card-button {
            margin-top: auto;
            display: inline-block;
            text-align: center;
            padding: 0.75rem 1.5rem;
            border-radius: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(to bottom, #9d7aff, #7443ff);
            border-bottom: 4px solid #5228c7;
            transition: all 0.1s;
            position: relative;
            top: 0;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        .feature-card-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(116, 67, 255, 0.4);
        }

        .feature-card-button:active {
            transform: translateY(2px);
            border-bottom: 2px solid #5228c7;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .wave-bg { position: relative; overflow: hidden; }
        .wave-bg-flipped::before { transform: scaleY(-1); }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floating { animation: float 5s ease-in-out infinite; }
        .floating-slow { animation: float 7s ease-in-out infinite; }
        .floating-fast { animation: float 3s ease-in-out infinite; }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .blink { animation: blink 2s infinite; }

        .btn-glow { position: relative; overflow: hidden; }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::before { left: 100%; }

        @keyframes badge-pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(116, 67, 255, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(116, 67, 255, 0);
            }
        }

        .badge-pulse {
            animation: badge-pulse 3s ease-in-out infinite;
        }

        .progress-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            border-radius: 4px;
            transition: width 1s ease-in-out;
        }

        .dropdown-menu {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            overflow: hidden;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            text-align: left;
            border: none;
            background: none;
            color: #4a5568;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f7fafc;
            color: #7443ff;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 4px 0;
        }

        /* === LOADING OVERLAY BARU === */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(45, 27, 105, 0.95) 0%, rgba(31, 16, 71, 0.95) 100%);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
            font-size: 1.2rem;
            backdrop-filter: blur(10px);
        }

        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.2);
            border-left-color: #FFF;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        .loading-button {
            position: relative;
            overflow: hidden;
        }

        .loading-button.loading {
            pointer-events: none;
        }

        .loading-button.loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* === MOBILE FLOATING BADGES === */
        .mobile-floating-badge {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #ffa500);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
            animation: float 4s ease-in-out infinite;
            z-index: 5;
        }

        .mobile-floating-badge:nth-child(2) {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            animation-delay: 1s;
        }

        .mobile-floating-badge:nth-child(3) {
            background: linear-gradient(135deg, #8e2de2, #4a00e0);
            animation-delay: 2s;
        }

        .mobile-floating-badge i {
            color: white;
            font-size: 1.2rem;
        }

        .mobile-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(116, 67, 255, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(116, 67, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(116, 67, 255, 0);
            }
        }

        /* Styling untuk halaman Permainan */
        .game-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 12px 36px rgba(124, 58, 234, 0.08);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(124, 58, 234, 0.1);
            display: flex;
            flex-direction: column;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(116, 67, 255, 0.2);
        }

        .game-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .game-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #7443ff, #d3a2ff);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        /* PERBAIKAN: Game difficulty yang responsif */
        .game-difficulty {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 0.5rem;
            width: fit-content;
        }

        .difficulty-easy {
            background: rgba(72, 187, 120, 0.2);
            color: #48bb78;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .difficulty-medium {
            background: rgba(246, 173, 85, 0.2);
            color: #f6ad55;
            border: 1px solid rgba(246, 173, 85, 0.3);
        }

        .difficulty-hard {
            background: rgba(245, 101, 101, 0.2);
            color: #f56565;
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        .game-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-btn:hover, .filter-btn.active {
            background: rgba(116, 67, 255, 0.3);
            border-color: rgba(116, 67, 255, 0.5);
        }

        .user-stats-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(124, 58, 234, 0.08);
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-item:last-child {
            margin-bottom: 0;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        .stat-value {
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
        }

        /* PERBAIKAN: Game card yang lebih baik */
        .game-card-improved {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 12px 36px rgba(124, 58, 234, 0.08);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            z-index: 1;
        }

        .game-card-improved::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #7443ff, #d3a2ff, #7443ff);
            border-radius: 22px;
            z-index: -1;
            opacity: 0.3;
            transition: opacity 0.3s ease;
        }

        .game-card-improved:hover::before {
            opacity: 0.6;
        }

        .game-card-improved:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(116, 67, 255, 0.3);
        }

        /* PERBAIKAN: Konten game card */
        .game-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* PERBAIKAN: Responsivitas untuk game stats */
        .game-stats-improved {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .game-stat-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* PERBAIKAN: Transisi antar section yang smooth */
        .main-container {
            background: linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 100%);
            min-height: 100vh;
        }

        .section-smooth {
            position: relative;
            padding: 6rem 0;
            overflow: hidden;
        }

        .section-smooth::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.05) 0%, transparent 50%);
            z-index: 1;
            pointer-events: none;
        }

        .section-content {
            position: relative;
            z-index: 2;
        }

        /* Efek transisi antar section */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            margin: 0 auto;
            width: 80%;
            max-width: 1200px;
        }

        /* Animasi smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Efek parallax subtle */
        .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .parallax-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(40px);
        }

        .parallax-1 {
            width: 300px;
            height: 300px;
            background: #8c52ff;
            top: 10%;
            left: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .parallax-2 {
            width: 200px;
            height: 200px;
            background: #f563fd;
            top: 60%;
            right: 10%;
            animation: float 6s ease-in-out infinite reverse;
        }

        .parallax-3 {
            width: 150px;
            height: 150px;
            background: #8f9bff;
            bottom: 20%;
            left: 15%;
            animation: float 10s ease-in-out infinite;
        }

        /* === MOBILE MENU IMPROVEMENTS === */
        .mobile-menu {
            display: none;
            background: rgba(45, 27, 105, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        .mobile-menu.active {
            display: flex;
        }

        .hamburger-line {
            display: block;
            height: 2px;
            width: 24px;
            background-color: white;
            transition: all 0.3s ease;
        }

        .hamburger-line:nth-child(2) {
            margin: 6px 0;
        }

        .hamburger.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* === MOBILE SCROLL INDICATOR === */
        .mobile-scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            z-index: 10;
        }

        .mobile-scroll-arrow {
            width: 20px;
            height: 20px;
            border-right: 2px solid white;
            border-bottom: 2px solid white;
            transform: rotate(45deg);
            animation: scroll-bounce 2s infinite;
        }

        @keyframes scroll-bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0) rotate(45deg);
            }
            40% {
                transform: translateY(-10px) rotate(45deg);
            }
            60% {
                transform: translateY(-5px) rotate(45deg);
            }
        }

        /* === MOBILE RESPONSIVE IMPROVEMENTS === */
        @media (max-width: 768px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu.active {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #4a2e7c;
                padding: 1rem;
                z-index: 100;
            }
            .literise-title {
                font-size: 4rem;
            }

            /* PERBAIKAN: Game stats di mobile */
            .game-stats-improved {
                justify-content: space-around;
            }

            .section-smooth {
                padding: 4rem 0;
            }

            /* PERBAIKAN: Hero section untuk mobile */
            .hero-section-mobile {
                padding-top: 120px;
                padding-bottom: 180px;
            }

            /* PERBAIKAN: Game card di mobile */
            .game-card-improved {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            /* PERBAIKAN: Game card header di mobile - FIXED */
            .game-card-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .game-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            /* PERBAIKAN: Difficulty text di mobile - FIXED */
            .game-difficulty-mobile {
                display: block;
                margin: 0 auto 0.5rem auto;
                width: fit-content;
            }

            /* PERBAIKAN: Filter buttons di mobile */
            .filter-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
                margin: 0.25rem;
            }

            /* PERBAIKAN: Grid layout untuk mobile */
            .grid-cols-mobile {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            /* PERBAIKAN: Tombol CTA di mobile */
            .cta-buttons-mobile {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-button-mobile {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 640px) {
            .literise-title {
                font-size: 3rem;
                margin-bottom: 1rem !important;
            }

            .hero-title-mobile {
                font-size: 2.5rem !important;
            }

            .game-card-improved {
                padding: 1.5rem 1rem;
                border-radius: 20px;
            }

            .explanation-box {
                padding: 1.5rem;
                margin: 1.5rem 0;
            }

            .correct-result, .incorrect-result {
                padding: 1.5rem !important;
            }

            .feature-card-button {
                padding: 0.75rem 1.25rem;
                font-size: 0.95rem;
                width: 100%;
            }

            .section-smooth {
                padding: 3rem 0;
            }

            /* PERBAIKAN: Padding section untuk mobile */
            .section-padding-mobile {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        @media (max-width: 480px) {
            .literise-title {
                font-size: 2.5rem;
            }

            .hero-title-mobile {
                font-size: 2rem !important;
            }

            .game-card-improved {
                padding: 1.25rem 0.75rem;
            }

            .explanation-box {
                padding: 1.25rem;
                margin: 1.25rem 0;
            }

            .correct-result, .incorrect-result {
                padding: 1.25rem !important;
            }

            .filter-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .section-smooth {
                padding: 2.5rem 0;
            }

            /* PERBAIKAN: Text size untuk mobile sangat kecil */
            .text-mobile-sm {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <div class="main-container">

        <!-- ===== HEADER / NAVIGASI ===== -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
            <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl sm:text-2xl font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <span>LITERISE</span>
                </a>

                <div class="hidden md:flex items-center space-x-4 lg:space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Beranda</a>
                    <a href="{{ route('permainan.index') }}" class="text-pink-300 font-bold transition-colors text-sm lg:text-base">Permainan</a>
                    <a href="{{ route('tentang.index') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Tentang</a>

                    <!-- LOGIKA AUTH DENGAN DROPDOWN PROFIL YANG DIPERBAIKI -->
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <!-- Tombol Dropdown yang diperbaiki -->
                            <button @click="open = !open" class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-4 py-2 lg:px-5 lg:py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow">
                                <span class="text-sm lg:text-base">{{ Str::limit(Auth::user()->name, 10) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 lg:h-5 lg:w-5 transition-transform duration-300" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Menu Dropdown yang diperbaiki -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="absolute right-0 mt-2 w-48 lg:w-56 bg-white rounded-xl shadow-xl z-50"
                                 style="display: none;">

                                <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil & Badge Saya
                                </a>
                                <a href="{{ route('leaderboard.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Leaderboard
                                </a>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Masuk</a>
                        <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-4 py-2 lg:px-5 lg:py-2 rounded-full transition-all duration-300 hover:shadow-lg btn-glow text-sm lg:text-base">
                            Daftar
                        </a>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="hamburger text-white focus:outline-none ml-2">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu">
                <a href="{{ route('home') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Beranda</a>
                <a href="{{ route('permainan.index') }}" class="py-3 px-4 text-pink-300 font-bold transition-colors border-b border-white/10">Permainan</a>
                <a href="{{ route('tentang.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Tentang</a>

                @auth
                    <a href="{{ route('profile.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Profil Saya</a>
                    <a href="{{ route('leaderboard.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Leaderboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline w-full border-b border-white/10">
                        @csrf
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="header-btn text-white font-semibold px-5 py-3 rounded-lg transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow w-full block">
                            Logout
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-3 rounded-lg transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow">
                        Daftar
                    </a>
                @endauth
            </div>
        </nav>

        <!-- =================================== -->
        <!-- KONTEN BARU UNTUK HALAMAN PERMAINAN -->
        <!-- =================================== -->
        <main class="relative z-20 pt-24 sm:pt-28 md:pt-32 pb-16 sm:pb-20">


            <!-- SECTION HERO PERMAINAN -->
            <section class="section-smooth hero-section-mobile">
                <div class="parallax-bg">
                    <div class="parallax-element parallax-1"></div>
                    <div class="parallax-element parallax-2"></div>
                    <div class="parallax-element parallax-3"></div>
                </div>
                <div class="section-content">
                    <div class="container mx-auto px-4 sm:px-6 text-center section-padding-mobile">
                        <h1 class="text-4xl md:text-7xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-4 md:mb-6 hero-title-mobile" data-aos="fade-down">
                            Arena Permainan
                        </h1>
                        <p class="text-lg md:text-xl text-white max-w-3xl mx-auto mb-8 md:mb-10 text-mobile-sm" data-aos="fade-up" data-aos-delay="200">
                            Jelajahi berbagai permainan seru yang akan meningkatkan kemampuan literasi digital Anda. Setiap permainan dirancang untuk melatih keterampilan berbeda dengan cara yang menyenangkan!
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 cta-buttons-mobile" data-aos="fade-up" data-aos-delay="400">
                            <!-- TOMBOL TANPA LOADING: Jelajahi Permainan -->
                            <a href="#daftar-permainan" class="btn-game-3d text-white font-bold py-4 px-6 md:px-8 text-lg w-full sm:w-auto flex items-center justify-center gap-3 group mobile-pulse cta-button-mobile">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Jelajahi Permainan
                            </a>
                            <!-- TOMBOL TANPA LOADING: Lihat Peringkat -->
                            <a href="{{ route('leaderboard.index') }}" class="btn-game-secondary text-white font-semibold py-4 px-6 md:px-8 text-lg w-full sm:w-auto flex items-center justify-center hover:bg-white/20 cta-button-mobile">
                                Lihat Peringkat
                            </a>
                        </div>
                    </div>
                </div>

            </section>

            <!-- Divider antar section -->
            <div class="section-divider my-8"></div>

            <!-- SECTION FILTER DAN DAFTAR PERMAINAN -->
            <section id="daftar-permainan" class="section-smooth">
                <div class="parallax-bg">
                    <div class="parallax-element parallax-1" style="top: 30%; left: 70%;"></div>
                    <div class="parallax-element parallax-2" style="top: 70%; right: 20%;"></div>
                </div>
                <div class="section-content">
                    <div class="container mx-auto px-4 sm:px-6 section-padding-mobile">
                        <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
                            <h2 class="text-3xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-4">
                                Pilih Permainan
                            </h2>
                            <p class="text-base md:text-lg text-white subtitle-shadow mx-auto max-w-3xl text-mobile-sm">
                                Temukan permainan yang sesuai dengan minat dan tingkat kemampuan Anda
                            </p>
                        </div>

                        <!-- Filter Kategori -->
                        <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-8 md:mb-12" data-aos="fade-up">
                            <button class="filter-btn active" data-filter="all">Semua</button>
                            <button class="filter-btn" data-filter="membaca">Membaca</button>
                            <button class="filter-btn" data-filter="fakta">Cek Fakta</button>
                            <button class="filter-btn" data-filter="tata-bahasa">Tata Bahasa</button>
                            <button class="filter-btn" data-filter="komprehensi">Pemahaman</button>
                        </div>

                        <!-- Grid Permainan - HANYA PERMAINAN YANG ROUTE-NYA ADA -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 grid-cols-mobile">
                            <!-- Permainan 1: Reading Mission -->
                            <div class="game-card-improved" data-category="membaca komprehensi" data-aos="fade-up" data-aos-delay="100">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-medium game-difficulty-mobile">Menengah</span>
                                            <h3 class="text-xl font-bold text-white">Reading Mission</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        Cari topik menarik, baca artikel yang dihasilkan AI, dan jawab 3 kuis pemahaman untuk mengumpulkan poin.
                                    </p>

                                    <!-- TOMBOL DENGAN LOADING: Mulai Misi -->
                                    <a href="{{ route('game.play') }}" class="feature-card-button loading-button mt-4">Mulai Misi</a>
                                </div>
                            </div>

                            <!-- Permainan 2: Hoax or Not? -->
                            <div class="game-card-improved" data-category="fakta" data-aos="fade-up" data-aos-delay="200">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-hard game-difficulty-mobile">Sulit</span>
                                            <h3 class="text-xl font-bold text-white">Hoax or Not?</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        Tebak apakah berita viral ini fakta atau hoaks, lalu lihat penjelasan AI dan sumber aslinya untuk memverifikasi.
                                    </p>

                                    <!-- TOMBOL DENGAN LOADING: Cek Fakta -->
                                    <a href="{{ route('hoax.index') }}" class="feature-card-button loading-button mt-4">Cek Fakta</a>
                                </div>
                            </div>

                            <!-- Permainan 3: Library Hub -->
                            <div class="game-card-improved" data-category="membaca komprehensi" data-aos="fade-up" data-aos-delay="300">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-easy game-difficulty-mobile">Mudah</span>
                                            <h3 class="text-xl font-bold text-white">Library Hub</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        Baca cerpen atau artikel AI berdasarkan genre favorit, lalu uji ingatan dengan game "Melengkapi Kata".
                                    </p>

                                    <!-- TOMBOL DENGAN LOADING: Mulai Membaca -->
                                    <a href="{{ route('library.index') }}" class="feature-card-button loading-button mt-4">Mulai Membaca</a>
                                </div>
                            </div>

                            <!-- Permainan 4: Zona Tata Bahasa -->
                            <div class="game-card-improved" data-category="tata-bahasa" data-aos="fade-up" data-aos-delay="400">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-medium game-difficulty-mobile">Menengah</span>
                                            <h3 class="text-xl font-bold text-white">Zona Tata Bahasa</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        AI akan memberikan 5 kalimat (benar atau salah) berdasarkan genre. Tugas Anda adalah memperbaiki kesalahan tata bahasa!
                                    </p>

                                    <!-- TOMBOL DENGAN LOADING: Asah Ejaan -->
                                    <a href="{{ route('grammar.index') }}" class="feature-card-button loading-button mt-4">Asah Ejaan</a>
                                </div>
                            </div>

                            <!-- Permainan 5: Coming Soon 1 -->
                            <div class="game-card-improved" data-category="tata-bahasa" data-aos="fade-up" data-aos-delay="500">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-medium game-difficulty-mobile">Menengah</span>
                                            <h3 class="text-xl font-bold text-white">Permainan Baru</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        Permainan seru sedang dalam pengembangan! Segera hadir untuk melatih kemampuan literasi digital Anda.
                                    </p>

                                    <button class="feature-card-button mt-4 opacity-50 cursor-not-allowed" disabled>
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>

                            <!-- Permainan 6: Coming Soon 2 -->
                            <div class="game-card-improved" data-category="fakta komprehensi" data-aos="fade-up" data-aos-delay="600">
                                <div class="game-card-content">
                                    <div class="game-card-header">
                                        <div class="game-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <!-- PERBAIKAN: Difficulty text di mobile -->
                                            <span class="game-difficulty difficulty-hard game-difficulty-mobile">Sulit</span>
                                            <h3 class="text-xl font-bold text-white">Permainan Baru</h3>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 flex-grow text-mobile-sm">
                                        Permainan tantangan baru sedang dipersiapkan untuk mengasah kemampuan berpikir kritis dan analitis Anda.
                                    </p>

                                    <button class="feature-card-button mt-4 opacity-50 cursor-not-allowed" disabled>
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        <!-- =================================== -->
        <!-- AKHIR KONTEN BARU                   -->
        <!-- =================================== -->

        <!-- ===== FOOTER ===== -->
        <footer class="w-full bg-[#4a2e7c] text-white pt-12 pb-6 relative z-[9999]">
            <div class="container mx-auto px-4 sm:px-6 z-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 sm:gap-8 mb-8 sm:mb-12">
                    <!-- Kolom 1: Tentang -->
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Tentang Literise
                        </h3>
                        <p class="text-gray-300 mb-3 sm:mb-4 text-sm sm:text-base">
                            Literise adalah platform edukasi interaktif yang dirancang untuk meningkatkan literasi digital dan kemampuan berpikir kritis melalui permainan yang menyenangkan.
                        </p>
                        <div class="flex space-x-3 sm:space-x-4">
                            <a href="#" class="platform-btn text-white p-2 sm:p-3 rounded-full transition-all duration-300 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                            </a>
                            <a href="#" class="platform-btn text-white p-2 sm:p-3 rounded-full transition-all duration-300 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 a6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>
                            </a>
                            <a href="#" class="platform-btn text-white p-2 sm:p-3 rounded-full transition-all duration-300 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Kolom 2: Link Cepat -->
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Link Cepat</h3>
                        <ul class="space-y-2 sm:space-y-3">
                            <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                                <span class="w-2 h-2 bg-pink-400 rounded-full mr-2 sm:mr-3"></span>
                                Beranda
                            </a></li>
                            <li><a href="{{ route('permainan.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                                <span class="w-2 h-2 bg-purple-400 rounded-full mr-2 sm:mr-3"></span>
                                Permainan
                            </a></li>
                            <li><a href="{{ route('tentang.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                                <span class="w-2 h-2 bg-blue-400 rounded-full mr-2 sm:mr-3"></span>
                                Tentang Kami
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-2 sm:mr-3"></span>
                                Kontak
                            </a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Kontak -->
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Kontak</h3>
                        <ul class="space-y-3 sm:space-y-4 text-gray-300 text-sm sm:text-base">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 sm:mr-3 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                info@literise.com
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 sm:mr-3 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                +62 812 3456 7890
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bagian bawah footer -->
                <div class="border-t border-gray-600 pt-6 sm:pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-xs sm:text-sm opacity-70 mb-3 sm:mb-0 text-center md:text-left">© 2025 Literise. Semua hak dilindungi.</p>
                    <div class="flex space-x-4 sm:space-x-6 text-xs sm:text-sm">
                        <a href="#" class="opacity-70 hover:opacity-100 transition-opacity hover:text-pink-300">Kebijakan Privasi</a>
                        <a href="#" class="opacity-70 hover:opacity-100 transition-opacity hover:text-pink-300">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- NEW: LOADING OVERLAY -->
    <div id="loading-overlay">
        <div class="spinner"></div>
        <p class="text-xl font-semibold mt-4">Memuat Permainan...</p>
        <p class="text-gray-300 mt-2">Tunggu sebentar ya!</p>
    </div>

    <!-- Script untuk AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Mobile menu toggle dengan hamburger animation
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburger = this;

            mobileMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Tutup mobile menu ketika mengklik link di dalamnya
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                const hamburger = document.getElementById('mobile-menu-button');

                mobileMenu.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Filter permainan berdasarkan kategori
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Hapus kelas active dari semua tombol
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Tambahkan kelas active ke tombol yang diklik
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');
                const gameCards = document.querySelectorAll('.game-card-improved');

                gameCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        const categories = card.getAttribute('data-category').split(' ');
                        if (categories.includes(filter)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#') && targetId.length > 1) {
                    e.preventDefault();

                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }

                    // Tutup mobile menu
                    const mobileMenu = document.getElementById('mobile-menu');
                    const hamburger = document.getElementById('mobile-menu-button');
                    mobileMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });
        });

        // Efek parallax sederhana
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax-element');

            parallaxElements.forEach(function(element) {
                const speed = 0.5;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // NEW: Loading animation hanya untuk tombol game (bukan untuk tombol CTA)
        document.querySelectorAll('.feature-card-button.loading-button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Jika tombol disabled (Segera Hadir), jangan lakukan apa-apa
                if (this.disabled) {
                    e.preventDefault();
                    return;
                }

                const loadingOverlay = document.getElementById('loading-overlay');
                loadingOverlay.style.display = 'flex';

                const originalText = this.innerHTML;

                // Tampilkan loading spinner di tombol
                this.innerHTML = '<span class="loading-spinner"></span>Memuat...';
                this.classList.add('loading');

                // Simulasi loading selama 2 detik
                setTimeout(() => {
                    // Kembalikan teks asli dan hapus kelas loading
                    this.innerHTML = originalText;
                    this.classList.remove('loading');

                    // Sembunyikan loading overlay
                    loadingOverlay.style.display = 'none';

                    // Lanjutkan ke halaman game
                    if (this.tagName === 'A') {
                        window.location.href = this.getAttribute('href');
                    }
                }, 2000);

                // Mencegah navigasi langsung untuk link
                if (this.tagName === 'A') {
                    e.preventDefault();
                }
            });
        });

        // NEW: Add floating particles for mobile
        function createMobileParticles() {
            if (window.innerWidth > 768) return;

            const particlesContainer = document.createElement('div');
            particlesContainer.className = 'particles-container';
            particlesContainer.style.position = 'fixed';
            particlesContainer.style.top = '0';
            particlesContainer.style.left = '0';
            particlesContainer.style.width = '100%';
            particlesContainer.style.height = '100%';
            particlesContainer.style.pointerEvents = 'none';
            particlesContainer.style.zIndex = '1';
            document.body.appendChild(particlesContainer);

            const colors = ['#ff6b6b', '#4ecdc4', '#8e2de2', '#f9c74f'];

            for (let i = 0; i < 10; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 8 + 4 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.position = 'absolute';
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = Math.random() * 100 + 'vh';
                particle.style.opacity = Math.random() * 0.4 + 0.1;

                particlesContainer.appendChild(particle);

                // Animasi partikel
                animateParticle(particle);
            }
        }

        function animateParticle(particle) {
            const duration = Math.random() * 8 + 6;
            const xMovement = Math.random() * 60 - 30;
            const yMovement = Math.random() * 60 - 30;

            particle.animate([
                { transform: 'translate(0, 0)' },
                { transform: `translate(${xMovement}vw, ${yMovement}vh)` }
            ], {
                duration: duration * 1000,
                iterations: Infinity,
                direction: 'alternate',
                easing: 'ease-in-out'
            });
        }

        // Jalankan saat halaman dimuat
        window.addEventListener('load', createMobileParticles);
        // 1. Setup Audio Context (Hanya dibuat sekali)
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

    // 2. Fungsi Membuat Suara "Click" Digital (Nol Delay)
    function playClickSound() {
        // Bangunkan Audio Context jika tertidur (kebijakan browser)
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }

        const oscillator = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();

        // Setting Nada: Mulai tinggi (800Hz) turun cepat ke (100Hz) -> Efek "Pluk"
        oscillator.type = 'sine';
        oscillator.frequency.setValueAtTime(800, audioCtx.currentTime);
        oscillator.frequency.exponentialRampToValueAtTime(100, audioCtx.currentTime + 0.1);

        // Setting Volume: Cepat hilang (Short decay)
        gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime); // Volume 30%
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.1);

        oscillator.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        oscillator.start();
        oscillator.stop(audioCtx.currentTime + 0.1);
    }

    // 3. Event Listener Spesifik Tombol
    document.addEventListener('DOMContentLoaded', function() {

        // Gunakan 'pointerdown' agar suara muncul SAAT JARI MENEMPEL (bukan saat dilepas)
        document.addEventListener('pointerdown', function(e) {

            // DAFTAR SELECTOR YANG DIANGGAP TOMBOL
            // Hanya elemen di dalam list ini yang akan bunyi
            const isButton = e.target.closest(`
                button,                 /* Semua tag <button> */
                .btn-game-3d,           /* Class tombol game Anda */
                .btn-game-secondary,    /* Class tombol secondary */
                .result-button,         /* Tombol di halaman hasil */
                .header-btn,            /* Tombol login/register di header */
                .feature-card-button,   /* Tombol di kartu fitur */
                .platform-btn,          /* Tombol sosmed di footer */
                .back-button,           /* Tombol kembali */
                .submit-button          /* Tombol kirim kuis */
                nav a,                 /* Link di navbar */
                .mobile-menu a         /* Link di mobile menu */
            `);

            // Jika yang ditekan adalah salah satu dari daftar di atas -> BUNYI
            if (isButton) {
                playClickSound();
            }
        });
    });
    </script>
</body>
</html>
