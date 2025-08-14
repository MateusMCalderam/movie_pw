<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Hero Icons -->
        <script src="https://unpkg.com/@heroicons/react@2.0.18/24/outline/esm/index.js"></script>
        <script src="https://unpkg.com/@heroicons/react@2.0.18/24/solid/esm/index.js"></script>
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

            body {
                font-family: 'Inter', sans-serif;
            }

            .movie-card {
                transition: all 0.3s ease;
                background: linear-gradient(145deg, #1f2937, #111111);
            }

            .movie-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }

            .genre-badge {
                background: linear-gradient(45deg, #dc2626, #991b1b);
                animation: pulse 2s infinite;
            }

            .hero-bg {
                background: linear-gradient(135deg, #000000 0%, #1f1f1f 50%, #2d2d2d 100%);
                position: relative;
                overflow: hidden;
            }

            .hero-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                pointer-events: none;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-20px);
                }
            }

            .spotlight {
                background: radial-gradient(circle at center, rgba(220, 38, 38, 0.3) 0%, transparent 70%);
                position: absolute;
                width: 400px;
                height: 400px;
                border-radius: 50%;
                pointer-events: none;
                animation: spotlight 8s linear infinite;
            }

            @keyframes spotlight {
                0% {
                    transform: translate(-50%, -50%) rotate(0deg);
                }
                100% {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }

            .film-strip {
                background: repeating-linear-gradient(90deg,
                        #2d2d2d 0px,
                        #2d2d2d 20px,
                        #1a1a1a 20px,
                        #1a1a1a 40px);
                height: 8px;
            }

            .glow-text {
                text-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
            }

            .rating-stars {
                background: linear-gradient(45deg, #f87171, #ef4444);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .movie-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 2rem;
            }

            .category-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .floating-animation {
                animation: float 6s ease-in-out infinite;
            }

            .admin-card {
                background: linear-gradient(145deg, #1f2937, #111111);
                border: 1px solid #374151;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            }

            .admin-button {
                background: linear-gradient(45deg, #dc2626, #991b1b);
                border: none;
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            }

            .admin-button:hover {
                background: linear-gradient(45deg, #b91c1c, #7f1d1d);
                box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            }

            .admin-table {
                background: linear-gradient(145deg, #1f2937, #111111);
            }

            .admin-table th {
                background: linear-gradient(45deg, #374151, #1f2937);
                border-bottom: 2px solid #4b5563;
            }

            .admin-table td {
                border-bottom: 1px solid #374151;
            }

            .auth-card {
                background: linear-gradient(145deg, #1f2937, #111111);
                border: 1px solid #374151;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            }

            .auth-input {
                background: rgba(31, 41, 55, 0.5);
                border: 1px solid #4b5563;
                transition: all 0.3s ease;
            }

            .auth-input:focus {
                background: rgba(31, 41, 55, 0.8);
                border-color: #dc2626;
                box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            }

            .icon-button {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s ease;
            }

            .icon-button:hover {
                transform: translateY(-1px);
            }

            .trailer-preview {
                position: relative;
                width: 100%;
                height: 0;
                padding-bottom: 56.25%; /* 16:9 aspect ratio */
                background: #1f2937;
                border-radius: 0.5rem;
                overflow: hidden;
            }

            .trailer-preview iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
            }

            .trailer-placeholder {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: linear-gradient(145deg, #374151, #1f2937);
                color: #9ca3af;
            }

            .emoji-card {
                background: linear-gradient(145deg, #1f2937, #111111);
                border: 1px solid #374151;
                border-radius: 1rem;
                padding: 1.5rem;
                text-align: center;
                transition: all 0.3s ease;
            }

            .emoji-card:hover {
                transform: translateY(-4px);
                border-color: #dc2626;
                box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
            }

            .emoji-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                display: block;
            }
        </style>
    </head>
    <body class="bg-black">
        <div class="min-h-screen bg-black">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-black/80 backdrop-blur-md border-b border-gray-800 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
