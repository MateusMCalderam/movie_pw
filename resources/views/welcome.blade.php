<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo | Netflix Clone</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css') <!-- Se estiver usando Vite -->
</head>
<body class="bg-black text-white">

    <!-- Background image overlay -->
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/00000000-0000-0000-0000-000000000000/00000000-0000-0000-0000-000000000000/BR-pt-20230807-popsignuptwoweeks-perspective_alpha_website_large.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <!-- Top Navbar -->
        <div class="relative z-10 px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-red-600">NETFLIX</h1>
            <div>
                <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                    Entrar
                </a>
            </div>
        </div>

        <!-- Welcome Text -->
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center px-4">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                Filmes, séries e muito mais. Sem limites.
            </h2>
            <p class="text-lg md:text-xl mb-6">
                Assista onde quiser. Cancele quando quiser.
            </p>

            <!-- Call to Action -->
            <div class="w-full max-w-2xl">
                <p class="text-md mb-4">Pronto para assistir? Informe seu email para criar ou reiniciar sua assinatura.</p>
                <form action="{{ route('register') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4">
                    <input type="email" name="email" placeholder="Email" required
                           class="w-full md:flex-1 px-4 py-3 rounded text-black focus:outline-none focus:ring-2 focus:ring-red-600">
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 font-semibold rounded">
                        Vamos lá &raquo;
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
