<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl glow-text">
            🎬 {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 hero-bg min-h-[60vh] flex items-center justify-center relative">
        <!-- Efeitos Spotlight -->
        <div class="spotlight top-1/3 left-1/4"></div>
        <div class="spotlight top-2/3 right-1/4" style="animation-delay: -4s;"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="movie-card overflow-hidden shadow-xl sm:rounded-lg p-8 text-center">
                <h3 class="text-2xl font-semibold mb-4 text-white">
                    {{ __("You're logged in!") }}
                </h3>
                <p class="text-gray-400 mb-6">
                    Bem-vindo ao painel! Explore seus filmes, categorias e muito mais.
                </p>
                <a href="{{ route('movies.index') }}" class="bg-gradient-to-r from-red-700 to-red-500 px-6 py-3 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                    Ir para Filmes
                </a>
            </div>
        </div>
    </div>

    <style>
        .hero-bg {
            background: linear-gradient(135deg, #000000 0%, #1f1f1f 50%, #2d2d2d 100%);
            position: relative;
            overflow: hidden;
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
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        .movie-card {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #1f2937, #111111);
            border: 1px solid rgba(255,255,255,0.05);
        }
        .movie-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(220, 38, 38, 0.4);
        }
        .glow-text {
            text-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
            color: #fff;
        }
    </style>
</x-app-layout>
