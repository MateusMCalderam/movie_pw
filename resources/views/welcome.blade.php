<script src="https://cdn.tailwindcss.com"></script>
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
</style>

<body class="bg-black text-white">
    <header class="bg-black/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="text-3xl font-bold glow-text">🎬 Infoflix</div>
                    <div class="film-strip w-20 hidden md:block"></div>
                </div>
                <nav class="flex justify-center align-center space-x-6 text-gray-300">
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors my-auto">Início</a>
                    <a href="#featured" class="hover:text-red-500 transition-colors my-auto">Filmes</a>
                    <a href="#categories" class="hover:text-red-500 transition-colors my-auto">Gêneros</a>
                    <a href="{{ route('login') }}" class="hover:text-red-500 transition-colors my-auto">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-700 to-red-500 px-4 py-2 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25 my-auto">
                        Criar Conta
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <section id="home" class="hero-bg min-h-screen flex items-center justify-center relative">
        <div class="spotlight top-1/4 left-1/4"></div>
        <div class="spotlight top-3/4 right-1/4" style="animation-delay: -4s;"></div>

        <div class="text-center z-10 max-w-4xl mx-auto px-6">
            <h1 class="text-7xl font-bold mb-6 glow-text floating-animation">
                Bem-vindo ao Infoflix
            </h1>
            <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                Explore o mundo do cinema com estilo. Dos clássicos aos mais recentes sucessos de bilheteria.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-700 to-red-500 px-8 py-4 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                    Começar a Explorar
                </a>
                <a href="#featured" class="border-2 border-white/20 px-8 py-4 rounded-full font-semibold hover:bg-white/10 transition-all duration-300">
                    Ver Filmes em Destaque
                </a>
            </div>
        </div>
    </section>

    @if(isset($featuredMovies) && $featuredMovies->count() > 0)
        <section id="featured" class="py-20 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-bold text-white mb-12 text-center glow-text">
                    Filmes em Destaque 🎭
                </h2>
                <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">
                    Descubra os filmes mais populares e aclamados da plataforma
                </p>
                <div class="movie-grid">
                    @foreach($featuredMovies as $movie)
                        <div class="movie-card rounded-xl overflow-hidden border border-gray-700">
                            @if($movie->cover_image)
                                <img src="{{ getCoverUrl($movie->cover_image) }}" alt="{{ $movie->name }}" class="w-full h-80 object-cover">
                            @else
                                <div class="w-full h-80 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                    <span class="text-6xl">🎬</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $movie->name }}</h3>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                        {{ $movie->year }}
                                    </span>
                                    @if($movie->categories->count() > 0)
                                        <span class="text-sm text-gray-400">{{ $movie->categories->first()->name }}</span>
                                    @endif
                                </div>
                                @if($movie->synopsis)
                                    <p class="text-gray-400 text-sm line-clamp-3">{{ Str::limit($movie->synopsis, 120) }}</p>
                                @endif
                                <div class="mt-4">
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                        Criar Conta para Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-700 to-red-500 px-8 py-4 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                        Ver Todos os Filmes
                    </a>
                </div>
            </div>
        </section>
    @endif

    @if(isset($categories) && $categories->count() > 0)
        <section id="categories" class="py-20 px-6 bg-gray-900/50">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-bold text-white mb-12 text-center glow-text">
                    Gêneros 🏷️
                </h2>
                <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">
                    Explore filmes por gênero e encontre exatamente o que você procura
                </p>
                <div class="category-grid">
                    @foreach($categories as $category)
                        <div class="movie-card rounded-xl p-6 text-center hover:border-red-500/50 transition-all duration-300">
                            <div class="text-4xl mb-4">🎭</div>
                            <h3 class="text-xl font-bold text-white mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4">{{ $category->movies_count }} filmes</p>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-red-600/20 text-red-400 text-sm font-medium rounded-lg border border-red-500/30 hover:bg-red-600/30 hover:border-red-500/50 transition-all duration-200">
                                Explorar
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-6 glow-text">
                Pronto para Começar? 🚀
            </h2>
            <p class="text-xl text-gray-400 mb-8">
                Junte-se a milhares de usuários que já descobriram filmes incríveis no Infoflix
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-700 to-red-500 px-8 py-4 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                    Criar Conta Gratuita
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white/20 px-8 py-4 rounded-full font-semibold hover:bg-white/10 transition-all duration-300">
                    Já Tenho Conta
                </a>
            </div>
        </div>
    </section>
</body>